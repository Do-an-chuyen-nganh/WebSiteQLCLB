<?php include './inc/header.php';?>
<?php include './inc/leftsidemenu.php';?>
<?php include '../models/club.php';?>
<?php include '../models/category.php';?>
<?php include '../models/MemberScoreModel.php'; ?>
<?php include '../models/SinhHoatCLBModel.php'; ?>
<?php include_once '../helper/format.php';?>

<?php
    $clb = new club();
    $fm = new format();
    $memberScoreModel = new MemberScoreModel();
    $shModel = new SinhHoatCLBModel();

    $listSinhHoat = $shModel->get_sinh_hoat_by_status(-1,Session::get('clb_id'));


	if(isset ($_GET['delId'])){
		$id = $_GET['delId'];
		$delClb = $shModel->set_status($id, -1);
    }
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
                                <li class="breadcrumb-item active">Danh sách các buổi sinh hoạt</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Danh sách các buổi sinh hoạt</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="demo-box">
                                                <a href="sinhHoatForm.php">
                                                    <i class="fas fa-plus-square" style="color:green"> Thêm buổi sinh hoạt mới</i>
                                                </a> | 
                                                <a href="listAbsent.php">
                                                    <i class="fa fa-exclamation-triangle" style="color:red"> Danh sách thành viên vắng</i>
                                                </a>
                                                <div class="table-responsive">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                    <table class="table col-sm-12 ">
                                                        <thead>
                                                        <?php
                                                            if(isset($delClb)){
                                                                echo $delClb;
                                                            }
                                                        ?> 
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Tên buổi sinh hoạt</th>
                                                                <th>Nội dung</th>
                                                                <th>Thời gian</th>
                                                                <th>Tổng số lượng thành viên</th>
                                                                <th>Số lượng tham gia</th>
                                                                <th>Đã off chưa</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                            $len = gettype($listSinhHoat) == 'array'? sizeof($listSinhHoat) : 0;
                                                            for($i = 0; $i < $len; $i++) {
                                                        ?>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row"><?php echo $i + 1; ?></th>
                                                                <td><?php echo $listSinhHoat[0][1]?></td>
                                                                <td><?php
                                                                                echo $fm->textShorten($listSinhHoat[$i][2], 50);
                                                                                ?></td>
                                                                <td><?php echo $listSinhHoat[$i][3]?></td>
                                                                
                                                                <td><?php echo $listSinhHoat[$i][5]?></td>
                                                                <?php 
                                                                    if($listSinhHoat[$i][4] == null){
                                                                 ?>
                                                                    <td>Chưa điểm danh</td>
                                                                 <?php 
                                                                    } else {
                                                                  ?>
                                                                <td><?php echo $listSinhHoat[$i][4]?></td>
                                                                <?php 
                                                                    }
                                                                    if($listSinhHoat[$i][6] == '1') {
                                                                 ?>
                                                                    <td>Chưa off</td>
                                                                <?php 
                                                                    } else {
                                                                 ?>
                                                                    <td>Đã off</td>
                                                                 <?php 
                                                                    }
                                                                  ?>
                                                                <td>
                                                                <a href="sinhHoatForm.php?sinhhoat_id=<?php echo $listSinhHoat[$i][0]?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a> |
                                                                <a onclick="return confirm('Bạn có muốn xoá danh mục này không?')" href="?delId=<?php echo $listSinhHoat[$i][0] ?>">
                                                                    <i class="fas fa-trash-alt" style="color:red"></i>
                                                                </a> |
                                                                <a href="diemdanh.php?sh_id=<?php echo $listSinhHoat[$i][0]?>">Điểm danh</a>
                                                                </td>
                                                            </tr>
                                                            <?php
						                                        }
						                                    ?>
                                                        </tbody>
                                                    </table>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
            <!-- end page title -->
        </div>
    </div>
</div>
<?php include './inc/footer.php';?>