<?php

    session_start();

    if(!isset($_SESSION["userid"])) {
        header("Location: index.html");
        exit;
    }

    if ($_SESSION["usertype"] !== "Admin") {

        echo "<script type='text/javascript'>
        alert('Unauthorized access. Only admins are allowed.');
        window.location.href='home.php';
        </script>";
        exit;
    }
    
?>    