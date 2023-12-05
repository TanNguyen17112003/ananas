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
        $errorPhone = "";

        $name = $_POST['name'];
        $email = $_SESSION['email_user'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        if (validatePhone($phone) != "") {
            $is_validated = false;
            $errorPhone = validatePhone($phone);
        }
        
        if ($is_validated) {
            $sql = "UPDATE `user` SET name='$name', address = '$address', phone = '$phone' WHERE email='$email';";
            if ($conn->query($sql) === TRUE) {
                //echo "User successfully updated";
                $status = "Đã cập nhật thành công.";
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
    <title>My Account</title>
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

<?php
    $email = $_SESSION['email_user'];
    $sqlFindUser = "SELECT * FROM user WHERE email = '$email'";
    $res = $conn->query($sqlFindUser);
    $user = $res->fetch_array();
?>
    
<div class="container-fluid bg-light p-xxl-5 p-md-3">
    <div class="col-lg-8 col-md-10 m-auto py-5 px-3" style="box-shadow: 0 10px 20px rgb(0 0 0 / 10%);">
        <h1 class="h1 text-center">Thông tin tài khoản</h1>
        <?php
            if ($status != "") {
              echo '<div class="alert alert-success" role="alert">
                '.$status.'
              </div>';
            }
        ?>
        <form class="mx-5" method="post" action="my_account.php">
            <div class="mb-3">
                <label for="Name" class="form-label">Tên khách hàng</label>
                <input type="text" name="name" class="form-control" id="Name" aria-describedby="emailHelp" value="<?php echo $user['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" id="Email" disabled value="<?php echo $user['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="Phone" class="form-label">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" id="Phone" value="<?php echo $user['phone']; ?>">
            </div>
            <div class="mb-3">
                <label for="Address" class="form-label">Địa chỉ</label>
                <input type="text" name="address" class="form-control" id="Address" value="<?php echo $user['address']; ?>">
            </div>
            <button type="submit" class="btn btn-primary float-end">Cập nhật</button>
        </form>
    </div>
</div>

<?php
    require '../includes/footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>