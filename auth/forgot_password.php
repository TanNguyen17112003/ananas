<?php
    ob_start();
    session_start();
    $rootPath = '/Lap_trinh_web';
    
    require_once '../database/DB.php';
    require_once '../PHPMailer/src/Exception.php';
    require_once '../PHPMailer/src/PHPMailer.php';
    require_once '../PHPMailer/src/SMTP.php';
    
    include_once '../helper/sendMail.php';

    if (isset($_POST['send'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        if ($email !='') {
            $sqlFind = "SELECT * FROM user WHERE email = '$email'";
            $result = $conn->query($sqlFind);
            if ($result->num_rows > 0) {
                $name = $result->fetch_array()['name']; 
                $password = '@HongTraNgoGia_' . substr(bin2hex(random_bytes(16)), 0, 8);
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $updatePassword = "UPDATE user SET password = '$hashPassword' WHERE email = '$email'";
                $conn->query($updatePassword);
                // send mail
                $receiver = [
                    'email'=> $email,
                    'name'=> $name,
                    'password'=> $password  
                ];
                resetPassword($mail, $receiver);
                $_SESSION['success'] = 'Mật khẩu mới đã gửi về email, vui lòng đăng nhập lại';        
                header('location: ../customer/login.php');
            } else {
                $error = 'Email này chưa đăng kí tài khoản!';
            }
        } else {
            $error = 'Vui lòng nhập email.';
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lấy lại mật khẩu</title>
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
                <label for="email" class="form-label text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color:#002A54">Lấy lại mật khẩu</label>
                <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                    <div class="d-flex flex-row align-items-center mb-4">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text"><i class="fa fa-paper-plane"></i></span>
                            <input type="text" id="email" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-success" value="Xác nhận" name="send">
                    </div>
                </form>
                <br>
                <div class="row">
                    <div class="alert alert-success text-center">Vui lòng nhập vào Email tài khoản của bạn.<br>Chúng tôi có thể giúp bạn lấy lại mật khẩu.</div>
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