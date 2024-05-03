<?php
$hostName = 'localhost';
$userName = 'root';
$password = '';
$database = 'ltweb';
$conn = @new mysqli( $hostName, $userName, $password, $database);
$conn->error;
if ($conn->error) {
    die('Kết nối thất bại !!! '.$conn->error);
} 
?>