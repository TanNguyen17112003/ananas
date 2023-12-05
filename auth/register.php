<?php
    ob_start();
    session_start();
    $rootPath = '/Lap_trinh_web';
    
    
    require_once '../database/DB.php';
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
    } else {
        header('location: ../404.php');
    }

    if (isset($_POST['verify'])) {
        if (isset($_POST['verifyCode']) && !empty($_POST['verifyCode'])) {

            $verifyCode = mysqli_escape_string($conn, $_POST['verifyCode']);
            $sqlFindCode = "SELECT verify_code FROM user WHERE email = '$email'";
            $result = $conn->query($sqlFindCode)->fetch_array();
            $code = $result['verify_code'];
            if ($code == $verifyCode) {
                $sqlUpdate = "UPDATE user SET active = 1 WHERE email = '$email'";
                $conn->query($sqlUpdate);
                $_SESSION['success'] = 'Đăng kí thành công, vui lòng đăng nhập lại.';        
                header('location: ../customer/login.php');
            } else {
                $error = 'Mã xác thực không trùng khớp, vui lòng nhập lại!';
            }
        } else {
            $error = 'Vui lòng nhập các trường còn thiếu!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <?php 
        require '../includes/header.php';
    ?>
    
    <div class="container">
        <?php
            if(isset($error)) {
        ?>
        <div class="row mt-5 mb-5">
            <div class="col">
                <div class="alert alert-danger">
                    <?=$error?>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
        
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                <label for="verify-code" class="form-label text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color:#002A54">Xác thực tài khoản</label>
                <form action="<?=$_SERVER['PHP_SELF']?>?email=<?=$email?>" method="POST">
                    <div class="d-flex flex-row align-items-center mb-4">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                            <input type="number" id="verify-code" class="form-control" name="verifyCode">
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-success" value="Xác nhận" name="verify">
                    </div>
                </form>
                <br>
                <div class="row">
                    <div class="alert alert-success text-center">Mã xác thực đã được gửi về email.</div>
                </div>
            </div>
            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center justify-content-center order-1 order-lg-2">
                <img class="img-fluid rounded w-50" alt="Login image" src="../public/img/login.png" />
            </div>
        </div>
    </div>

    <?php
        require '../includes/footer.php';
    ?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>