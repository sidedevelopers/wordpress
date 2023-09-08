<h1><?php printf( esc_html__( 'Search Results for: %s', 'your-theme-textdomain' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

<?php if(have_posts()){ ?>

<?php
    while(have_posts()){
    the_post(); ?>

<?php  } wp_reset_postdata(); ?>

<div class="text-center my-3">
    <?php echo paginate_links(); ?>
</div>

<?php
    }
    else{
        echo '<h3>No Product Found!</h3>';
    }
?>