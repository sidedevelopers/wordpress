<!-- # Load With Bootstrap Spinner  -->
<?php
// Disable default WooCommerce pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

// Handle AJAX on PHP Side
function load_more_products_ajax() {

    $paged = (isset($_POST['page'])) ? intval($_POST['page']) : 1;

    $args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'paged'          => $paged,
        'posts_per_page' => get_option('posts_per_page'),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            wc_get_template_part('content', 'product');
        endwhile;
    endif;

    wp_die();
}
add_action('wp_ajax_load_more_products', 'load_more_products_ajax');
add_action('wp_ajax_nopriv_load_more_products', 'load_more_products_ajax');


// Pass Variables to JS
function enqueue_infinite_scroll_scripts() {
    wp_enqueue_script(
        'infinite-scroll',
        get_stylesheet_directory_uri() . '/inc/infinite-scroll.js',
        array('jquery'),
        '1.0',
        true
    );

    global $wp_query;

    wp_localize_script('infinite-scroll', 'woocommerce_params', array(
        'ajax_url'   => admin_url('admin-ajax.php'),
        'max_pages'  => $wp_query->max_num_pages,
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_infinite_scroll_scripts');

?>

<!-- # Create infinite-scroll.js in your theme's js/ folder: -->
<script>
    jQuery(function($) {
        
        let page = 2;
        let loading = false;
        const maxPages = parseInt(woocommerce_params.max_pages);

        function loadMoreProducts() {
            
            if (loading || page > maxPages) return;
            loading = true;

            $('#infinite-loader').show(); // show spinner

            $.ajax({
                url: woocommerce_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'load_more_products',
                    page: page,
                },
                success: function(response) {
                    if (response) {
                        $('.products').append(response);
                        page++;
                    }
                    loading = false;
                    $('#infinite-loader').hide(); // hide spinner
                },
                error: function() {
                    loading = false;
                    $('#infinite-loader').hide(); // hide spinner on error
                }
            });
        }

        // Auto-load products on scroll
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
                loadMoreProducts();
            }
        });
    });
</script>

<!-- In your archive-product.php, place this after the product loop after woocommerce_product_loop_end(); -->
<div id="infinite-loader" style="display:none; text-align:center; padding:20px;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>


<!-- -------------------------------------------------------------------------------------------------------------- -->

# Load Without Spinner or Any Loader

<?php
// Disable default WooCommerce pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

//upar declare ho chuka hai ye function isliye error show kar raha hai
function load_more_products_ajax() { 
    $paged = (isset($_POST['page'])) ? intval($_POST['page']) : 1;

    $args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'paged'          => $paged,
        'posts_per_page' => get_option('posts_per_page'),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            wc_get_template_part('content', 'product');
        endwhile;
    endif;

    wp_die();
}
add_action('wp_ajax_load_more_products', 'load_more_products_ajax');
add_action('wp_ajax_nopriv_load_more_products', 'load_more_products_ajax');


function enqueue_infinite_scroll_scripts() {
    wp_enqueue_script(
        'infinite-scroll',
        get_stylesheet_directory_uri() . '/js/infinite-scroll.js',
        array('jquery'),
        '1.0',
        true
    );

    global $wp_query;

    wp_localize_script('infinite-scroll', 'woocommerce_params', array(
        'ajax_url'   => admin_url('admin-ajax.php'),
        'max_pages'  => $wp_query->max_num_pages,
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_infinite_scroll_scripts');

?>

<script>
jQuery(function($) {
    let page = 2;
    let loading = false;
    const maxPages = parseInt(woocommerce_params.max_pages);

    function loadMoreProducts() {
        if (loading || page > maxPages) return;
        loading = true;

        $.ajax({
            url: woocommerce_params.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_products',
                page: page,
            },
            success: function(response) {
                if (response) {
                    $('.products').append(response);
                    page++;
                    loading = false;
                }
            }
        });
    }

    // Trigger when scrolling near bottom
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
            loadMoreProducts();
        }
    });
});
</script>