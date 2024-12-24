<?php
/*
Plugin Name: Custom-form
Plugin URI: https://example.com
Description: A custom form which takes data from user and stores data in database also shows data in table.
Version: 1.0
Author: Kavita Bisht
Author URI: https://example.com
License: GPLv2 or later
*/
if ( ! defined( 'ABSPATH' ) ) {
	header('Location : /H2Hosty');
exit;
}
function custom_form_activation(){
  global $wpdb,$table_prefix;
    // echo "plugin-activate";
}

function custom_form_deactivation(){
    echo "plugin deactviate";
}
register_activation_hook( __FILE__, "custom_form_activation" );
register_deactivation_hook( __FILE__, "custom_form_deactivation" );


?>