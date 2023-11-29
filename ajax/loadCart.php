<?php
session_start();
ob_start();
$rootPath = '/Lap_trinh_web';
require_once '../database/DB.php';


$cart = '';
$headerCart = '';
// unset($_SESSION['cart']);
if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
    $totalBill = 0;

    $cart .= '<div class="container-fluid mt-5 mb-5">
                    <div class="row">
                        <div class="col-xl-9 col-md-8 col-sm-12">
                            <table class="table">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Đơn giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Thành tiền</th>
                                        <th scope="col">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>';
    foreach ($_SESSION['cart'] as $key => $value) {
        $cart .=    '<tr>
                                        <td scope="row">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-xl-3 d-none d-xl-block d-xxl-none">
                                                        <img src="' . $rootPath . '/public/img/products/' . $value['img'] . '" class="img-fluid rounded">
                                                    </div>
                                                    <div class="col-xl-9">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p>' . $value['name'] . '</p>
                                                            <p>Mã sản phẩm: <strong>#' . $value['id'] . '</strong></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td> &emsp; &emsp; &emsp;' . number_format($value['price']) . ' <sup>đ</sup></td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-secondary btn-sm ms-1" onclick="subCartQty(' . $value['id'] . ')">-</button>
                                                <button class="btn btn-light disabled">' . $value['quantity'] . '</button>
                                                <button class="btn btn-secondary btn-sm me-1" onclick="addCartQty(' . $value['id'] . ')">+</button>
                                            </div>
                                        </td>
                                        <td class="text-danger">&emsp; &emsp; &emsp; <strong>' . number_format($value['price'] * $value['quantity']) . ' <sup>đ</sup></strong></td>
                                        <td>
                                            &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
                                            <button class="btn btn-danger" onclick="deleteCartItem(' . $value['id'] . ')"><i class="fa-solid fa-trash-can"></i></button>
                                        </td>
                                    </tr>';
        $totalBill += $value['price'] * $value['quantity'];
    }
    $cart .=    '</tbody>
                            </table>
                        </div>
                        <div class="col-xl-3 col-md-4 col-sm-12">
                            <div class="container shadow-sm p-3 mb-5 bg-body rounded">
                                <div class="row">
                                    <table class="table">
                                        <tr>
                                            <td>Tổng tiền</td>
                                            <td class="d-flex justify-content-end"><strong>' . number_format($totalBill) . ' <sup>đ</sup></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Giảm giá</td>
                                            <td class="d-flex justify-content-end"><strong>0 <sup>đ</sup></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Thành tiền</td>
                                            <td class="text-danger d-flex justify-content-end"><strong>' . number_format($totalBill) . ' <sup>đ</sup></strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="row">
                                    <a href="' . $rootPath . '/customer/check_out.php" class="btn btn-primary"><strong>Đặt hàng</strong></a>
                                    <a href="' . $rootPath . '/product.php" class="btn btn-outline-warning mt-2">Tiếp tục mua hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
    $headerCart .= '<i class="fa-sharp fa-solid fa-bag-shopping me-1"></i>' . sizeof($_SESSION['cart']);
} else {
    $cart .=    '<div class="container pt-5 pb-5">
                            <div class="row mb-2">
                                <div class="alert alert-warning">
                                    <span class="h4"> <i class="fa-light fa-face-smile"></i> Giỏ hàng trống! Vui lòng thêm sản phẩm</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-3 col-sm-6 mx-auto">
                                    <a href="' . $rootPath . '/product.php" class="btn btn-primary">Trở về trang sản phẩm</a>
                                </div>
                            </div>
                        </div>';
    $headerCart .= '<i class="fa-sharp fa-solid fa-bag-shopping me-1"></i> 0';
}

$result = array(
    'cart' => $cart,
    'headerCart' => $headerCart
);
// var_dump($result);
// exit;
echo json_encode($result);
