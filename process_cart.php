<?php
    session_start();
    ob_start();
    $rootPath = '/Lap_trinh_web';
    require_once './database/DB.php';
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        settype($_GET['id'], 'int');
        settype($_GET['quantity'], 'int');
        $id = $_GET['id'];
        $quantity = $_GET['quantity'];
        switch ($action) {
            case 'add':
                if ($id==0 || $quantity==0) 
                    header('location: product.php');
                if (isset($_SESSION['cart'][$id])) {
                    // nếu sản phẩm đã có trong giỏ thì tăng số lượng sản phẩm
                    $_SESSION['cart'][$id]['quantity'] += $quantity;
                    $conn->close();
                    header('location: product.php');
                } else {
                    // nếu sản phẩm chưa có trong giỏ thì set số lượng là 1
                    $sql = "SELECT name, images, price, price_sale FROM product WHERE product_id='$id'";
                    $product = $conn->query($sql);
                    if ($product->num_rows > 0) {
                        $row = $product->fetch_array();
                        $price = $row['price_sale'] != 0 ? $row['price_sale'] : $row['price'];
                        $_SESSION['cart'][$id] = array(
                        "id" => $id,
                        "quantity" => $quantity,
                        "price" => $price,
                        "name" => $row['name'],
                        "img" => $row['images']
                        );
                        $conn->close();
                        header('location: product.php');
                    }
                    else {
                        echo '<div class="alert alert-danger mt-2 mb-2">'.'Sản phẩm này không tồn tại'.'</div>';
                        echo "<a href='$rootPath/product.php'>".'Trở về trang chủ'.'</a>'; 
                    }
                }
                break;
            case 'delete':
                if (isset($_SESSION['cart'][$id])==0) {
                    // unset($_SESSION['cart']); 
                    $conn->close();
                    header('location: cart.php');
                }
                else {
                    unset($_SESSION['cart'][$id]);
                    $conn->close();
                    header('location: cart.php');
                }
                    break;
            default:
                $conn->close();
                header('location: product.php');
                break;
        }
    } else {
        $conn->close();
        header('location: product.php');
    }
?>