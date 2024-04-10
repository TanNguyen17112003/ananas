<?php
$rootPath = '/ananas/';
require_once './database/DB.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

include_once './helper/sendMail.php';

?>

<?php
    require("./validate.php");
    $status = "";
    $name = '';
    $email = '';
    $phone = '';
    $address = '';
    $password = '';
    $re_password = '';
    if (isset($_POST['register'])) {
        $is_validated = true;
        $errorName = $errorEmail = $errorPhone = $errorPassword = $errorRePassword = "";
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $re_password = mysqli_real_escape_string($conn, $_POST['repeatPassword']);
        if($name == "") {
          $is_validated = false;
          $errorName = "Name không được để trống.";
        }
        if (checkEmailExist($email) != ""){
          $is_validated = false;
          $errorEmail = checkEmailExist($email);
        }
        if (validateEmail($email) != "") {
          $is_validated = false;
          $errorEmail = validateEmail($email);
        }
        if (validatePassword($password) != "") {
          $is_validated = false;
          $errorPassword = validatePassword($password);
        }
        if (checkPassword($password, $re_password) != "") {
          $is_validated = false;
          $errorRePassword = "Nhập mật khẩu lần 2 không khớp.";
        }
        if ($is_validated) {
          $hashPassword = password_hash($password, PASSWORD_DEFAULT);
          $verifyCode = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
          // $verifyCode = isset($_SESSION['generated_otp']) ? $_SESSION['generated_otp'] : '';
          $sql = "INSERT INTO user (name, email, phone, address, password, verify_code) 
                  VALUES ('$name', '$email', '$phone', '$address', '$hashPassword', '$verifyCode')";
          if ($conn->query($sql) === TRUE) {
          //     // send mail 
              $receiver = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
              ];
          //     // print_r($receiver);
          //     // exit;
          //     // verifyEmail($mail, $receiver, $verifyCode);
          //     // header("Location: ./customer/verifyOTP.php");
              verifyEmail($mail, $receiver, $verifyCode);
              header("Location: ./auth/register.php?email=$email");

          } else {
              echo "Error: ". $conn->error;
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
    <title>Đăng ký - Ananas</title>
    <link rel="stylesheet" href="<?= $rootPath ?>/public/css/showPassword.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <link rel="icon" type="image/x-icon" href="https://brademar.com/wp-content/uploads/2022/09/Ananas-Logo-PNG-1.png">
    <!-- <link rel="stylesheet" href="./public/css/home.css"> -->
</head>

<body>
    <?php
    require './includes/header.php';
?>

    <section style="background-color: #eee;" class="py-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                    <form class="mx-1 mx-md-4" method="post">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0 ">
                                                <input type="text" id="nameInput" class="form-control" name="name"
                                                    placeholder="Your name" />
                                                <?php if (isset($errorName)) : ?>
                                                <span class="help text-danger form-text mb-2" id="nameHelp">
                                                    <?php echo $errorName; ?>
                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" id="emailInput" class="form-control" name="email"
                                                    placeholder="Your email" />
                                                <?php if (isset($errorEmail)) : ?>
                                                <span class="help text-danger form-text mb-2" id="emailHelp">
                                                    <?php echo $errorEmail; ?>
                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="passwordInput" name="password"
                                                    class="form-control" placeholder="Your password" />
                                                <div style="max-width: 300px;">
                                                    <span class="help text-danger form-text mb-2" id="passwordHelp">
                                                        <?php if (isset($errorPassword)) : ?>
                                                        <?php echo $errorPassword; ?>
                                                        <?php endif; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="repeatPasswordInput" name="repeatPassword"
                                                    class="form-control" placeholder="Repeat your password" />
                                                <?php if (isset($errorRePassword)) : ?>
                                                <span class="help text-danger form-text mb-2" id="repeatPasswordHelp">
                                                    <?php echo $errorRePassword; ?>
                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button name="register" type="submit"
                                                class="btn btn-primary btn-lg">Register</button>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="./assets/signup-image.png" class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="./public/javascripts/validate.js"></script> -->
    <script src="<?= $rootPath ?>/public/javascripts/showPassword.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="./public/javascripts/loadCartHeader.js"></script>

    <script>
    $(document).ready(function() {
        loadCartAjax();

        $(window).scroll(function() {
            if ($(this).scrollTop() > 114) {
                $("#navbar-top").addClass('fix-nav')
            } else {
                $("#navbar-top").removeClass('fix-nav')
            }
        })
    });
    </script>

    <script src="./public/javascripts/liveSearch.js"></script>

</body>

</html>