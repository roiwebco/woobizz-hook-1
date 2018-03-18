<?php
/*
Plugin Name: Woobizz Hook 1 
Plugin URI: http://woobizz.com
Description: Hide coupon on checkout page
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.3
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
	add_action( 'woocommerce_before_checkout_form', 'woobizzhook1_remove_checkout_coupon_form', 9 );
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook1_admin_notice' );
}
//Hook1 Notice
function woobizzhook1_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz hook 1 needs woocommerce to work properly, please install and activate woocommerce or disable this plugin.', 'woobizzhook1' ); ?></p>
    </div>
    <?php
}
//Add Hook 1
function woobizzhook1_remove_checkout_coupon_form(){
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
}
