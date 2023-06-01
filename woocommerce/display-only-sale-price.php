<?php

// Display only sale price in variable product
function display_variable_product_sale_price($price, $product) {
    if ($product->is_type('variable')) {
        $min_price = $product->get_variation_price('min');
        $max_price = $product->get_variation_price('max');

        if ($min_price === $max_price) {
            $price = wc_price($min_price);
        } else {
            $price = wc_price($min_price);
        }
    }

    return $price;
}
add_filter('woocommerce_variable_price_html', 'display_variable_product_sale_price', 10, 2);

// #####################################################################

// You can change price fetch middle symbol like
$price = wc_price($min_price) . ' - ' . wc_price($max_price);