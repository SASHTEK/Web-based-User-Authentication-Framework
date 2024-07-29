<?php
include 'authentication\auth_admin.php';

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userid'];
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $useremail = trim($_POST['useremail']);
    $username = trim($_POST['username']);

    if (empty($userid)) {
        echo "<script type='text/javascript'>
            alert('User ID cannot be empty!');
            window.location.href='user_update_retrieve.php';
        </script>";
        exit;
    }

    // Check if user ID exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE userid = ?");
    $stmt->bind_param('s', $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User ID exists, now check username
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Username already exists
            echo "<script type='text/javascript'>
                alert('Username already taken. Please choose another.');
                window.location.href='user_update_retrieve.php';
            </script>";
        } else {
            // Proceed with updating user details
            $sql = "UPDATE users SET firstname = ?, lastname = ?, useremail = ?, username = ? WHERE userid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssss', $firstname, $lastname, $useremail, $username, $userid);

            if ($stmt->execute()) {
                echo "<script type='text/javascript'>
                    alert('User details updated successfully!');
                    window.location.href='user_update_retrieve.php';
                </script>";
            } else {
                echo "<script type='text/javascript'>
                    alert('Failed to update user details!');
                    window.location.href='user_update_retrieve.php';
                </script>";
            }
        }
    } else {
        // User ID does not exist
        echo "<script type='text/javascript'>
            alert('User ID does not exist!');
            window.location.href='user_update_retrieve.php';
        </script>";
    }
    $stmt->close();
    $conn->close();
}
?>