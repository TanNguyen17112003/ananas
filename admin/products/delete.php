<?php
    session_start();
    ob_start();
    $rootPath = '/Lap_trinh_web/admin';
    require_once '../../database/DB.php';
  
    if (isset($_GET['id'])) {
        settype($_GET['id'], 'int');
        if ($_GET['id'] == 0) header('location: ../../404.php');
        $productId = $_GET['id'];
        $sqlFindImg = "SELECT images FROM product WHERE product_id = '$productId'";
        $ketQua = $conn->query($sqlFindImg);
        // Kiểm tra id sản phẩm có trong database không
        if ($ketQua->num_rows>0) {
            $ketQua = $ketQua->fetch_array();
            $images = $ketQua['images'];
            $sqlDelete = "DELETE FROM product WHERE product_id = '$productId'";
            $conn->query($sqlDelete);
            unlink("../../public/img/products/".$images);
            $conn->close();
            setcookie('thongBao', 'Đã xóa sản phẩm thành công', time()+5);
            header("location: index.php");
        } else {
            $conn->close();
            header('location: ../../404.php');
        }
    } else {
        $conn->close();
        header('location: ../../404.php');
    }
?>