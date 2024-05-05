<?php
session_start();
ob_start();
$rootPath = '/ananas/admin/';
if (!isset($_SESSION["email_ad"])) {
    header('location: login.php');
}

require_once '../../database/DB.php';

// lấy productId
if (isset($_GET['id'])) {
    settype($_GET['id'], 'int');
    $productId = mysqli_real_escape_string($conn,$_GET['id']);
    if ($productId == 0) header('location: ../../404.php');
} else {
    $conn->close();
    header('location: ../../404.php');
}
$sqlFindProduct = "SELECT * FROM product, product_instock WHERE product.product_id = product_instock.product_id AND product.product_id = '$productId'";
$product = $conn->query($sqlFindProduct);
if ($product->num_rows <= 0) {
    $conn->close();
    header('location: ../../404.php');
}
// khi nút update được nhấn
if (isset($_POST['update'])) {
    
    if ($_FILES['images']['error']>0 && $_FILES['images']['error']!=4) {
        $tb = 'Lỗi: lỗi file hình - mã lỗi:'.$_FILES['images']['error'].'<br>';
    } else {
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $size = mysqli_real_escape_string($conn, $_POST['size']);
        $quantity = mysqli_real_escape_string($conn,$_POST['quantity']);
        $price = mysqli_real_escape_string($conn,$_POST['price']);
        $priceSale = mysqli_real_escape_string($conn,$_POST['priceSale']);
        $description = mysqli_real_escape_string($conn,$_POST['description']);
        $categoryId = mysqli_real_escape_string($conn,$_POST['categoryId']);
        $images = '';
        if ($_FILES['images']['error']==4) {
            $images = 'NULL';
        }
        else{
            $images = mysqli_real_escape_string($conn,$_FILES['images']['name']);

        }
        $imagesOld = mysqli_real_escape_string($conn,$_POST['imagesOld']);
        if ($name == '' || $quantity == '' || $description == '' || $price == '' || $categoryId =='' ) {
            $tb .= 'Bạn chưa nhập đủ các trường'.'<br/>';
        } else {
        if ($images == 'NULL'){
            $images = $imagesOld;
        }
        $sqlProductUpdate = "UPDATE product SET name = '$name', category_id = $categoryId, description = '$description', images = '$images',  price = '$price', price_sale = NULL
            WHERE product_id = '$productId'";
        if ($priceSale != ''){
            $sqlProductUpdate = "UPDATE product SET name = '$name', category_id = $categoryId, description = '$description', images = '$images',  price = '$price', price_sale = '$priceSale'
                        WHERE product_id = '$productId'";;
        }
        
        $sqlProductInstockUpdate = "UPDATE product_instock SET quantity = '$quantity' WHERE product_id = '$productId' AND size = '$size'"; 
        $conn->query($sqlProductUpdate);
        $conn->query($sqlProductInstockUpdate);
        if ($images!=$imagesOld){
            if (! file_exists("../../public/img/".$images))
            move_uploaded_file($_FILES["images"]["tmp_name"],"../../public/img/".$images);
            unlink("../../public/img/".$imagesOld);
        }
        
        $conn->close();
        setcookie('thongBao', 'Cập nhật sản phẩm thành công', time()+5);
        header("location: index.php");
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
    <title>Cập nhật sản phẩm</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <link rel="icon" type="image/x-icon" href="https://brademar.com/wp-content/uploads/2022/09/Ananas-Logo-PNG-1.png">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/sidemenu.css">
    <link rel="stylesheet" href="../../public/css/base.css">
    <link rel="stylesheet" href="../../public/css/home.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <?php
        require '../includes/sidemenu.php'
    ?>
    <div class="main p-3">
        <div class="container-fluid"></div>
        <div class="container">
            <div class="row">
                <div class="col text-center h4 text-primary">
                    Cập nhật sản phẩm
                </div>
            </div>
            <?php 
                if (isset($tb)) {
                    echo '<div class="row"><div class="alert alert-danger">'.$tb.'</div></div>'; 
                }
            ?>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8 shadow p-3 mb-5 bg-body rounded">
                    <form action="<?=$_SERVER['PHP_SELF']?>?id=<?=$productId?>" method="post" enctype="multipart/form-data">
                        <?php
                            $product = $product->fetch_array();
                        ?>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name" value="<?=$product['name']?>" id="name" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="size" class="form-label d-block">Kích thước</label>
                                <select id="size" class="selectpicker bs-select-hidden p-2 w-100" data-style="btn" name="size">
                                    <?php
                                         $sizes = [];
                                         $sqlShowSizes = "SELECT size FROM product_instock WHERE product_id = '$productId'";
                                         $sizesResult = $conn->query($sqlShowSizes);
                                         while ($sizeRow = $sizesResult->fetch_assoc()) {
                                             echo '<option value="' . $sizeRow['size'] . '">' . $sizeRow['size'] . '</option>';
                                             $sizes[] = $sizeRow['size'];
                                         }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="quantity" class="form-label">Số lượng tồn kho</label>
                                <input type="number" class="form-control" name="quantity" value="<?=$product['quantity']?>" id="quantity" placeholder="Nhập số lượng hàng còn lại">
                            </div>
                        </div>
                       
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" class="form-control" name="price" value="<?=$product['price']?>" id="price" placeholder="Nhập giá bán của sản phẩm">
                        </div>
                        <div class="mb-3">
                            <label for="price_sale" class="form-label">Giá giảm</label>
                            <input type="number" class="form-control" name="priceSale" value="<?=$product['price_sale']?>" id="price_sale" placeholder="Giảm giá">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Mô tả</label>
                            <textarea id="desc" name="description" class="form-control mt-2" id="" rows="6" placeholder="Nhập mô tả cho sản phẩm"><?=$product['description']?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Thể loại</label>
                            <select name="categoryId" class="form-select" id="">
                                <?php
                                    $sqlCategory = "SELECT * FROM category";
                                    $category = $conn->query($sqlCategory);
                                    while($row = $category->fetch_assoc()){
                                ?>
                                <option value="<?=$row['category_id']?>" <?php if ($product['category_id']==$row['category_id']) echo 'selected'; ?> ><?=$row['category_name']?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <img src="../../public/img/<?=$product['images']?>" width="200px" alt="">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Hình</label>
                                <input class="form-control" name="images" type="file" id="formFile">
                                <input class="form-control" name="imagesOld" value="<?=$product['images']?>" type="hidden">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary w-100 mt-2" value="Cập nhật" name="update">
                    </form>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="../public/javascripts/sidemenu.js"></script>
</body>
</html>