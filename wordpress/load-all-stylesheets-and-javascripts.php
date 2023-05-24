<?php

//Load All Stylesheets & Javascripts
function load_stylesheets()
{
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), microtime(), 'all');
    wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('owl', get_template_directory_uri() . '/assets/OwlCarousel/dist/assets/owl.carousel.css', array(), microtime(), 'all');
    wp_enqueue_style('owl-theme', get_template_directory_uri() . '/assets/OwlCarousel/dist/assets/owl.theme.default.css', array(), microtime(), 'all');
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/main-css/main.css', false, microtime(), 'all');
    wp_enqueue_style('main_style', get_stylesheet_uri());

    //Jquery version Load by wordpress default 
    wp_enqueue_script('jquery', '//code.jquery.com/jquery-3.6.4.min.js', array( 'jquery' ), microtime(), true);
    wp_enqueue_script('owl-js', get_template_directory_uri() . '/assets/OwlCarousel/dist/owl.carousel.js', null, microtime(), true);
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', null, microtime(), true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/main-js/main.js', null, microtime(), true);
}
add_action('wp_enqueue_scripts', 'load_stylesheets');

//For Load Jquery custom version
wp_deregister_script('jquery');
wp_enqueue_script('jquery', '//code.jquery.com/jquery-3.6.4.min.js', '1.0', true);

// ##############################################################################

// https://developer.wordpress.org/themes/basics/including-css-javascript/

// Stylesheet Syntax
wp_enqueue_style( $handle, $src, $deps, $ver, $media );

// $handle is simply the name of the stylesheet.
// $src is where it is located. The rest of the parameters are optional.
// $deps refers to whether or not this stylesheet is dependent on another stylesheet. If this is set, this stylesheet will not be loaded unless its dependent stylesheet is loaded first.
// $ver sets the version number.
// $media can specify which type of media to load this stylesheet in, such as ‘all’, ‘screen’, ‘print’ or ‘handheld.’

//Script Syntax
wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer);

// $handle is the name for the script.
// $src defines where the script is located.
// $deps is an array that can handle any script that your new script depends on, such as jQuery.
// $ver lets you list a version number.
// $in_footer is a boolean parameter (true/false) that allows you to place your scripts in the footer of your HTML document rather then in the header, so that it does not delay the loading of the DOM tree.