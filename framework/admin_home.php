<?php include 'authentication\auth_admin.php'; ?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="styles_card.css">
</head>
<body>
    
    <?php include 'navbar.php'; ?>

    <table class="mainframe">
        <tr>
            <td>
                <h1 class="page-title">Admin Home</h1>
                <?php include 'side_navbar_admin.php'; ?>
            </td>
            <td>
                <div class="page-content">
                    <div class="toolbar">
                        <ul>
                            <li><h5>Welcome back to Admin Portal, <?php echo "$_SESSION[username]";?>!</h5></li>
                        </ul>
                    </div>
                    <div class = "bgimage">
                        <table class="mainframe">
                            <tr>
                                <td>
                                    <?php include 'dashboard_card_users.php'; ?>
                                </td>
                                <td>
                                    <?php include 'dashboard_card_types.php'; ?>
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