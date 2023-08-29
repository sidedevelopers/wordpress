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


function add_profile_page_for_subscribers() {
    add_menu_page(
        'Profile',           // Page title
        'Profile',           // Menu title
        'read',              // Capability (subscribers can read)
        'profile2',           // Page slug
        'render_profile_page'// Callback function to render the page
    );
}
add_action('admin_menu', 'add_profile_page_for_subscribers');

function render_profile_page() {
    ?>
    <div class="wrap">
        <h1>Welcome to Profile Page!</h1>
        <p>This is a page dedicated to profile for subscribers.</p>

        <?php

        $user_id = get_current_user_id();

        ?>



    </div>
    <?php
}
