<?php
session_start();
$id = $_POST['id'];

require_once '../../db/DB.php';
$query = "DELETE FROM `user` WHERE user_id='" . $id . "'";

if ($conn->query($query) === TRUE) {
    echo "Successfully";
    header('Location: index.php');
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
