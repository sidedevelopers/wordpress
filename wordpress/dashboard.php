<?php

//Hide "Screen Options" Tab and "Help" Tab
function restrict_screen_options_for_subscribers() {
    if (current_user_can('subscriber')) {
        echo '<style>#screen-options-link-wrap, #contextual-help-link-wrap { display: none; }</style>';
    }
}
add_action('admin_head', 'restrict_screen_options_for_subscribers');


//Remove Widgets in Dashboard
function remove_dashboard_widgets_for_subscribers() {
    if (current_user_can('subscriber')) {
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // Quick Draft
        remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress Events and News
        remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // At a Glance
        remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // Activity
    }
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets_for_subscribers');