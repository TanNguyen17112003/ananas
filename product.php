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
    <title>Sản phẩm - Ananas</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link rel="icon" type="image/x-icon" href="https://brademar.com/wp-content/uploads/2022/09/Ananas-Logo-PNG-1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <link rel="stylesheet" href="./public/css/product.css">
    <style>
        @media (min-width: 992px) {
            .collapse-option {
                display: block !important;
            }
        }

        @media (max-width: 992px) {
            .shipping-banner {
                padding-left: 0;
                padding-right: 0;
            }
        }

        .pagination {
            font-family: 'Ubuntu', sans-serif;
            display: inline-flex;
            position: relative;
        }

        .pagination-outer {
            text-align: center;
        }

        .pagination li a.page-link {
            color: #fff;
            background-color: #333;
            font-size: 20px;
            font-weight: 500;
            line-height: 39px;
            height: 40px;
            width: 40px;
            padding: 0;
            margin: 0 5px;
            border: none;
            border-radius: 7px;
            overflow: hidden;
            position: relative;
            z-index: 1;
            transition: all 0.3s ease 0s;
        }

        .pagination li a.page-link:hover,
        .pagination li a.page-link:focus,
        .pagination li.active a.page-link:hover,
        .pagination li.active a.page-link {
            color: #fff;
            background: #2ecc71;
        }

        .pagination li a.page-link:before,
        .pagination li a.page-link:after {
            content: '';
            background: #555;
            height: 100%;
            width: 7px;
            border-radius: 10px 0 0 10px;
            opacity: 1;
            position: absolute;
            left: 0;
            top: 0;
            z-index: -1;
            transition: all 0.4s ease 0s;
        }

        .pagination li a.page-link:after {
            border-radius: 0 10px 10px 0;
            left: auto;
            right: 0;
            top: auto;
            bottom: 0;
        }

        .pagination li a.page-link:hover:before,
        .pagination li a.page-link:focus:before,
        .pagination li.active a.page-link:before {
            background-color: #27ae60;
            border-radius: 10px 10px 0 0;
            width: 100%;
            height: 7px;
        }

        .pagination li a.page-link:hover:after,
        .pagination li a.page-link:focus:after,
        .pagination li.active a.page-link:after {
            background-color: #27ae60;
            border-radius: 0 0 10px 10px;
            width: 100%;
            height: 7px;
        }

        @media only screen and (max-width: 480px) {
            .pagination {
                font-size: 0;
                border: none;
                display: inline-block;
            }

            .pagination li {
                display: inline-block;
                vertical-align: top;
                margin: 0 0 10px;
            }
        }
    </style>

</head>

<body>
    <?php
    require './includes/header.php';
    require './includes/navbar.php';
    ?>
    <?php
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 15;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;


