<?php
    session_start();
    ob_start();
    $rootPath = '/Lap_trinh_web/customer';
    require_once '../../database/DB.php';
    if (isset($_POST['update'])) {
        $reviewId = mysqli_real_escape_string($conn, $_POST['reviewId']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        $sqlUpdate = "UPDATE review SET title = '$title' ,content = '$content' WHERE review_id = '$reviewId'";
        $conn->query($sqlUpdate);
        $conn->close();
        setcookie('thongBao', 'Cập nhật thành công', time()+5);
        header('location: index.php');
    } 
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
    if (isset($_GET['id'])) {
       settype($_GET['id'], 'int');
       $reviewId = $_GET['id'];
       if ($_GET['id'] == 0) header('location: /Lap_trinh_web/404.php');
       $sqlReview = "SELECT review_id, title, content FROM review WHERE review_id = '$reviewId'";
       $ketQua = $conn->query($sqlReview);
    } else {
        $conn->close();
        header('location: /Lap_trinh_web/404.php');
    }

    if ($ketQua->num_rows>0) {
        while($row = $ketQua->fetch_assoc()) {
?>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-xl-4"></div>
        <div class="col-xl-4 col-md-6 col-sm-12 shadow p-3 mb-5 bg-body rounded">
            <div class="h4 text-primary text-center"><b>Cập nhật đánh giá</b></div>
            <form action="<?=$_SERVER["PHP_SELF"]?>" class="text-center" method="post">
                <input type="hidden" name="reviewId" value="<?=$row['review_id']?>">
                <input type="text" class="form-control mt-2" name="title" value="<?=$row['title']?>">
                <textarea name="content" class="form-control mt-2" id="" rows="6"><?=$row['content']?></textarea>
                <input type="submit" class="btn btn-success w-100 mt-2" value="Cập nhật" name="update">
            </form>
        </div>
        <div class="col-xl-4"></div>    
    </div>
</div>
<?php
        }
    } else {
        $conn->close();
        header('location: /Lap_trinh_web/404.php');
    }
?>
<?php
    require '../../includes/footer.php';
?>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>