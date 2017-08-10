<?php
/*
Plugin Name: Woobizz Hook 1 
Plugin URI: http://woobizz.com
Description: Hide coupon on checkout page
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.1
Text Domain: woobizzhook1
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook1_load_textdomain' );
function woobizzhook1_load_textdomain() {
  load_plugin_textdomain( 'woobizzhook1', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
    add_filter( 'woocommerce_coupons_enabled', 'woobizzhook1_hide' );
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook1_admin_notice' );
}
//Add Hook 1
function woobizzhook1_hide( $enabled ) {
	if ( is_checkout() ) {
		$enabled = false;
	}
	return $enabled;
}
//Hook1 Notice
function woobizzhook1_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 1 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook1' ); ?></p>
    </div>
    <?php
}