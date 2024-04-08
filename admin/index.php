<?php
session_start();
ob_start();
$rootPath = '/ananas/admin';

if (!isset($_SESSION["email_ad"])) {
    header('location: login.php');
}

require_once '../database/DB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/base.css">
    <link rel="stylesheet" href="../public/css/home.css">
	<link rel="stylesheet" href="../public/css/sidemenu.css">
	<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="https://brademar.com/wp-content/uploads/2022/09/Ananas-Logo-PNG-1.png">

</head>
<body>
	<div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-list"></i>
                </button>
                <div class="sidebar-logo">
                    <h2 class = "text-white">Ananas</h2>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="<?php echo $rootPath?>/report.php" class="sidebar-link">
                        <i class="lni lni-grid-alt"></i>
                        <span>Thống kê</span>
                    </a>
                </li>
				<li class="sidebar-item">
					<a href="<?php echo $rootPath?>/orders" class="sidebar-link">

						<i class="lni lni-printer"></i>
						<span>Đơn hàng</span>
					</a>
				</li>
				<li class="sidebar-item">
					<a href="<?php echo $rootPath?>/products" class="sidebar-link">

						<i class="lni lni-cart"></i>
						<span>Sản phẩm</span>
					</a>
				</li>
                <li class="sidebar-item">
                    <a href="<?php echo $rootPath?>/users" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Người dùng</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
					<a href="<?php echo $rootPath?>/posts" class="sidebar-link">
						<i class="lni lni-book"></i>
						<span>Tin tức</span>
					</a>
				</li>
				<li class="sidebar-item">
					<a href="<?php echo $rootPath?>/contacts" class="sidebar-link">

						<i class="lni lni-envelope"></i>
						<span>Liên hệ</span>
					</a>
				</li>

				<li class="sidebar-item">
					<a href="<?php echo $rootPath?>/changePassword.php" class="sidebar-link">
						<i class = "lni lni-lock"></i>
						<span>Đổi mật khẩu</span>
					</a>
				</li>
            </ul>
            <div class="sidebar-footer">
                <a href="<?php echo $rootPath?>/logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Đăng xuất</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">
			Dashboard
        </div>
    </div>

	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<script src="../public/javascripts/sidemenu.js"></script>
</body>
</html>