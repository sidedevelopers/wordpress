<!-- For only defined Blog Post or product page -->
<div class="text-center my-3">
    <?php echo paginate_links(); ?>
</div>

<!-- ############################################################## -->

<!-- For Custom Post type or Search Page -->

<?php

// Get the current page number
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Construct the query arguments
$args = array(
    'post_type' => 'post',
    'paged' => $paged,
);

// Generate pagination links
$pagination_args = array(
    'total' => $searchPosts->max_num_pages, // Total number of pages
    'current' => $paged, // Current page
);

?>

<div class="text-center my-3">
    <?php echo paginate_links($pagination_args); ?>
</div>

<style>
    .page-numbers {
        margin: 0px 4px;
        border: 1px solid var(--color-primary);
        padding: 4px 7px;
        background-color: var(--color-secondary);
    }
    .page-numbers:hover, .page-numbers.current {
        color: #fff;
        background-color: var(--color-primary);
    }
</style>