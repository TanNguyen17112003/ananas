<?php
ob_start();
session_start();
$rootPath = '/ananas';
require_once './database/DB.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Off - Ananas</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link rel="icon" type="image/x-icon" href="https://brademar.com/wp-content/uploads/2022/09/Ananas-Logo-PNG-1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <link rel="stylesheet" href="./public/css/product.css">
    
</head>

<body>
    <?php
    include './includes/header.php';
    include './includes/navbar.php';
    ?>
    <?php
    $saleOffProducts = $conn->query("SELECT * FROM product WHERE status = 'Sale Off'");
    ?>
    <div class="container">
        <div class="row mb-4">
            <picture>
                <source media="(max-width: 768px)" srcset="./assets/mobile-saleoff.jpg" class="col-12">
                <img src="./assets/desktop-saleoff.jpg" alt="" class="col-12">
            </picture>
        </div>
        <div class="row">
            <?php
            while ($productRow = $saleOffProducts->fetch_assoc()) {
            ?>
                <div class="col-xl-4 col-sm-6 mb-3">
                    <a href="<?php echo $rootPath ?>/product_detail.php?productId=<?php echo $productRow['product_id'] ?>" class="text-black text-decoration-none">
                        <div class="card h-100 position-relative">

                            <img src="<?php echo $rootPath ?>/public/img/<?php echo $productRow['images']; ?>" class="img-fluid" alt="..." onmouseover="this.src='<?php echo $rootPath ?>/public/img/<?php echo $productRow['subimg_1']; ?>'" onmouseout="this.src='<?php echo $rootPath ?>/public/img/<?php echo $productRow['images']; ?>'">
                            <div class="btn btn-outline-danger position-absolute end-0 bottom-25"><i class=" fa-light fa-heart"></i> </div>
                            <div class="card-body d-flex flex-column justify-content-between align-items-center">
                                <div class="d-flex flex-column justify-content-start">
                                    <h6 class="card-title" style="font-size: 0.75rem"><?php echo $productRow["name"]; ?></h6>
                                </div>
                                <div class="card-text">
                                    <p>
                                        <?php
                                        // Nếu có giá Khuyến mãi
                                        if ($productRow["price_sale"] != 0) {
                                        ?>
                                            <?php
                                            echo '<del class="text-secondary">' . number_format($productRow["price"]) . '</del><sup>đ</sup>';
                                            ?>

                                            <?php
                                            echo '<strong><span class="text-danger ms-3">' . number_format($productRow["price_sale"]) . '<sup>đ</sup></span></strong>';
                                            ?>
                                        <?php
                                            // nếu không có khuyến mãi, hiện giá gốc
                                        } else {
                                            echo '<strong>' . number_format($productRow["price"]) . '<sup>đ</sup></strong>';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer d-flex flex-column">
                                <!-- <a href="<?php echo $rootPath ?>/process_cart.php?action=add&id=<?php echo $productRow['product_id'] ?>&quantity=1" class="btn btn-warning mt-1 <?php if ($productRow["quantity"] == 0) echo 'disabled' ?>"><i class="fa-light fa-cart-plus"></i></a> -->
                                <!-- <button onclick="addCartItem(<?= $productRow['product_id'] ?>)" class="btn btn-warning mt-1 <?php if ($productRow["quantity"] == 0) echo 'disabled' ?>"><i class="fa-light fa-cart-plus"></i></button> -->
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
    require './includes/footer.php';
    ?>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./public/javascripts/loadCartHeader.js"></script>

    <script>
    
    // tăng số lượng
    

    

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