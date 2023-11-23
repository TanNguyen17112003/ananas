<?php
session_start();
ob_start();
unset($_SESSION["email_user"]);
header('location: login.php');
?>