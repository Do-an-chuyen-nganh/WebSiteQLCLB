<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/MemberScoreModel.php'; ?>
<?php include '../models/category.php'; ?>
<?php include '../models/club.php'; ?>

<?php
//member score model
$memberScore = new MemberScoreModel();
//id member score
$memberScore_id = null;
//club model
$clubModel = new club();
//get member
$member = $memberScore->get_students_by_status_and_club(1, $_SESSION['clb_id']);
//get all club
$club = $clubModel->get_all_club();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_GET['memberScore_id'])) {
    $insertClb = $memberScore->insert_memberscore($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['memberScore_id'])) {
    $insertClb = $memberScore->edit_memberScore($_POST);
}
if (isset($_GET['memberScore_id'])) {
    $memberScore_id = $_GET['memberScore_id'];
}
?>

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <?php
            if (isset($insertClb)) {
                echo $insertClb;
            }
            if ($memberScore_id != null) {
                $memberScoreList = $memberScore->show_memberscore_byId($memberScore_id);
                if ($memberScoreList != null) {
            ?>
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-10">
                            <div class="page-title-box">
                                <h4 class="page-title">Chỉnh sửa điểm thành viên</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card-box">

                                <form id="basic-form" action="memberScoreForm.php?memberScore_id=<?php echo $memberScore_id ?>" method="POST">
                                    <div>
                                        <h3></h3>
                                        <section>
                                            <!--Chọn thành viên-->
                                            <input type="hidden" name="memberScore_id" value="<?php echo $memberScoreList[0][0] ?>">
                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="namememberScore">Tên thành viên</label>
                                                <div class="col-lg-10">
                                                    <select class="form-control" name="id_student" aria-label="Default select example">
                                                        <?php
                                                        for ($i = 0; $i < count($member); $i++) {
                                                            if ($memberScoreList[0][5] == $member[$i][0]) {

                                                        ?>
                                                                <option value="<?php echo $member[$i][0] ?>" selected><?php echo $member[$i][1] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $member[$i][0] ?>"><?php echo $member[$i][1] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <!--End Chọn thành viên-->
                                            <!--Chọn câu lạc bộ-->
                                            <input type="hidden" name="clb_id" value="<?php echo $_SESSION['clb_id'] ?>">

                                            <!--End Chọn câu lạc bộ-->
                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="totalScore">Total score</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" name="totalScore" type="text" placeholder="Total score..."  value="<?php echo $memberScoreList[0][1] ?>" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="startDay">Ngày nhập</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" name="create_at" type="datetime-local" value="<?php echo date('Y-m-d\TH:i', strtotime($memberScoreList[0][2])); ?>" >
                                                </div>
                                            </div>

                                            <?php
                                            //check nếu chưa có sửa thì ẩn
                                            if ($memberScoreList[0][3]) {
                                            ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label " for="startDay">Ngày sửa</label>
                                                    <div class="col-lg-10">

                                                        <input class="form-control" name="startDay" type="datetime-local" value="<?php echo date('Y-m-d\TH:i', strtotime($memberScoreList[0][3])); ?>" required>

                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <div class="form-group row">
                                                <div class="col-sm-8 offset-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Chỉnh sửa
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect ml-1">

                                                        <a href="memberScore.php" style="color:white">Trở về</a>

                                                    </button>
                                                </div>
                                            </div>
                                        </section>

                                    </div>
                                </form>
                            <?php
                        }
                    } else {
                            ?>
                            <!-- start page title -->
                            <div class="row">
                                <div class="col-10">
                                    <div class="page-title-box">
                                        <h4 class="page-title">Thêm điểm thành viên</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="card-box">
                                        <form id="basic-form" action="memberScoreForm.php" method="POST" enctype="multipart/form-data">
                                            <h3></h3>
                                            <section>
                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label " for="namememberScore">Tên thành viên</label>
                                                    <div class="col-lg-10">
                                                        <select class="form-control" name="id_student" aria-label="Default select example">
                                                            
                                                            <?php
                                                            for ($i = 0; $i < count($member); $i++) {

                                                            ?>
                                                                <option value="<?php echo $member[$i][0] ?>"><?php echo $member[$i][1] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="clb_id" value="<?php echo $_SESSION['clb_id'] ?>">


                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label " for="totalScore">Total score</label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control" name="totalScore" type="number" step="0.05" placeholder="Total score..."  value="" />
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-sm-8 offset-sm-9">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                            Thêm
                                                        </button>
                                                        <button type="reset" class="btn btn-secondary waves-effect ml-1">

                                                            <a href="listMemberScore.php" style="color:white">Trở về</a>

                                                        </button>
                                                    </div>
                                                </div>
                                            </section>

                                    </div>
                                    </form>


                                </div>
                            </div>
                            </div>
                        <?php
                    }
                        ?>
                        <!-- End row -->
                        </div>
                        <!-- End start page title -->
                    </div>
                    <!-- End content -->
        </div>
        <!-- End content-page -->
        <?php include './inc/footer.php'; ?>
<script>
    $().ready(function() {
        $("#basic-form").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "totalScore": {
                    required: true
                }
            },
            messages: {
                "totalScore": {
                    required: "Điểm không được để trống !"
                }
            }
        });
    });
</script> 