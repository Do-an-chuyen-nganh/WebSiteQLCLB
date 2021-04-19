<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/newsModel.php'; ?>
<?php include '../models/category.php'; ?>
<?php include_once '../helper/format.php'; ?>
<?php
$news = new newsModel();
$fm = new format();
$news_id = null;
$type = null;
if (isset($_GET['news_id'])) {
    $news_id = $_GET['news_id'];
}
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}
$result = $news->show_news_byId($news_id);
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
                                <li class="breadcrumb-item active">Chi tiết news</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Chi tiết news</h4>
                            <button type="button" class="btn btn-link" onclick="history.back()"> <i class="fas fa-angle-double-left"></i> Trở lại</button>
                    </div>
                </div>
            </div>
            <!-- Page Content -->
            <div class="container">

                <div class="row">

                    <!-- Post Content Column -->
                    <div class="col-lg-8">

                        <!-- Tieu de -->
                        <h1 class="mt-4"><?php echo $result[0][6] ?></h1>

                        <hr>

                        <!-- Date/Time -->
                        <p>Được viết vào <?php echo $result[0][3] ?></p>
                        <hr>
                        <!-- Title content -->
                        <p class="lead"><?php echo $result[0][2] ?></p>
                        <!-- Short content -->
                        <hr>
                        <!-- Preview Image -->
                        <img class="img-fluid rounded" src="../uploads/<?php echo $result[0][4] ?>" alt="">
                        <hr>
                        <p class="lead"><?php echo $result[0][5] ?></p>
                        <!-- Post Content -->
                        <p><?php// echo $result[0][4] ?></p>
                         <p> Tên tiêu đề không dấu:  <?php echo $result[0][1] ?></p>
                        <hr>
                        <div class="card my-4">
                            <h5 class="card-header">Search</h5>
                            <div class="card-body">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">Go!</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Widgets Column -->
                    <div class="col-md-4">

                        <!-- Search Widget -->
                      

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
                                <p>Để đăng ký tiết mục của câu lạc bộ cho news này vui lòng nút "Next" !</p>
                                <button type="button" class="btn btn-link" onclick="location.href='newsRegister.php'">Next  <i class="fas fa-arrow-right"></i> </button>
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