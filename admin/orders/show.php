<?php
session_start();
ob_start();
$rootPath = '/Lap_trinh_web/admin';
if (!isset($_SESSION["email_ad"])) {
    header('location: ../login.php');
}
require_once '../../database/DB.php';

if (isset($_GET['id'])) {
    settype($_GET['id'], 'int');
    $orderId = mysqli_real_escape_string($conn,$_GET['id']);
    if ($orderId == 0) header('location: ../../404.php');
} else {
    $conn->close();
    header('location: ../../404.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/home.css"> -->
</head>
<body>
<?php
    require '../includes/header.php';
    require '../includes/navbar.php';
?>
    <div class="container mt-5 mb-5 shadow-sm p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="h3 text-primary text-center">Chi tiết hóa đơn <a href="./index.php" class="btn btn-secondary">Back</a></div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-12">
                <?php
                    $sqlOrder = "SELECT order_id, payment_method, address_receiver, phone_receiver, name_receiver, order.updated_at, status, name, email 
                    FROM `ltwdb`.`order`, user 
                    WHERE order.user_id = user.user_id
                    AND order_id = '$orderId'";
                    $ketQua = $conn->query($sqlOrder);
                    $ketQua = $ketQua->fetch_array();
                ?>  
                <div class="text-secondary h5">Đơn hàng #<?=$ketQua['order_id']?></div>
                <div>Người đặt hàng: <?=$ketQua['name']?></div>
                <div>Người nhận: <?=$ketQua['name_receiver']?></div>
                <div>Hình thức thanh toán: <?=$ketQua['payment_method']?></div>
                <div>Địa chỉ nhận hàng: <?=$ketQua['address_receiver']?></div>
                <div>Số điện thoại: <?=$ketQua['phone_receiver']?></div>
                <div>Địa chỉ email: <?=$ketQua['email']?></div>
                <div>Thời gian đặt hàng: <?=$ketQua['updated_at']?></div>
                <div>Trạng thái đơn hàng: 
                <span class="
                    <?php 
                        if ($ketQua['status'] == 'Đang xử lý')
                            echo 'text-danger';
                        elseif ($ketQua['status'] == 'Đang giao')
                            echo 'text-primary';
                        else 
                            echo 'text-success' 
                    ?>
                ">
                    <?=$ketQua['status']?>
                </span>     
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-12">
                <?php
                    $sqlDetail = "SELECT product.name, quantity_item, product.price, product.price_sale  
                    FROM order_item, product 
                    WHERE order_id = '$orderId' 
                    AND order_item.product_id = product.product_id";
                    $detail = $conn->query($sqlDetail);
                ?>
                <ul class="list-group">
                    <li class="list-group-item">
                        <h6>Đơn hàng gồm <?=$detail->num_rows?> sản phẩm</h6>
                    </li>
                    <?php 
                        $totalBill = 0;
                    ?>
                    <?php while($row = $detail->fetch_assoc()) { ?>
                        <li class="list-group-item">
                            <p class="d-flex justify-content-between">
                                <span><?=$row['quantity_item']?>x <?=$row['name']?></span>
                                <?php if (is_null($row['price_sale'])) { ?>
                                    <span><?=number_format($row['price']*$row['quantity_item'])?> <sup>đ</sup> </span>
                                    <?php 
                                        $totalBill += $row['price']*$row['quantity_item'];
                                    ?>
                                <?php } else {?>
                                    <span><?=number_format($row['price_sale']*$row['quantity_item'])?> <sup>đ</sup> </span>
                                    <?php 
                                        $totalBill += $row['price_sale']*$row['quantity_item'];
                                    ?>
                                <?php } ?>
                                
                            </p>
                        </li>
                    <?php } ?>
                    <li class="list-group-item">
                        <p class="d-flex justify-content-between">
                            <span>Tổng hóa đơn (đã gồm VAT)</span>
                            <span class="text-danger"><strong><?=number_format($totalBill)?> <sup>đ</sup></strong> </span>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php
  require '../includes/footer.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>