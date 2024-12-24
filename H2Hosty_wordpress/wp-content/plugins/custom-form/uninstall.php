<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
die();
}
// drop table here

    global $wpdb;
    $wp_table = $wpdb->prefix . 'plugin_table';
    $wpdb->query("DROP TABLE IF EXISTS $wp_table");

 ?>