<?php include './inc/header.php';?>
<?php include './inc/leftsidemenu.php';?>
<?php include '../models/club.php';?>
<?php include '../models/AdminModel.php'; ?>
<?php include_once '../helper/format.php';?>
<?php
    $clb = new club();
    $adminModel = new AdminModel();

    //danh sách admin ngoại trừ thằng đang đăng nhập
    // $listAdmin = $adminModel->get_all_admin($_SESSION['adminId']);

    $listCLB = $clb->get_all_club();

	if(isset ($_GET['delId'])){
		$id = $_GET['delId'];
		$delClb = $adminModel->delete_admin($id);
    }
    $listAdmin = $adminModel->get_all_admin($_SESSION['adminId']);
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
                                <li class="breadcrumb-item active">Danh sách thành viên các câu lạc bộ</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Danh sách thành viên các câu lạc bộ</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="demo-box">
                                                <a href="adminForm.php">
                                                    <i class="fas fa-plus-square" style="color:green"> Thêm admin mới</i>
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
                                                                <th>Họ và tên</th>
                                                                <th>Gmail</th>
                                                                <th>Username</th>
                                                                <th>Level</th>
                                                                <th>Câu lạc bộ</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                            $len = gettype($listAdmin) == 'array'? sizeof($listAdmin) : 0;
                                                            for($i = 0; $i < $len; $i++) {
                                                        ?>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row"><?php echo $i + 1; ?></th>
                                                                <td><?php echo $listAdmin[$i][1]?></td>
                                                                <td><?php echo $listAdmin[$i][2]?></td>
                                                                <td><?php echo $listAdmin[$i][3]?></td>
                                                                <td><?php echo $listAdmin[$i][5]?></td>
                                                                <?php 
                                                                    $lenCLB = gettype($listCLB) == 'array' ? sizeof($listCLB) : 0;
                                                                    for($j = 0; $j < $lenCLB; $j++) {
                                                                        if($listCLB[$j][0] == $listAdmin[$i][6]) {
                                                                 ?>
                                                                <td><?php echo $listCLB[$j][1]; ?></td>

                                                                <?php 
                                                                        }
                                                                    }
                                                                  ?>

                                                                  <?php 
                                                                    if($listAdmin[$i][6] == 0) {

                                                                   ?>
                                                                   <td>Admin trưởng</td>
                                                                   <?php 
                                                                    }
                                                                    ?>
                                                                  <td>                                                        
                                                                <a href="adminForm.php?admin_id=<?php echo $listAdmin[$i][0]?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a> |
                                                                <a onclick="return confirm('Bạn có muốn xoá danh mục này không?')" href="?delId=<?php echo $listAdmin[$i][0] ?>">
                                                                    <i class="fas fa-trash-alt" style="color:red"></i>
                                                                </a>
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