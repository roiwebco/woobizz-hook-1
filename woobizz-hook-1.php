<?php
/*
Plugin Name: Woobizz Hook 1 
Plugin URI: http://woobizz.com
Description: Hide coupon on checkout page
Author: WOOBIZZ.COM
Author URI: http://woobizz.com
Version: 1.0.4
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
//Add Hook 1
function woobizzhook1_remove_checkout_coupon_form(){
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
}
add_action( 'woocommerce_before_checkout_form', 'woobizzhook1_remove_checkout_coupon_form', 9 );

