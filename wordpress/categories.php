<!-- Filter For Fetch All Product Categories -->
<h5>Product Categories:</h5>
<ul class="mb-3">
    <?php
		$categories = get_terms( array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
		) );
		foreach ( $categories as $category ) {
		$category_id = $category->term_id;
	?>
    <li>
        <a href="<?php echo get_category_link($category_id); ?>">
            <?php echo esc_html($category->name); ?>
        </a>
    </li>
    <?php } ?>
</ul>

<!-- ################################################################################# -->

<!-- Fetch Category in loop -->
<?php
	// Get the category name
    $categories = get_the_category();
    if ($categories) {
	    foreach( $categories as $category ) {
			$category_id = $category->term_id;
?>
<a href="<?php echo get_category_link($category_id); ?>">
    <span class="badge mb-3"><?php echo esc_html($category->name); ?></span>
</a>
<?php
		}
	}
?>

<!-- ################################################################################# -->

=> N.B.

=> For First category fetch use echo $category[0]->name;

=> For hide last , comma
.single-category a:last-child span {
    display: none;
}

<!-- ################################################################################# -->