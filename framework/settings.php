<?php
    include 'authentication\auth_gen.php';
    include 'db_connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $currentpassword = mysqli_real_escape_string($conn, $_POST['currentpassword']);
        $newpassword = mysqli_real_escape_string($conn, $_POST['newpassword']);
        $username = $_SESSION["username"];

        // Retrieve hashed password from the database
        $sql = "SELECT password FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            if (password_verify($currentpassword, $hashed_password)) {
                // Hash the new password
                $new_hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

                // Update the password in the database
                $update_sql = "UPDATE users SET password = '$new_hashed_password' WHERE username = '$username'";
                if ($conn->query($update_sql)) {
                    // Password change successful
                    echo "<script type='text/javascript'>
                    alert('Password change successful!');
                    window.location.href='settings.php';
                    </script>";
                    exit;
                    
                } else {
                    // Error updating password
                    echo "Error updating password: " . $conn->error;
                }
            } else {
                // Invalid current password
                echo "<script type='text/javascript'>
                alert('Current Password is Invalid!');
                window.location.href='settings.php';
                </script>";
                exit;
            }
        } else {
            // Username not found
            echo "<script type='text/javascript'>
            alert('Username not found');
            window.location.href='index.html';
            </script>";
            exit;
        }

        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="styles_admin.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <table class="mainframe">
        <tr>
            <td>
                <h1 class="page-title">Settings</h1>
                <?php include 'side_navbar.php'; ?>
            </td>
            <td>
                <div class="page-content">

                    <div class="toolbar">
                        <ul>
                            <li><span id="toolbar-heading">Controls and Settings</span></li>
                        </ul>
                    </div>
                    <div class = "bgimage">
                        <table class="mainframe">
                            <tr>
                                <td>
                                    <div class="container">
                                        <h2>Change Password</h2>
                                        <form action="settings.php" method="POST">
                                        <input type="password" id="currentpassword" name="currentpassword" placeholder="Current Password" required><br>
                                        <input type="password" id="newpassword" name="newpassword" placeholder="New Password" required><br>
                                        <input type="submit" value="Submit" class="submit-button">
                                        </form> 
                                    </div>
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