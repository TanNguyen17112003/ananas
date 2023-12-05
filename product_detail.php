<?php
    ob_start();
    session_start();
    $rootPath = '/Lap_trinh_web';
    require_once './database/DB.php';
    
    if (isset($_GET['productId'])) {
        settype($_GET['productId'], 'int');
        $productId = $_GET['productId'];
    }

    $sqlFindProduct = "SELECT * FROM product, category WHERE product_id = '$productId' AND product.category_id = category.category_id";
    $product = $conn->query($sqlFindProduct);
?>


<?php
    require './includes/header.php';
    require './includes/navbar.php';

if ($product->num_rows > 0) {
    //start loop while
    while($row = $product->fetch_assoc()) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row["name"] ;?></title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <!-- <link rel="stylesheet" href="./public/css/home.css"> -->
</head>
<body>
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img rounded img-fluid" id="product-detail" alt="bla" src="./public/img/products/<?php echo $row["images"]; ?>">
                </div>
                <div class="row">
                    <!--Start Controls-->
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="prev">
                            <i class="text-dark fas fa-chevron-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </div>
                    <!--End Controls-->
                    <!--Start Carousel Wrapper-->
                    <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                        <!--Start Slides-->
                        <div class="carousel-inner product-links-wap" role="listbox">
                            <!--First slide-->
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-4">
                                        <img class="card-img img-fluid" src="https://source.unsplash.com/random/600x600/?drink Rubber Knife" alt="Product Image 1">
                                    </div>
                                    <div class="col-4">
                                        <img class="card-img img-fluid" src="https://source.unsplash.com/random/600x600/?drink Duty Paper Computer" alt="Product Image 2">
                                    </div>
                                    <div class="col-4">
                                        <img class="card-img img-fluid" src="https://source.unsplash.com/random/600x600/?drink Marble Knife" alt="Product Image 3">
                                    </div>
                                </div>
                            </div>
                            <!--/.First slide-->

                            <!--Second slide-->
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-4">
                                        <img class="card-img img-fluid" src="https://source.unsplash.com/random/600x600/?drink Duty Copper Plate" alt="Product Image 4">
                                    </div>
                                    <div class="col-4">
                                        <img class="card-img img-fluid" src="https://source.unsplash.com/random/600x600/?drink Wooden Computer" alt="Product Image 5">
                                    </div>
                                    <div class="col-4">
                                        <img class="card-img img-fluid" src="https://source.unsplash.com/random/600x600/?drink Duty Bronze Coat" alt="Product Image 6">
                                    </div>
                                </div>
                            </div>
                            <!--/.Second slide-->

                            <!--Third slide-->
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-4">
                                        <img class="card-img img-fluid" src="https://source.unsplash.com/random/600x600/?drink Wool Coat" alt="Product Image 7">
                                    </div>
                                    <div class="col-4">
                                        <img class="card-img img-fluid" src="https://source.unsplash.com/random/600x600/?drink Concrete Bag" alt="Product Image 8">
                                    </div>
                                    <div class="col-4">
                                        <img class="card-img img-fluid" src="https://source.unsplash.com/random/600x600/?drink Aluminum Coat" alt="Product Image 9">
                                    </div>
                                </div>
                            </div>
                            <!--/.Third slide-->
                        <!--First slide-->
                        </div>
                    </div>
                    <!--End Carousel Wrapper-->
                    <!--Start Controls-->
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="next">
                            <i class="text-dark fas fa-chevron-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <!--End Controls-->
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2" style="color:#002A54"><?php echo $row["name"] ;?> <span class="text-secondary">#<?php echo $row["product_id"]; ?></span></h1>
                        <p class="h3 py-2" id="price">
                            <?php
                                // Nếu có giá Khuyến mãi
                                if ($row["price_sale"] != 0 ) {
                                    echo '<del class="text-secondary">'.number_format($row["price"]).'</del><sup>đ</sup>'; 
                                    echo '<strong><span class="text-danger ms-3">'.number_format($row["price_sale"]).'<sup>đ</sup></span></strong>'; 
                            ?>
                                <span class="ms-3 bg-danger text-danger bg-opacity-25 rounded">
                                    <?php
                                        echo '-'.(int)(100 - ($row['price_sale']/$row['price'])*100).'%';
                                    ?>
                                </span>
                            <?php
                                } else {
                                    echo '<strong>'.number_format($row["price"]).'<sup>đ</sup></strong>'; 
                                }
                            ?>
                        </p>
                        <p><span class="h6">Loại sản phẩm:</span> <?php echo $row["category_name"]; ?> </p>
                        <h6>Mô tả chi tiết:</h6>
                        <p><?php echo $row["description"]?></p>
                        <?php  
                            if ($row["quantity"] > 0) {
                        ?>
                        <div class="pb-3">
                            <span class="badge bg-success">Còn <?php echo $row['quantity']?> sản phẩm </span>
                        </div>
                        <?php
                            } else {
                        ?>
                        <div class="pb-3">
                            <span class="badge bg-danger"href="#">Hết hàng tạm thời</span>
                        </div>
                        <?php
                            }
                        ?>
                        <form action="process_cart.php" accept-charset="UTF-8" method="get">
                            <div class="row">
                                <div class="col-5">
                                <ul class="list-inline pb-3 equal-width">
                                    <li class="list-inline-item">
                                        <label class="form-label" for="cart_item_product_stock">Chọn size</label>
                                    </li>
                                    <li class="list-inline-item col-6">
                                        <select class="form-select" name="selectedSize" id="cart_item_product_stock">
                                            <option value="Size S" selected>Size S</option>
                                            <option value="Size M">Size M</option>
                                            <option value="Size L">Size L</option>
                                        </select>
                                    </li>
                                </ul>
                                </div>

                                <div class="col-7">
                                    <ul class="list-inline pb-3 equal-width">
                                        <li class="list-inline-item text-right col-2.5">
                                            <label class="form-label" for="cart_item_product_stock">Số lượng</label>
                                        </li>
                                        <li class="list-inline-item col-3">
                                            <input type="number" class="form-control" name="quantity" id="quantityInput" value=1 min=1 max="<?=$row['quantity']?>">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-3 d-flex justify-content-end">
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <input type="hidden" name="action" value="add"> 
                                    <input type="hidden" name="id" value="<?php echo $row['product_id']?>">
                                    <button onclick="addCartItem(<?=$row['product_id']?>)" class="w-100 btn btn-warning btn-lg  <?php if ($row["quantity"] <= 0) echo 'disabled'?>"><i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    }
    // end loop while
} else {
    header("location: 404.php");
}
?>
<?php
    // lấy userId hiện tại
    if (isset($_SESSION['email_user']) && !empty($_SESSION['email_user'])) {
        $email = $_SESSION['email_user'];
        $sqlFindUser = "SELECT user_id FROM user WHERE email = '$email'";
        $ketQua = $conn->query($sqlFindUser);
        $user = $ketQua->fetch_array();
        $userId = $user['user_id'];
    }

    $sqlReviews = "SELECT user.user_id, name, title, content, review.updated_at FROM review, user WHERE user.user_id = review.user_id AND review.product_id = '$productId'";
    $review = $conn->query($sqlReviews);
    if ($review->num_rows>0) {
?>
        <div class="container card mt-5 mb-5">
            <div class="row">
                <div class="ps-3 pe-3 pt-2">
                    <h3 class="border-bottom border-secondary pb-3">Đánh giá sản phẩm</h3>
                </div>
            </div>
            <div class="row">
            <?php 
            while($row = $review->fetch_assoc()) {
            ?>
                <!-- Review -->
                <div class="ps-3 pe-3 pt-2">
                    <div class="media-body border-bottom border-secondary">
                        <span class="h4"><?=$row['name']?></span> 
                        <?php 
                            $userIdSelf = $row['user_id'];
                            $sqlUserOrder = "SELECT user_id FROM `ltwdb`.`order`, order_item WHERE user_id = '$userIdSelf' AND product_id = '$productId' AND order.order_id = order_item.order_id";
                            $checkBuy = $conn->query($sqlUserOrder);
                            if ($checkBuy->num_rows>0) {
                                echo '<span class="text-success"><i class="fa-duotone fa-badge-check"></i> Đã mua sản phẩm này</span>';
                            } else {
                                echo '<span class="text-warning"><i class="fa-duotone fa-badge-check"></i> Chưa mua sản phẩm này</span>';
                            }
                        ?> 
                        <p class="mt-3 ms-2">
                            <span class="text-success"><?=$row['title']?></span>:
                            <?=$row['content']?>
                        </p>
                        <p class="ms-2"><i class="fa-light fa-clock"></i> <small><?=$row['updated_at']?></small></p>
                    </div>
                </div>
            <?php
            }
            ?>
                <div class="ps-3 pe-3 pt-3 pb-3">
                    <button type="button" class="btn btn-primary <?php if(!isset($_SESSION['email_user'])) echo 'disabled' ?>" data-bs-toggle="modal" data-bs-target="#postReview"><i class="fa-sharp fa-solid fa-circle-star"></i> Viết đánh giá</button>
                    <!-- <button class="ms-1 btn btn-outline-primary">Xem đánh giá <i class="fa-light fa-circle-play"></i></button> -->
                    <div class="mt-1">
                        <i><small>(<i class="fa-regular fa-asterisk"></i>) Vui lòng đăng nhập để đánh giá sản phẩm này</small></i>
                    </div>
                </div>
            </div>
        </div>

<?php
    } else {
?>
    <div class="container card mt-5 mb-5">
        <div class="row">
            <div class="ps-3 pe-3 pt-2">
                <h3 class="border-bottom border-secondary pb-3">Hãy là người đầu tiên đánh giá sản phẩm này</h3>
            </div>
        </div>
        <div class="row">
            <div class="ps-3 pe-3 pt-3 pb-3">
                <button type="button" class="btn btn-primary <?php if(!isset($_SESSION['email_user'])) echo 'disabled' ?>" data-bs-toggle="modal" data-bs-target="#postReview"><i class="fa-sharp fa-solid fa-circle-star"></i> Viết đánh giá</button>
                <!-- <button class="ms-1 btn btn-outline-primary">Xem đánh giá <i class="fa-light fa-circle-play"></i></button> -->
            </div>
        </div>
        <div class="row">
            <div class="ps-3 pe-3 pb-3">
                <i><small>(<i class="fa-regular fa-asterisk"></i>) Vui lòng đăng nhập để đánh giá sản phẩm này</small></i>
            </div>
        </div>
    </div>
<?php
    }
?>
<div class="modal fade" id="postReview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?=$rootPath?>/customer/reviews/add.php" method="post">
        <input type="hidden" name="userId" value="<?=$userId?>">
        <input type="hidden" name="productId" value="<?=$productId?>">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Đánh giá sản phẩm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="titleReview" class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" id="titleReview" name="title" placeholder="Mời nhập tiêu đề">
                </div>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" name="content" id="content" style="height: 100px"></textarea>
                    <label for="content">Đánh giá</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" name="review" class="btn btn-primary">Gửi</button>
            </div>
        </div>
    </form>
  </div>
</div>
<?php
    $conn->close();
    require './includes/footer.php';
?>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="./public/javascripts/loadCartHeader.js"></script>

<script>
    function addCartItem(pId) {
        var id = pId;
        console.log(id);
        $.ajax({
            url: "<?=$rootPath?>/ajax/loadCart.php",
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
        $(window).scroll(
            function() {
                if ($(this).scrollTop() > 114) {
                    $("#navbar-top").addClass('fix-nav')
                } else{
                    $("#navbar-top").removeClass('fix-nav')
                }
            }
        )
    });
</script>
<script src="./public/javascripts/liveSearch.js"></script>
</body>
</html>