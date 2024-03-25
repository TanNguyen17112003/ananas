<?php
session_start();
ob_start();
$rootPath = '/ananas/admin';

if (!isset($_SESSION["email_ad"])) {
    header('location: login.php');
}

require_once '../database/DB.php';

$email = $_SESSION["email_ad"];
$email = mysqli_real_escape_string($conn, $email);
$sqlPassword = "SELECT password FROM admin WHERE email = '$email'";
$ketQua = $conn->query($sqlPassword);
$ketQua = $ketQua->fetch_array();
$password = $ketQua['password'];

if (isset($_POST['change'])) {
	$oldPassword = $_POST['oldPassword'];
	$newPassword = $_POST['newPassword'];
	if ($oldPassword == '' || $newPassword == '') {
		$tb = 'Bạn chưa nhập đầy đủ dữ liệu';
	} else {
		if (!password_verify($oldPassword, $password)) {
			$tb = 'Bạn nhập sai mật khẩu cũ!';
		} else {
			if ($newPassword == $oldPassword) {
				$tb = 'Mật khẩu mới trùng mật khẩu cũ';
			} else {
				$newPWD = password_hash($newPassword, PASSWORD_DEFAULT);
				$sqlUpdate = "UPDATE admin SET password = '$newPWD' WHERE email = '$email'";
				$conn->query($sqlUpdate);
				setcookie('thongBao', 'Đổi mật khẩu thành công! Vui lòng đăng nhập lại', time()+5);
				$conn->close();
				header('location: ./logout.php');
			}
		}
	}
}
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

</head>
<body>

	<!-- <div class="container">
		<div class="row">
			<div class="col text-center h4 text-primary">
				Đổi mật khẩu
			</div>
		</div>
		<?php 
			if (isset($tb)) {
				echo '<div class="row"><div class="alert alert-danger">'.$tb.'</div></div>'; 
			}
		?>
		<div class="row">
			<div class="col-2"></div>
			<div class="col-8 shadow p-3 mb-5 bg-body rounded">
				<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<div class="mb-3">
						<label for="oldPassword" class="form-label">Mật khẩu cũ</label>
						<input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Nhập mật khẩu cũ">
					</div>
					<div class="mb-3">
						<label for="newPassword" class="form-label">Mật khẩu mới</label>
						<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Nhập mật khẩu mới">
					</div>
					<div class="text-center">
						<input type="submit" class="btn btn-primary" value="Xác nhận" name="change">
					</div>
				</form>
			</div>
			<div class="col-2"></div>
		</div>
	</div> -->

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
					<a href="<?php echo $rootPath?>/" class="sidebar-link">
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