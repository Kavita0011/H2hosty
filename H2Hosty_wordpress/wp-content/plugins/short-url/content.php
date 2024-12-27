<?php 
if (isset($_POST['submit'])) {
    // Sanitize and validate user inputs
    $longUrl = sanitize_text_field($_POST['longUrl']);
    $alias = sanitize_text_field($_POST['alias']);
    
    // Validate URL
    if (!filter_var($longUrl, FILTER_VALIDATE_URL)) {
        echo '<p style="color: red;">Invalid URL format. Please enter a valid URL.</p>';
    } else {
        // Construct the short URL
        $new_url = home_url('/' . $alias);

        // Insert data into the database
        global $wpdb, $table_prefix;
        $table_name = $table_prefix . 'shorturls';

        // Insert data securely with wpdb placeholders
        $inserted = $wpdb->insert(
            $table_name,
            [
                'linkalias' => $alias,      // Fix: Changed backticks (`) to single quotes (') for array keys.
                'longurl'   => $longUrl,
                'shorturl'  => $new_url,
                'clicks'    => 20,         // Fix: Removed quotes from numeric value.
            ],
            ['%s', '%s', '%s', '%d']      // Fix: Added value formats for SQL query sanitization.
        );

        // Check if the insertion was successful
        if ($inserted) {
            echo '<p style="color: green;">Data submitted successfully! Short URL: <a href="' . esc_url($new_url) . '" target="_blank">' . esc_html($new_url) . '</a></p>';
        } else {
            echo '<p style="color: red;">Error submitting data. Please try again.</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WP Safelink</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        /* Main container styling */
        .container {
            max-width: 100%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Header section styling */
        .header {
            text-align: left;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #402AE8;
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1.2em;
            color: #555;
        }

        .form-grp-wrap {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }

        /* Form section styling */
        .form-group {
            display: flex;
            flex-direction: column;
            margin: 15px 15px 15px 0px;
            min-width: 48%;
        }

        .form-group label {
            font-size: 1.1em;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input[type="text"] {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: border 0.3s;
        }

        .form-group input[type="text"]:focus {
            border-color: #402AE8;
        }

        .btn {
            background-color: #402AE8;
            color: #fff;
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 15px;
        }

        .btn:hover {
            background-color: #333;
        }

        /* Table section styling */
        table {
            min-width: 97%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #402AE8;
            color: white;
            font-weight: bold;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #e6e6ff;
        }

        /* Pagination styling */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination button {
            background-color: #402AE8;
            color: white;
            padding: 10px 15px;
            border: none;
            margin: 0 5px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .pagination button:hover {
            background-color: #333;
        }

        .pagination button.active {
            background-color: #555;
            cursor: default;
        }
        #wpfooter{
            position: relative;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>WP Safelink</h1>
        </div>

        <!-- Generate Link Section -->
        <form method="post" action="#">
            <div class="form-grp-wrap">
                <div class="form-group">
                    <label for="long-url">Enter URL:</label>
                    <input type="text" id="long-url" name="longUrl" placeholder="https://example.com">
                </div>
                <div class="form-group">
                    <label for="alias">Alias:</label>
                    <input type="text" id="alias" name="alias" placeholder="Enter custom alias (optional)">
                </div>
            </div>
            <button type="submit" name="submit" class="btn">Generate</button>
        </form>

        <!-- Table Section -->
        <?php
if(isset($new_url)){
echo $new_url;
}
        echo show_data();
        ?>

        <!-- Pagination Section -->
        <div id="pagination" class="pagination"></div>
    </div>
    <script>
        function renderPagination(data) {
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';
            const totalPages = Math.ceil(data.length / rowsPerPage);

            for (let i = 1; i <= totalPages; i++) {
                const button = document.createElement('button');
                button.textContent = i;
                button.className = i === currentPage ? 'active' : '';
                button.disabled = i === currentPage;

                button.addEventListener('click', () => {
                    currentPage = i;
                    renderTable(data, currentPage);
                    renderPagination(data);
                });

                pagination.appendChild(button);
            }
        }

        renderTable(tableData, currentPage);
        renderPagination(tableData);
    </script>
</body>
</html>
