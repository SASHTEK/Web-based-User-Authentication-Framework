<?php

include 'db_connection.php';

$sql = "SELECT 
            SUM(CASE WHEN usertype = 'Admin' THEN 1 ELSE 0 END) AS admins,
            SUM(CASE WHEN usertype = 'User' THEN 1 ELSE 0 END) AS users,
            SUM(CASE WHEN usertype = 'Manager' THEN 1 ELSE 0 END) AS managers,
            SUM(CASE WHEN usertype = 'Director' THEN 1 ELSE 0 END) AS directors
        FROM users";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $admins = $row['admins'];
    $users = $row['users'];
    $managers = $row['managers'];
    $directors = $row['directors'];
    
} else {
    echo "0 results";
}

$conn->close();
?>

<div class="box-card">
    <table class="table-card">
        <tr>
            <td>
                <p class="table-card-cont">System Admins</p>
            </td>
            <td>
                <p class="table-card-cont"><?php echo $admins ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="table-card-cont">Users</p>
            </td>
            <td>
                <p class="table-card-cont"><?php echo $users ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="table-card-cont">Managers</p>
            </td>
            <td>
                <p class="table-card-cont"><?php echo $managers ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="table-card-cont">Directors</p>
            </td>
            <td>
                <p class="table-card-cont"><?php echo $directors ?></p>
            </td>
        </tr>
    </table>
</div>