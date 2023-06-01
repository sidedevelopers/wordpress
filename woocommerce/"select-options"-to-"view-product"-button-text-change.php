<!-- To change the button text "Select Options" to "View Product" of a variable product -->
function change_select_options_text($text) {
    global $product;

    if ($product && $product->is_type('variable')) {
        $text = __('View Product', 'woocommerce');
    }

    return $text;
}
add_filter('woocommerce_product_add_to_cart_text', 'change_select_options_text');
add_filter('woocommerce_product_single_add_to_cart_text', 'change_select_options_text');