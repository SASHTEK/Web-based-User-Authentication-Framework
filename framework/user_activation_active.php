<?php

    include 'authentication\auth_admin.php';

    include 'db_connection.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userid = mysqli_real_escape_string($conn, $_POST['userid']);
        $status = "Active"; 

        $sql = "UPDATE users SET userstatus = ? WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $status, $userid);
        $stmt->execute();
        $stmt->close();

        echo "<script type='text/javascript'>
            alert('User Activation Successful!.');
            window.location.href='user_activation.php';
            </script>";
            exit;

    } else {
        
        // Handle other cases (e.g., invalid request method)
    }

    $conn->close();
?>