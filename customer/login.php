<?php
session_start();
ob_start();
$rootPath = '/ananas';
require_once '../database/DB.php';

$sql = "SELECT email, password FROM user WHERE active = 1";
$ketqua = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="<?= $rootPath ?>/public/css/showPassword.css">
</head>
<style>
.bg-align {
    margin: 0 auto;
    min-height: 100vh;
}

.form-login {
    border: 1px solid #000000;
    padding-top: 20px;
    padding-bottom: 20px;
    border-radius: 20px;
    box-shadow: gray;
}

@media screen and (min-width: 620px) {
    .side-img {
        width: 200px;
    }
}

@media screen and (min-width: 920px) {
    .side-img {
        width: 400px;
    }

}

@media screen and (max-width: 620px) {
    .side-img {
        display: none;
    }
}
</style>

<body>

    <?php 
    require '../includes/header.php';
?>

    <?php
require("../validate.php");
$email = '';
$password = '';
$tb = '';

if (isset($_POST['login_user'])) {
    $is_validated = true;
    $errorEmail = $errorPassword = "";
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email == "" || $password == "") {
      $is_validated = false;
      $tb = "Vui lòng nhập các ô còn thiếu";
    }
    if (checkEmailExist($email) == ""){
      $is_validated = false;
      $errorEmail = "Email không tồn tại";
    }
    

    if ($ketqua->num_rows == 0) {
      $tb = 'Tài khoản không tồn tại hoặc chưa xác thực!';
      $is_validated = false;
    }
    if ($ketqua->num_rows > 0) {
      while ($row = $ketqua->fetch_assoc()) {
        if ($row["email"] == $email && password_verify($password, $row["password"])) {
          $_SESSION["email_user"] = $email;
          if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) 
              header('location: check_out.php');
            else
              header('location: ../product.php');
        } else {
          $is_validated = false;
          $tb = 'Sai email hoặc mật khẩu';
        }
      }
    }

    if ($email == "" || $password == "") {
      $is_validated = false;
      $tb = "Vui lòng nhập các ô còn thiếu";
    }
    if ($is_validated) {
      $_SESSION["email_user"] = $email;
      if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) 
        header('location: check_out.php');
      else
        header('location: ../product.php');
    }
}
?>

    <!-- <div class="row d-flex justify-content-center align-items-center h-100">
  <div class="col-lg-12 col-xl-11">
    <div class="card-body p-md-5">
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
        <?php
          if (isset($_SESSION['success'])) {
              echo '<div id="success-message" class="mb-2 text-center"><div class="alert alert-success">'.$_SESSION['success'].'</div></div>';
              // Xóa session 'success' sau khi hiển thị để tránh hiển thị lại khi trang được làm mới
              unset($_SESSION['success']);
          }
          ?>
          <script>
            // Sử dụng JavaScript để ẩn thông báo sau 2 giây
            setTimeout(function() {
                var successMessage = document.getElementById('success-message');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 2000);
          </script>
          <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color:#002A54"> 
            Đăng nhập 
          </p>
          <form class="mx-1 mx-md-4" action="<?php echo $_SERVER['PHP_SELF']?>" accept-charset="UTF-8" method="post">
            <div class="d-flex flex-row align-items-center mb-4">
              <div class="input-group flex-nowrap">
                <span class="input-group-text"><i class="fa-light fa-envelope"></i></span>
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email">
              </div>
            </div>
            <div class="d-flex flex-row align-items-center mb-4">
              <div class="input-group flex-nowrap password-container">
                <span class="input-group-text"><i class="fa-light fa-key"></i></span>
                <input type="password" id="password" class="form-control" name="password" value="<?php echo $password; ?>" placeholder="Password">
                <span>
                  <i class="far fa-eye" id="toggle-password"></i>
                </span>
              </div>
            </div>
            
            <p>
              Bạn chưa có tài khoản?
              <a href="/ananas/sign_up.php">Đăng kí ngay</a>
            </p>
            <p class="mt-2 mb-2">
              Quên mật khẩu? <a href="/ananas/auth/forgot_password.php">Lấy lại mật khẩu</a>
            </p>
                <?php 
                    if(!empty($tb)) {
                      echo '<div class="alert alert-danger">'.$tb. '</div>';
                    }
                    else if(!empty($errorEmail)) {
                        echo '<div class="alert alert-danger">'.$errorEmail. '</div>';
                    } else if (!empty($errorPassword)) {
                      echo '<div class="alert alert-danger">'.$errorPassword. '</div>';
                    } 

                ?>
                <?php 
                    
                ?>
            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
              <input type="submit" name="login_user" value="Login" class="btn btn-primary" data-disable-with="Create account" />
            </div>
        </form>        
    </div>
        <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center justify-content-center order-1 order-lg-2">
          <img class="img-fluid rounded w-75" alt="Login image" src="../public/img/login.png" />
        </div>
      </div>
    </div>
  </div>
</div> -->
    <div class="vh-100 row d-flex justify-content-center align-items-center bg-align">
        <div class="container">
            <div class="row">
                <div class="col-6 text-black py-3">

                    <div class="px-5 ms-xl-4 d-flex items-center">
                        <img src="https://brademar.com/wp-content/uploads/2022/09/Ananas-Logo-PNG-1.png" alt="Logo"
                            width="60" height="60" />
                        <span class="h1 fw-bold mb-0 text-warning">Ananas</span>
                    </div>
                    <?php
          if (isset($_SESSION['success'])) {
              echo '<div id="success-message" class="mb-2 text-center"><div class="alert alert-success">'.$_SESSION['success'].'</div></div>';
              // Xóa session 'success' sau khi hiển thị để tránh hiển thị lại khi trang được làm mới
              unset($_SESSION['success']);
          }
          ?>
                    <script>
                    // Sử dụng JavaScript để ẩn thông báo sau 2 giây
                    setTimeout(function() {
                        var successMessage = document.getElementById('success-message');
                        if (successMessage) {
                            successMessage.style.display = 'none';
                        }
                    }, 2000);
                    </script>
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-3 pt-5 pt-xl-0 mt-xl-n5">

                        <form style="width: 23rem;" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                            <div class="input-group mb-3">
                                <input type="email" id="form2Example18" name="email" value="<?php echo $email ?>"
                                    class="form-control form-control-lg" placeholder="Email" />
                            </div>
                            <div class="input-group flex-nowrap mb-3">
                                <input type="password" id="password" class="form-control form-control-lg"
                                    name="password" value="<?php echo $password; ?>" placeholder="Password">
                                <span>
                                    <i class="far fa-eye" id="toggle-password"></i>
                                </span>
                            </div>
                            <div class="pt-1 mb-4">
                                <input type="submit" name="login_user" value="Đăng nhập" class="btn btn-primary w-100"
                                    data-disable-with="Create account" />
                            </div>
                            <?php 
                    if(!empty($tb)) {
                      echo '<div class="alert alert-danger">'.$tb. '</div>';
                    }
                    else if(!empty($errorEmail)) {
                        echo '<div class="alert alert-danger">'.$errorEmail. '</div>';
                    } else if (!empty($errorPassword)) {
                      echo '<div class="alert alert-danger">'.$errorPassword. '</div>';
                    } 
            ?>
                            <p class="small mb-5 pb-lg-2"><a class="text-muted"
                                    href="/ananas/auth/forgot_password.php">Quên mật khẩu?</a></p>
                            <p>Chưa có tài khoản? <a href="/ananas/sign_up.php" class="link-info">Đăng ký
                                    ngay</a></p>

                        </form>

                    </div>

                </div>
                <div class="col-6 ">
                    <img src="../assets/login-sideimage.jpg" class="img-fluid side-img" alt="Login image" />
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="<?= $rootPath ?>/public/javascripts/showPassword.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>