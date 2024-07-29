<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                if ($row['userstatus'] == 'Inactive') {
                    echo "<script type='text/javascript'>
                        alert('Access Denied! Please contact your System Admin.');
                        window.location.href='index.html';
                    </script>";
                    exit;
                } else {
                    session_start();
                    $_SESSION["userid"] = $row['userid'];
                    $_SESSION["username"] = $row['username'];
                    $_SESSION["usertype"] = $row['usertype'];
                    header("Location: home.php");
                    exit;
                }
            } else {
                echo "<script type='text/javascript'>
                    alert('Invalid password!');
                    window.location.href='index.html';
                </script>";
                exit;
            }
        }
    } else {
        echo "<script type='text/javascript'>
            alert('Invalid Username!');
            window.location.href='index.html';
        </script>";
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>
