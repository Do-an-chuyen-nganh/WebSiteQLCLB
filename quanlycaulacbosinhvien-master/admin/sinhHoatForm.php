<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/MemberScoreModel.php'; ?>
<?php include '../models/category.php'; ?>
<?php include '../models/club.php'; ?>
<?php include '../models/SinhHoatCLBModel.php'; ?>

<?php
$shModel = new SinhHoatCLBModel();
$memberScoreModel = new MemberScoreModel();
//number of members in club
$numberOfMem = $memberScoreModel->count_students_by_status_and_club(1, $_SESSION['clb_id']);

$sinhhoat_id = null;


if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_GET['sinhhoat_id'])) {
    $insertClb = $shModel->insert_buoi_sinh_hoat($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['sinhhoat_id'])) {
    $insertClb = $shModel->edit_buoi_sinh_hoat($_POST);
}
if (isset($_GET['sinhhoat_id'])) {
    $sinhhoat_id = $_GET['sinhhoat_id'];
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
            if ($sinhhoat_id != null) {
                $buoi_sinh_hoat = $shModel->get_sinh_hoat_by_id($sinhhoat_id);
                if ($buoi_sinh_hoat != null) {
            ?>
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-10">
                            <div class="page-title-box">
                                <h4 class="page-title">Chỉnh sửa điểm buổi sinh hoạt CLB</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card-box">

                                <form id="basic-form" action="sinhHoatForm.php?sinhhoat_id=<?php echo $sinhhoat_id ?>" method="POST">
                                    <div>
                                        <h3></h3>
                                        <section>
                                            <input type="hidden" name="sinhhoat_id" value="<?php echo $sinhhoat_id ?>">
                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="totalScore">Tên buổi sinh hoạt</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" name="ten_buoi_sh" type="text" placeholder="Tên buổi sinh hoạt" value="<?php echo $buoi_sinh_hoat[0][1] ?>" required/>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="noi_dung_sh">Nội dung sinh hoạt</label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" name="noi_dung_sh" rows="4" cols="50"  placeholder="Tiêu đề nội dung" required><?php echo $buoi_sinh_hoat[0][2] ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="startDay">Thời gian sinh hoạt</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" name="thoi_gian" type="datetime-local" value="<?php echo date('Y-m-d\TH:i', strtotime($buoi_sinh_hoat[0][3])); ?>" required>
                                                </div>
                                            </div>

                                            <input type="hidden" name="status" value="<?php echo $buoi_sinh_hoat[0][6] ?>">
                                            <input type="hidden" name="tong_sl_thanh_vien_hien_tai" value="<?php echo $buoi_sinh_hoat[0][5] ?>">

                                            <input type="hidden" name="clb_id" value="<?php echo $_SESSION['clb_id']?>">

                                            <div class="form-group row">
                                                <div class="col-sm-8 offset-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Chỉnh sửa
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect ml-1">
                                                        
                                                            <a href="listSinhHoat.php" style="color:white">Trở về</a>
                                                        
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
                                        <h4 class="page-title">Thêm mới buổi sinh hoạt CLB</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="card-box">
                                        <form id="basic-form" action="sinhHoatForm.php" method="POST" enctype="multipart/form-data">
                                                <h3></h3>
                                                <section>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="totalScore">Tên buổi sinh hoạt</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="ten_buoi_sh" type="text" placeholder="Tên buổi sinh hoạt" required/>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="noi_dung_sh">Nội dung sinh hoạt</label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" name="noi_dung_sh" rows="4" cols="50" placeholder="Tiêu đề nội dung" required></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="startDay">Thời gian sinh hoạt</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="thoi_gian" type="datetime-local" required>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="tong_sl_thanh_vien_hien_tai" value="<?php echo $numberOfMem[0][0]?>">

                                                    <input type="hidden" name="clb_id" value="<?php echo $_SESSION['clb_id']?>">
                                                    <div class="form-group row">
                                                        <div class="col-sm-8 offset-sm-9">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                                Thêm
                                                            </button>
                                                            <button type="reset" class="btn btn-secondary waves-effect ml-1">
                                                                
                                                                    <a href="listSinhHoat.php" style="color:white">Trở về</a>
                                                                
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
                    <script>
                        CKEDITOR.replace('noi_dung_sh');
                    </script>
                    <!-- End content-page -->
                    <?php include './inc/footer.php'; ?>
<script>
    $().ready(function() {
        $("#basic-form").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                
                "ten_buoi_sh": {
                    required: true,
                    minlength: 8
                },
                "noi_dung_sh": {
                    required: true,
                    minlength: 8
                },
                "thoi_gian": {
                    required: true
                }
            },
            messages: {
                "noi_dung_sh": {
                    required: "Nội dung sinh hoạt không được để trống !",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                },
                "ten_buoi_sh": {
                    required: "Tên buổi sinh hoạt không được để trống !",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                },
                "thoi_gian": {
                    required: "Hãy chọn thời gian sinh hoạt !"
                }
            }
        });
        
    });
</script> 