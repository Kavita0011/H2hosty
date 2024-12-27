<?php

/*
Plugin Name: Short-url Plugin
Plugin URI: https://example.com
Description: A custom plugin to track user.
Version: 1.0
Author: Kavita Bisht
Author URI: https://example.com
License: GPLv2 or later
*/

// Plugin activation function
function plugin_activate() {
    global $wpdb;

    $table_prefix = $wpdb->prefix;

    // Define table names with prefix
    $shorturls_table = $table_prefix . 'shorturls';
    $shorturl_tracking_table = $table_prefix . 'shorturl_tracking';

    // Query to create the 'shorturl_tracking' table
    $query1 = "CREATE TABLE IF NOT EXISTS `$shorturls_table` (
        id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        linkalias VARCHAR(8) NOT NULL UNIQUE,
        longurl TEXT NOT NULL,
        shorturl TEXT NOT NULL,
        clicks INT(11) DEFAULT 0,
        status TINYINT(1) DEFAULT 1,
        created DATETIME DEFAULT CURRENT_TIMESTAMP
    );";

    // Query to create the 'shorturls' table
    $query2 = "CREATE TABLE IF NOT EXISTS `$shorturl_tracking_table` (
        id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        link_id BIGINT(20) UNSIGNED NOT NULL,
        ip VARCHAR(45) NOT NULL,
        country VARCHAR(100),
        referral TEXT,
        user_agent TEXT,
        created DATETIME DEFAULT CURRENT_TIMESTAMP
    );";

    // Execute the queries to create the tables
    $wpdb->query($query1);
    $wpdb->query($query2);
}

// Plugin deactivation function
function plugin_deactivate() {
    global $wpdb,$table_prefix;

    $table_prefix = $wpdb->prefix;

    // Define table names with prefix
    $shorturls_table = $table_prefix . 'shorturls';
    $shorturl_tracking_table = $table_prefix . 'shorturl_tracking';

    // Drop the tables
    $wpdb->query(" TRUNCATE `$shorturls_table`");
    $wpdb->query("TRUNCATE `$shorturl_tracking_table`");

   }

// Register activation and deactivation hooks
register_activation_hook( __FILE__, 'plugin_activate' );
register_deactivation_hook( __FILE__, 'plugin_deactivate' );

// Hook into admin menu to add submenu
add_action('admin_menu', 'create_short_url_menu');

function create_short_url_menu() {
    // Top-level menu
    add_menu_page(
        'Short URL',             
        'Short URL',             
        'manage_options',        
        'short-url-dashboard',    
        'short_url_dashboard_page',
        'dashicons-admin-links',  
        6                         
    );

    // Sub-menu: Dashboard
    add_submenu_page(
        'short-url-dashboard', 
        'Dashboard',            
        'Dashboard',            
        'manage_options',       
        'short-url-dashboard',   
        'short_url_dashboard_page' 
        );

    // Sub-menu: Tracking
    add_submenu_page(
        'short-url-dashboard',    
        'Tracking',                
        'Tracking',
        'manage_options',        
        'short-url-tracking',     
        'short_url_tracking_page'  
    );
}

// Callback function for Dashboard page
function short_url_dashboard_page() {
    include "content.php";
    echo '</div>';
}

// Callback function for Tracking page
function short_url_tracking_page() {
    echo '<div class="wrap"><h1>Short URL Tracking</h1>';
    echo '<p>Here you can view the tracking data for your shortened URLs.</p>';
    // Add tracking details or functionality here
    echo '</div>';
}

function show_data() {
    global $wpdb, $table_prefix;

    // Define the table name
    $table_name = $table_prefix . 'shorturls';

    // Set pagination variables
    $rows_per_page = 10; // Number of rows per page
    $current_page = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
    $offset = ($current_page - 1) * $rows_per_page;

    // Fetch total number of entries
    $total_entries = $wpdb->get_var("SELECT COUNT(*) FROM `$table_name`");

    // Fetch data for the current page
    $results = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM `$table_name` LIMIT %d OFFSET %d", $rows_per_page, $offset)
    );

    // Start output buffering
    ob_start();
    ?>
    <h1>Shorten urls</h1>
    <?php if (!empty($results)) { ?>
       <?php echo '<table class="" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Alias</th>
                <th>Short URL</th>
                <th>Long URL</th>
                <th>Clicks</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($results as $url) {
        echo '<tr>
            <td>' . esc_html($url->id) . '</td>
            <td>' . esc_html($url->linkalias) . '</td>
            <td>' . site_url('/' . esc_html($url->linkalias)) . '</td>
            <td>' . esc_html($url->longurl) . '</td>
            <td>' . esc_html($url->clicks) . '</td>
            <td>' . ($url->status ? 'Active' : 'Inactive') . '</td>
        </tr>';
    }

    echo '</tbody></table> ';?>
        <p>Total entries: <?php echo esc_html($total_entries); ?></p>

        <?php
        // Pagination
        $total_pages = ceil($total_entries / $rows_per_page);

        if ($total_pages > 1) {
            echo '<div class="pagination">';
            for ($i = 1; $i <= $total_pages; $i++) {
                $current_url = add_query_arg('paged', $i);
                echo '<a href="' . esc_url($current_url) . '" style="margin: 0 5px; ' . ($i == $current_page ? 'font-weight: bold;' : '') . '">' . esc_html($i) . '</a>';
            }
            echo '</div>';
        }
        ?>
    <?php } else { ?>
        <p>No data found.</p>
    <?php } ?>

    <?php
    return ob_get_clean();
}



function short_url(){
    include "content.php";    
}
?>
