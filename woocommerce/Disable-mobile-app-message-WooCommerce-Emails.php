<?php
/**
 * Disable messages about the mobile apps in WooCommerce emails.
 * https://wordpress.org/support/topic/remove-process-your-orders-on-the-go-get-the-app/
 */
function mtp_disable_mobile_messaging( $mailer ) {
    remove_action( 'woocommerce_email_footer', array( $mailer->emails['WC_Email_New_Order'], 'mobile_messaging' ), 9 );
}
add_action( 'woocommerce_email', 'mtp_disable_mobile_messaging' );


// ------------------------------------------------------------------------------------------------------------------------


// By Business Blommer
// https://www.businessbloomer.com/woocommerce-remove-jetpack-ads-wp-dashboard/

add_action( 'woocommerce_email_footer', 'bbloomer_remove_get_the_app_ad', 8 );

function bbloomer_remove_get_the_app_ad() {
   $mailer = WC()->mailer()->get_emails();
   $object = $mailer['WC_Email_New_Order'];
   remove_action( 'woocommerce_email_footer', array( $object, 'mobile_messaging' ), 9 );
}