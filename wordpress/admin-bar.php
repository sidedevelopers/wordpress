<?php

// Hide the toolbar for subscribers users
function hide_admin_toolbar() {
    if (current_user_can('subscriber')) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'hide_admin_toolbar');

// #######################################################

// Hide the toolbar for all users with also administrator
add_filter('show_admin_bar', '__return_false');
