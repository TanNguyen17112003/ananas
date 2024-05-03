<?php
session_start();
ob_start();
$rootPath = '/ananas/admin';

if (!isset($_SESSION["email_ad"])) {
    header('location: login.php');
}
else {
    header('location: /report');
}
