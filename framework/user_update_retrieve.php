<?php
    include 'authentication\auth_admin.php';

    $error=""; // for get the error message (Please enter user ID)
    $userid = "";
    $firstname ="";
    $lastname ="";
    $useremail ="";
    $_username ="";

    include 'db_connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userid = mysqli_real_escape_string($conn, $_POST['userid']);

        $sql = "SELECT userid, firstname, lastname, useremail, username FROM users WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {
                
                $userid = $row["userid"];
                $firstname =$row["firstname"];
                $lastname =$row["lastname"];
                $useremail =$row["useremail"];
                $_username =$row["username"];
            }   
        }else {
            $error = "Please enter a valid user ID and hit Submit.";
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
    <title>Update User Details</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="styles_admin.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <table class="mainframe">
        <tr>
            <td>
                <h1 class="page-title">Update User Details</h1>
                <?php include 'side_navbar_admin.php'; ?>
            </td>
            <td>
                <div class="page-content">

                    <div class="toolbar">
                        <ul>
                            <li><span id="toolbar-heading">Update User Details</span></li>
                        </ul>
                    </div>
                    <div class="bgimage">
                        <table class="mainframe">
                            <tr>
                                <td>
                                    <div class="container">
                                        <!-- <h2>Update User Details</h2> -->
                                        <form action="user_update_retrieve.php" method="post">
                                        <input type="text" id="userid" name="userid" placeholder="Type User ID"><br>
                                        <input type="submit" value="Submit" class="submit-button">
                                        </form>
                                        <p><?php echo $error; ?></p> 
                                    </div>
                                </td>

                                <td>
                                    <div class="container">
                                        <form action="user_update_submit.php" method="post">
                                        <label for="userid">User ID</label>
                                        <input type="text" id="userid" name="userid" value="<?php echo $userid; ?>" required readonly><br>
                                        <label for="firstname">First Name</label>
                                        <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>"><br>
                                        <label for="lastname">Last Name</label>
                                        <input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>"><br>
                                        <label for="useremail">Email</label>
                                        <input type="email" id="useremail" name="useremail" value="<?php echo $useremail; ?>"><br>
                                        <label for="username">Username</label>
                                        <input type="text" id="username" name="username" value="<?php echo $_username; ?>"><br>
                                        <input type="submit" value="Update" class="submit-button">
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