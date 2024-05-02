<?php
session_start();
ob_start();
$rootPath = '/ananas';
require_once '../database/DB.php';


$cart = '';
$headerCart = '';
// unset($_SESSION['cart']);
if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
    $totalBill = 0;

    $cart .= '<div class="container-fluid mt-5 mb-5">
                    <div class="row">
                    <div class="col-xl-9 col-md-8 col-sm-12">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr class="table-primary" style="text-align: center">
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Size</th>
                                <th scope="col">Thành tiền</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>';
    $checkoutDisabled = "";
    foreach ($_SESSION['cart'] as $key => $value) {

        if (!isset($value['id'])){
            unset($_SESSION['cart'][$key]);
            continue;
        }
        $productID = $value["id"];
        $productSize = $value["size"];
        $sqlFindProduct = "SELECT * FROM product_instock WHERE  product_instock.product_id = '$productID' AND product_instock.size = '$productSize' LIMIT 1";
        $product = $conn->query($sqlFindProduct);
        $row = $product->fetch_assoc();
        $maxQuantity = $row['quantity'];
        $quantity = $value['quantity'];
        if ($value['quantity']>$maxQuantity){
            $quantity = $maxQuantity;
            $_SESSION['cart'][$productID.'_'.$productSize]['quantity'] = $maxQuantity;
        }
        $addDisabled = "";
        $subDisabled = "";
        $leftBadge = '<div class="pb-3">
        <span class="badge bg-success" id="product-quantity">Còn '.$maxQuantity.' sản phẩm </span>
        </div>';
        if ($maxQuantity<1){
            $addDisabled = "disabled";
            $subDisabled = "disabled";
            $checkoutDisabled = "disabled";
            $leftBadge = '<div class="pb-3">
        <span class="badge bg-danger" id="product-quantity">Hết hàng</span>
        </div>';
        }
        if ($maxQuantity <= $quantity){
            $addDisabled = "disabled";
        }
        if (0 == $quantity){
            $subDisabled = "disabled";
        }

        $cart .=    '<tr>           
                                   <td scope="row" class="align-middle">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-3 d-none d-xl-block">
                <img src="' . $rootPath . '/public/img/' . $value['img'] . '" class="img-fluid rounded">
            </div>
            <div class="col-xl-9">
                <div class="d-flex flex-column justify-content-center">
                    <p>' . $value['name'] . '</p>
                    <p>Mã sản phẩm: <strong>#' . $value['id'] . '</strong></p>
                    '.$leftBadge.'
                </div>
            </div>
        </div>
    </div>
</td>
                                    <td class="text-center align-middle">' . number_format($value['price']) . ' <sup>đ</sup></td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <button class="btn btn-secondary btn-sm ms-1" onclick="subCartQty(\'' . $value['id'] . '_' . $value['size'] . '\')" '.$subDisabled.'>-</button>
                                            <button class="btn btn-light disabled" id="' . $value['id'] . '_' . $value['size'] . '" min="1" max="'.$maxQuantity.'">' . $quantity . '</button>
                                            <button class="btn btn-secondary btn-sm me-1" onclick="addCartQty(\'' . $value['id'] . '_' . $value['size'] . '\')" '.$addDisabled.'>+</button>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">' . $value['size'] . '</td>
                                    <td class="text-center text-danger align-middle"><strong>' . number_format($value['price'] * $quantity) . ' <sup>đ</sup></strong></td>
                                    <td class="text-center align-middle">
                                        <button class="btn btn-danger" onclick="deleteCartItem(\'' . $value['id'] . '_' . $value['size'] . '\')"><i class="fa-solid fa-trash-can"></i></button>
                                    </td>
                                </tr>';
        $totalBill += $value['price'] * $quantity;
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
                                    <a href="' . $rootPath . '/customer/check_out.php" class="btn btn-primary '.$checkoutDisabled.'"><strong>Đặt hàng</strong></a>
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