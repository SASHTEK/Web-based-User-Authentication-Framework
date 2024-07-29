<!-- navbar.php -->
<div class="navigation">
    <ul>
        <span id="homename">Management System</span>
        <li>
            <form action="logout.php" method="post">
                <input type="submit" value="Logout" class="logout-button">
            </form>
        </li>

        <li id="username">
            <?php echo $_SESSION["username"]; ?> &nbsp;<span class="displyid"><?php echo $_SESSION["userid"]; ?></span>
        </li>

        <li>
            <a href="Home.php">Home</a>
            <a href="admin_home.php">Admin</a>
            <!-- User select dropdown list -->
            <div class="dropdown">
            <button class="dropbtn">Users</button>
                <div class="dropdown-content">
                    <a href="">User</a>
                    <a href="">Manager</a>
                    <a href="">Director</a>
                </div>
            </div>
            &nbsp;<b>|</b>
        </li>
    </ul>
</div>

<style>
    .displyid {
        width: 15px; 
        height: 15px; 
        padding: 2px; 
        background-color: green; 
        border-radius: 50%; 
        color: white; 
        display: inline-block; 
        /* text-align: center;  */
        vertical-align: middle;
        margin-bottom: 1px;
    }
</style>
