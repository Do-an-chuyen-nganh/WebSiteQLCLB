<?php
ob_start();
include '../lib/session.php';
session_start();
$check = null;
$student = null;
$check = Session::get('homeLogin');
$student = Session::get('student');
ob_flush();
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
$_SESSION["test1"] = "green";
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CLB Hutech</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png">
    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header class="container">
        <!-- Header Start -->
        <div class="header-area header_area">
            <div class="main-header">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3" style="margin-top: 21px;">
                                <div class="logo">
                                    <a href="index.php"><img src="assets/img/logo.png" alt="" width="65" height="65"></a>
                                    <a href="index.php"><b style="font-size: 20px;">CLB Hutech</b></a>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-left  d-flex f-right align-items-center">
                                    <!-- Main-menu -->
                                    <div class="main-menu f-right d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li><a href="index.php">Trang chủ</a></li>
                                                <li><a href="listCLB.php">Về CLB</a>
                                                   
                                                </li>
                                                <?php 
                                                    if(isset($_SESSION['student'])) {
                                                 ?>
                                                 <li><a href="diem_clb.php">Điểm CLB</a></li>
                                                 <?php 
                                                    }
                                                  ?>

                                                <li><a href="#"> </a></li>
                                                <?php
                                                if ($check != true) {
                                                ?>
                                                    <li><!-- <button class="btn" onclick="location.href='login.php'">Đăng Nhập</button> --></li>
                                                    <li><a href="login.php">Đăng Nhập</button></li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li><!-- <button class="btn" onclick="location.href='logout.php'">Đăng Xuất</button> --></li>
                                                    <li><a href="logout.php">Đăng Xuất</button></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
