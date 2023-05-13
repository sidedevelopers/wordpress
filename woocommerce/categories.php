<?php

    //Show Empty WooCommerce Product Categories
    add_filter( 'woocommerce_product_subcategories_hide_empty', '__return_false' );

?>

<!-- ################################################################################# -->

<?php

    //Fetch Categories
	$categories = get_categories(array(
	    'orderby' => 'name',
		'order'   => 'DESC' or 'ASC',
		'taxonomy' => 'product_cat',
        'hide_empty' => false,
		'parent' => 0 //For Fetch only parent categories
	));

	foreach($categories as $category) {

        $category_id = $category->term_id;
        $image_id = get_term_meta($category_id, 'thumbnail_id', true);
        $image_url = wp_get_attachment_url($image_id);

    ?>

    <a href="<?php echo get_category_link($category_id); ?>">
        <img src="<?php echo $image_url; ?>" />
        <h5><?php echo $category->name; ?></h5>
    </a>

<?php } wp_reset_postdata(); ?>

<!-- ################################################################################# -->