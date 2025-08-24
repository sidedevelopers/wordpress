<?php
// Rename "Regular Price" to "MRP" in WooCommerce admin only
add_filter('woocommerce_get_price_html', 'custom_admin_regular_price_label', 10, 2);
add_action('admin_enqueue_scripts', 'custom_change_regular_price_label_admin');

function custom_change_regular_price_label_admin() {
    if (!is_admin()) return;

    add_filter('gettext', 'rename_regular_price_admin', 100, 3);
    add_filter('ngettext', 'rename_regular_price_admin', 100, 3);
}

function rename_regular_price_admin($translated, $text, $domain) {
    if (is_admin() && $domain === 'woocommerce') {
        if ($text === 'Regular price') {
            $translated = 'MRP';
        }
        if ($text === 'Regular price (%s)') {
            $translated = 'MRP (%s)';
        }
    }
    return $translated;
}
?>