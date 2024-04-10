<?php
session_start();
ob_start();
$rootPath = '/ananas';
if (isset($_POST['productId'])) {
    settype($_POST['productId'], 'int');
    $id = $_POST['productId'];
    if ($id == 0)
        header('location: ../404.php');
    $_SESSION['cart'][$id]['quantity']--;
    if ($_SESSION['cart'][$id]['quantity'] == 0)
        unset($_SESSION['cart'][$id]);
    echo json_encode(array(
        'status' => 'success',
    ));
} else {
    header('location: ../404.php');
}
