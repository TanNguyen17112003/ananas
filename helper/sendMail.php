<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);

function sendMailOrder($mail, $receiver, $content) {
    try {
        // Server settings
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls"; //ssl
        $mail->Host = 'smtp.gmail.com';                     
        $mail->Port = 587; //465
        $mail->Username = 'ghetueyh@gmail.com';
        $mail->Password = 'tcps wzhs ihui dytw';                          
        
        // Recipients
        $mail->setFrom('ghetueyh@gmail.com', 'Ananas_ADMIN');
        $mail->addAddress($receiver['email'], $receiver['name']);     
        $mail->addReplyTo('ghetueyh@gmail.com', 'Ananas_ADMIN');

        // Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Ananas_ADMIN xác nhận đơn hàng #'.$receiver['id'];
        $mail->Body = ' <html>
                            <body>
                                <h3>Xin chào '.$receiver['name'].'</h3>
                                <p>Cảm ơn quý khách đã đặt hàng tại <a href="#">Ananas_ADMIN</a>.</p>
                                <p>Đơn hàng quý khách sẽ sớm được gửi đi sau khi nhân viên của chúng tôi hoàn tất các thủ tục.</p>
                                <div>'.$content.'</div>
                                <p>Mọi thắc mắc xin vui lòng liên hệ qua gmail: ghetueyh@gmail.com</p>
                                <p>Xin kính chúc sức khỏe và may mắn!</p>
                                <p><b style="color: blue">Ananas_ADMIN</b></p>
                            </body>
                        </html>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function verifyEmail($mail, $receiver, $verifyCode) {
    try {
        // Server settings
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls"; //ssl
        $mail->Host = 'smtp.gmail.com';                     
        $mail->Port = 587; //465
        $mail->Username = 'ghetueyh@gmail.com';
        $mail->Password = 'tcps wzhs ihui dytw';                          
        
        // Recipients
        $mail->setFrom('ghetueyh@gmail.com', 'Ananas_ADMIN');
        $mail->addAddress($receiver['email'], $receiver['name']);     
        $mail->addReplyTo('ghetueyh@gmail.com', 'Ananas_ADMIN');

        // Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Ananas_ADMIN xác thực tài khoản tạo mới';
        $mail->Body = ' <html>
                            <body>
                                <h3>Xin chào '.$receiver['name'].'</h3>
                                <p>Thông tin tài khoản của quý khách vừa đăng ký:</p>
                                <p>Tên đăng nhập: <b style="color:blue">'.$receiver['email'].'</b></p>
                                <p>Mật khẩu: <b style="color:blue">'.$receiver['password'].'</b></p>
                                <p>Quý khách vui lòng điền mã xác thực để sử dụng tài khoản này trên Website của chúng tôi.</p>
                                <p>Mã xác thực kích hoạt tài khoản:</p>
                                <div><b>'.$verifyCode.'</b></div>
                                <p>Mọi thắc mắc xin vui lòng liên hệ qua gmail: ghetueyh@gmail.com</p>
                                <p>Xin kính chúc sức khỏe và may mắn!</p>
                                <p><b style="color: blue">Ananas_ADMIN</b></p>
                            </body>
                        </html>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function resetPassword($mail, $receiver) {
    try {
        // Server settings
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls"; //ssl
        $mail->Host = 'smtp.gmail.com';                     
        $mail->Port = 587; //465
        $mail->Username = 'ghetueyh@gmail.com';
        $mail->Password = 'tcps wzhs ihui dytw';                          
        
        // Recipients
        $mail->setFrom('ghetueyh@gmail.com', 'Ananas_ADMIN');
        $mail->addAddress($receiver['email'], $receiver['name']);     
        $mail->addReplyTo('ghetueyh@gmail.com', 'Ananas_ADMIN');

        // Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Ananas_ADMIN xác thực thông tin tài khoản';
        $mail->Body = ' <html>
                            <body>
                                <h3>Xin chào '.$receiver['name'].'</h3>
                                <p>Thông tin tài khoản của bạn:</p>
                                <p>Tên đăng nhập: <b style="color:blue">'.$receiver['email'].'</b></p>
                                <p>Mật khẩu: <b style="color:blue">'.$receiver['password'].'</b></p>
                                <p>Từ giờ quý khách có thể đăng nhập lại trên Website của chúng tôi.</p>
                                <p>Lưu ý: Quý khách vui lòng thay đổi mật khẩu sau khi đăng nhập.</p>
                                <p>Mọi thắc mắc xin vui lòng liên hệ qua gmail: ghetueyh@gmail.com</p>
                                <p>Xin kính chúc sức khỏe và may mắn!</p>
                                <p><b style="color: blue">Ananas_ADMIN</b></p>
                            </body>
                        </html>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function sendLink2ChangePWD($mail, $receiver, $content) {
    try {
        // Server settings
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls"; //ssl
        $mail->Host = 'smtp.gmail.com';                     
        $mail->Port = 587; //465
        $mail->Username = 'ghetueyh@gmail.com';
        $mail->Password = 'tcps wzhs ihui dytw';                          
        
        // Recipients
        $mail->setFrom('ghetueyh@gmail.com', 'Ananas_ADMIN');
        $mail->addAddress($receiver['email'], $receiver['name']);     
        $mail->addReplyTo('ghetueyh@gmail.com', 'Ananas_ADMIN');

        // Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Ananas_ADMIN gửi link thay đổi mật khẩu';
        $mail->Body = ' <html>
                            <body>
                                <h3>Xin chào '.$receiver['name'].'</h3>
                                <p>Chúng tôi vừa nhận được yêu cầu thay đổi mật khẩu cho tài khoản của bạn:</p>
                                <p>Bạn hãy Click vào đường dẫn dưới đây để có thể thay đổi mật khẩu:</p>
                                <div>'.$content.'</div>
                                <p>Mọi thắc mắc xin vui lòng liên hệ qua gmail: ghetueyh@gmail.com</p>
                                <p>Xin kính chúc sức khỏe và may mắn!</p>
                                <p><b style="color: blue">Ananas_ADMIN</b></p>
                            </body>
                        </html>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

?>