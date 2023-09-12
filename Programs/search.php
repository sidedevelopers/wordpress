<?php

//Used this for remove error undefined array key
//it takes empty value if not used
$search_term = '';
$localisation = '';
$category_name = '';
$publication_date = '';
$employment = '';
$career_level = '';

// Get the search parameters
if (isset($_GET['s'])) {
    $search_term = sanitize_text_field($_GET['s']);
}
if (isset($_GET['localisation'])) {
    $localisation = sanitize_text_field($_GET['localisation']);
}
if (isset($_GET['category_name'])) {
    $category_name = sanitize_text_field($_GET['category_name']);
}
if (isset($_GET['publication_date'])) {
    $publication_date = sanitize_text_field($_GET['publication_date']);
}
if (isset($_GET['employment'])) {
    $employment = sanitize_text_field($_GET['employment']);
}
if (isset($_GET['career_level'])) {
    $career_level = sanitize_text_field($_GET['career_level']);
}

?>

<form method="GET" action="<?php echo site_url(); ?>">
                    
    <input type="text" name="s" value="<?php echo get_search_query() ?>" />

    <input type="text" name="localisation" value="<?php echo $localisation; ?>" />
    
    <select class="form-control search-control" name="category_name">

        <option value="">- - Choose Option - -</option>

        <?php
            //Fetch Categories
            $categories = get_categories(array(
                'parent' => 0,
            ));

            foreach ($categories as $category) {
                $category_id = $category->term_id;
                $category_name_1 = $category->name;
        ?>
                    <option value="<?php echo $category_name_1; ?>" <?php selected($category_name, $category_name_1);?>>
                        <?php echo $category_name_1; ?>
                    </option>

        <?php } wp_reset_postdata();?>

    </select>

    <select name="publication_date">
        
        <option value="">All</option>
        <option value="Last 24 hours" <?php selected($publication_date, 'Last 24 hours');?>>Last 24 hours</option>
        <option value="Last 7 days" <?php selected($publication_date, 'Last 7 days');?>>Last 7 days</option>
        <option value="Last 14 days" <?php selected($publication_date, 'Last 14 days');?>>Last 14 days</option>
        <option value="Last 30 days" <?php selected($publication_date, 'Last 30 days');?>>Last 30 days</option>

    </select>

    <input type="submit" class="btn btn-search px-5" value="Search" />

</form>

<?php

// Get the current page number
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Construct the query arguments
$args = array(
    'post_type' => 'post', // Replace with your custom post type if applicable
    's' => $search_term,
    'category_name' => $category_name,
    'meta_query' => array(),
    'paged' => $paged,
    // 'date_query' => array(),

    // 'meta_key' => 'publication_date',
    // 'meta_value' => array('2023-08-20', '2023-09-07'),
    // 'meta_compare' => 'BETWEEN',
    // 'meta_type' => 'DATE',
    
);

// Add location filter if provided
if (!empty($localisation)) {
    $args['meta_query'][] = array(

        'relation' => 'OR', // Use OR relationship for location name or zip code

        array(
            'key' => 'localisation', // Replace with your ACF field name
            'value' => $localisation,
            'compare' => 'LIKE', // You can adjust the comparison if needed
        ),
        array(
            'key' => 'zip_code', // Replace with your ACF field for zip code
            'value' => $localisation,
            'compare' => 'LIKE', // You can adjust the comparison if needed
        ),
    );
}

if (!empty($publication_date)) {

    if ($publication_date === 'Last 24 hours') {
        // Calculate the date 24 hours ago
        $start_date = date('Y-m-d', strtotime('-1 day'));
        $end_date = date('Y-m-d');
    } else if ($publication_date === 'Last 7 days') {
        // Calculate the date 7 days ago
       $start_date = date('Y-m-d', strtotime('-7 days'));
       $end_date = date('Y-m-d');
    } else if ($publication_date === 'Last 14 days') {
        // Calculate the date 14 days ago
        $start_date = date('Y-m-d', strtotime('-14 days'));
        $end_date = date('Y-m-d');
    } else if ($publication_date === 'Last 30 days') {
        // Calculate the date 30 days ago
        $start_date = date('Y-m-d', strtotime('-30 days'));
        $end_date = date('Y-m-d');
    } else {
        // Exact date comparison
        $start_date = $publication_date;
        $end_date = $publication_date;
    }

    $args['meta_query'][] = array(

        'relation' => 'AND',

        array(
            'key' => 'publication_date',
            'value' => $start_date,
            'compare' => '>=',
            'type' => 'DATE',
        ),
        array(
            'key' => 'publication_date',
            'value' => $end_date,
            'compare' => '<=',
            'type' => 'DATE',
        ),

    );

}

//     $args['date_query'][] = array(
//         'key' => 'publication_date',
//         'after' => $after,
//         'before' => $before,
//         'inclusive' => true,
//     );

if (!empty($employment)) {
    $args['meta_query'][] = array(
        'key' => 'type_of_employment',
        'value' => $employment,
        'compare' => 'LIKE', // Use '=' to compare exact dates
    );
}

if (!empty($career_level)) {
    $args['meta_query'][] = array(
        'key' => 'career_level',
        'value' => $career_level,
        'compare' => 'LIKE', // Use '=' to compare exact dates
    );
}

$searchPosts = new WP_Query($args);

if ($searchPosts->have_posts()) {
    while ($searchPosts->have_posts()) {
        $searchPosts->the_post();?>

                <?php get_template_part('template-parts/content', 'job-box');?>

                <?php }} else {
    echo 'No Jobs Found!';
}
wp_reset_postdata();?>


<div class="text-center my-3">

                    <?php
// Generate pagination links
$pagination_args = array(
    'total' => $searchPosts->max_num_pages, // Total number of pages
    'current' => $paged, // Current page
);
?>
                    <?php echo paginate_links($pagination_args); ?>
                </div>