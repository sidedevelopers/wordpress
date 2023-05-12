// Add themes Supports
function themes_support()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    add_image_size( 'homepage-thumb', 400, 280, true );
}
add_action('after_setup_theme', 'themes_support'); 