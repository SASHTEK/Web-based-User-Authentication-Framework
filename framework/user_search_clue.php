<?php include 'authentication\auth_admin.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search user details</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="styles_admin.css">
    <link rel="stylesheet" type="text/css" href="styles-table.css">

</head>
<body>
    <?php include 'navbar.php'; ?>
    <table class="mainframe">
        <tr>
            <td>
                <h1 class="page-title">Search User Details</h1>
                <?php include 'side_navbar_admin.php'; ?>
            </td>
            <td>
                <div class="page-content">

                    <div class="toolbar">
                        <ul>
                            <li><span id="toolbar-heading">Search User Details</span></li>
                            <li><a href="user_search_id.php">by User ID</a></li>
                            <li><a style="background-color: #078025; color: white;" href="user_search_clue.php">by Clue</a></li>
                            <li><a href="user_search_filter.php">by Filters</a></li>
                        </ul>
                    </div>
                    <div class = "bgimage">
                        <table class="mainframe">
                            <tr>
                                <td>
                                    <div class="container">
                                        <form action="user_search_clue.php" method="post">
                                        <input type="text" id="searchclue" name="searchclue" placeholder="Type any clue of the user"><br>
                                        <input type="submit" value="Search" class="submit-button">
                                        </form>
                                    </div>

                                    <?php
                                    include 'db_connection.php';

                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $searchclue = mysqli_real_escape_string($conn, $_POST['searchclue']);

                                        if (empty($searchclue)) {
                                            echo "Please type something to search.";
                                        } else {
                                            $sql = "SELECT userid, firstname, lastname, useremail, username, usertype, userstatus
                                                    FROM users
                                                    WHERE userid LIKE CONCAT('%', ?, '%') OR
                                                    firstname LIKE CONCAT('%', ?, '%') OR
                                                    lastname LIKE CONCAT('%', ?, '%') OR
                                                    useremail LIKE CONCAT('%', ?, '%') OR
                                                    username LIKE CONCAT('%', ?, '%') OR
                                                    usertype LIKE CONCAT('%', ?, '%') OR
                                                    userstatus LIKE CONCAT('%', ?, '%')";

                                            $stmt = $conn->prepare($sql);
                                            $stmt->bind_param("issssss", $searchclue, $searchclue, $searchclue, $searchclue, $searchclue, $searchclue, $searchclue);  
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result->num_rows > 0) {
                                                echo "<table class='datatable'>";
                                                echo "<tr>
                                                        <th>User ID</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>User Email</th>
                                                        <th>Username</th>
                                                        <th>User Type</th>
                                                        <th>User Status</th>
                                                    </tr>";
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
                                                echo "<br>";
                                                if ($result->num_rows > 1) {
                                                    echo "Found $result->num_rows records";
                                                } else {
                                                    echo "Found $result->num_rows record";
                                                }
                                            } else {
                                                echo "No matching records found.";
                                            }
                                            $stmt->close();
                                        }
                                        $conn->close();
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>