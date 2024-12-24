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
    $wp_table=$table_prefix .'custom_user';
    $query="CREATE TABLE `$wp_table` (`Id` INT(11) NOT NULL AUTO_INCREMENT , `Name` VARCHAR(255) NOT NULL , `Email` VARCHAR(255) NOT NULL , `Password` VARCHAR(30) NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;";
    $wpdb->query($query);
}

function custom_form_deactivation(){
  global $wpdb,$table_prefix;
  $wp_table=$table_prefix .'custom_user';
  $query="TRUNCATE `$wp_table`;";
  $wpdb->query($query);
  // echo "plugin deactviate";
}
register_activation_hook( __FILE__, "custom_form_activation" );
register_deactivation_hook( __FILE__, "custom_form_deactivation" );


?>