<?php
$hostName = 'localhost:3307';
$userName = 'root';
$password = '';
$database = 'ltwdb';
$conn = @new mysqli( $hostName, $userName, $password, $database);
$conn->error;
if ($conn->error) {
    die('Kết nối thất bại !!! '.$conn->error);
} 
?>