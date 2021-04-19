<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/EventModel.php'; ?>
<?php include '../models/club.php'; ?>
<?php include '../models/studentModel.php'; ?>
<?php
$event = new EventModel();
$event_id = null;
$type = null;
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $insertClb = $event->register_event($_POST);
}
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
}
$sm = new studentModel();

$studentList = $sm->get_students_by_clb(Session::get('clb_id'));

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
                                <li class="breadcrumb-item active">Đăng ký tham gia event</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Đăng ký tham gia Event</h4>
                    </div>
                </div>
            </div>
            <form id="basic-form" action="eventRegister.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-box">
                        <?php
                        if (isset($insertClb)) {
                            echo $insertClb;
                        }
                        ?>
                        
                            <div>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="category">Câu lạc bộ</label>
                                        <div class="col-lg-10">
                                            <select class="browser-default custom-select" id="select" name="clb_id" required>
                                                <option>------Chọn câu lạc bộ------</option>
                                                <?php
                                                $club = new club();
                                                $clubList = $club->show_club();
                                                if ($clubList) {
                                                    while ($result = $clubList->fetch_assoc()) {
                                                ?>
                                                        <option value="<?php echo $result['clb_id'] ?>"><?php echo $result['clbName'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="quantity">Số lượng thành viên</label>
                                        <div class="col-lg-10">
                                            <input class="form-control required" id="quantity" name="quantity" type="number" required>
                                            <input class="form-control required" name="event_id" type="text" value="<?php echo $event_id ?>" hidden>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="description">Mô tả</label>
                                        <div class="col-lg-10">
                                            <input class="form-control required" name="description" type="text" placeholder="Mô tả về tiết mục..." />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="content">Nội dung</label>
                                        <div class="col-lg-10">
                                            <textarea class="form-control" name="content" rows="4" cols="50" placeholder="Nội dung sự kiện"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="image">Ảnh</label>
                                        <div class="col-lg-10">
                                            <input class="form-control required" name="image" data-height="300" type="file" />
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-sm-8 offset-sm-9">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Đăng ký
                                            </button>
                                            <button type="reset" class="btn btn-secondary waves-effect ml-1">
                                                <a href="eventCLB.php" style="color:white">Trở về</a>
                                            </button>
                                        </div>
                                    </div>
                                </section>

                            </div>


                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-box">
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
                                    <td><input type="checkbox" class="student_id" name="student_id[]" value="<?php echo $studentList[$i][0]?>"></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </form>
            </div>

            <!-- End row -->
        </div>
        <!-- End start page title -->
    </div>
    <!-- End content -->
</div>
<script>
    CKEDITOR.replace('content');
</script>
<!-- End content-page -->
<?php include './inc/footer.php'; ?>
<script>
    $(".student_id").click(function() {
        var count = $('#quantity').val();
            $('#quantity').val($('.student_id:checked').length);
    });
</script>