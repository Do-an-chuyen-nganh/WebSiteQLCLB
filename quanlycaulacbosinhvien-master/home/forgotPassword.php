<?php
include './inc/header.php';
include '../models/HomeModel.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer-master/src/SMTP.php';


$hm = new HomeModel();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //$register = $hm->register_student($_POST);
    $pass = $hm->randomPassword(10, 1, "lower_case,upper_case,numbers,special_symbols",$_POST['gmail']);
    if($pass != false){
        try {

            $mail = new PHPMailer(true);
            
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'dotrungduckspm@gmail.com';                     // SMTP username
            $mail->Password   = 'ducgapro1234';                               // SMTP password
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('dotrungduckspm@gmail.com', 'QL CLB');
            $mail->addAddress($_POST['gmail'], $_POST['gmail']);     // Add a recipient
        
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Đây là mail cấp lại mật khẩu';
            $mail->Body    = 'Mật khẩu của bạn là : '.implode("",$pass);
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->CharSet = 'UTF-8';
            $mail->send();
            $register = "Cấp lại mật khẩu thành công !";
        } catch (Exception $e) {
            $register = "Không thể gửi mail !";
        }
    }
}

?>

<div class="container" id="login-container">

    <div class="row">
        <div class="col-md-4 login-sec">
            <h2 class="text-center" style="color: white;">Quên mật khẩu</h2>
            <?php
            if (isset($register)) {
                echo $register;
            }
            ?>
            <form class="register-form" id="form-register" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="text-uppercase">Gmail</label>
                    <input type="text" class="form-control" name="gmail" placeholder="">

                </div>

                <div class="form-check">
                    <button type="submit" class="btn btn-login float-right">Lấy lại mật khẩu</button>
                </div>

            </form>
            <div class="copy-text"><a href="login.php" style="color: white;">Trở lại trang đăng nhập</a></div>
        </div>
        <div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <div class="banner-text">
                                <h2>This is Heaven</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <div class="banner-text">
                                <h2>This is Heaven</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <div class="banner-text">
                                <h2>This is Heaven</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include './inc/footer.php'; ?>
<script>
    $().ready(function() {
        $("#form-register").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "gmail": {
                    required: true,
                    validateGmail: true
                },
                "password": {
                    required: true,
                    validatePassword: true,
                    minlength: 8
                },
                "re-password": {
                    equalTo: "#password",
                    minlength: 8
                },
                "fullName": {
                    required: true,
                    minlength: 8
                },
                "studentCode": {
                    required: true,
                    minlength: 8
                },
                "age": {
                    required: true
                },
                "phone": {
                    required: true,
                    minlength: 8,
                    validatePhone: true
                }
            },
            messages: {
                "gmail": {
                    required: "Gmail không được để trống !",
                    maxlength: "Hãy nhập tối đa 15 ký tự"
                },
                "password": {
                    required: "Mật Khẩu không được để trống !",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                },
                "re-password": {
                    equalTo: "Mật khẩu nhập lại không đúng !",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                },
                "fullName": {
                    required: "Họ và tên không được để trống !",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                },
                "studentCode": {
                    required: "Mã số sinh viên không được để trống !",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                },
                "age": {
                    required: "Ngày tháng năm sinh không được để trống !",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                },
                "phone": {
                    required: "Số điện thoại không được để trống !",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                }
            }
        });
        $.validator.addMethod("validatePassword", function(value, element) {
            return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/i.test(value);
        }, "Hãy nhập password từ 8 đến 16 ký tự bao gồm chữ hoa, chữ thường và ít nhất một chữ số");
        $.validator.addMethod("validatePhone", function(value, element) {
            return this.optional(element) || /((09|03|07|08|05)+([0-9]{8})\b)/i.test(value);
        }, "Số điện thoại không hợp lệ !");
        $.validator.addMethod("validateGmail", function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(value);
        }, "Gmail không hợp lệ !");
    });
</script>