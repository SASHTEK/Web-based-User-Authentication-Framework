<?php

include 'db_connection.php';

$sql = "SELECT 
            SUM(CASE WHEN userstatus = 'Active' THEN 1 ELSE 0 END) AS active_users,
            SUM(CASE WHEN userstatus = 'Inactive' THEN 1 ELSE 0 END) AS inactive_users
        FROM users";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $active_users = $row['active_users'];
    $inactive_users = $row['inactive_users'];

    $total_users = $active_users + $inactive_users;
    
} else {
    echo "0 results";
}

$conn->close();
?>

<div class="box-card">
    <table class="table-card">
        <tr>
            <td>
                <p class="table-card-title">Active Users</p>
            </td>
            <td>
                <p class="table-card-title"><?php echo $active_users ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="table-card-cont">Inactive Users</p>
            </td>
            <td>
                <p class="table-card-cont"><?php echo $inactive_users ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="table-card-cont">All Users</p>
            </td>
            <td>
                <p class="table-card-cont"><?php echo $total_users ?></p>
            </td>
        </tr>
    </table>
</div>