<?php

    include 'authentication\auth_admin.php';

    include 'db_connection.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userid = mysqli_real_escape_string($conn, $_POST['userid']);
        $newusertype = mysqli_real_escape_string($conn, $_POST['usertype']);

        $sql = "UPDATE users SET usertype = ? WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newusertype, $userid);
        $stmt->execute();
        $stmt->close();

        echo "<script type='text/javascript'>
            alert('User Type Changed Successfully!.');
            window.location.href='user_typechange.php';
            </script>";
            exit;

    } else {
        
        // Handle other cases (e.g., invalid request method)
    }

    $conn->close();
?>