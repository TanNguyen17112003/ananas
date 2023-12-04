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
    <title>Document</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <link rel="stylesheet" href="./public/css/search.css">
</head>
<body>
<?php
    require './includes/header.php';
    require './includes/navbar.php';
?>

<?php
    if (!empty($_GET['key'])) {
        // $key = trim(addslashes($_GET['key']));
        $key = trim(mysqli_real_escape_string($conn,$_GET['key']));
    } else {
        header('location: index.php');
    } 
    $sqlSearch = "SELECT * FROM product WHERE product.name LIKE '%$key%' or product.description LIKE '%$key%'";
    $products = $conn->query($sqlSearch);
?>
<div class="container ps-5 pe-5 pt-5 pb-5">  
        <?php 
            if ($products->num_rows>0) {
                $totalProducts = $products->num_rows;
        ?>
    <div class="row">
        <div class="d-flex justify-content-start me-4 mb-2">
            <button class="btn btn-outline-primary me-2">Tất cả (<?php echo $totalProducts?>)</button>
            <button class="btn btn-outline-primary me-2">Giá tăng dần</button>
            <button class="btn btn-outline-primary me-2">Giá giảm dần</button>
        </div>
    </div>
    <div class="row mt-3 mb-3">
        <div class="h6">Tìm thấy <?php echo $totalProducts?> kết quả</div>
    </div>    
    <div class="row">
        <?php
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
            $sqlSearch = $sqlSearch." LIMIT $start, $limit";
            $products = $conn->query($sqlSearch); 
            while ($row = $products->fetch_assoc()) {
        ?>
        <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
            <div class="card h-100">
            <!-- <div class="product-img" style="background-image: url(<?php echo $rootPath?>/public/img/products/<?php echo $row["images"];?>);"></div> -->
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
                    <a href="<?php echo $rootPath?>/process_cart.php?action=add&id=<?php echo $row['product_id']?>" class="btn btn-warning mt-1 <?php if ($row["quantity"] == 0) echo 'disabled'?>"><i class="fa-light fa-cart-plus"></i></a>
                </div>
            </div>
        </div>
        <?php
            }          
        } else {
        ?>
            <div class="alert alert-warning" role="alert">
                <i class="fa-light fa-circle-exclamation"></i>
                Rất tiếc, <strong>theCoffeeHouse.com</strong> không tìm thấy kết quả nào phù hợp với từ khóa "<?php echo $key?>"
            </div>
            <div class="d-flex justify-content-center">
                <div>
                    <h6>Để tìm được kết quả chính xác hơn, bạn vui lòng:</h6>
                    <ul>
                        <li>Kiểm tra lỗi chính tả của từ khóa đã nhập</li>
                        <li>Thử lại bằng từ khóa khác</li>
                        <li>Thử lại bằng những từ khóa tổng quát hơn</li>
                        <li>Thử lại bằng những từ khóa ngắn gọn hơn</li>
                    </ul>
                </div>
            </div>
        <?php
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
                    <a href="<?php echo $rootPath?>/search.php?key=<?php echo $key ?>&page=<?php echo ($currentPage - 1); ?>" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" data-remote="true">&lsaquo; Prev</a>
                </li>
            <?php
                }
            ?>

            <?php
                for ($i=1; $i <= $totalPage; $i++) { 
                    if ($i == $currentPage) {
            ?>
                <li class="page-item active">
                    <span rel="prev" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" data-remote="true"><?php echo $i ?></span>
                </li>
            <?php
                    }  else {
            ?>
                <li class="page-item">
                    <a data-remote="true" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="<?php echo $rootPath ?>/search.php?key=<?php echo $key ?>&page=<?php echo $i ?>"><?php echo $i ?></a>
                </li>
            <?php
                    } 
                }
            ?>
            <?php
                if ($currentPage < $totalPage && $totalPage > 1) {
            ?>
                <li class="page-item">
                    <a href="<?php echo $rootPath;?>/search.php?key=<?php echo $key ?>&page=<?php echo ($currentPage + 1) ?>" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" data-remote="true">Next &rsaquo;</a>
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


<?php
    require './includes/footer.php';
?>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="./public/javascripts/loadCart.js"></script>
<script src="./public/javascripts/loadCartHeader.js"></script>

<script>

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