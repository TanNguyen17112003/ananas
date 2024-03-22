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
    <title>Ananas</title>
    <link rel="icon" type="image/x-icon" href="https://brademar.com/wp-content/uploads/2022/09/Ananas-Logo-PNG-1.png">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <!-- <link rel="stylesheet" href="./public/css/home.css"> -->
    <style>
        p {
            text-align: justify;
        }
        .card-info:hover {
            border-color: aqua !important;
        }
    </style>
</head>

<body>
    <?php
        require './includes/header.php';
        require './includes/navbar.php';
        $bestSellerQueryString = "SELECT product.product_id, `order`.`order_id`, product.name, SUM(order_item.quantity_item) AS number_sold, product.images
        FROM order_item, product, `order`
        WHERE order_item.product_id = product.product_id 
            AND order_item.order_id = `order`.`order_id` 
            AND MONTH(`order`.`updated_at`) = MONTH(CURRENT_DATE())
            AND YEAR(`order`.`updated_at`) = YEAR(CURRENT_DATE())
        GROUP BY product.product_id
        ORDER BY number_sold DESC
        LIMIT 3";

        $result = mysqli_query($conn,$bestSellerQueryString);
    ?>

    <div id="template-mo-zay-hero-carousel" class="carousel carousel-dark slide mb-5" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000"> 
                    <img class="d-block mx-auto img-fluid" src="https://ananas.vn/wp-content/uploads/Hi-im-Mule_1920x1050-Desktop.jpg" alt="First slide" />
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img class="d-block mx-auto img-fluid" src="https://ananas.vn/wp-content/uploads/Web1920-1.jpeg" alt="First slide" />
            </div>
            <div class="carousel-item" data-bs-interval="3000">          
                <img class="d-block mx-auto img-fluid" src="https://ananas.vn/wp-content/uploads/kv_basas_mobileBanner_4_2019.jpg" alt="First slide" />

            </div>
        </div>
    </div>

    <div class="container-fluid pt-5 pb-5">
        <!-- team member -->
        <div class="container mb-5">
            <div class="row text-center mb-2">
                <div class="h2" style="color:#ED171F">TEAM MEMBERS</div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 col-sm-12 shadow-sm">
                    <div class="text-center card border border-2  card-info">
                        <a href="https://www.facebook.com/nguyenducbinh2003/"><img alt="AVT" width="200" height="200" src="data:image/png;base64,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" class="rounded-circle mb-3 mt-3" /></a>
                        <p class="text-dark" style="text-align: center; font-weight: bold;">Nguyễn Hoàng Duy Tân</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 shadow-sm">
                    <div class="text-center card border border-2  card-info">
                        <a href="https://www.facebook.com/hienlq161"><img alt="AVT" width="200" height="200" src="https://scontent.fsgn8-4.fna.fbcdn.net/v/t39.30808-6/278845862_2866247320339254_5072976998028888841_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeEl2osANthFpodvVHiXCmIQfeHcUstbpYl94dxSy1ulify1UBWSchOfnOcpJkxZLifVQW5kb1cMTVWuT-sGFkzV&_nc_ohc=HpCeZ-Ke4rsAX_oXiLD&_nc_ht=scontent.fsgn8-4.fna&oh=00_AfBKHxgSmR8M90zbZiUz8KC2HHcqx_0xMiTicdsvlb92zw&oe=6602C103" class="rounded-circle mb-3 mt-3" /></a>
                        <p class="text-dark" style="text-align: center; font-weight: bold;">Trần Nguyễn Minh Tuệ</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 shadow-sm">
                    <div class="text-center card border border-2  card-info">
                        <a href="https://www.facebook.com/nguyenconganhluan"><img alt="AVT" width="200" height="200" src="https://scontent.fhan4-3.fna.fbcdn.net/v/t39.30808-6/428710940_918265379774526_7666743542801049874_n.jpg?stp=cp6_dst-jpg&_nc_cat=100&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeEHBHFNzwyCcfXn1dCPPSP3PbyUuj8qHjQ9vJS6PyoeNMvJ2NVldOn5AHgD4UmJQsCklLBqVVDSlqvIbqpvXW3O&_nc_ohc=S3RpwSYzaV0AX85B6e8&_nc_ht=scontent.fhan4-3.fna&oh=00_AfAyQS_Q_Ab079bguS8lvsGnqsrKzFL9w8-jc5a76oODqw&oe=660276CE" class=" rounded-circle mb-3 mt-3" /></a>
                        <p class="text-dark" style="text-align: center; font-weight: bold;">Nguyễn Minh Lộc</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 shadow-sm">
                    <div class="text-center card border border-2 card-info">
                        <a href="https://www.facebook.com/nguyenduytung259"><img alt="AVT" width="200" height="200" src="https://scontent.fhan4-3.fna.fbcdn.net/v/t39.30808-6/422678895_3644956405775072_2989470423597768858_n.jpg?stp=cp6_dst-jpg&_nc_cat=103&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeH3RdvlU56AUgS8tMXbJWEMnTGx1fHn4m-dMbHV8efib3n4Oh3BeC7vpOq2fuAVEk-0NpfqZcmiqtHAiJjURiQP&_nc_ohc=rdZOcqpKxosAX9QP2AI&_nc_ht=scontent.fhan4-3.fna&oh=00_AfC1sTjeHm8DpBIzCw5llcdQh7br8v_N1Ni75hucRu6i7A&oe=660240B6" class="rounded-circle mb-3 mt-3" /></a>
                        <p class="text-dark" style="text-align: center; font-weight: bold;">Trần Đan Huy</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- best seller -->
        <?php function DisplayBestSeller(){ ?>
            <?php 
                global $result;
                if (mysqli_num_rows($result) == 0){
                    return;
                }
            ?>
            <div class="container mb-5">
                <div class="row text-center">
                    <div class="h3 mb-2" style="color:#ED171F">BEST SELLER OF THE MONTH</div>
                </div>
                <div class="row">
                    <?php while($productData = mysqli_fetch_assoc($result)){ ?>
                        <div class="col-xl-4">
                            <div class="text-center">
                                <a href="product_detail.php?productId=<?php echo $productData['product_id']; ?>">
                                    <img alt="topProduct" width="200" height="200" 
                                    src="public/img/products/<?php echo $productData['images']; ?>"
                                    class="rounded-circle mb-3 mt-3 border border-2" />
                                </a>
                                <p class="h4 text-dark" style="text-align: center;"><?php echo $productData['name']; ?></p>
                                <a class="btn btn-primary btn-lg" href="product_detail.php?productId=<?php echo $productData['product_id']; ?>">Buy Now</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php 
            DisplayBestSeller();
        ?>
    </div>

    <?php
    $sqlShowProducts = "SELECT product_id, name, quantity, images, price, price_sale FROM product";
    $categoryId = '';
    if (isset($_POST['search_btn'])) {
        $categoryId = $_POST['categoryId'];
        $sqlShowProducts = "SELECT product_id, name, quantity, images, price, price_sale FROM product WHERE category_id = '$categoryId'";
    }
    $products = $conn->query($sqlShowProducts);
    $totalProducts = $products->num_rows;
    $currentPage = 1;
    if (isset($_GET['page'])) {
        settype($_GET['page'], 'int'); // tránh injection, trang tự về 0
        $currentPage = $_GET['page'];
    }
    $limit = 8;
    $totalPage = ceil($totalProducts / $limit);

    // giới hạn phân trang trong 1-totalPage
    if ($currentPage > $totalPage) {
        $currentPage = $totalPage;
    } elseif ($currentPage < 1) {
        $currentPage = 1;
    }

    $start = ($currentPage - 1) * $limit;
    // $sqlShowProducts = "SELECT product_id, name, quantity, images, price, price_sale FROM product LIMIT $start, $limit";
    $sqlShowProducts = $sqlShowProducts . " LIMIT $start, $limit";
    $products = $conn->query($sqlShowProducts);
    ?>

    <?php
        require './includes/footer.php';
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
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