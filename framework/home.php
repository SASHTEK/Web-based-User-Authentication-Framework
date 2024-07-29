<?php include 'authentication\auth_gen.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    
    <?php include 'navbar.php'; ?>

    <table class ="mainframe">
        <tr>
            <td>
                <h1 class="page-title">Home</h1>
                <?php include 'side_navbar.php'; ?>
            </td>
            <td>
                <div class="page-content">

                    <div class="toolbar">
                        <ul>
                            <li><h5>Welcome back, <?php echo "$_SESSION[username]";?>!</h5></li>
                        </ul>
                    </div>
                    <div class = "bgimage">
                        <table class="mainframe">
                            <tr>
                                <td>
                                    <img id="bgimage" src="images/main_background.png" alt="Home Background">
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