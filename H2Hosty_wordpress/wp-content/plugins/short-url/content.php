<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WP Safelink</title>
    <style>
        /* Reset some basic styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
        }

        .tabs {
            display: flex;
            border-bottom: 2px solid #ddd;
            margin-bottom: 20px;
        }

        .tab {
            padding: 15px 20px;
            cursor: pointer;
            text-align: center;
            flex: 1;
            background: #0000;
            color: #fff;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .tab:hover {
            background: #555;
        }

        .tab.active {
            background: #402AE8;
            color: #fff;
            border-bottom: 3px solid #402AE8;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"] {
            width: 70%;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 30px;
        }

        .btn {
            background-color: #402AE8;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background: #007BFF;
            color: #fff;
        }

        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="tabs">
            <div class="tab active" data-tab="generate-link">Generate Link</div>
            <div class="tab" data-tab="settings">Settings</div>
            <div class="tab" data-tab="theme-code">Theme Header and Footer Code</div>
            <div class="tab" data-tab="advertisements">Advertisements</div>
        </div>

        <div class="tab-content active" id="generate-link">
            <h2>Generate Link</h2>
            <form>
                <div class="form-group">
                    <label for="long-url">Enter URL:</label>
                    <input type="text" id="long-url" placeholder="https://example.com">
                
                <button type="button" class="btn">Generate</button>
              </div>
            </form>

        
            <!-- Pagination -->
            <div class="pagination" id="pagination"></div>
        </div>
        <div class="tab-content" id="settings">
            <h2>Settings</h2>
            <p>Settings content goes here.</p>
        </div>

        <div class="tab-content" id="theme-code">
            <h2>Theme Header and Footer Code</h2>
            <p>Theme header and footer code content goes here.</p>
        </div>

        <div class="tab-content" id="advertisements">
            <h2>Advertisements</h2>
            <p>Advertisements content goes here.</p>
        </div>
    </div>

    <script>
        // JavaScript for Tabs
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                tab.classList.add('active');
                const activeContent = document.getElementById(tab.getAttribute('data-tab'));
                activeContent.classList.add('active');
            });
        });

        // Sample Data for Table
        const tableData = [
            { date: '2024-12-26', alias: 'alias123', shortUrl: 'https://short.link/alias123', targetUrl: 'https://example.com', clicks: 10 },
            { date: '2024-12-25', alias: 'alias124', shortUrl: 'https://short.link/alias124', targetUrl: 'https://example2.com', clicks: 8 },
            { date: '2024-12-24', alias: 'alias125', shortUrl: 'https://short.link/alias125', targetUrl: 'https://example3.com', clicks: 15 },
            
            { date: '2024-12-26', alias: 'alias123', shortUrl: 'https://short.link/alias123', targetUrl: 'https://example.com', clicks: 10 },
            { date: '2024-12-25', alias: 'alias124', shortUrl: 'https://short.link/alias124', targetUrl: 'https://example2.com', clicks: 8 },
            { date: '2024-12-24', alias: 'alias125', shortUrl: 'https://short.link/alias125', targetUrl: 'https://example3.com', clicks: 15 },
            
            { date: '2024-12-26', alias: 'alias123', shortUrl: 'https://short.link/alias123', targetUrl: 'https://example.com', clicks: 10 },
            { date: '2024-12-25', alias: 'alias124', shortUrl: 'https://short.link/alias124', targetUrl: 'https://example2.com', clicks: 8 },
            { date: '2024-12-24', alias: 'alias125', shortUrl: 'https://short.link/alias125', targetUrl: 'https://example3.com', clicks: 15 },
            
            { date: '2024-12-26', alias: 'alias123', shortUrl: 'https://short.link/alias123', targetUrl: 'https://example.com', clicks: 10 },
            { date: '2024-12-25', alias: 'alias124', shortUrl: 'https://short.link/alias124', targetUrl: 'https://example2.com', clicks: 8 },
            { date: '2024-12-24', alias: 'alias125', shortUrl: 'https://short.link/alias125', targetUrl: 'https://example3.com', clicks: 15 },
            
            { date: '2024-12-26', alias: 'alias123', shortUrl: 'https://short.link/alias123', targetUrl: 'https://example.com', clicks: 10 },
            { date: '2024-12-25', alias: 'alias124', shortUrl: 'https://short.link/alias124', targetUrl: 'https://example2.com', clicks: 8 },
            { date: '2024-12-24', alias: 'alias125', shortUrl: 'https://short.link/alias125', targetUrl: 'https://example3.com', clicks: 15 },
            
            { date: '2024-12-26', alias: 'alias123', shortUrl: 'https://short.link/alias123', targetUrl: 'https://example.com', clicks: 10 },
            { date: '2024-12-25', alias: 'alias124', shortUrl: 'https://short.link/alias124', targetUrl: 'https://example2.com', clicks: 8 },
            { date: '2024-12-24', alias: 'alias125', shortUrl: 'https://short.link/alias125', targetUrl: 'https://example3.com', clicks: 15 },
            
            { date: '2024-12-26', alias: 'alias123', shortUrl: 'https://short.link/alias123', targetUrl: 'https://example.com', clicks: 10 },
            { date: '2024-12-25', alias: 'alias124', shortUrl: 'https://short.link/alias124', targetUrl: 'https://example2.com', clicks: 8 },
            { date: '2024-12-24', alias: 'alias125', shortUrl: 'https://short.link/alias125', targetUrl: 'https://example3.com', clicks: 15 },
            // Add more rows as needed
        ];

        const rowsPerPage = 5; // Number of rows per page
        let currentPage = 1;

        function renderTable(data, page = 1) {
            const tbody = document.querySelector('#data-table tbody');
            tbody.innerHTML = '';

            const startIndex = (page - 1) * rowsPerPage;
            const endIndex = startIndex + rowsPerPage;

            const currentData = data.slice(startIndex, endIndex);

            currentData.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.date}</td>
                    <td>${row.alias}</td>
                    <td>${row.shortUrl}</td>
                    <td>${row.targetUrl}</td>
                    <td>${row.clicks}</td>
                `;
                tbody.appendChild(tr);
            });
        }

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

        // Initial Render
        renderTable(tableData, currentPage);
        renderPagination(tableData);
    </script>
    </body>
</html>
