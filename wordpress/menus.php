<!-- Footer1 Menu start -->
<?php
    wp_nav_menu(array(
        'theme_location' => 'Footer1',
        'container' => 'false',
        'menu_class' => 'footer-ul',
    ));
?>
<!-- Footer1 Menu End -->

<!-- ########################################################### -->

<?php
// Add the "nav-link" class to custom menu items
function add_nav_link_class($atts, $item, $args) {
    if ($args->theme_location == 'MainMenu') {
        $atts['class'] = 'nav-link';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_nav_link_class', 10, 3);

// Add the "nav-item" class to custom menu items
function add_nav_item_class($classes, $item, $args, $depth) {
    if ($args->theme_location == 'MainMenu') {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_nav_item_class', 10, 4);

?>