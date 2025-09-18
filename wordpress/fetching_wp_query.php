<?php

    //Normally Blog Code Fetch
    while(have_posts()){
        the_post(); ?>
        <img src="<?php the_post_thumbnail_url(); ?>" />
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php the_excerpt(); ?> <!-- use echo "get_the_excerpt()" for remove p tag at time of fetch -->
        <?php the_content(); ?>
        <?php the_category(', '); ?> <!-- Fetch Category -->
        <?php echo wp_trim_words(get_the_content(), 14); ?>
        
<?php } wp_reset_postdata(); ?>

<!-- ################################################################################# -->

<?php
    $homepagePosts = new WP_Query(array(
        'post_type' => 'post' or 'page' or 'product',
        'category_name' => 'Awards', //For blog post or custom post type category
        'product_cat' => 'Best Sellers', //For woocommerce products category
        'posts_per_page' => 3,
        'order' => 'ASC' or 'DESC',
        'post__not_in' => array( get_the_ID() ), //single.php post is not = current post
        'post__in' => array(219, 65, 59, 213, 53, 49, 44),
		'orderby' => 'post__in',
    ));
    while($homepagePosts->have_posts()){
    $homepagePosts->the_post(); ?>

<?php } wp_reset_postdata(); ?>

<!-- ################################################################################# -->

<?php

if(!empty(get_the_content())){
    the_content();
}
if(!empty(get_the_post_thumbnail_url())){
    the_post_thumbnail_url();
}

?>

<!-- ################################################################################# -->

<!-- Fetch Author Name & Link -->
<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>">By <?php the_author(); ?></a>

<!-- Fetch Date & Link -->
<a href="<?php echo esc_url( get_day_link( get_the_date('Y'), get_the_date('m'), get_the_date('d') ) ); ?>" title="<?php echo get_the_date('d M Y'); ?>"><?php echo get_the_date('d M Y'); ?></a>

<!-- ################################################################################# -->

<?php the_time(); ?>

<?php
// Last Updated x minuted ago start
function altered_post_time_ago_function() {
    return ( get_the_time('U') >= strtotime('-1 week') ) ? sprintf( esc_html__( 'Last updated %s ago', 'textdomain' ), human_time_diff( get_the_time ( 'U' ), current_time( 'timestamp' ) ) ) : get_the_date();
    //After 1 week it prints the real date (-1 week)
}
add_filter( 'the_time', 'altered_post_time_ago_function' );
// Last Updated x minuted ago end
?>

<!-- ################################################################################# -->

<?php global $product; ?>
or 
<?php
// Get the product object
$product = wc_get_product(get_the_ID());
?>

<div class="price-div">

<?php
if ($product->is_on_sale()) {
    echo '<span class="regular-price text-decoration-line-through">₹' . $product->get_regular_price() . '</span>';
    echo '<span class="sale-price">₹' . $product->get_sale_price() . '</span>';
}
else{
    echo '<span class="sale-price">₹' . $product->get_regular_price() . '</span>';
}
?>
            
</div>

<!-- ################################################################################# -->