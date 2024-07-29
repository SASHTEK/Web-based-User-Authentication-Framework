<?php
    include 'authentication\auth_admin.php';
    include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- <link rel="stylesheet" type="text/css" href="styles_admin.css"> -->
    <link rel="stylesheet" type="text/css" href="styles-table.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <table class="mainframe">
        <tr>
            <td>
                <h1 class="page-title">All User Details</h1>
                <?php include 'side_navbar_admin.php'; ?>
            </td>
            <td>
                <div class="page-content">

                    <div class="toolbar">
                        <ul>
                            <li><span id="toolbar-heading">All User Details</span><li>
                            <?php include 'functions_general.php'; ?>
                            <li><a href="javascript:void(0);" onclick="exportToExcel('userdetails', 'All_User_Details')">Export</a></li>
                        </ul>
                    </div>
                        <div class="bgimage">
                            <table class="mainframe">
                                <tr>
                                    <td>
                                        <div class="container-search">
                                        <!-- Search box -->
                                        <?php include 'functions_general.php'; ?>
                                        <input type="text" id="mysearch" onkeyup="searchTable('userdetails')" placeholder="Search">
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <?php
                            // Define the number of results per page
                            $per_page = 8;

                            // Get the current page number from the query parameters (e.g., ?page_no=2)
                            $page_number = isset($_GET['page_no']) ? intval($_GET['page_no']) : 1;

                            // Modify SQL query to include LIMIT and OFFSET
                            $offset = ($page_number - 1) * $per_page;
                            $sql = "SELECT userid, firstname, lastname, useremail, username, usertype, userstatus FROM users LIMIT $offset, $per_page";

                            // Execute the query to fetch the records
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<table class='datatable' id='userdetails'>";
                                echo "<tr><th>User ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Username</th><th>User Type</th><th>Status</th></tr>";
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["userid"] . "</td>";
                                    echo "<td>" . $row["firstname"] . "</td>";
                                    echo "<td>" . $row["lastname"] . "</td>";
                                    echo "<td>" . $row["useremail"] . "</td>";
                                    echo "<td>" . $row["username"] . "</td>";
                                    echo "<td>" . $row["usertype"] . "</td>";
                                    echo "<td>" . $row["userstatus"] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";

                                // Fetch the total record count dynamically
                                $count_sql = "SELECT COUNT(*) AS total_records FROM users";
                                $count_result = $conn->query($count_sql);
                                $total_records = $count_result->fetch_assoc()['total_records'];

                                // Calculate the total number of pages
                                $total_pages = ceil($total_records / $per_page);

                                // Display dynamic pagination links
                                echo "<ul class='pagination'>";
                                if ($page_number > 1) {
                                    echo "<li><a href='?page_no=1'>First Page</a></li>";
                                }
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    echo "<li><a href='?page_no=$i'>$i</a></li>";
                                }
                                if ($page_number < $total_pages) {
                                    echo "<li><a href='?page_no=$total_pages'>Last ››</a></li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "0 results";
                            }

                            $conn->close();
                            ?>
                        </div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>