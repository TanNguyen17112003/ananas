<?php
session_start();
ob_start();
$rootPath = '/Lap_trinh_web/admin';
if (!isset($_SESSION["email_ad"])) {
    header('location: ../login.php');
}
require_once '../../database/DB.php';
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

<?php
    $sqlOrders = "SELECT order_id, user.name, status, address_receiver, payment  FROM `ltwdb`.`order`, user WHERE order.user_id = user.user_id";
    $orders = $conn->query($sqlOrders);

    if ($orders->num_rows>0) {
?>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="h4 text-primary">Danh sách đơn hàng</div>
        </div>
        <?php
            if (isset($_COOKIE['thongBao'])) {
                echo '<div class="row"><div class="alert alert-success">'.$_COOKIE['thongBao'].'</div></div>';
            }
        ?>
        <div class="row">
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">#Mã đơn</th>
                        <th scope="col">Người dùng</th>
                        <th scope="col">Nơi giao</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                $i = 1;
                while($row = $orders->fetch_assoc()) {
            ?>
                    <tr>
                        <td scope="col"><?=$i?></td>
                        <td scope="col"><?=$row['order_id']?></td>
                        <td scope="col"><?=$row['name']?></td>
                        <td scope="col"><?=$row['address_receiver']?></td>
                        <td scope="col"><?=number_format($row['payment'])?> <sup>đ</sup></td>
                        <td scope="col"><span class="text-danger"><?=$row['status']?></span></td>
                        <th scope="col">
                            <a href="./show.php?id=<?=$row['order_id']?>" class="btn btn-secondary"><i class="fa-regular fa-eye"></i></a>
                            <a href="./update.php?id=<?=$row['order_id']?>" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                            <a href="./delete.php?id=<?=$row['order_id']?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                        </th>
                    </tr>
            <?php
                    $i++;
                }
            ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
    } else {
?>
<div class="container pt-5 pb-5">
    <div class="row mb-2">
        <div class="alert alert-warning">
            <span class="h4"> <i class="fa-light fa-face-smile"></i> Chưa có đơn đặt hàng!!!</span>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-6 col-sm-12">
            <a href="<?php echo $rootPath?>/" class="btn btn-primary">Trở về trang chủ</a>
        </div>
    </div>
</div>

<?php
    }
  require '../includes/footer.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>