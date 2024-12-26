<?php 
/*
Plugin Name: Custom Plugin
Plugin URI: https://example.com
Description: A custom form that takes data from users, stores it in the database, and displays it in a table.
Version: 1.0
Author: Kavita Bisht
Author URI: https://example.com
License: GPLv2 or later
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Plugin activation
function form_activation() {
    global $wpdb, $table_prefix;
    $table_name = $table_prefix . 'custom_user';
    
    // SQL to create a table
    $query = "CREATE TABLE IF NOT EXISTS `$table_name` (
        `Id` INT(11) NOT NULL AUTO_INCREMENT,
        `Name` VARCHAR(255) NOT NULL,
        `Email` VARCHAR(255) NOT NULL,
        `Password` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`Id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    // Execute the query
    $wpdb->query($query);
}

// Plugin deactivation
function form_deactivation() {
    global $wpdb, $table_prefix;
    $table_name = $table_prefix . 'custom_user';
    
    // Optional: Empty the table on deactivation
    // Uncomment the line below if you want to clear data on deactivation
    // $wpdb->query("TRUNCATE `$table_name`;"); 
}

// Hooks to call activation and deactivation functions
register_activation_hook(__FILE__, 'form_activation');
register_deactivation_hook(__FILE__, 'form_deactivation');

// Function to display the form (Shortcode)
function custom_form_shortcode() {
    ob_start();
    ?>
    <form method="POST" action="">
        <?php wp_nonce_field('custom_form_nonce_action', 'custom_form_nonce'); ?>
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <button type="submit" name="submit_form">Submit</button>
        </div>
    </form>
    <?php
    handle_form_submission(); // Process form submission

    return ob_get_clean();
}

// Handle form submission
function handle_form_submission() {
    if (isset($_POST['submit_form'])) {
        // Verify nonce for security
        if (!isset($_POST['custom_form_nonce']) || !wp_verify_nonce($_POST['custom_form_nonce'], 'custom_form_nonce_action')) {
            die('Security check failed');
        }

        // Sanitize and validate user inputs
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $password = sanitize_text_field($_POST['password']);

        if (!is_email($email)) {
            echo '<p class="error">Invalid email address!</p>';
            return;
        }

        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the database
        global $wpdb, $table_prefix;
        $table_name = $table_prefix . 'custom_user';

        $wpdb->insert(
            $table_name,
            [
                'Name' => $name,
                'Email' => $email,
                'Password' => $hashed_password
            ]
        );
        echo '<p>Data submitted successfully!</p>';
    }
}

// Function to display data in a table (Shortcode)
function show_data_shortcode() {
    global $wpdb, $table_prefix;
    $table_name = $table_prefix . 'custom_user';
    $results = $wpdb->get_results("SELECT * FROM `$table_name`");

    ob_start();
    ?>
    <h1>Submitted Data</h1>
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
    <p>Total entries: <?php echo count($results); ?></p>
    <?php
    return ob_get_clean();
}

// Add menu to the admin panel
function custom_plugin_menu() {
    add_menu_page(
        'Custom Plugin',             // Page title
        'Custom Form',               // Menu title
        'manage_options',            // Capability
        'custom-plugin',             // Menu slug
        'custom_plugin_admin_page'   // Callback function
    );
}

// Admin page callback
function custom_plugin_admin_page() {
    ?>
    <div class="wrap">
        <h1>Welcome to Custom Plugin</h1>
        <p>Use the shortcode <code>[custom-form]</code> to display the form.</p>
        <p>Use the shortcode <code>[show-data]</code> to display the submitted data.</p>
        <hr />
        <h2>form</h2>
        <?php echo custom_form_shortcode(); ?>
        <h2>Submitted Data:</h2>
        <?php echo show_data_shortcode(); ?>
    </div>
    <?php
}

// Register shortcodes
add_shortcode('custom-form', 'custom_form_shortcode');
add_shortcode('show-data', 'show_data_shortcode');

// Add menu to admin panel
add_action('admin_menu', 'custom_plugin_menu');
?>
