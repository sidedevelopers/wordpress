<?php

//auto update cart on quantity change in cart page start
add_action('wp_footer', 'cart_update_qty_script');
function cart_update_qty_script()
{
    if (is_cart()):
        ?>
<script>
jQuery('div.woocommerce').on('change', '.qty', function() {
    jQuery("[name='update_cart']").removeAttr('disabled');
    jQuery("[name='update_cart']").trigger("click");
});
</script>
<?php
    endif;
}
//auto update cart on quantity change in cart page end

?>