<?php
session_start();
ob_start();
$rootPath = '/Lap_trinh_web';
require_once './database/DB.php';
?>

<?php
    $status = "";
    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if ($name =='' || $email =='' || $message == '') {
            $status = 'Vui lòng điền các trường còn thiếu';
        } else {
            $sql = "INSERT INTO contact (username, email, message) VALUES ('$name', '$email', '$message')";
            
            if ($conn->query($sql) === TRUE) {
                // echo "Send message successfully";
                $status = "Cảm ơn bạn đã liên hệ với chúng tôi. <br> Chúng tôi sẽ phản hồi cho bạn trong thời gian sớm nhất.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Liên hệ</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <link rel="stylesheet" href="./public/css/contact.css">
</head>
<body>
<?php
    require './includes/header.php';
    require './includes/navbar.php';
?>
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1" style="color:#002A54">Liên hệ với chúng tôi</h1>
        <p style="color:#ED171F">
            Bạn có thắc mắc về dịch vụ của chúng tôi? Hãy gửi tin nhắn cho chúng tôi tại đây.
        </p>
    </div>
</div>
<!-- start contact page -->
<div class="container py-2">
    <div class="row py-2">
        <p class="text-center text-danger"><?php echo $status?></p>
        <form class="col-md-9 m-auto" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" role="form">
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="contactName">Tên của bạn</label>
                    <input type="text" class="form-control mt-1" id="contactName" name="name" placeholder="Enter your name">
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="contactEmail">Email</label>
                    <input type="email" class="form-control mt-1" id="contactEmail" name="email" placeholder=" Enter your email">
                </div>
            </div>
            <div class="mb-3">
                <label for="contactMessage">Tin nhắn</label>
                <textarea class="form-control mt-1" id="contactMessage" name="message" placeholder="Message" rows="8"></textarea>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button name="submit" type="submit" class="btn btn-primary btn-lg px-5 contact-btn">Gửi</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end contact page -->

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