<?php include './inc/header.php';?>
<?php include './inc/leftsidemenu.php';?>
<?php include '../models/category.php';?>
<?php
	$cat = new category();
	if(isset ($_GET['delId'])){
		$id = $_GET['delId'];
		$deltCat = $cat->del_category($id);
    }
?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-10">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Zircos</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Danh sách danh mục</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Danh mục câu lạc bộ</h4>
                    </div>
                </div>
            </div>
        
            <div class="row">
                            <div class="col-sm-10">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="demo-box">
                                                <h4 class="header-title"> Danh sách </h4>
                                                <div class="table-responsive">
                                                    <form action="" method="POST">
                                                    <table class="table table-default col-sm-12">
                                                        <thead>
                                                        <?php
                                                            if(isset($delCat)){
                                                                echo $delCat;
                                                            }
                                                        ?> 
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Tên danh mục</th>
                                                                <th>Hành động</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                            $show_cate = $cat->show_category();
                                                            if($show_cate){
                                                                $i = 0;
                                                                while($result = $show_cate->fetch_assoc()){
                                                                    $i++;
                                                        ?>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row"><?php echo $i; ?></th>
                                                                <td><?php echo $result['catName']?></td>
                                                                <td>
                                                                    <a href="catEdit.php?catId=<?php echo $result['catId'] ?>">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a> |
                                                                    <a onclick="return confirm('Bạn có muốn xoá danh mục này không?')" href="?delId=<?php echo $result['catId'] ?>">
                                                                        <i class="fas fa-trash-alt" style="color:red"></i>
                                                                    </a> |
                                                                    <a href="catAdd.php">
                                                                        <i class="fas fa-plus-square" style="color:green"></i>
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
            <!-- end page title -->
        </div>
    </div>
</div>
<?php include './inc/footer.php';?>