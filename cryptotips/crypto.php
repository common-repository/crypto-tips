<?php
/*
Plugin Name: Crypto tips
Description: Plugin to receive tips in differenct cryptocurrenies
Version: 1.0
Author: Michael Buhl
License: GPL2
*/

	global $wp_query;
  	global $wpdb;
include'jsonRPCclient.php';


require_once('crypto-installer.php');
require_once('crypto-admin.php');
require_once('crypto-newpost.php');
require_once('crypto-userpage.php');


/* Runs when plugin is activated */
register_activation_hook(__FILE__,'crypto_plugin_install'); 

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'crypto_plugin_remove' );

add_action('admin_menu', 'crypto_add_admin_menu');

add_filter('the_content', 'crypto_show_post');  
add_action('show_user_profile', 'crypto_add_extra_profile_fields');
add_action( 'edit_user_profile', 'crypto_add_extra_profile_fields' );
add_action( 'personal_options_update', 'crypto_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'crypto_save_custom_user_profile_fields' );
?>