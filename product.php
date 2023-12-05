<?php
session_start();
ob_start();
$rootPath = '/Lap_trinh_web';
require_once './database/DB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu đồ uống</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <link rel="stylesheet" href="./public/css/product.css">
</head>
<body>
<?php
    require './includes/header.php';
    require './includes/navbar.php';
?>
<?php
    $sqlShowProducts = "SELECT product_id, name, quantity, images, price, price_sale FROM product";
    if (isset($_GET['categoryId'])) {
        settype($_GET['categoryId'], 'int');
        $categoryId = $_GET['categoryId'];
        if ($categoryId == 0) {
            $sqlShowProducts = "SELECT product_id, name, quantity, images, price, price_sale FROM product";
        } else {
            $sqlShowProducts = "SELECT product_id, name, quantity, images, price, price_sale FROM product WHERE category_id = '$categoryId'";
        }
    } else {
        $categoryId = 0;
    }
    $products = $conn->query($sqlShowProducts);
?>
<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="list-group mb-5">
                <span class="list-group-item bg-primary text-dark" aria-current="true">
                    <b class="user-select-none text-light">Danh mục</b>
                </span>
                <?php
                    $sqlShowCategory = "SELECT * FROM category";
                    $category = $conn->query($sqlShowCategory);
                    $i = 1;
                    while ($row = $category->fetch_assoc()) {
                ?>
                <a href="<?php echo $rootPath?>/product.php?categoryId=<?php echo $row['category_id']?>" class=" <?php if ($categoryId == $i) echo 'bg-primary text-dark bg-opacity-25' ?> list-group-item list-group-item-action "><?php echo $row['category_name']?></a>
                <?php
                        $i++;
                    }
                ?>
                <a href="<?php echo $rootPath?>/product.php?categoryId=0" class="list-group-item list-group-item-action <?php if($categoryId == 0) echo 'bg-primary text-dark bg-opacity-25'?>">Xem tất cả</a>
            </div>
        </div>
        <div class="col-xl-10 col-md-8 col-sm-6">
            <div class="container mb-5">    
                <div class="row">
                    <?php
                    if ($products->num_rows>0) {
                        $totalProducts = $products->num_rows;
                        $currentPage = 1;
                        if (isset($_GET['page'])) {
                            settype($_GET['page'], 'int'); // tránh injection, trang tự về 0
                            $currentPage = $_GET['page'];
                        }
                        $limit = 4;
                        $totalPage = ceil($totalProducts/$limit);

                        // giới hạn phân trang trong 1-totalPage
                        if($currentPage > $totalPage) {
                            $currentPage = $totalPage;
                        } elseif ($currentPage < 1) { 
                            $currentPage = 1;
                        }

                        $start = ($currentPage - 1)*$limit;
                        $sqlShowProducts = $sqlShowProducts." LIMIT $start, $limit";
                        $products = $conn->query($sqlShowProducts); 
                        while ($row = $products->fetch_assoc()) {
                    ?>
                    <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                        <div class="card h-100">
                        <!-- <div class="product-img" style="height:300px; width:100%; background-size:300px; background-image: url(<?php echo $rootPath?>/public/img/products/<?php echo $row["images"];?>);"></div> -->
                        <img src="<?php echo $rootPath?>/public/img/products/<?php echo $row['images'];?>" class="img-fluid" alt="...">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="d-flex flex-column justify-content-start">
                                <h6 class="card-title"><?php echo $row["name"];?></h6>
                            </div>
                            <div class="card-text">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>    
                                        <?php  
                                            if ($row["quantity"] > 0) {
                                        ?>
                                            <span class="badge bg-success">Còn hàng</span>
                                        <?php
                                            } else {
                                        ?>
                                            <span class="badge bg-danger">Hết hàng</span>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="btn btn-outline-danger"><i class=" fa-light fa-heart"></i> </div>
                                </div>
                                <p>
                                <?php
                                    // Nếu có giá Khuyến mãi
                                    if ($row["price_sale"] != 0 ) {
                                ?>
                                        <?php
                                            echo '<del class="text-secondary">'.number_format($row["price"]).'</del><sup>đ</sup>'; 
                                        ?> 
                                    
                                        <?php
                                            echo '<strong><span class="text-danger ms-3">'.number_format($row["price_sale"]).'<sup>đ</sup></span></strong>'; 
                                        ?> 
                                <?php
                                // nếu không có khuyến mãi, hiện giá gốc
                                    } else {
                                        echo '<strong>'.number_format($row["price"]).'<sup>đ</sup></strong>'; 
                                    }
                                ?>
                                </p>
                            </div>
                        </div>
                        <div class="card-footer d-flex flex-column">
                            <a href="<?php echo $rootPath?>/product_detail.php?productId=<?php echo $row['product_id']?>" class="btn btn-primary">Xem chi tiết</a>
                            <!-- <a href="<?php echo $rootPath?>/process_cart.php?action=add&id=<?php echo $row['product_id']?>&quantity=1" class="btn btn-warning mt-1 <?php if ($row["quantity"] == 0) echo 'disabled'?>"><i class="fa-light fa-cart-plus"></i></a> -->
                            <button onclick="addCartItem(<?=$row['product_id']?>)" class="btn btn-warning mt-1 <?php if ($row["quantity"] == 0) echo 'disabled'?>"><i class="fa-light fa-cart-plus"></i></button>
                        </div>
                        </div>
                    </div>
                    <?php
                        }          
                    } else {
                        echo '<div class="alert alert-warning" role="alert"><i class="fa-light fa-circle-exclamation"></i> Không tìm thấy sản phẩm nào</div>';
                    }
            
                    $conn->close();
                    ?>
                </div>
                <?php 
                    if($products->num_rows > 0) {
                ?>
                <div class="row paging">
                    <!-- Phân trang -->
                    <nav class="mt-3">
                        <ul class="pagination pagination-lg d-flex">
                        <?php 
                            if ($currentPage > 1 && $totalPage >1) {
                        ?>
                            <li class="page-item">
                                <a href="<?php echo $rootPath?>/product.php?categoryId=<?php echo $categoryId ?>&page=<?php echo ($currentPage - 1); ?>" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" data-remote="true">&lsaquo; Prev</a>
                            </li>
                        <?php
                            }
                        ?>

                        <?php
                            for ($i=1; $i <= $totalPage; $i++) { 
                                if ($i == $currentPage) {
                        ?>
                            <li class="page-item active">
                                <span rel="prev" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-light" data-remote="true"><?php echo $i ?></span>
                            </li>
                        <?php
                                }  else {
                        ?>
                            <li class="page-item">
                                <a data-remote="true" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="<?php echo $rootPath ?>/product.php?categoryId=<?php echo $categoryId ?>&page=<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                        <?php
                                } 
                            }
                        ?>
                        <?php
                            if ($currentPage < $totalPage && $totalPage > 1) {
                        ?>
                            <li class="page-item">
                                <a href="<?php echo $rootPath;?>/product.php?categoryId=<?php echo $categoryId ?>&page=<?php echo ($currentPage + 1) ?>" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" data-remote="true">Next &rsaquo;</a>
                            </li>
                        <?php
                            }
                        ?>
                        </ul>
                    </nav>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>


<?php
    require './includes/footer.php';
?>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./public/javascripts/loadCartHeader.js"></script>

<script>
    // tăng số lượng
    function addCartItem(pId) {
        var id = pId;
        console.log(id);
        $.ajax({
            url: "<?=$rootPath?>/ajax/addCartItem.php",
            type: "POST",
            data: {
                productId: id,
            },
            success: function (data) {
                alert("Thêm sản phẩm thành công");
                loadCartAjax();
            },
            error: function () {
                alert("Lỗi thao tác");
            }
        });
    }

    $(document).ready(function() {
            loadCartAjax();
            
            $(window).scroll(function(){
                if($(this).scrollTop()>114){
                $("#navbar-top").addClass('fix-nav')
                }else{
                    $("#navbar-top").removeClass('fix-nav')
                }}
            )
    });

</script>
<script src="./public/javascripts/liveSearch.js"></script>
</body>
</html>