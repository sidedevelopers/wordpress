<?php $search_query = get_search_query(); ?>

<?php if (!empty($search_query)) { ?>

    <?php if (have_posts()) { ?>

    <!-- Search Content Here -->
    
    <?php } else { ?>
        <?php printf( esc_html__( 'Search Results for: %s', 'theuktimes' ), $search_query ); ?>
        Sorry, but nothing matched your search terms. Please try again with some different keywords.
    <?php } ?>

<?php } else { ?>
    Discover Breaking News!
<?php } ?>