<?php
session_start();
unset($_SESSION['login_user']);
$_SESSION = array();
session_destroy();
header("location: login.php");
?>