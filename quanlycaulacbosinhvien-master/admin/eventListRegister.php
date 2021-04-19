<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/EventModel.php'; ?>
<?php include '../models/category.php'; ?>
<?php include_once '../helper/format.php'; ?>
<?php include '../models/studentModel.php'; ?>
<?php
$event = new EventModel();
$fm = new format();
$id = null;
if (isset($_GET['event_id'])) {
    $id = $_GET['event_id'];
}
if (isset($_GET['accept_id'])) {
    $insertClb = $event->accept_event_register($_GET['accept_id']);
}
if (isset($_GET['denied_id'])) {
    $insertClb = $event->delete_register($_GET['denied_id']);
}
$result = $event->show_request_register($id);
$studentList = $event->show_list_member($id);
?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Danh sách CLB đăng ký tham dự</h4>
                    </div>
                </div>
                <button type="button" class="btn btn-link" onclick="history.back()"> <i class="fas fa-angle-double-left"></i> Trở lại</button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="demo-box">
                                    <div class="table-responsive">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <table class="table col-sm-12 ">
                                                <thead>
                                                    <?php
                                                    if (isset($insertClb)) {
                                                        echo $insertClb;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tên CLB</th>
                                                        <th>Mô tả</th>
                                                        <th>Nội dung</th>
                                                        <th>SL thành viên</th>
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
                                                                <td><?php echo $result[$i][4] ?></td>
                                                                <td><?php echo $result[$i][2] ?></td>
                                                                <td> <?php
                                                                        echo $fm->textShorten($result[$i][1], 50);
                                                                        ?>
                                                                </td>
                                                                <td style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal"><?php echo $result[$i][0] ?></td>
                                                                <td><img style="width:150px" src="../uploads/<?php echo $result[$i][3] ?>"></td>
                                                                <td>
                                                                    <a onclick="return confirm('Bạn có chấp thuận yêu cầu này không?')" href="?event_id=<?php echo $id ?>&accept_id=<?php echo $result[$i][5] ?>">
                                                                        <i class="fas fa-check" style="color:green"></i>
                                                                    </a> |
                                                                    <a onclick="return confirm('Bạn có từ chối yêu cầu này không?')" href="?event_id=<?php echo $id ?>&denied_id=<?php echo $result[$i][5] ?>">
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
                            </div>

                        </div>
                        <!-- end page title -->
                    </div>
                </div>
            </div>
            <script>
                $('#myModal').on('shown.bs.modal', function() {
                    $('#myInput').trigger('focus')
                })
            </script>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Danh sách thành viên tham gia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên Thành Viên</th>
                                    <th scope="col">Student Code</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < sizeof($studentList); $i++) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i+1?></th>
                                    <td><?php echo $studentList[$i][1]?></td>
                                    <td><?php echo $studentList[$i][3]?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php include './inc/footer.php'; ?>