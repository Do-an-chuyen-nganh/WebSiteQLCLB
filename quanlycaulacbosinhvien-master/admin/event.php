<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/EventModel.php'; ?>
<?php include '../models/category.php'; ?>
<?php include_once '../helper/format.php'; ?>
<?php
$event = new EventModel();
$fm = new format();

if (isset($_GET['event_id'])) {
    $id = $_GET['event_id'];
    $del_event = $event->del_event($id);
}

$result = $event->show_event(1,0);
?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Danh sách sự kiện</h4>
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
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Quản Lý Sự Kiện</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Quản lý CLB tham gia</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="table-responsive">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <table class="table col-sm-12 ">
                                                        <thead>
                                                            <?php
                                                            if (isset($del_event)) {
                                                                echo $del_event;
                                                            }
                                                            ?>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Tên Sự Kiện</th>
                                                                <th>Nội Dung</th>
                                                                <th>Ngày Bắt Đầu</th>
                                                                <th>Ngày Kết Thúc</th>
                                                                <th>Địa Điểm</th>
                                                                <th>Yêu Cầu</th>
                                                                <th>Hình ảnh</th>
                                                                <th> <a href="eventForm.php?type=1">
                                                                        <i class="fas fa-plus-square" style="color:green"> Thêm Sự Kiện</i>
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
                                                                        <td> <?php
                                                                                echo $fm->textShorten($result[$i][2], 50);
                                                                                ?>
                                                                        </td>
                                                                        <td><?php echo $result[$i][3] ?></td>
                                                                        <td><?php echo $result[$i][4] ?></td>
                                                                        <td><?php echo $result[$i][5] ?></td>
                                                                        <td><?php echo $result[$i][6] ?></td>
                                                                        <td><img style="width:150px" src="../uploads/<?php echo $result[$i][7] ?>"></td>
                                                                        <td>
                                                                        <a href="eventDetail.php?event_id=<?php echo $result[$i][0] ?>">
                                                                                <i class="fas fa-eye"></i>
                                                                            </a> |
                                                                            <a href="EventForm.php?type=1&event_id=<?php echo $result[$i][0] ?>">
                                                                                <i class="fas fa-edit"></i>
                                                                            </a> |
                                                                            <a onclick="return confirm('Bạn có muốn xoá danh mục này không?')" href="?event_id=<?php echo $result[$i][0] ?>">
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
                                                            if (isset($del_event)) {
                                                                echo $del_event;
                                                            }
                                                            ?>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Tên Sự Kiện</th>
                                                                <th>Nội Dung</th>
                                                                <th>Ngày Bắt Đầu</th>
                                                                <th>Ngày Kết Thúc</th>
                                                                <th>Địa Điểm</th>
                                                                <th>Yêu Cầu</th>
                                                                <th>Hình ảnh</th>
                                                                <th></th>
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
                                                                        <td> <?php
                                                                                echo $fm->textShorten($result[$i][2], 50);
                                                                                ?>
                                                                        </td>
                                                                        <td><?php echo $result[$i][3] ?></td>
                                                                        <td><?php echo $result[$i][4] ?></td>
                                                                        <td><?php echo $result[$i][5] ?></td>
                                                                        <td><?php echo $result[$i][6] ?></td>
                                                                        <td><img style="width:150px" src="../uploads/<?php echo $result[$i][7] ?>"></td>
                                                                        <td>
                                                                        <a href="eventListRegister.php?event_id=<?php echo $result[$i][0] ?>">
                                                                                <i class="fas fa-eye"></i>
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
                                    </div>


                                </div>

                            </div>
                            <!-- end page title -->
                        </div>
                    </div>
                </div>
                <?php include './inc/footer.php'; ?>