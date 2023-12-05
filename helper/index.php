<!-- App Password: phpEmail - 'xazq gfwi qmlh jlic' -->

<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

function generateOTP() {
  return strval(mt_rand(100000, 999999));
}

if (isset($_POST['send'])) {
  // $name = htmlentities($_POST['name']);
  $email = htmlentities($_POST['email']);
  // $subject = htmlentities($_POST['subject']);
  // $message = htmlentities($_POST['message']);

  // Generate OTP
  $otp = generateOTP();
  $_SESSION['generated_otp'] = $otp;

  // /**
  //  * Default properties -
  //  * $digits -> 4
  //  * $expiry -> 10 min
  //  */

  // $manager->digits(6); // To change the number of OTP digits
  // $manager->expiry(20); // To change the mins until expiry

  // $manager->generate($unique_secret); // Will return a string of OTP

  // $manager->match($otp, $unique_secret); // Will return true or false.

  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'tungnd.goat@gmail.com';
  $mail->Password = 'xazq gfwi qmlh jlic';
  $mail->Port = 465;
  $mail->SMTPSecure = 'ssl';
  $mail->isHTML(true);
  $mail->setFrom('tungnd.goat@gmail.com', 'HongTraNgoGia_ADMIN');
  $mail->addAddress($email);
  $mail->Subject = ("Verification Email!");
  // $mail->Body = "Message: $message<br>OTP: $otp<br>Please use it to verify your account!";
  // $mail->Body = file_get_contents('form.php');
  $mail->Body = str_replace('{OTP}', $otp, file_get_contents('form.php'));
  $mail->send();

  header("Location: ./index.php?=email_sent!");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/allencasul/lonica@d9dbccfa5b0a4666760e4f72b28effa775c56857/css/cdn/lonica.css" integrity="sha256-E1S8yAbnRZ6uM4sA6NMSgTyoDsdK1ZCjBYF3lqXqv6Q=" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/1e8d61f212.js"></script>
</head>

<body>
  <body class="center-absolute">
    <form class="display-grid row-gap-1-rem" method="post">
      <!-- <input class="box-shadow-primary" name="name" type="text" placeholder="Name" autocomplete="off" required /> -->
      <input class="box-shadow-primary" name="email" type="email" placeholder="Email" autocomplete="off" required />
      <!-- <input class="box-shadow-primary" name="subject" type="text" placeholder="Subject" autocomplete="off" required />
      <textarea class="box-shadow-primary" name="message" placeholder="Message..." required></textarea> -->
      <button type="submit" name="send">
        Send <i class="fa-solid fa-paper-plane color-white margin-left-1-rem"></i>
      </button>
    </form>
  </body>
</body>

</html>