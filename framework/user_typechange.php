<?php include 'authentication\auth_admin.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Activation</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="styles_admin.css">
    <link rel="stylesheet" type="text/css" href="styles-table.css">
</head>
<body>

    <?php include 'navbar.php'; ?>
    <table class="mainframe">
        <tr>
            <td>
                <h1 class="page-title">Change User Type</h1>
                <?php include 'side_navbar_admin.php'; ?>
            </td>
            <td>
                <div class="page-content">

                    <div class="toolbar">
                        <ul>
                            <li><span id="toolbar-heading">Change User Type</span></li>
                        </ul>
                    </div>
                        <div class="bgimage">
                        <table class="mainframe">
                            <tr>
                                <td>
                                    <div class="container">
                                        <!-- <h2>Change User Type</h2> -->
                                        <form action="user_typechange.php" method="post">
                                        <input type="text" id="userid" name="userid" placeholder="Type the User ID"><br>
                                        <input type="submit" value="Submit" class="submit-button">
                                        </form> 
                                    </div>

                                    <?php
                                        include 'db_connection.php';

                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            $userid = mysqli_real_escape_string($conn, $_POST['userid']);

                                            $sql = "SELECT userid, firstname, lastname, username, usertype, userstatus FROM users WHERE userid = ?";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bind_param("s", $userid);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result->num_rows > 0) {
                                                echo "<table class='datatable'>";
                                                echo "<tr>
                                                        <th>User ID</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Username</th>
                                                        <th>Current User Type</th>
                                                        <th>New User Type</th>
                                                    </tr>";
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row["userid"] . "</td>";
                                                    echo "<td>" . $row["firstname"] . "</td>";
                                                    echo "<td>" . $row["lastname"] . "</td>";
                                                    echo "<td>" . $row["username"] . "</td>";
                                                    echo "<td>" . $row["usertype"] . "</td>";
                                                    echo "<td>";
                                                    echo '<form method="post" action="user_typechange_action.php">';
                                                    echo '<input type="hidden" name="userid" value="' . $row["userid"] . '">';
                                                    echo '<select name="usertype" id="usertype" required>';
                                                        echo '<option value="" disabled selected>Select User Type...</option>';
                                                        echo '<option value="User">User</option>';
                                                        echo '<option value="Manager">Manager</option>';
                                                        echo '<option value="Director">Director</option>';
                                                        echo '<option value="Admin">Admin</option>';
                                                    echo '</select>';
                                                    echo '&nbsp';
                                                    echo '&nbsp';
                                                    echo '&nbsp';
                                                    echo '<input type="submit" class="update-button" value="Update">';
                                                    echo '</form>';
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                                echo "</table>";
                                            } else {
                                                echo "Please enter a valid user ID and hit Submit.";
                                            }

                                            $stmt->close();
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