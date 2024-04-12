<?php
session_start();
ob_start();
unset($_SESSION["email_user"]);
unset($_SESSION["cart"]);
header('location: login.php');
?>