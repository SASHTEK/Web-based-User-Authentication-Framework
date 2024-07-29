<?php
    include 'authentication\auth_admin.php';

    $error=""; // for get the error message (Please enter user ID)
    $userid = "";
    $firstname ="";
    $lastname ="";
    $useremail ="";
    $_username ="";
    $_usertype ="";
    $_userstatus ="";


    include 'db_connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userid = mysqli_real_escape_string($conn, $_POST['userid']);

        $sql = "SELECT userid, firstname, lastname, useremail, username, usertype, userstatus FROM users WHERE userid = ?";
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
                $_usertype =$row["usertype"];
                $_userstatus =$row["userstatus"];
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
    <title>Search user details</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="styles_admin.css">

</head>
<body>
    <?php include 'navbar.php'; ?>
    <table class="mainframe">
        <tr>
            <td>
                <h1 class="page-title">Search User Details</h1>
                <?php include 'side_navbar_admin.php'; ?>
            </td>
            <td>
                <div class="page-content">

                    <div class="toolbar">
                        <ul>
                            <li><span id="toolbar-heading">Search User Details</span></li>
                            <li><a style="background-color: #078025; color: white;" href="user_search_id.php">by User ID</a></li>
                            <li><a href="user_search_clue.php">by Clue</a></li>
                            <li><a href="user_search_filter.php">by Filters</a></li>
                        </ul>
                    </div>
                    <div class = "bgimage">
                        <table class="mainframe">
                            <tr>
                                <td>
                                    <div class="container">
                                        <form action="user_search_id.php" method="post">
                                        <input type="text" id="userid" name="userid" placeholder="Type User ID"><br>
                                        <input type="submit" value="Search" class="submit-button">
                                        </form>
                                        <p><?php echo $error; ?></p> 
                                    </div>
                                </td>

                                <td>
                                    <div class="container">
                                        <form action="" method="post">
                                        <label for="userid">User ID</label>
                                        <input type="text" id="userid" name="userid" value="<?php echo $userid; ?>" readonly><br>
                                        <label for="firstname">First Name</label>
                                        <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>" readonly><br>
                                        <label for="lastname">Last Name</label>
                                        <input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>" readonly><br>
                                        <label for="useremail">Email</label>
                                        <input type="email" id="useremail" name="useremail" value="<?php echo $useremail; ?>" readonly><br>
                                        <label for="username">Username</label>
                                        <input type="text" id="username" name="username" value="<?php echo $_username; ?>" readonly><br>
                                        <label for="usertype">User Type</label>
                                        <input type="text" id="usertype" name="usertype" value="<?php echo $_usertype; ?>" readonly><br>
                                        <label for="userstatus">User Status</label>
                                        <input type="text" id="userstatus" name="userstatus" value="<?php echo $_userstatus; ?>" readonly><br>
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