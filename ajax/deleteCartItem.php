<?php
session_start();
ob_start();
$rootPath = '/ananas';
if (isset($_POST['productId'])) {
    $id = $_POST['productId'];
    if ($id == "")
        header('location: ../404.php');
    unset($_SESSION['cart'][$id]);
    echo json_encode(array(
        'status' => 'success',
    ));
} else {
    header('location: ../404.php');
}