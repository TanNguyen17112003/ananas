<?php
session_start();
ob_start();
$rootPath = '/AssignmentWeb';
require_once './db/DB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chính sách</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <!-- <link rel="stylesheet" href="./public/css/home.css"> -->
</head>
<body>
<?php
    require './includes/header.php';
    require './includes/navbar.php';
?>

<div class="container pt-5 pb-5">
    <div class="row">
        <!-- <div class="col-xl-9 col-md-8 col-sm-6"> -->
        <div class="col-lg-9 col-md-10 m-auto">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                           A. Chính sách bán hàng
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>- Thời gian giao hàng: Thời gian giao hàng từ 30-40 phút. Đối với các đơn hàng như cafe đóng gói, đơn hàng nhận trước 12h00 trưa sẽ giao vào ngày làm việc của ngày hôm sau; những đơn hàng nhận sau 12h trưa sẽ giao hàng vào ngày làm việc kế tiếp của ngày hôm sau.</p>
                            <p>- Giá sản phẩm đã bao gồm thuế VAT</p>
                            <p>- Thời gian làm việc từ 8h00 đến 17h30 từ thứ 2 đến thứ 6, thứ bảy làm việc buổi sáng.</p>
                            <p>- Với đơn hàng trên 600.000<sup>đ</sup> ở khu vực trung tâm tp.hcm (Phí vận chuyển tùy theo khu vực nhân viên sẽ liên hệ ĐT để báo phí vận chuyển trước khi giao hàng cho Quý khách)</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            B. Quy định thanh toán
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h6>Quý khách có thể thanh toán bằng tiền mặt hoặc chuyển khoản qua ngân hàng</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Ngân hàng</th>
                                        <th scope="col">STK</th>
                                        <th scope="col">Chủ tài khoản</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">OCB</td>
                                        <td>0999.888.418.289</td>
                                        <td>Nguyễn Đức Hậu</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">OCB</td>
                                        <td>0999.888.418.199</td>
                                        <td>Trần Thế Quang</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">OCB</td>
                                        <td>0999.888.418.200</td>
                                        <td>Võ Trịnh Xuân Nguyên</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">OCB</td>
                                        <td>0999.888.418.888</td>
                                        <td>Lý Gia Huy</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            C. Hướng dẫn mua hàng
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="h6">1.Thêm sản phẩm vào giỏ hàng</p>
                            <p>
                                Chọn mục Menu góc trái bên trên để hiển thị các danh mục Sau đó click vào mục sản phẩm hoặc click vào nút <button class="btn btn-warning"><i class="fa-light fa-cart-shopping"></i></button> để thêm sản phẩm vào giỏ.
                            </p>
                            <p class="h6">2.Thanh toán đơn hàng</p>
                            <p>
                                Khách hàng cần <a href="#">đăng nhập</a> để đặt hàng (<a href="<?php echo $rootPath?>/sign_up.php">đăng kí</a> nếu bạn chưa có tài khoản). Sau đó bạn nhập các thông tin cần thiết theo mẫu để nhân viên xác nhận đơn hàng. 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-xl-3 col-md-4 d-none d-md-block d-xl-block d-xxl-none"> 
            <img src="<?php echo $rootPath?>/public/img/logo.jpg" class="img-fluid mb-2 rounded" alt="">
            <img src="<?php echo $rootPath?>/public/img/logo.jpg" class="img-fluid mb-2 rounded" alt="">
            <img src="<?php echo $rootPath?>/public/img/logo.jpg" class="img-fluid mb-2 rounded" alt="">
        </div> -->
    </div>
</div>

<?php
$conn->close();
    require './includes/footer.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
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