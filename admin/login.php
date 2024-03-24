<?php
session_start();
ob_start();
$rootPath = '/Lap_trinh_web/admin';
require_once '../database/DB.php';

$sql = "SELECT email, password FROM admin";
$ketqua = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
  <!-- CSS only -->
  <link rel="stylesheet" href="../public/css/showPassword.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<style>
  .bground {
    background: url('../assets/admin-login-background.png') no-repeat center center fixed;
    background-size: cover;
    opacity: 0.8;
    height: 100vh;
  }

  .password-container {
    position: relative;
  }

  .password-container i {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
  }
</style>

<body>
  <?php
  require './includes/header.php';
  ?>

  <?php
  $tb = '';
  $email = '';
  $password = '';
  if (isset($_POST['login_ad'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    while ($row = $ketqua->fetch_assoc()) {
      if ($row["email"] == $email && password_verify($password, $row["password"])) {
        $_SESSION["email_ad"] = $email;
        header('location: index.php');
        break;
      } else $tb = 'Sai email hoặc mật khẩu';
    }
  }
  ?>
  <div class="row d-flex justify-content-center align-items-center bground">
    <!-- <div class="col-lg-12 col-xl-11">
      <div class="card-body p-md-5">
        <div class="row justify-content-center">
          <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

            <p class="text-center text-primary h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Đăng nhập</p>
            <?php
            if (isset($_COOKIE['thongBao'])) {
              echo '<p class="alert alert-success">' . $_COOKIE['thongBao'] . '</p>';
            }
            ?>
            <form class="mx-1 mx-md-4" action="<?php echo $_SERVER['PHP_SELF'] ?>" accept-charset="UTF-8" method="post">
              <div class="d-flex flex-row align-items-center mb-4">
                <div class="input-group flex-nowrap">
                  <span class="input-group-text"><i class="fa-light fa-envelope"></i></span>
                  <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email">
                </div>
              </div>
              <div class="d-flex flex-row align-items-center mb-4">
                <div class="input-group flex-nowrap password-container">
                  <span class="input-group-text"><i class="fa-light fa-key"></i></span>
                  <input id="password" type="password" class="form-control" name="password" value="<?php echo $password; ?>" placeholder="Password">
                  <span>
                    <i class="far fa-eye" id="toggle-password"></i>
                  </span>
                </div>
              </div>
              <?php
              if (!empty($tb)) {
                echo '<div class="alert alert-danger">' . $tb . '</div>';
              }
              ?>
              <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                <input type="submit" name="login_ad" value="Login" class="btn btn-primary" data-disable-with="Create account" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div> -->
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Sign in</h3>

            <div class="form-outline mb-4">
              <input type="email" id="typeEmailX-2" class="form-control form-control-lg" placeholder="Email"/>
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="typePasswordX-2" class="form-control form-control-lg" placeholder="Password"/>
            </div>

            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-start mb-4">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
              <label class="form-check-label" for="form1Example3"> Remember password </label>
            </div>

            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script src="../public/javascripts/showPassword.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>