<?php

    //Normally Blog Code Fetch
    while(have_posts()){
        the_post(); ?>
        <img src="<?php the_post_thumbnail_url(); ?>">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php the_excerpt(); ?> <!-- use echo get_the_excerpt() for remove p tag at time of fetch -->
        <?php the_content(); ?>
        <?php echo wp_trim_words(get_the_content(), 14); ?>
        
<?php } wp_reset_postdata(); ?>

<!-- ################################################################################# -->

<?php

    //Fetch Product or Custom Post Type
    $homepagePosts = new WP_Query(array(
        'post_type' => 'post' or 'page' or 'product',
        'category_name' => 'Awards', //For blog post or custom post type category
        'product_cat' => 'Best Sellers', //For woocommerce products category
        'posts_per_page' => 3,
        'order' => 'ASC' or 'DESC',
        'post__not_in' => array( get_the_ID() ), //single.php post is not = current post 
    ));
    while($homepagePosts->have_posts()){
    $homepagePosts->the_post(); ?>

<?php } wp_reset_postdata(); ?>

<!-- ################################################################################# -->

    <!-- Fetch Author Name & Link -->
    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>">By <?php the_author(); ?></a>

    <!-- Fetch Date & Link -->
    <a href="<?php echo esc_url( get_day_link( get_the_date('Y'), get_the_date('m'), get_the_date('d') ) ); ?>" title="<?php echo get_the_date('d M Y'); ?>"><?php echo get_the_date('d M Y'); ?></a>

