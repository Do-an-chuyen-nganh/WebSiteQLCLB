<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/EventModel.php'; ?>
<?php include '../models/category.php'; ?>
<?php include_once '../helper/format.php'; ?>
<?php
$event = new EventModel();
$fm = new format();
$id = null;
if (isset($_GET['accept'])) {
    $del_event = $event->accept_register($_GET['accept']);
}
if (isset($_GET['delete'])) {
    $del_event = $event->delete_member_register($_GET['delete']);
}
if (isset($_GET['event_id'])) {
    $id = $_GET['event_id'];
}
$result = $event->select_member_register_clb($id);
?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Danh sách thành viên đăng ký tham gia sự kiện</h4>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-link" onclick="history.back()"> <i class="fas fa-angle-double-left"></i> Trở lại</button>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="row">
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
                                                                <th>Tên Thành Viên</th>
                                                                <th>Student Code</th>
                                                                <th>Lý Do</th>
                                                                <th>Trạng Thái</th>
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
                                                                                 echo $result[$i][2]
                                                                                ?>
                                                                        </td>
                                                                        <td><?php echo $result[$i][3] ?></td>
                                                                        <td >
                                                                        <?php if($result[$i][4]==1){?>
                                                                        <i class="fas fa-check" style="color: green; "></i>
                                                                        <?php }else{?>
                                                                            Đang chờ xử lý
                                                                        <?php }?>
                                                                        </td>
                                                                        <td>
                                                                        <?php if($result[$i][4] == 0){?>
                                                                        <a href="?event_id=<?php echo $id ?>&accept=<?php echo $result[$i][0] ?>">
                                                                                <i class="fas fa-check" style="color: green;"></i>
                                                                            </a>
                                                                            |<?php }?> 
                                                                            <a onclick="return confirm('Bạn có muốn xoá danh mục này không?')" href="?event_id=<?php echo $id ?>&delete=<?php echo $result[$i][0] ?>">
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

                            <!-- end page title -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include './inc/footer.php'; ?>