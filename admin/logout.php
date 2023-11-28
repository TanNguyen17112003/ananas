<?php
session_start();
ob_start();
unset($_SESSION["email_ad"]);
header('location: login.php');
?>