<?php
ob_start();
include '../lib/session.php';
Session::checkSession();
ob_flush();
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
$_SESSION["test"] = "green";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang quản trị</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description">
    <meta content="Coderthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets\images\favicon.ico">

    <!-- App css -->
    <script src="ckeditor/ckeditor.js"></script>
    <!-- <script src="assets/js/form-validation.init.js"></script> -->
    <link href="assets\css\bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet">
    <link href="assets\css\icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets\css\app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet">
    <link href="assets\css\blog-post.css" rel="stylesheet" type="text/css" id="app-stylesheet">
    <link href="assets\css\custom.css" rel="stylesheet" type="text/css" id="app-stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- JS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js">
    </script>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Military Expenditure of Countries: 2016"
                },
                axisX: {
                    interval: 1
                },
                axisY: {
                    title: "Expenses in Billion Dollars",
                    includeZero: true,
                    scaleBreaks: {
                        type: "wavy",
                        customBreaks: [{
                                startValue: 80,
                                endValue: 210
                            },
                            {
                                startValue: 230,
                                endValue: 600
                            }
                        ]
                    }
                },
                data: [{
                    type: "bar",
                    toolTipContent: "<img src=\"https://canvasjs.com/wp-content/uploads/images/gallery/javascript-column-bar-charts/\"{url}\"\" style=\"width:40px; height:20px;\"> <b>{label}</b><br>Budget: ${y}bn<br>{gdp}% of GDP",
                    dataPoints: [{
                            label: "Israel",
                            y: 17.8,
                            gdp: 5.8,
                            url: "israel.png"
                        },
                        {
                            label: "United Arab Emirates",
                            y: 22.8,
                            gdp: 5.7,
                            url: "uae.png"
                        },
                        {
                            label: "Brazil",
                            y: 22.8,
                            gdp: 1.3,
                            url: "brazil.png"
                        },
                        {
                            label: "Australia",
                            y: 24.3,
                            gdp: 2.0,
                            url: "australia.png"
                        },
                        {
                            label: "South Korea",
                            y: 36.8,
                            gdp: 2.7,
                            url: "skorea.png"
                        },
                        {
                            label: "Germany",
                            y: 41.1,
                            gdp: 1.2,
                            url: "germany.png"
                        },
                        {
                            label: "Japan",
                            y: 46.1,
                            gdp: 1.0,
                            url: "japan.png"
                        },
                        {
                            label: "United Kingdom",
                            y: 48.3,
                            gdp: 1.9,
                            url: "uk.png"
                        },
                        {
                            label: "India",
                            y: 55.9,
                            gdp: 2.5,
                            url: "india.png"
                        },
                        {
                            label: "Russia",
                            y: 69.2,
                            gdp: 5.3,
                            url: "russia.png"
                        },
                        {
                            label: "China",
                            y: 215.7,
                            gdp: 1.9,
                            url: "china.png"
                        },
                        {
                            label: "United States",
                            y: 611.2,
                            gdp: 3.3,
                            url: "us.png"
                        }
                    ]
                }]
            });
            chart.render();

        }
    </script>
</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-bell noti-icon"></i>
                        <span class="badge badge-success rounded-circle noti-icon-badge">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="font-16 m-0">
                                <span class="float-right">
                                    <a href="" class="text-dark">
                                        <small>Clear All</small>
                                    </a>
                                </span>Notification
                            </h5>
                        </div>

                        <div class="slimscroll noti-scroll">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                                <p class="notify-details">Caleb Flakelar commented on Admin
                                    <small class="text-muted">4 days ago</small>
                                </p>
                            </a>

                        </div>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                            See all Notification
                            <i class="fi-arrow-right"></i>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-email noti-icon"></i>
                        <span class="badge badge-danger rounded-circle noti-icon-badge">8</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="font-16 m-0">
                                <span class="float-right">
                                    <a href="" class="text-dark">
                                        <small>Clear All</small>
                                    </a>
                                </span>Messages
                            </h5>
                        </div>

                        <div class="slimscroll noti-scroll">

                            <div class="inbox-widget">
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets\images\users\avatar-5.jpg" class="rounded-circle" alt=""></div>
                                        <p class="inbox-item-author">Shahedk</p>
                                        <p class="inbox-item-text text-truncate">Hey! there I'm available...</p>

                                    </div>
                                </a>
                            </div> <!-- end inbox-widget -->

                        </div>
                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                            See all Messages
                            <i class="fi-arrow-right"></i>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="assets\images\users\avatar-1.jpg" alt="user-image" class="rounded-circle">
                        <span class="d-none d-sm-inline-block ml-1"> Xin chào </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome <?php echo Session::get('adminName') ?>!</h6>
                        </div>

                        <!-- item-->
                        <a href="profile.php" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-outline"></i>
                            <span>Profile</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="mdi mdi-settings-outline"></i>
                            <span>Settings</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="mdi mdi-lock-outline"></i>
                            <span>Lock Screen</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="?action=logout" class="dropdown-item notify-item">
                            <i class="mdi mdi-logout-variant"></i>
                            <?php
                            if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                                Session::destroy();
                            }
                            ?>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect">
                        <i class="mdi mdi-settings noti-icon"></i>
                    </a>
                </li>

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="index.html" class="logo text-center">
                    <span class="logo-lg">
                        <img src="assets\images\logo-light.png" alt="" height="18">
                        <!-- <span class="logo-lg-text-light">Zircos</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">Z</span> -->
                        <img src="assets\images\logo-sm.png" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>

                <li class="d-none d-sm-block">
                    <form class="app-search">
                        <div class="app-search-box">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search...">
                                <div class="input-group-append">
                                    <button class="btn" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </li>

                <li class="d-none d-lg-block">
                    <a href="#" class="nav-link">New</a>
                </li>

                <li class="dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="assets\images\flags\us.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">English <i class="mdi mdi-chevron-down"></i> </span>
                    </a>
                    <div class="dropdown-menu">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <img src="assets\images\flags\germany.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">German</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <img src="assets\images\flags\italy.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Italian</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <img src="assets\images\flags\spain.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Spanish</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <img src="assets\images\flags\russia.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Russian</span>
                        </a>

                    </div>
                </li>


            </ul>
        </div>
        <!-- end Topbar -->