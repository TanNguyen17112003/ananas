<?php
session_start();
ob_start();
$rootPath = '/Lap_trinh_web';

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

include_once '../helper/sendMail.php';

$basename = basename($_SERVER['HTTP_REFERER']);
$basname_replace = str_replace($basename, "reset_password.php", $_SERVER['HTTP_REFERER']);

$str_code = rand(100000, 10000000);
$reset_code = str_shuffle("abcdefghijklmnopqrstuvwxyz".$str_code);

$url = $basname_replace."?resetLink=".$reset_code;

// nếu khách hàng chưa đăng nhập thì chuyển đến trang đăng nhập
if (!isset($_SESSION['email_user']) && empty($_SESSION['email_user']) ) header('location: /customer/login.php');

require_once '../database/DB.php';

$email = mysqli_real_escape_string($conn,$_SESSION['email_user']);

if ($conn->connect_error) {
    die("Có lỗi xảy ra".$conn->connect_error);
}

$sqlUser = "SELECT name FROM user WHERE email = '$email'";

$ketQua = $conn->query($sqlUser);
$user = $ketQua->fetch_array();
$name = $user['name'];

if (isset($_POST['resetLink'])) {

    $receiver = [
        'name' => $name,
        'email' => $_SESSION['email_user'],
    ];

	$content =  '<p>Link: '.$url.'</p>';

    sendLink2ChangePWD($mail, $receiver, $content);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <link rel="stylesheet" href="./public/css/home.css">
</head>
<body>
<?php
    require '../includes/header.php';
    require '../includes/navbar.php';
?>
    
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 text-center">
        <label for="verify-code" class="form-label h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color:#002A54">Gửi Link xác thực</label>
        <div class="wrapper">
            <div class="otp">
                <form action="" method="POST">
                    <div class="form-group">
                        <label></label>
                        <input type="submit" class="btn btn-success" name="resetLink" value="Click">
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="alert alert-success">Nhấn nút để nhận Link và thực hiện đổi mật khẩu.</div>
            </div>
        </div>
    </div>
    <div class="col-md-10 col-lg-6 col-xl-6 d-flex align-items-center justify-content-center order-1 order-lg-2">
        <img class="img-fluid rounded w-50" alt="Login image" src="../public/img/login.png" />
    </div>
</div>

<?php
    require '../includes/footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>