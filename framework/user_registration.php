<?php
    include 'authentication\auth_admin.php';

    include 'db_connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $useremail = trim($_POST['useremail']);
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $usertype = $_POST['usertype'];
        $userstatus = 'Active'; // Set User Status

        if (empty($username)) {
            echo "<script type='text/javascript'>
                alert('Username cannot be empty!');
                window.location.href='user_registration.php';
            </script>";
            exit;
        }

        // Check if username already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script type='text/javascript'>
                alert('Username already exists!');
                window.location.href='user_registration.php';
            </script>";
            exit;
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (firstname, lastname, useremail, username, password, usertype, userstatus)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssss', $firstname, $lastname, $useremail, $username, $hashed_password, $usertype, $userstatus);

        if ($stmt->execute()) {
            echo "<script type='text/javascript'>
                alert('User registration successful!');
                window.location.href='user_registration.php';
            </script>";
            exit;
        } else {
            echo "<script type='text/javascript'>
                alert('User registration failed!');
                window.location.href='user_registration.php';
            </script>";
            exit;
        }

        $stmt->close();
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="styles_admin.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <table class="mainframe">
        <tr>
            <td>
                <h1 class="page-title">User Registration</h1>
                <?php include 'side_navbar_admin.php'; ?>
            </td>
            <td>
                <div class="page-content">

                    <div class="toolbar">
                        <ul>
                            <li><span id="toolbar-heading">User registration</span></li>
                        </ul>
                    </div>
                    <div class = "bgimage">
                        <table class="mainframe">
                            <tr>
                                <td>
                                    <div class="container">
                                        <!-- <h2>User registration</h2> -->
                                        <form action="user_registration.php" method="post">
                                        <input type="text" id="firstname" name="firstname" placeholder="First Name" required><br>
                                        <input type="text" id="lastname" name="lastname" placeholder="Last Name" required><br>
                                        <input type="email" id="useremail" name="useremail" placeholder="User Email" required><br>
                                        <input type="text" id="username" name="username" placeholder="User Name" required><br>
                                        <select name="usertype" id="usertype" required>
                                        <?php include 'lists\usertype.php'; ?>
                                        </select><br>
                                        <input type="password" id="password" name="password" placeholder="Password" required><br>
                                        <input type="submit" value="Register" class="submit-button">
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