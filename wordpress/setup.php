<?php

//Load All Stylesheets & Javascripts
function load_stylesheets()
{
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), microtime(), 'all');
    wp_enqueue_style('themify-css', get_template_directory_uri() . '/assets/themify-icons/themify-icons.css', array(), microtime(), 'all');
    wp_enqueue_style('font-awesome-css', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('owl-css', get_template_directory_uri() . '/assets/OwlCarousel/dist/assets/owl.carousel.css', array(), microtime(), 'all');
    wp_enqueue_style('owl-theme-css', get_template_directory_uri() . '/assets/OwlCarousel/dist/assets/owl.theme.default.css', array(), microtime(), 'all');
    wp_enqueue_style('slick-css', get_template_directory_uri() . '/assets/slick/slick/slick.css', array(), microtime(), 'all');
    wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/assets/slick/slick/slick-theme.css', array(), microtime(), 'all');
    wp_enqueue_style('aos-css', get_template_directory_uri() . '/assets/aos/dist/aos.css', array(), microtime(), 'all');
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/main-css/main.css', false, microtime(), 'all');
    wp_enqueue_style('main-woo-css', get_template_directory_uri() . '/assets/main-css/main-woo.css', false, microtime(), 'all');
    wp_enqueue_style('main_style', get_stylesheet_uri());

    //For Load Jquery custom version
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', '//code.jquery.com/jquery-3.7.1.min.js', '1.0', true);
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', null, microtime(), true);
    wp_enqueue_script('owl-js', get_template_directory_uri() . '/assets/OwlCarousel/dist/owl.carousel.js', null, microtime(), true);
    wp_enqueue_script('slick-js', get_template_directory_uri() . '/assets/slick/slick/slick.min.js', null, microtime(), true);
    wp_enqueue_script('aos-js', get_template_directory_uri() . '/assets/aos/dist/aos.js', null, microtime(), true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/main-js/main.js', null, microtime(), true);
}
add_action('wp_enqueue_scripts', 'load_stylesheets');


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
}
add_action('after_setup_theme', 'themes_support');


//Add Menus
function dynamic_menu()
{
    register_nav_menu('MainMenu', 'Main Menu');
    register_nav_menu('Footer1', 'footer1 Menu');
    register_nav_menu('Footer2', 'footer2 Menu');
    register_nav_menu('Footer3', 'footer3 Menu');
    register_nav_menu('Footer4', 'footer4 Menu');
    register_nav_menu('Footer5', 'footer5 Menu');
    register_nav_menu('Footer6', 'footer6 Menu');
    register_nav_menu('Footer7', 'footer7 Menu');
}
add_action('after_setup_theme', 'dynamic_menu');


//change login logo
function change_login_logo() {
    ?>
    
    <style type="text/css">
        #login h1 a {
            background-image: url('<?php echo site_url(); ?>/wp-content/uploads/2023/07/golden-mystique.png');
            height: 100px;
            width: 270px;
            background-size: 210px 110px;
            background-repeat: no-repeat;
            padding-bottom: 10px;
        }
    </style>
    
    <?php
}
    add_action( 'login_enqueue_scripts', 'change_login_logo' );
        
//chnage login logo url
function custom_login_logo_url() {
    return site_url();
}
add_filter('login_headerurl', 'custom_login_logo_url');
    
//add css for admin
add_action('admin_head', 'my_admin_css');
function my_admin_css() {
    echo '<style>
        li#wp-admin-bar-wp-logo {
            display: none;
        }
        div#wpfooter {
            display: none;
        }
    </style>';
}