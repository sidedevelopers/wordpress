<?php

// auto cart count refresh start
add_filter('woocommerce_add_to_cart_fragments', 'refresh_cart_count', 50, 1);
function refresh_cart_count($fragments)
{
    ob_start();
?>
<span class="cart-icon-value" id="cart-count"><?php
$cart_count = WC()->cart->get_cart_contents_count();
    echo sprintf(_n('%d', '%d', $cart_count), $cart_count);
?></span>
<?php
$fragments['#cart-count'] = ob_get_clean();
    return $fragments;
}
// auto cart count refresh end