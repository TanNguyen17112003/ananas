


<?php
session_start();
$rootPath = '/ananas/admin';
if (!isset($_SESSION["email_ad"])) {
    header('location: login.php');
}
require_once '../../database/DB.php';
$rootPath = '/ananas/admin';
// đơn hàng
$sqlOrder = "SELECT count(*) as count FROM `ltweb`.`order`";
$dataCountOrder = $conn->query($sqlOrder);
$dataCountOrder = $dataCountOrder->fetch_array();
$countOrder = $dataCountOrder['count'];
// khách hàng
$sqlCustomer = "SELECT count(*) as count FROM user";
$dataCountCustomer = $conn->query($sqlCustomer);
$dataCountCustomer = $dataCountCustomer->fetch_array();
$countCustomer = $dataCountCustomer['count'];
// sản phẩm
$sqlProduct = "SELECT count(*) as count FROM product";
$dataCountProduct = $conn->query($sqlProduct);
$dataCountProduct = $dataCountProduct->fetch_array();
$countProduct = $dataCountProduct['count'];
// doanh thu
$sqlOrder = "SELECT sum(payment) as count FROM `ltweb`.`order` WHERE status = 'Đã giao'";
$dataRevenue = $conn->query($sqlOrder);
$dataRevenue = $dataRevenue->fetch_array();
$revenue = $dataRevenue['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/base.css">
    <link rel="stylesheet" href="../../public/css/product.css">
    <link rel="stylesheet" href="../../public/css/sidemenu.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="https://brademar.com/wp-content/uploads/2022/09/Ananas-Logo-PNG-1.png">
    
</head>
<body>

<div style="display: flex;">
<div style="width: 10%">
<?php
    require '../includes/sidemenu.php';
?>
</div>

	<div class="row" style="width: 100%">
        <div class="text-center h2 text-primary mb-4">
            Thống kê tổng quan
        </div>
        <a class="col-xl-3 col-md-6 col-sm-12 text-decoration-none" href="<?php echo $rootPath?>/orders">
            <div class="card bg-info">
                <div class="card-body">
                    <h5 class="card-title text-light" style="font-size: 40px;"><b><?=$countOrder?></b></h5>
                    <p class="card-text text-light" style="font-size: 20px;">Đơn hàng</p>
                </div>
            </div>
        </a>
        <a class="col-xl-3 col-md-6 col-sm-12 text-decoration-none" href="<?php echo $rootPath?>/products">
            <div class="card bg-success">
                <div class="card-body">
                <h5 class="card-title text-light" style="font-size: 40px;"><b><?=$countProduct?></b></h5>
                    <p class="card-text text-light" style="font-size: 20px;">Sản phẩm</p>
                </div>
            </div>
        </a>
        <a class="col-xl-3 col-md-6 col-sm-12 text-decoration-none">
            <div class="card bg-warning">
                <div class="card-body">
                <h5 class="card-title text-light" style="font-size: 40px;"><b><?=$revenue?></b></h5>
                    <p class="card-text text-light" style="font-size: 20px;">Doanh thu (VND)</p>
                </div>
            </div>
        </a>
        <a class="col-xl-3 col-md-6 col-sm-12 text-decoration-none" href="<?php echo $rootPath?>/users">
            <div class="card bg-danger">
                <div class="card-body">
                <h5 class="card-title text-light" style="font-size: 40px;"><b><?=$countCustomer?></b></h5>
                    <p class="card-text text-light" style="font-size: 20px;">Khách hàng</p>
                </div>
            </div>
        </a>
	</div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="../../public/javascripts/sidemenu.js"></script>
</body>
</html>