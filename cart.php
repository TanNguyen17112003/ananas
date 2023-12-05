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
    <title>Giỏ hàng</title>
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
<!-- giỏ hàng -->
<div id="cart"></div>

<?php
    // end giỏ hàng
    require './includes/footer.php';
?>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./public/javascripts/loadCart.js"></script>
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

    // tăng số lượng
    function addCartQty(pId) {
        var id = pId;
        console.log(id);
        $.ajax({
            url: "<?=$rootPath?>/ajax/addCartQty.php",
            type: "POST",
            data: {
                productId: id,
            },
            success: function (data) {
                loadCartAjax();
            },
            error: function () {
                alert("Lỗi thao tác");
            }
        });
    }
    // Giảm số lượng
    function subCartQty(pId) {
        var id = pId;
        console.log(id);
        $.ajax({
            url: "<?=$rootPath?>/ajax/subCartQty.php",
            type: "POST",
            data: {
                productId: id,
            },
            success: function (data) {
                loadCartAjax();
            },
            error: function () {
                alert("Lỗi thao tác");
            }
        });
    }

    function deleteCartItem(pId) {
        var id = pId;
        console.log(id);
        $.ajax({
            url: "<?=$rootPath?>/ajax/deleteCartItem.php",
            type: "POST",
            data: {
                productId: id,
            },
            success: function (data) {
                loadCartAjax();
            },
            error: function () {
                alert("Lỗi thao tác");
            }
        });
    }
</script>
<script src="./public/javascripts/liveSearch.js"></script>

</body>
</html>