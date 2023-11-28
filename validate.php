<?php
function validateEmail($email) {
    $error = "";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email không hợp lệ."; 
    }
    return $error;
}

function validatePhone($phone) {
    $error = "";
    if (!preg_match("/^[0-9]{10}/", $phone)) {
        $error = "Số điện thoại phải bao gồm 10 chữ số.";
    }
    return $error;
}

function validatePassword($password) {
    $error = "";
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $error = "Mật khẩu phải gồm ít nhất 8 kí kự và phải chứa ít nhất 1 chữ số, 1 chữ viết hoa, 1 chữ viết thường, 1 kí tự đặc biệt.";
    } 
    return $error;
}

function validateURL($url) {
    $error = "";
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
        $error = "URL không hợp lệ.";
    }
    return $error;
}

function checkPassword($password1, $password2)
{
    $error = "";
    if ($password1 != $password2) {
        $error = "Mật khẩu không khớp.";
    }
    return $error;
}

function checkEmailExist($email) {
    $conn = @new mysqli("localhost:3307", "root", "", "ltwdb");
    $conn->error;
    if ($conn->error) {
        die('Kết nối thất bại'.$conn->error);
    }
    $error = "";
    $sql = "SELECT email FROM user WHERE email='$email'";
    $user = $conn->query($sql);
    if ($user->num_rows > 0) {
        $error = "Email đã tồn tại.";
    }
    return $error;
}
?>