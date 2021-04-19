<?php include './inc/header.php';?>
<?php include './inc/leftsidemenu.php';?>
<?php include '../models/club.php';?>
<?php include '../models/category.php';?>
<?php
    $clb = new club();
    if(!isset ($_GET['clbId']) || $_GET['clbId'] == NULL){
        echo "<script> window.location = 'clbList.php'</script>";
    }else{
        $id = $_GET['clbId'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $updateClb = $clb->update_club($_POST, $_FILES, $id);
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
                                <li class="breadcrumb-item active">Danh sách câu lạc bộ</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Chỉnh sửa câu lạc bộ</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                <?php
                                    if(isset($updateClb)){
                                    echo $updateClb;
                                }
                                ?>
                                <?php
                                    $get_clb_id = $clb->getClbById($id);
                                    if($get_clb_id){
                                        while($resultCLB = $get_clb_id->fetch_assoc()){
                                ?>
                                    <form id="basic-form" action="" method="POST">
                                        <div>
                                            <h3></h3>
                                            <section>
                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label " for="clbName">Tên câu lạc bộ </label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control required" value="<?php echo $resultCLB['clbName'] ?>" id="clbName" name="clbName" type="text">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label "> Số lượng </label>
                                                    <div class="col-lg-10">
                                                        <input type="number" class="form-control required" name="quantity" data-height="300" value="<?php echo $resultCLB['quantity'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label "> Nội dung </label>
                                                    <div class="col-lg-10">
                                                       <textarea name="content" class="form-control required"><?php echo $resultCLB['content'] ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label "> Hình ảnh </label>
                                                    <div class="col-lg-10">
                                                        <input type="file" class="form-control required" name="img" data-height="300" />
                                                        <img style="width:150px; margin-top:20px;" src="..uploads/<?php echo $resultCLB['img']?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label " for="content">Danh mục </label>
                                                    <div class="col-lg-10">
                                                    <select class="browser-default custom-select" id="select" name="category">
                                                            <option>------Chọn danh mục------</option>
                                                            <?php
                                                                $cat = new category();
                                                                $catlist = $cat->show_category();
                                                                if($catlist){
                                                                    while($result = $catlist->fetch_assoc()){
                                                            ?>
                                                            <option 
                                                            <?php
                                                                if($result['catId'] == $resultCLB['catId']){
                                                                    echo 'selected';
                                                                }
                                                            ?>
                                                            value="<?php echo $result['catId']?>"><?php echo $result['catName']?></option>
                                                            <?php
                                                            }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                        <div class="col-sm-10 offset-sm-9">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                                Cập nhật
                                                            </button>
                                                            <button type="reset" class="btn btn-secondary waves-effect ml-1">
                                                                <a href="clbList.php" style="color:white">Trở về</a>
                                                            </button>
                                                        </div>
                                                    </div>
                                            </section>
                        
                                        </div>
                                    </form>
                                    <?php
                                        }
                                    }
                                    ?>                
                                </div>
                            </div>
                        </div>

                        <!-- End row -->
        </div>
        <!-- End start page title -->
    </div>
    <!-- End content -->
</div>
<!-- End content-page -->
<?php include './inc/footer.php';?>