<?php include './inc/header.php';?>
<?php include './inc/leftsidemenu.php';?>
<?php include '../models/club.php';?>
<?php include '../models/category.php';?>
<?php include '../models/MemberScoreModel.php'; ?>
<?php include '../models/SinhHoatCLBModel.php'; ?>
<?php include_once '../helper/format.php';?>
<?php include '../models/DiemDanhModel.php'; ?>

<?php
    $sh_id = $_GET['sh_id'];

    $diemDanhModel = new DiemDanhModel();
    $memberScoreModel = new MemberScoreModel();
    $sinhHoatCLBModel = new SinhHoatCLBModel();

    $listDaDiemDanh = $diemDanhModel->get_danh_sach_by_sh_id($sh_id);

    $listThanhVien = $memberScoreModel->get_students_by_status_and_club(1, $_SESSION['clb_id']);

    if($listDaDiemDanh == null){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(isset($_POST['student_id']) && gettype($_POST['student_id']) == "array"){
                for($i = 0; $i < count($listThanhVien); $i++) {
                    $diemDanh['co_mat'] = in_array($listThanhVien[$i][0], $_POST['student_id']);
                    $diemDanh['id_student'] = $listThanhVien[$i][0];
                    $diemDanh['sinhhoat_id'] = $_POST['sinhhoat_id'];
                    $diemDanhModel->insert_diem_danh($diemDanh);
                }
                //get sl tham vien co tham gia
                $sl_thamgia = $diemDanhModel->get_number_members_present($_POST['sinhhoat_id']);
                //cap nhat lai sl thanh vien tham gia
                $sinhHoatCLBModel->edit_numbers_of_mem_tham_gia($_POST['sinhhoat_id'], $sl_thamgia[0][0]);
                //set trang thai la da off clb
                $sinhHoatCLBModel->set_status($_POST['sinhhoat_id'], 0);
            }

        }

    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['student_id']) && gettype($_POST['student_id']) == "array"){
                for($i = 0; $i < count($listThanhVien); $i++) {
                    $diemDanhModel->edit_diem_danh($listThanhVien[$i][0], $_POST['sinhhoat_id'], in_array($listThanhVien[$i][0], $_POST['student_id']));

                }
                //get sl thanh vien co tham gia
                $sl_thamgia = $diemDanhModel->get_number_members_present($_POST['sinhhoat_id']);
                //cap nhat lai sl thanh vien tham gia
                $sinhHoatCLBModel->edit_numbers_of_mem_tham_gia($_POST['sinhhoat_id'], $sl_thamgia[0][0]);
            }

        }
    }
    $listDaDiemDanh = $diemDanhModel->get_danh_sach_by_sh_id($sh_id);

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
                                <li class="breadcrumb-item active">Danh sách câu lạc bộ</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Danh sách câu lạc bộ</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="demo-box">
                                                <!-- <a href="sinhHoatForm.php">
                                                    <i class="fas fa-plus-square" style="color:green"> Thêm buổi sinh hoạt mới</i>
                                                </a> -->
                                                <?php 
                                                        if($listDaDiemDanh == null) {

                                                 ?>
                                                <div class="table-responsive">
                                                    <form action="diemDanh.php?sh_id=<?php echo $sh_id ?>" method="POST" enctype="multipart/form-data">
                                                    <table class="table col-sm-12 ">
                                                        <thead>
                                                        
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Tên thành viên</th>
                                                                <th>MSSV</th>
                                                                <th>Phone</th>
                                                                <th>Có mặt</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                            $len = gettype($listThanhVien) == 'array'? sizeof($listThanhVien) : 0;
                                                            for($i = 0; $i < $len; $i++) {
                                                                $mem = $memberScoreModel->get_students_by_id($listThanhVien[$i][0]);
                                                        ?>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row"><?php echo $i + 1; ?></th>
                                                                <td><?php echo $mem[0][1]?></td>
                                                                
                                                                <td><?php echo $mem[0][3]?></td>
                                                                
                                                                <td><?php echo $mem[0][2]?></td>
                                                                
                                                                <td>
                                                                    <input type="checkbox" name="student_id[]" value="<?php echo $listThanhVien[$i][0]?>">
                                                                </td>
                                                            </tr>
                                                            <?php
						                                        }
						                                    ?>
                                                        </tbody>
                                                    </table>
                                                    <input type="hidden" name="sinhhoat_id" value="<?php echo $sh_id?>">
                                                    <button class="btn btn-primary waves-effect waves-light">Submit</button>
                                                    <button type="reset" class="btn btn-secondary waves-effect ml-1">
                                                                
                                                                    <a href="listSinhHoat.php" style="color:white">Trở về</a>
                                                                
                                                    </button>
                                                    </form>
                                                </div>
                                                <?php 
                                                    } else {
                                                 ?>
                                                <div class="table-responsive">
                                                    <form action="diemDanh.php?sh_id=<?php echo $sh_id ?>" method="POST" enctype="multipart/form-data">
                                                    <table class="table col-sm-12 ">
                                                        <thead>
                                                        
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Tên thành viên</th>
                                                                <th>MSSV</th>
                                                                <th>Phone</th>
                                                                <th>Có mặt</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                            $len = gettype($listDaDiemDanh) == 'array'? sizeof($listDaDiemDanh) : 0;
                                                            for($i = 0; $i < $len; $i++) {
                                                                $mem = $memberScoreModel->get_students_by_id($listDaDiemDanh[$i][2]);
                                                        ?>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row"><?php echo $i + 1; ?></th>
                                                                <td><?php echo $mem[0][1]?></td>
                                                                
                                                                <td><?php echo $mem[0][3]?></td>
                                                                
                                                                <td><?php echo $mem[0][2]?></td>
                                                                
                                                                <td>
                                                                    <?php 
                                                                        if($listDaDiemDanh[$i][1] == 1) {
                                                                     ?>
                                                                    <input type="checkbox" name="student_id[]" value="<?php echo $listDaDiemDanh[$i][2]?>" checked>

                                                                    <?php 
                                                                        } else {
                                                                     ?>
                                                                        <input type="checkbox" name="student_id[]" value="<?php echo $listDaDiemDanh[$i][2]?>"  >

                                                                     <?php 
                                                                        }
                                                                      ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <input type="hidden" name="sinhhoat_id" value="<?php echo $sh_id?>">
                                                    <button class="btn btn-primary waves-effect waves-light">Submit</button>
                                                    <button type="reset" class="btn btn-secondary waves-effect ml-1">
                                                                
                                                                    <a href="listSinhHoat.php" style="color:white">Trở về</a>
                                                                
                                                    </button>       
                                                    </form>
                                                </div>
                                                 <?php 
                                                    }
                                                  ?>
                                            </div>

                                        </div>
            <!-- end page title -->
        </div>
    </div>
</div>
<?php include './inc/footer.php';?>