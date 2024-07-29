<?php
include 'authentication\auth_gen.php';

$_SESSION = array();

session_destroy();

header("Location: index.html");
exit;
?>
