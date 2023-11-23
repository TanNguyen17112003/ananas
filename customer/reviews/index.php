<?php
    session_start();
    ob_start();
    $rootPath = '/Lap_trinh_web';
    if (!isset($_SESSION['email_user']) && empty($_SESSION['email_user']) ) header('location: ../login.php');
    require_once '../../database/DB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <link rel="stylesheet" href="./public/css/home.css">
</head>
<body>
<?php
    require '../../includes/header.php';
    require '../../includes/navbar.php';
?>

<?php
    $email = $_SESSION['email_user'];
    $sqlFindUser = "SELECT user_id FROM user WHERE email = '$email'";
    $ketQua = $conn->query($sqlFindUser);
    $user = $ketQua->fetch_array();
    $userId = $user['user_id'];
    $sqlReviews = "SELECT review_id ,title , content, updated_at, name FROM review, product WHERE product.product_id = review.product_id AND user_id = '$userId'";
    $reviews = $conn->query($sqlReviews);
    if ($reviews->num_rows>0) {
?>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="h4 text-primary">Danh sách đánh giá</div>
        </div>
        <?php
            if (isset($_COOKIE['thongBao']) && $_COOKIE['thongBao']!='') {
        ?>
            <div class="row">
                <div class="alert alert-success"><?=$_COOKIE['thongBao']?></div>
            </div>
        <?php
            }
        ?>
        <div class="row">
            <table class="table">
                <thead class="table-warning">
                    <tr>
                        <th scope="col">
                            <span class="d-none d-xl-block d-xxl-none">STT</span>
                        </th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Nội dung</th>
                        <th scope="col">
                            <span class="d-none d-xl-block d-xxl-none">Thời gian</span>
                        </th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                $i = 1;
                while($row = $reviews->fetch_assoc()) {
            ?>
                    <tr>
                        <td scope="col">
                            <span class="d-none d-xl-block d-xxl-none"><?=$i?></span>
                        </td>
                        <td scope="col"><?=$row['name']?></td>
                        <td scope="col"><?=$row['title']?></td>
                        <td scope="col"><?=$row['content']?></td>
                        <td scope="col">
                            <span class="d-none d-xl-block d-xxl-none"><?=$row['updated_at']?></span>
                        </td>
                        <td scope="col">
                            <a href="./update.php?id=<?=$row['review_id']?>" data-bs- class="btn btn-success"><i class="fa-regular fa-wrench"></i></a>
                            <a href="./delete.php?id=<?=$row['review_id']?>" data-bs- class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
            <?php
                    $i++;
                }
            ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
    } else {
?>
<div class="container pt-5 pb-5">
    <div class="row mb-2">
        <div class="alert alert-warning">
            <span class="h4"> <i class="fa-light fa-face-smile"></i> Bạn chưa có đánh giá sản phẩm nào!!!</span>
        </div>
    </div>
    <div class="row">
        <div class="mx-auto w-25">
            <a href="<?php echo $rootPath?>/product.php" class="btn btn-primary">Trở về trang sản phẩm</a>
        </div>
    </div>
</div>
<?php
    }
    require '../../includes/footer.php';
?>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>