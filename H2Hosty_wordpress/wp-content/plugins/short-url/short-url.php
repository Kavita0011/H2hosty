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
    $query1 = "CREATE TABLE IF NOT EXISTS `$shorturl_tracking_table` (
        `Id` INT(11) NOT NULL AUTO_INCREMENT,
        `ip` VARCHAR(100) NOT NULL,
        `country` VARCHAR(100) NOT NULL,
        `referral` TEXT,
        `user_agent` TEXT,
        `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`Id`)
    );";

    // Query to create the 'shorturls' table
    $query2 = "CREATE TABLE IF NOT EXISTS `$shorturls_table` (
        `Id` INT(11) NOT NULL AUTO_INCREMENT,
        `linkalies` VARCHAR(8) NOT NULL UNIQUE,
        `longurl` TEXT NOT NULL,
        `clicks` INT(11) DEFAULT 0,
        `status` INT(1) DEFAULT 1,
        `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`Id`)
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
function add_menu(){
add_menu_page(
    "Short-url-page",
    "short-url",
    "manage_options",
    "shortUrl",
    "short_url"
);
}
function show_data() {
    global $wpdb, $table_prefix;

    // Define the table name
    $table_name = $table_prefix . 'custom_user';

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
    <h1>Submitted Data</h1>
    <?php if (!empty($results)) { ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row) { ?>
                    <tr>
                        <td><?php echo esc_html($row->Id); ?></td>
                        <td><?php echo esc_html($row->Name); ?></td>
                        <td><?php echo esc_html($row->Email); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
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
add_shortcode('show_data', 'show_data_shortcode');
function short_url(){

    include "content.php";
    
    echo show_data();
}
add_action("admin_menu","add_menu");
?>
