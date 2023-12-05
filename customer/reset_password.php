<?php
    session_start();
    ob_start();
    $rootPath = '/Lap_trinh_web';
    if (!isset($_SESSION['email_user']) && empty($_SESSION['email_user']) ) header('location: login.php');
    require_once '../database/DB.php';
?>

<?php
    require("../validate.php");
    $status = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $is_validated = true;
        $errorPassword = $errorRePassword1 = $errorRePassword2 = "";

        $email = $_SESSION['email_user'];
        $sql = "SELECT password FROM user WHERE email='$email'";
        $ketqua = $conn->query($sql);
        $user = $ketqua->fetch_array();

        $old_password = $_POST['old-password'];
        $new_password1 = $_POST['new-password'];
        $new_password2 = $_POST['new-password2'];
        
        if (!password_verify($old_password, $user["password"])) {
            $is_validated = false;
            $errorPassword = "Mật khẩu không đúng";
        }

        if (validatePassword($new_password1) != "") {
            $is_validated = false;
            $errorRePassword1 = validatePassword($new_password1);
        }

        if (checkPassword($new_password1, $new_password2) != "") {
            $is_validated = false;
            $errorRePassword2 = checkPassword($new_password1, $new_password2);
        }
        
        if ($is_validated) {
            $newPWD = password_hash($new_password1, PASSWORD_DEFAULT);
            $sql = "UPDATE `user` SET password = '$newPWD' WHERE email='$email';";
            if ($conn->query($sql) === TRUE) {
                echo "User password successfully updated";
                $status = "Mật khẩu đã được cập nhật.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Đặt lại mật khẩu</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link rel="stylesheet" href="<?= $rootPath ?>/public/css/showPassword.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <link rel="stylesheet" href="./public/css/home.css">
</head>
<body>
<?php
    require '../includes/header.php';
    require '../includes/navbar.php';
?>
    
<div class="container-fluid bg-light p-xxl-5 p-md-3">
    <div class="col-lg-8 col-md-10 m-auto py-5 px-3" style="box-shadow: 0 10px 20px rgb(0 0 0 / 10%);">
        <h1 class="h1 text-center"><b><code style="color: black;">Đổi mật khẩu</code></b></h1>
        <?php
            if ($status != "") {
              echo '<div class="alert alert-success" role="alert">
                '.$status.'
              </div>';
            }
        ?>
        <form class="mx-5" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <div class="mb-3">
                <label for="Name" class="form-label">Mật khẩu cũ</label>
                <div class="password-container">
                    <input id="password" type="password" name="old-password" class="form-control">
                    <span>
                        <i class="far fa-eye" id="toggle-password"></i>
                    </span>
                </div>
                <div class="form-text text-danger">
                    <?php if (isset($errorPassword)) echo $errorPassword ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu mới</label>
                <div class="password-container">
                    <input id="password2" type="password" name="new-password" class="form-control">
                    <span>
                        <i class="far fa-eye" id="toggle-password2"></i>
                    </span>
                </div>
                <div class="form-text text-danger">
                    <?php if(isset($errorRePassword1)) echo $errorRePassword1 ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Nhập lại mật khẩu mới</label>
                <div class="password-container">
                    <input id="password3" type="password" name="new-password2" class="form-control">
                    <span>
                        <i class="far fa-eye" id="toggle-password3"></i>
                    </span>
                </div>
                <div class="form-text text-danger">
                    <?php if(isset($errorRePassword2)) echo $errorRePassword2 ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-end">Cập nhật</button>
        </form>
    </div>
</div>

<?php
    require '../includes/footer.php';
?>
<script src="<?= $rootPath ?>/public/javascripts/showPassword.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>