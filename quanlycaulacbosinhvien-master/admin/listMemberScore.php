<?php include './inc/header.php';?>
<?php include './inc/leftsidemenu.php';?>
<?php include '../models/club.php';?>
<?php include '../models/category.php';?>
<?php include '../models/MemberScoreModel.php'; ?>
<?php include_once '../helper/format.php';?>

<?php
    $clb = new club();
    $fm = new format();
    $memberScoreModel = new MemberScoreModel();

    


	if(isset ($_GET['delId'])){
		$id = $_GET['delId'];
		$delClb = $memberScoreModel->del_member_score($id);
    }
    $memberScore = $memberScoreModel->show_memberscore(Session::get('clb_id'));
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
                                                <a href="memberScoreForm.php">
                                                    <i class="fas fa-plus-square" style="color:green"> Thêm phiếu điểm</i>
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
                                                                <th>Tên thành viên</th>
                                                                <th>Tên câu lạc bộ</th>
                                                                <th>Tổng điểm</th>
                                                                <th>Ngày lập</th>
                                                                <th>Ngày chỉnh sửa</th>
                                                                <th>Feedback</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                            $len = gettype($memberScore) == 'array'? sizeof($memberScore) : 0;
                                                            for($i = 0; $i < $len; $i++) {
                                                                $member = $memberScoreModel->get_students_by_id($memberScore[$i][6]);

                                                                $club = $clb->get_club_by_id($memberScore[$i][5]);
                                                        ?>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row"><?php echo $i + 1; ?></th>
                                                                <td><?php echo $member[0][1]?></td>
                                                                <td><?php echo $club[0][1]?></td>
                                                                <td><?php echo $memberScore[$i][1]?></td>
                                                                
                                                                <td><?php echo $memberScore[$i][2]?></td>
                                                                <td><?php echo $memberScore[$i][3]?></td>
                                                                <td><?php echo $memberScore[$i][4]?></td>
                                                                <td>
                                                                <a href="memberScoreForm.php?memberScore_id=<?php echo $memberScore[$i][0]?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a> |
                                                                <a onclick="return confirm('Bạn có muốn xoá danh mục này không?')" href="?delId=<?php echo $memberScore[$i][0] ?>">
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