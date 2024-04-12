<?php
session_start();
ob_start();
$rootPath = '/ananas';
require_once '../database/DB.php';
if (isset($_POST['productId'])) {
    $id = $_POST['productId'];
    if ($id == "")
        header('location: ../404.php');

    if (isset($_SESSION['cart'][$id])) {
        // nếu sản phẩm đã có trong giỏ thì tăng số lượng sản phẩm
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        // nếu sản phẩm chưa có trong giỏ thì set số lượng là 1
        $id_size = mysqli_real_escape_string($conn, $id);
        list($ID, $size) = explode('_', $id_size);
        $sql = "SELECT name, images, price, price_sale FROM product WHERE product_id='$id'";
        $product = $conn->query($sql);
        if ($product->num_rows > 0) {
            $row = $product->fetch_array();
            $price = $row['price_sale'] != 0 ? $row['price_sale'] : $row['price'];
            $_SESSION['cart'][$id] = array(
                "id" => $ID,
                "quantity" => 1,
                "price" => $price,
                "name" => $row['name'],
                "img" => $row['images'],
                "size" => $size,
            );
            $conn->close();
        }
    }
    echo json_encode(array(
        'status' => 'success',
    ));
} else {
    header('location: ../404.php');
}