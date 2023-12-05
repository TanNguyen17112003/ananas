<?php
$rootPath = '/Lap_trinh_web';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not found</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <link rel="stylesheet" href="./public/css/home.css">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="alert alert-danger" role="alert">
                <i class="fa-duotone fa-triangle-exclamation"></i> 404 Không tìm thấy trang!!!
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-center">
                <a href="<?php echo $rootPath?>" class="btn btn-primary"><i class="fa-sharp fa-solid fa-house"></i>     Trở về trang chủ</a>
            </div>
        </div>
    </div>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>