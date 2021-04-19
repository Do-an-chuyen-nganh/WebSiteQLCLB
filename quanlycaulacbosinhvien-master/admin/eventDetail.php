<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/EventModel.php'; ?>
<?php include '../models/category.php'; ?>
<?php include_once '../helper/format.php'; ?>
<?php
$event = new EventModel();
$fm = new format();
$event_id = null;
$type = null;
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
}
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}
$result = $event->show_event_byId($event_id);
?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Zircos</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Chi tiết event</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Chi tiết event</h4>
                            <button type="button" class="btn btn-link" onclick="history.back()"> <i class="fas fa-angle-double-left"></i> Trở lại</button>
                    </div>
                </div>
            </div>
            <!-- Page Content -->
            <div class="container">

                <div class="row">

                    <!-- Post Content Column -->
                    <div class="col-lg-8">

                        <!-- Title -->
                        <h1 class="mt-4"><?php echo $result[0][1] ?></h1>

                        <hr>

                        <!-- Date/Time -->
                        <p>Được viết vào <?php echo $result[0][5] ?></p>

                        <hr>
                        <!-- Title content -->
                        <p class="lead"><?php echo $result[0][2] ?></p>
                        <!-- Short content -->
                        <p class="lead"><?php echo $result[0][3] ?></p>

                        <hr>
                        <!-- Preview Image -->
                        <img class="img-fluid rounded" src="../uploads/<?php echo $result[0][11] ?>" alt="">

                        <hr>

                        <!-- Post Content -->
                        <p><?php echo $result[0][4] ?></p>

                        <hr>

                    </div>

                    <!-- Sidebar Widgets Column -->
                    <div class="col-md-4">

                        <!-- Search Widget -->
                        <div class="card my-4">
                            <h5 class="card-header">Tìm kiếm</h5>
                            <div class="card-body">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">Go!</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Categories Widget
                        <div class="card my-4">
                            <h5 class="card-header">Categories</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul class="list-unstyled mb-0">
                                            <li>
                                                <a href="#">Web Design</a>
                                            </li>
                                            <li>
                                                <a href="#">HTML</a>
                                            </li>
                                            <li>
                                                <a href="#">Freebies</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6">
                                        <ul class="list-unstyled mb-0">
                                            <li>
                                                <a href="#">JavaScript</a>
                                            </li>
                                            <li>
                                                <a href="#">CSS</a>
                                            </li>
                                            <li>
                                                <a href="#">Tutorials</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <?php 
                        if($type == 2){
                        ?>
                        <!-- Side Widget -->
                        <div class="card my-4">
                            <h5 class="card-header">Đăng ký ngay</h5>
                            <div class="card-body">
                                <p>Để đăng ký tiết mục của câu lạc bộ cho event này vui lòng nút "Next" !</p>
                                <button type="button" class="btn btn-link" onclick="location.href='eventRegister.php'">Next  <i class="fas fa-arrow-right"></i> </button>
                            </div>
                        </div>
                        <?php
                        }
                        ?>

                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
            <!-- end page title -->
        </div>
    </div>
</div>
<?php include './inc/footer.php'; ?>