<?php
// Add a custom notice to the Plugins and Updates pages
function custom_admin_notice() {
    $screen = get_current_screen();

    // Check if the current screen is the Plugins or Updates page
    if ($screen && ($screen->id === 'plugins' || $screen->id === 'update-core')) {
        ?>
        <div class="notice notice-info is-dismissible">
            <p><?php _e('Please Do not update plugin Advanced Custom Fields - Recommended By Python Web Services', 'text-domain'); ?></p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'custom_admin_notice');