<?php
include './inc/header.php';
include '../models/HomeModel.php';
$class = new HomeModel();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $gmail = $_POST['gmail'];
    $password = md5($_POST['password']);
    
    $login_check = $class->home_login($gmail,$password);
}
?>

<div class="container" id="login-container">

        <div class="row">
            <div class="col-md-4 login-sec">
                <h2 class="text-center" style="color: white;">Đăng Nhập</h2>
                <p><?php
				if(isset($login_check)){
					echo $login_check;
				}
			?></p>
                <form class="login-form" method="POST">
                    <div class="form-group">
                        <label for="gmail" class="text-uppercase">Gmail</label>
                        <input type="text" class="form-control" placeholder="" name="gmail">

                    </div>
                    <div class="form-group">
                        <label for="password" class="text-uppercase">Password</label>
                        <input type="password" class="form-control" placeholder="" name="password">
                    </div>


                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                            <small>Remember Me</small>
                        </label>
                        <button type="submit" class="btn btn-login float-right">Đăng Nhập</button>
                    </div>

                </form>
                <div class="copy-text">
                <a href="register.php" style="color: white;">Bạn Chưa Có Tài Khoản ? Đăng ký</a>
                
                <div class=""><a href="forgotPassword.php" style="color: white;">Quên Mật Khẩu</a></div>
                </div>
                
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