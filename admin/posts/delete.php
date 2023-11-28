<?php
session_start();
$id = $_POST['id'];

require_once '../../database/DB.php';
$query = "DELETE FROM `post` WHERE post_id='" . $id . "'";


if ($conn->query($query) === TRUE) {
    echo "Successfully";
    header('Location: index.php');
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
