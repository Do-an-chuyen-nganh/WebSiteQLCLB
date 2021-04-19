<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/NewsModel.php'; ?>
<?php include '../models/category.php'; ?>
<?php include_once '../helper/format.php'; ?>
<?php
$news = new NewsModel();
$fm = new format();

if (isset($_GET['news_id'])) {
    $id = $_GET['news_id'];
    $del_news = $news->del_news($id);
}

$result = $news->show_news();

?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Danh sách tin tức</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="demo-box">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Quản lý News</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Quản Lý News Trường</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="table-responsive">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <table class="table col-sm-12 ">
                                                        <thead>
                                                            <?php
                                                            if (isset($del_news)) {
                                                                echo $del_news;
                                                            }
                                                            ?>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Tên Sự Kiện</th>
                                                                <th>Nội Dung Ngắn</th>
                                                                <th>Nội Dung Dài</th>
                                                                <th>Tiêu Đề</th>
                                                                <th>Ngày Đăng</th>
                                                                <th>Hình ảnh</th>

                                                                <th> <a href="NewsForm.php?type=1">
                                                                        <i class="fas fa-plus-square" style="color:green"> Thêm Tin Tuc</i>
                                                                    </a></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($result != false) {
                                                                for ($i = 0; $i < sizeof($result); $i++) {

                                                            ?>
                                                                    <tr>
                                                                        <th scope="row"><?php echo $i + 1; ?></th>
                                                                        <td><?php echo $result[$i][1] ?></td> 
                                                                        <td><?php echo $result[$i][2] ?></td>
                                                                        <td> <?php
                                                                                echo $fm->textShorten($result[$i][3], 50);
                                                                                ?>
                                                                        </td>
                                                                        <td><?php echo $result[$i][4] ?></td>
                                                                        <td><?php echo $result[$i][5] ?></td>
                                                                        <td><img style="width:150px" src="../uploads/<?php echo $result[$i][6] ?>"></td>
                                                                        <td>
                                                                            <a href="newsDetail.php?news_id=<?php echo $result[$i][0] ?>">
                                                                                <i class="fas fa-eye"></i>
                                                                            </a> |
                                                                            <a href="NewsForm.php?type=2&news_id=<?php echo $result[$i][0] ?>">
                                                                                <i class="fas fa-edit"></i>
                                                                            </a> |
                                                                            <a onclick="return confirm('Bạn có muốn xoá danh mục này không?')" href="?news_id=<?php echo $result[$i][0] ?>">
                                                                                <i class="fas fa-trash-alt" style="color:red"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="table-responsive">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <table class="table col-sm-12 ">
                                                        <thead>
                                                            <?php
                                                            if (isset($del_news)) {
                                                                echo $del_news;
                                                            }
                                                            ?>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Tên Sự Kiện</th>
                                                                <th>Nội Dung Ngắn</th>
                                                                <th>Nội Dung Dài</th>
                                                                <th>Ngày Bắt ĐầuNgày Kết Thúc</th>
                                                                <th>Địa Điểm</th>
                                                                <th>Yêu Cầu</th>
                                                                <th>Hình ảnh</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($result2 != false) {
                                                                for ($i = 0; $i < sizeof($result2); $i++) {
                                                            ?>
                                                                    <tr onclick="location.href='newsDetail.php?news_id=<?php echo $result2[$i][0] ?>'" style="cursor:pointer">
                                                                        <th scope="row"><?php echo $i + 1; ?></th>
                                                                        <td><?php echo $result2[$i][1] ?></td>
                                                                        <td> <?php
                                                                                echo $fm->textShorten($result2[$i][2], 50);
                                                                                ?>
                                                                        </td>
                                                                        <td><?php echo $result2[$i][3] ?></td>
                                                                        <td><?php echo $result2[$i][4] ?></td>
                                                                        <td><?php echo $result2[$i][5] ?></td>
                                                                        <td><?php echo $result2[$i][6] ?></td>
                                                                        <td><img style="width:150px" src="../uploads/<?php echo $result2[$i][7] ?>"></td>
                                                                        <td>
                                                                            <a href="newsDetail.php?news_id=<?php echo $result2[$i][0] ?>&type=2">
                                                                                <i class="fas fa-eye"></i>
                                                                            </a>
                                                                            <?php
                                                                            $check = $news->check_exist_news($result2[$i][0]);
                                                                            if ($check[0][0] == 0) {
                                                                            ?>
                                                                                |<a href="newsRegister.php?news_id=<?php echo $result2[$i][0] ?>&type=2">
                                                                                    <i class="far fa-plus-circle" style="color: green;"></i>
                                                                                </a>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                    </div>
                </div>
            </div>
            <?php include './inc/footer.php'; ?>