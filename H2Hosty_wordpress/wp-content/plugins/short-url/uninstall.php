<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
die();
}
// drop table here
global $wpdb;

$table_prefix = $wpdb->prefix;

// Define table names with prefix
$shorturls_table = $table_prefix . 'shorturls';
$shorturl_tracking_table = $table_prefix . 'shorturl_tracking';

// Drop the tables
$wpdb->query("DROP TABLE IF EXISTS $shorturls_table");
$wpdb->query("DROP TABLE IF EXISTS $shorturl_tracking_table");
 ?>