$getProductsQuery = "SELECT product_id, name, images, price, price_sale, subimg_1, category_id, range_id FROM product, cost_range WHERE ((price_sale IS NOT NULL AND ((low_cost IS NULL AND price_sale <= high_cost) OR (high_cost IS NULL AND price_sale >= low_cost) OR (low_cost IS NOT NULL AND high_cost IS NOT NULL AND price_sale BETWEEN low_cost AND high_cost))) OR (price_sale IS NULL AND price IS NOT NULL AND ((low_cost IS NULL AND price <= high_cost) OR (high_cost IS NULL AND price >= low_cost) OR (low_cost IS NOT NULL AND high_cost IS NOT NULL AND price BETWEEN low_cost AND high_cost))))";
$getCountProductsQuery =("SELECT count(product_id) AS id FROM product, cost_range WHERE ((price_sale IS NOT NULL AND ((low_cost IS NULL AND price_sale <= high_cost) OR (high_cost IS NULL AND price_sale >= low_cost) OR (low_cost IS NOT NULL AND high_cost IS NOT NULL AND price_sale BETWEEN low_cost AND high_cost))) OR (price_sale IS NULL AND price IS NOT NULL AND ((low_cost IS NULL AND price <= high_cost) OR (high_cost IS NULL AND price >= low_cost) OR (low_cost IS NOT NULL AND high_cost IS NOT NULL AND price BETWEEN low_cost AND high_cost))))");
    if (isset($_GET['line'])) {
        $line = $_GET['line'];
    }
    else {
        $line = '';
    }
    if (isset($_GET['material'])) {
        $material = $_GET['material'];
    }
    else {
        $material = '';
    }
    if (isset($_GET['costRange'])) {
        $costRangeId = $_GET['costRange'];
    }
    else {
        $costRangeId = '';
    }
    $lineCondition = '';
            if ($line != '') {
                $lines = explode(',', $line);
                foreach ($lines as $l) {
                    $lineCondition .= " OR name LIKE '%$l%'";
                }
                $lineCondition = substr($lineCondition, 4);
                $lineCondition = " AND ($lineCondition)";
            }
    if (isset($_GET['categoryId'])) {
        $categoryId = $_GET['categoryId'];
        if ($categoryId == 0 || $categoryId == '') {
            
            $getProductsQuery = $getProductsQuery . ($material != '' ? "AND FIND_IN_SET(upper_material, '$material')" : '') . ($costRangeId != '' ? "AND FIND_IN_SET(range_id, '$costRangeId')" : '') . $lineCondition;
            $getCountProductsQuery = $getCountProductsQuery . ($material != '' ? "AND FIND_IN_SET(upper_material, '$material')" : '') . ($costRangeId != '' ? "AND FIND_IN_SET(range_id, '$costRangeId')" : '') . $lineCondition;
        } else {
            $getCountProductsQuery =$getCountProductsQuery . "AND FIND_IN_SET(category_id, '$categoryId')"  . ($material != '' ? " AND FIND_IN_SET(upper_material, '$material')" : '') . ($costRangeId != '' ? "AND FIND_IN_SET(range_id, '$costRangeId')" : '') . $lineCondition;
            $getProductsQuery = $getProductsQuery . "AND FIND_IN_SET(category_id, '$categoryId')"  . ($material != '' ? " AND FIND_IN_SET(upper_material, '$material')" : '') . ($costRangeId != '' ? "AND FIND_IN_SET(range_id, '$costRangeId')" : '') . $lineCondition;
        }
    } else {
        $categoryId = 0;
    }
    $getProductsQuery .= " LIMIT $start, $limit";
    $result = $conn->query($getProductsQuery);
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $total = $conn->query($getCountProductsQuery)->fetch_assoc()['id'];
    $pages = ceil($total / $limit);
    $Previous = $page - 1;
    $Next = $page + 1;
    $categoryIdParam = isset($_GET['categoryId']) ? $_GET['categoryId'] : '';
    ?>
    <div class="mt-lg-5 mb-lg-5">
        <div class="row">
            <div class="col-lg-3 row p-lg-3 p-sm-0">
                <div class="col-6 dropdown-toggle list text-decoration-none text-white p-4 bg-black d-lg-none" data-toggle="collapse" href="#collapseOptions" role="button" aria-expanded="false" aria-controls="collapseOptions">
                    <span class="user-select-none" style="font-size: 2rem; font-weight: bold">Tùy chọn</span>
                </div>
                <div class="col-6 text-white p-4 bg-black d-lg-none" style="text-align: right; border-left: 1px solid #ddd">
                    <span style="font-size: 2rem; font-weight: bold;"><?= $total ?> sản phẩm</span>
                </div>
                <div class="px-4 collapse-option" id="collapseOptions">
                    <div class="mb-5">
                        <a class="dropdown-toggle list text-decoration-none text-warning" data-toggle="collapse" href="#collapseStyle" role="button" aria-expanded="false" aria-controls="collapseStyle">
                            <span class="user-select-none" style="font-size: 24px; font-weight: bold">Kiểu dáng</span>
                        </a>
                        <ul class="collapse list-unstyled" id="collapseStyle">
                            <?php
                            $sqlShowStyle = "SELECT * FROM category";
                            $style = $conn->query($sqlShowStyle);
                            $i = 1;
                            while ($row = $style->fetch_assoc()) {
                            ?>
                                <div class="text-decoration-none text-black font-weight-bold" href="<?php echo $rootPath ?>/product.php?categoryId=<?php echo $row['category_id'] ?>">
                                    <li class="mb-2">
                                        <div class="form-check d-flex items-center gap-2">
                                            <input class="form-check-category" type="checkbox" value="<?php echo $row['category_id'] ?>" id="categoryCheck<?php echo $i ?>" <?php echo strpos($categoryId, (string)$row['category_id']) !== false ? "checked" : "" ?>>
                                            <label class="form-check-label list-group-item list-group-item-action dropdown-item" for="categoryCheck<?php echo $i ?>">
                                                <?php echo $row['category_name'] ?>
                                            </label>
                                        </div>
                                    </li>
                                </div>
                            <?php
                                $i++;
                            }
                            ?>
                        </ul>
                    </div>
                    <div class=" mb-5">
                        <a class="dropdown-toggle list text-decoration-none text-warning" data-toggle="collapse" href="#collapseProductLine" role="button" aria-expanded="false" aria-controls="collapseProductLine">
                            <span class="user-select-none" style="font-size: 24px; font-weight: bold">Dòng sản phẩm</span>
                        </a>
                        <ul class="collapse list-unstyled" id="collapseProductLine">
                            <div class="text-decoration-none text-black font-weight-bold">
                                <li class="mb-2">
                                    <div class="form-check d-flex items-center gap-2">
                                        <input class="form-check-line" type="checkbox" value="Basas" id="lineCheck<?php echo $i ?>" <?php echo strpos($line, "Basas") !== false ? "checked" : "" ?>>
                                        <label class="form-check-label  list-group-item list-group-item-action dropdown-item" for="lineCheck<?php echo $i ?>">
                                            Basas
                                        </label>
                                    </div>
                                </li>
                            </div>
                            <div class="text-decoration-none text-black font-weight-bold">
                                <li class="mb-2">
                                    <div class="form-check d-flex items-center gap-2">
                                        <input class="form-check-line" type="checkbox" value="Vintas" id="lineCheck<?php echo $i ?>" <?php echo strpos($line, "Vintas") !== false ? "checked" : "" ?>>
                                        <label class="form-check-label  list-group-item list-group-item-action dropdown-item" for="lineCheck<?php echo $i ?>">
                                            Vintas
                                        </label>
                                    </div>
                                </li>
                            </div>
                            <div class="text-decoration-none text-black font-weight-bold">
                                <li class="mb-2">
                                    <div class="form-check d-flex items-center gap-2">
                                        <input class="form-check-line" type="checkbox" value="Urbas" id="lineCheck<?php echo $i ?>" <?php echo strpos($line, "Urbas") !== false ? "checked" : "" ?>>
                                        <label class="form-check-label  list-group-item list-group-item-action dropdown-item" for="lineCheck<?php echo $i ?>">
                                            Urbas
                                        </label>
                                    </div>
                                </li>
                            </div>
                            <div class="text-decoration-none text-black font-weight-bold" >
                                <li class="mb-2">
                                    <div class="form-check d-flex items-center gap-2">
                                        <input class="form-check-line" type="checkbox" value="Pattas" id="lineCheck<?php echo $i ?>" <?php echo strpos($line, "Pattas") !== false ? "checked" : "" ?>>
                                        <label class="form-check-label  list-group-item list-group-item-action dropdown-item" for="lineCheck<?php echo $i ?>">
                                            Pattas
                                        </label>
                                    </div>
                                </li>
                            </div>
                        </ul>
                    </div>
                    <div class=" mb-5">
                        <a class="dropdown-toggle list text-decoration-none text-warning" data-toggle="collapse" href="#collapseCostRange" role="button" aria-expanded="false" aria-controls="collapseCostRange">
                            <span class="user-select-none" style="font-size: 24px; font-weight: bold">Giá</span>
                        </a>
                        <ul class="collapse list-unstyled" id="collapseCostRange">
                            <?php
                            $sqlShowCostRange = "SELECT * FROM cost_range";
                            $style = $conn->query($sqlShowCostRange);
                            $i = 1;
                            while ($row = $style->fetch_assoc()) {
                            ?>
                                <div class="text-decoration-none text-black font-weight-bold">
                                    <li class="mb-2">
                                        <div class="form-check d-flex items-center gap-2">
                                            <input class="form-check-cost-range" type="checkbox" value="<?= $i ?>" id="costRangeCheck<?php echo $i ?>"  <?php echo strpos($costRangeId, (string)$row['range_id']) !== false ? "checked" : "" ?>>
                                            <label class="form-check-label  list-group-item list-group-item-action dropdown-item" for="costRangeCheck<?php echo $i ?>">
                                                <?php
                                                if (isset($row['low_cost']) && isset($row['high_cost'])) {
                                                    echo ' ' . $row['low_cost'] . 'k - ' . $row['high_cost'] . 'k';
                                                } elseif (isset($row['high_cost'])) {
                                                    echo ' < ' . $row['high_cost'] . 'k';
                                                } else {
                                                    echo ' > ' . $row['low_cost'] . 'k';
                                                }
                                                ?>
                                            </label>
                                        </div>
                                    </li>
                                </div>
                            <?php
                                $i++;
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="mb-5">
                        <a class="dropdown-toggle list text-decoration-none text-warning" data-toggle="collapse" href="#collapseMaterial" role="button" aria-expanded="false" aria-controls="collapseMaterial">
                            <span class="user-select-none" style="font-size: 24px; font-weight: bold">Chất liệu</span>
                        </a>
                        <ul class="collapse list-unstyled" id="collapseMaterial">
                            <div class="text-decoration-none text-black font-weight-bold">
                                <li class="mb-2">
                                    <div class="form-check d-flex items-center gap-2">
                                        <input class="form-check-material" type="checkbox" value="Canvas" id="materialCheck<?php  ?>" <?php echo strpos($material, "Canvas") !== false ? "checked" : "" ?>>
                                        <label class="form-check-label  list-group-item list-group-item-action dropdown-item" for="materialCheck<?php echo $i ?>">
                                            Canvas
                                        </label>
                                    </div>
                                </li>
                            </div>
                            <div class="text-decoration-none text-black font-weight-bold">
                                <li class="mb-2">
                                    <div class="form-check d-flex items-center gap-2">
                                        <input class="form-check-material" type="checkbox" value="Suede" id="materialCheck<?php echo $i ?>" <?php echo strpos($material, "Suede") !== false ? "checked" : "" ?>>
                                        <label class="form-check-label  list-group-item list-group-item-action dropdown-item" for="materialCheck<?php echo $i ?>">
                                            Suede
                                        </label>
                                    </div>
                                </li>
                            </div>
                            <div class="text-decoration-none text-black font-weight-bold  ">
                                <li class="mb-2">
                                    <div class="form-check d-flex items-center gap-2">
                                        <input class="form-check-material" type="checkbox" value="Leather" id="materialCheck<?php echo $i ?>" <?php echo strpos($material, "Leather") !== false ? "checked" : "" ?>>
                                        <label class="form-check-label  list-group-item list-group-item-action dropdown-item" for="materialCheck<?php echo $i ?>">
                                            Leather
                                        </label>
                                    </div>
                                </li>
                            </div>
                            <div class="text-decoration-none text-black font-weight-bold  " >
                                <li class="mb-2">
                                    <div class="form-check d-flex items-center gap-2">
                                        <input class="form-check-material" type="checkbox" value="Cotton" id="materialCheck<?php echo $i ?>"  <?php echo strpos($material, "Cotton") !== false ? "checked" : "" ?>>
                                        <label class="form-check-label  list-group-item list-group-item-action dropdown-item" for="materialCheck<?php echo $i ?>">
                                            Cotton
                                        </label>
                                    </div>
                                </li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="px-sm-3 mb-5">
                    <div class="row">
                        <div class="mb-3 col-12 shipping-banner">
                            <img src="./assets/shipping_banner.jpg" style="width: 100%;" />
                        </div>
                        <?php
                        if ($total > 0) {
                        ?>
                            <?php
                            foreach ($products as $row) :
                            ?>

                                <div class="col-xl-4 col-sm-6 mb-3">
                                    <a href="<?php echo $rootPath ?>/product_detail.php?productId=<?php echo $row['product_id'] ?>" class="text-black text-decoration-none">
                                        <div class="card h-100 position-relative"> 
                                        <img src="<?php echo $rootPath ?>/public/img/<?php echo $row['images']; ?>" class="img-fluid" alt="..." onmouseover="this.src='<?php echo $rootPath ?>/public/img/<?php echo $row['subimg_1']; ?>'" onmouseout="this.src='<?php echo $rootPath ?>/public/img/<?php echo $row['images']; ?>'">
                                            <div class="btn btn-outline-danger position-absolute end-0 bottom-25"><i class=" fa-light fa-heart"></i> </div>
                                            <div class="card-body d-flex flex-column justify-content-between align-items-center">
                                                <div class="d-flex flex-column justify-content-start">
                                                    <h6 class="card-title" style="font-size: 0.75rem"><?php echo $row["name"]; ?></h6>
                                                </div>
                                                <div class="card-text">
                                                    <p>
                                                        <?php
                                                        if ($row["price_sale"] != 0) {
                                                        ?>
                                                            <?php
                                                            echo '<del class="text-secondary">' . number_format($row["price"]) . '</del><sup>đ</sup>';
                                                            ?>

                                                            <?php
                                                            echo '<strong><span class="text-danger ms-3">' . number_format($row["price_sale"]) . '<sup>đ</sup></span></strong>';
                                                            ?>
                                                        <?php
                                                            // nếu không có khuyến mãi, hiện giá gốc
                                                        } else {
                                                            echo '<strong>' . number_format($row["price"]) . '<sup>đ</sup></strong>';
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-footer d-flex flex-column">
                                                <!-- <a href="<?php echo $rootPath ?>/process_cart.php?action=add&id=<?php echo $row['product_id'] ?>&quantity=1" class="btn btn-warning mt-1 <?php if ($row["quantity"] == 0) echo 'disabled' ?>"><i class="fa-light fa-cart-plus"></i></a> -->
                                                <!-- <button onclick="addCartItem(<?= $row['product_id'] ?>)" class="btn btn-warning mt-1 <?php if ($row["quantity"] == 0) echo 'disabled' ?>"><i class="fa-light fa-cart-plus"></i></button> -->
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                            <div class="mt-2 d-flex justify-content-center">
                                <nav class="pagination-outer" aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                                            <a href="product.php?categoryId=<?= $categoryId ?>&page=<?= $Previous; ?>&line=<?= $line?>&material=<?= $material?>&costRange=<?= $costRangeId ?>" aria-label="Previous" class="page-link">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <?php for ($i = 1; $i <= $pages; $i++) : ?>
                                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>"><a href="product.php?categoryId=<?= $categoryId ?>&page=<?= $i; ?>&line=<?= $line?>&material=<?= $material?>&costRange=<?= $costRangeId?>" class="page-link"><?= $i; ?></a></li>
                                        <?php endfor; ?>
                                        <li class="page-item <?= ($page == $pages) ? 'disabled' : '' ?>">
                                            <a href="product.php?categoryId=<?= $categoryId ?>&page=<?= $Next; ?>&line=<?= $line?>&material=<?= $material?>&costRange=<?= $costRangeId ?>" aria-label="Next" class="page-link">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        <?php
                        } else {
                            echo '<div class="alert alert-warning" role="alert"><i class="fa-light fa-circle-exclamation"></i> Không tìm thấy sản phẩm nào</div>';
                        }

                        $conn->close();
                        ?>

                    </div>

                    <?php

                    ?>
                </div>
            </div>
        </div>
    </div>


    <?php
    require './includes/footer.php';
    ?>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./public/javascripts/loadCartHeader.js"></script>

    <script>
        window.onload = function() {
            var limit;

            if (window.innerWidth <= 480) { // Mobile devices
                limit = 8;
            } else if (window.innerWidth <= 768) { // Tablets
                limit = 12;
            } else { // Desktop
                limit = 15;
            }

            // Use AJAX to send a request to the server with the limit
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'product.php?limit=' + limit, true);
            xhr.onload = function() {
                if (this.status == 200) {
                    // Update your page with the data returned from the server
                }
            }
            xhr.send();
        }
        // tăng số lượng
        function addCartItem(pId) {
            var id = pId;
            console.log(id);
            $.ajax({
                url: "<?= $rootPath ?>/ajax/addCartItem.php",
                type: "POST",
                data: {
                    productId: id,
                },
                success: function(data) {
                    alert("Thêm sản phẩm thành công");
                    loadCartAjax();
                },
                error: function() {
                    alert("Lỗi thao tác");
                }
            });
        }
        function checkline(s1, s2) {
    var s1Array = s1.split(" ");
    var s2Array = s2.split(",");
    for (var i = 0; i < s1Array.length; i++) {
        if (s2Array.includes(s1Array[i])) {
            return true;
        }
    }
    return false;
}

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

        $(document).ready(function() {
            $(".form-check-category, .form-check-line, .form-check-material, .form-check-cost-range").change(function() {
                var categoryId = $(".form-check-category:checked").map(function() {
                    return $(this).val();
                }).get().join(",");

                var line = $(".form-check-line:checked").map(function() {
                    return $(this).val();
                }).get().join(",");
                
                var material = $(".form-check-material:checked").map(function() {
                    return $(this).val();
                }).get().join(",");
                
                var costRange = $(".form-check-cost-range:checked").map(function() {
                    return $(this).val();
                }).get().join(",");
                window.location.href = "<?php echo $rootPath ?>/product.php?categoryId=" + categoryId + "&page=<?= $page ?>" + "&line=" + line + "&material=" + material + "&costRange=" + costRange;
            });
        });
    </script>
    <script src="./public/javascripts/liveSearch.js"></script>
</body>

</html>