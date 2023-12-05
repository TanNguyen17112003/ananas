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
    <title>Chính sách</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <!-- <link rel="stylesheet" href="./public/css/home.css"> -->
    <style>
        p {
            text-align: justify;
        }
    </style>
</head>

<body>
<?php
    require './includes/header.php';
    require './includes/navbar.php';
?>

<div class="container pt-5 pb-5">
    <div class="row">
        <div class="col-lg-9 col-md-10 m-auto">
            <div class="accordion" id="accordionExample">
                <!-- A. Điều kiện nhượng quyền -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                           A. Điều kiện nhượng quyền
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>- Chứng minh nhân dân hợp lệ, giấy xác nhận không phạm tội, đủ tư cách để xin các giấy phép liên quan.</p>
                            <p>- Có hứng thú với ngành thức uống, chấp nhận văn hóa thương hiệu và triết lí kinh doanh, toàn tâm toàn ý cho việc kinh doanh, tuân theo sự thống nhất điều hành của công ty và có tinh thần hợp tác cao.</p>
                            <p>- Bên nhượng quyền thương hiệu có thể trực tiếp tham gia khóa đào tạo, vận hành và quản lý cửa tiệm toàn thời gian (trước khi khai trương, phải đến công ty để tham gia học đào tạo, mỗi ngày cần học từ 7 - 8 tiếng và từ 5 - 7 ngày, tùy theo thực tế năng lực học tập để quyết định).</p>
                            <p>- Có khả năng chịu rủi ro nhất định, có đủ kinh phí hoạt động ( nguồn vốn hợp pháp), địa điểm, nhân sự …</p>
                            <p>- Không cùng lúc điều hành các doanh nghiệp có liên quan hoặc có tính cạnh tranh.</p>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            B. Hướng dẫn mua hàng
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="h6">1. Thêm sản phẩm vào giỏ hàng</p>
                            <p>
                                Chọn mục Menu góc trái bên trên để hiển thị các danh mục Sau đó click vào mục sản phẩm hoặc click vào nút <button class="btn btn-warning""><i class="fa-sharp fa-solid fa-bag-shopping"></i></button> để thêm sản phẩm vào giỏ.
                            </p>
                            <p class="h6">2. Thanh toán đơn hàng</p>
                            <p>
                                Khách hàng cần đăng nhập để đặt hàng (<a href="<?php echo $rootPath?>/sign_up.php" style="text-decoration: none; color: red;">đăng kí ngay</a> nếu bạn chưa có tài khoản). Sau đó bạn nhập các thông tin cần thiết theo mẫu để nhân viên xác nhận đơn hàng. 
                            </p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            C. Quy định thanh toán
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h6>Quý khách có thể thanh toán bằng tiền mặt hoặc chuyển khoản qua ngân hàng</h6>
                            <table class="table" style="text-align: center;">
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
                                        <td>0004100040716008</td>
                                        <td>Hồng trà Ngô Gia</td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td scope="row">Momo</td>
                                        <td>0123456789</td>
                                        <td>Hồng trà Ngô Gia</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <img src="<?php echo $rootPath?>/public/img/logo.jpg" class="img-fluid mb-2 rounded" alt="">
            <img src="<?php echo $rootPath?>/public/img/logo.jpg" class="img-fluid mb-2 rounded" alt="">
            <img src="<?php echo $rootPath?>/public/img/logo.jpg" class="img-fluid mb-2 rounded" alt="">
        </div>
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