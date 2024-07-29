<?php

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentuseremail = filter_var($_POST['currentuseremail'], FILTER_SANITIZE_EMAIL);

    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789#@&';
    $password_length = 10;
    $resetpassword = substr(str_shuffle($characters), 0, $password_length);

    $hashed_password = password_hash($resetpassword, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password = '$hashed_password' WHERE useremail = '$currentuseremail'";
    if ($conn->query($sql) === TRUE) {

        // email configuration
        $smtp_server = ''; 
        $smtp_port = ; 
        $smtp_username = ''; 
        $smtp_password = '';

        $headers = "From: $smtp_username";

        if (mail($currentuseremail, "Password Reset", "Your new password: $resetpassword", $headers, "-f$smtp_username")) {
            echo "<script type='text/javascript'>
                    alert('Password reseted successfully! An email has been sent with the new password.');
                    window.location.href='index.html';
                    </script>";
                    exit;

        } else {
            echo "<script type='text/javascript'>
                    alert('Error sending email. Please check your server configuration.');
                    window.location.href='forget_password.php';
                    </script>";
                    exit;
        }

    } else {
        echo "<script type='text/javascript'>
                    alert('Wrong email address! Please contact your System Admin for further assistance.');
                    window.location.href='forget_password.php';
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
    <title>Forget Password</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="styles_admin.css">
</head>
<body>
    <br><br><br><br><br><br>
    <div class="container">
        <h2>Reset Password</h2>
        <form action="forget_password.php" method="POST">
        <input type="email" id="currentuseremail" name="currentuseremail" placeholder="Please enter the email address registered with us"><br>
        <input type="submit" value="Submit" class="submit-button">
        </form> 
        <p>Note: If you forgot your registered email address as well, please contact your system admin for password reset.</p>
        <br>
        <a class="back-button" href="index.html">Back</a>
    </div>
</body>
</html>