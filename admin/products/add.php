<?php
session_start();
ob_start();
$rootPath = '/ananas/admin/';
if (!isset($_SESSION["email_ad"])) {
    header('location: login.php');
}


require_once '../../database/DB.php';
if (isset($_POST['add'])) {
    if ($_FILES['images']['error']>0) {
        $tb = 'Lỗi: lỗi file hình - mã lỗi:'.$_FILES['images']['error'].'<br>';
    } else {
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $price = mysqli_real_escape_string($conn,$_POST['price']);
        $priceSale = mysqli_real_escape_string($conn,$_POST['priceSale']);
        $description = mysqli_real_escape_string($conn,$_POST['description']);
        $categoryId = mysqli_real_escape_string($conn,$_POST['categoryId']);
        $images = mysqli_real_escape_string($conn,$_FILES['images']['name']);
        $sizeArray = json_decode($_POST['sizeArray']);
        $quantityArray = json_decode($_POST['quantityArray']);
        if ($name == '' ||  $description == '' || $price == '' || $priceSale == '' || $categoryId =='' || $images == '' ) {
            $tb .= 'Bạn chưa nhập đủ các trường'.'<br/>';
        } else {
        $sqlProductInsert = "INSERT INTO product (name, category_id, description, images,  price, price_sale) 
                    VALUES ('$name', '$categoryId', '$description', '$images', '$price', '$priceSale')"; 
        
        $conn->query($sqlProductInsert);
        $productId = $conn->insert_id;
        for ($i = 0; $i < count($sizeArray); $i++) {
            $sqlProductInstockInsert = "INSERT INTO product_instock (product_id, size, quantity) 
                    VALUES ('$productId', '$sizeArray[$i]', '$quantityArray[$i]')";
            $conn->query($sqlProductInstockInsert);
        }
        if (! file_exists("../../public/img/".$images))
            move_uploaded_file($_FILES["images"]["tmp_name"],"../../public/img/".$images);
        $conn->close();
        setcookie('thongBao', 'Đã thêm sản phẩm thành công', time()+5);
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
    <title>Document</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/sidemenu.css">
    <link rel="stylesheet" href="../../public/css/base.css">
    <link rel="stylesheet" href="../../public/css/home.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<div class="wrapper">
<?php
    require '../includes/sidemenu.php';
?>
<div class="main p-3">
<div class="container-fluid">
</div>
<div class="container">
    <div class="row">
        <div class="col text-center h4 text-primary">
            Thêm mới sản phẩm
        </div>
    </div>
    <?php 
        if (isset($tb)) {
            echo '<div class="row"><div class="alert alert-danger">'.$tb.'</div></div>'; 
        }
    ?>
    <div class="row">
        <div class="shadow p-3 mb-5 bg-body rounded">
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" value="" id="name" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="mb-3 row">
                    <input type="hidden" name="sizeArray" id="sizeArray">
                    <input type="hidden" name="quantityArray" id="quantityArray">
                    <div class="col-6">
                        <label for="size" class="form-label">Kích thước</label>
                        <input type="number" class="form-control" name="size" value="" id="size" placeholder="Nhập kích thước sản phẩm">
                    </div>
                    <div class="col-6">
                        <label for="quantity" class="form-label">Hàng tồn</label>
                        <input type="number" class="form-control" name="quantity" value="" id="quantity" placeholder="Nhập số lượng hàng còn lại">
                    </div>
                    <table class="mt-3 col-6 container" id="tableForPair">
                        <tr>
                            <td>Kích thước</td>
                            <td>Số lượng</td>
                        </tr>
                    </table>
                    <button type="button" onClick="addNewPair()" name="plus" class="mt-3 col-12 py-3 bg-primary border border-none text-white">Plus</button>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Giá</label>
                    <input type="number" class="form-control" name="price" value="" id="price" placeholder="Nhập giá bán của sản phẩm">
                </div>
                <div class="mb-3">
                    <label for="price_sale" class="form-label">Giá giảm</label>
                    <input type="number" class="form-control" name="priceSale" value="" id="price_sale" placeholder="Giảm giá">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Mô tả</label>
                    <textarea id="desc" name="description" class="form-control mt-2" id="" rows="6" placeholder="Nhập mô tả cho sản phẩm"></textarea>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Thể loại</label>
                    <select name="categoryId" class="form-select" id="">
                        <?php
                            $sqlCategory = "SELECT * FROM category";
                            $category = $conn->query($sqlCategory);
                            while($row = $category->fetch_assoc()){
                        ?>
                        <option value="<?=$row['category_id']?>"><?=$row['category_name']?></option>
                        <?php 
                            }
                        ?>
                    </select>
                </div>
                <div class="d-flex">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Hình</label>
                        <input class="form-control" name="images" type="file" id="formFile">
                    </div>
                </div>
                <input type="submit" class="btn btn-success w-100 mt-2" value="Cập nhật" name="add">
            </form>
        </div>
        <div class="col-xl-2"></div>
    </div>
</div>
</div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="../public/javascripts/sidemenu.js"></script>
<script>
    var sizeArray = [];
    var quantityArray = [];
    function addNewPair() {
        let size = document.getElementById('size').value;
        let quantity = document.getElementById('quantity').value;
        if (sizeArray.includes(size))  {
            var index = sizeArray.indexOf(size);
            quantityArray[index] = quantity;
        }
        else {
            sizeArray.push(size);
            quantityArray.push(quantity);
        }
        document.getElementById('sizeArray').value = JSON.stringify(sizeArray);
        document.getElementById('quantityArray').value = JSON.stringify(quantityArray);
         var table = document.getElementById('tableForPair');
    // Clear the table
    while (table.rows.length > 1) {
        table.deleteRow(1);
    }
    // Add the new data
    for (var i = 0; i < sizeArray.length; i++) {
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = sizeArray[i];
        cell2.innerHTML = quantityArray[i];
    }
    }
</script>
</body>
</html>
