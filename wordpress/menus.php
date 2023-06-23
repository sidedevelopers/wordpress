<?php

//Add Menus
function dynamic_menu()
{
    register_nav_menu('MainMenu', 'Main Menu');
    register_nav_menu('Footer1', 'footer1 Menu');
    register_nav_menu('Footer2', 'footer2 Menu');
    register_nav_menu('Footer3', 'footer3 Menu');
    register_nav_menu('Footer4', 'footer4 Menu');
    register_nav_menu('Footer5', 'footer5 Menu');
}
add_action('after_setup_theme', 'dynamic_menu');

?>

<!-- ########################################################### -->

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