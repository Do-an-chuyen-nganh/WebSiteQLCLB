<?php include './inc/header.php';?>
<?php include './inc/leftsidemenu.php';?>
<?php include  '../models/DiemDanhModel.php'?>
<?php include_once '../helper/format.php';?>


<?php
    
    $month = date('m');
    
    $diemDanhModel = new DiemDanhModel();

    $listAbsentMember = $diemDanhModel->count_student_absent(1);
    if(isset($_GET['month'])){
        $month = $_GET['month'];
    }

    $listAbsentMember = $diemDanhModel->count_student_absent($month);


	
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
                                <li class="breadcrumb-item active">Danh sách thành viên vắng</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Danh sách thành viên vắng</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="demo-box">
                                                <div class="dropdown show">
                                                      <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Chọn tháng
                                                      </a>

                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <?php 
                                                            for($i = 1; $i < 13; $i ++) {
                                                         ?>
                                                        <a class="dropdown-item" href="?month=<?php echo $i ?>">Tháng <?php echo $i ?></a>
                                                        <?php 
                                                            }
                                                         ?>
                                                      </div>
                                                    </div>
                                                <div class="table-responsive">
                                                    
                                                    <table class="table col-sm-12 ">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Tên thành viên</th>
                                                                <th>MSSV</th>
                                                                <th>Số buổi vắng</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                            $len = gettype($listAbsentMember) == 'array'? sizeof($listAbsentMember) : 0;
                                                            for($i = 0; $i < $len; $i++) {
                                                        ?>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row"><?php echo $i + 1; ?></th>
                                                                <td><?php echo $listAbsentMember[$i][1]?></td>
                                                                <td><?php echo $listAbsentMember[$i][2]?></td>
                                                                <td><?php echo $listAbsentMember[$i][3]?></td>
                                                                
                                                            </tr>
                                                            <?php
						                                        }
						                                    ?>
                                                        </tbody>
                                                    </table>
                                                    <button type="reset" class="btn btn-secondary waves-effect ml-1">
                                                                
                                                                    <a href="listSinhHoat.php" style="color:white">Trở về</a>
                                                                
                                                    </button>  
                                                
                                                </div>
                                            </div>

                                        </div>
            <!-- end page title -->
        </div>
    </div>
</div>
<?php include './inc/footer.php';?>