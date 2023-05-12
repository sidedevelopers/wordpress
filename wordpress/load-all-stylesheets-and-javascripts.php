<?php

//Load All Stylesheets & Javascripts
function load_stylesheets()
{
    wp_enqueue_style('main_style', get_stylesheet_uri());
    wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), microtime(), 'all');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_register_style('main-css', get_template_directory_uri() . '/assets/main-css/main.css', array(), microtime(), 'all');
    wp_enqueue_style('main-css');
    wp_register_style('owl', get_template_directory_uri() . '/assets/OwlCarousel/dist/assets/owl.carousel.css', array(), microtime(), 'all');
    wp_enqueue_style('owl');
    wp_register_style('owl-theme', get_template_directory_uri() . '/assets/OwlCarousel/dist/assets/owl.theme.default.css', array(), microtime(), 'all');
    wp_enqueue_style('owl-theme');

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', '//code.jquery.com/jquery-3.6.0.min.js', microtime(), true);
    wp_enqueue_script('owl-js', get_template_directory_uri() . '/assets/OwlCarousel/dist/owl.carousel.js', null, microtime(), true);
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', null, microtime(), true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/main-js/main.js', null, microtime(), true);
}
add_action('wp_enqueue_scripts', 'load_stylesheets');