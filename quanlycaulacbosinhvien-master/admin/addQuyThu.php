<?php include './inc/header.php';?>
<?php include './inc/leftsidemenu.php';?>
<?php include '../models/club.php';?>
<?php include '../models/category.php';?>
<?php
    $clb = new club();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $insertClb  = $clb->insert_club($_POST, $_FILES);
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
                                <li class="breadcrumb-item active">Quản lý câu lạc bộ</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Thêm câu lạc bộ</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                            <div class="col-md-10">
                                <div class="card-box">
                                <?php
                                    if(isset($insertClb)){
                                        echo $insertClb;
                                    }
                                ?>    
                                    <form id="basic-form" action="clbAdd.php" method="POST" enctype="multipart/form-data">
                                        <div>
                                            <h3></h3>
                                            <section>
                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label " for="clbName">Tên câu lạc bộ *</label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control required" name="clbName" type="text" placeholder="Thêm câu lạc bộ..." />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label " for="quantity">Số lượng</label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control required" name="quantity" type="number">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label " for="content">Nội dung</label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control required" name="content" type="text">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label " for="image">Ảnh</label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control required" name="image" data-height="300" type="file" />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="startDay">Ngày Thu</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" name="startDay" type="datetime-local" value="<?php echo date('Y-m-d\TH:i', strtotime($eventList[0][5])); ?>" required>
                                                </div>
                                            </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label " for="category">Danh mục</label>
                                                    <div class="col-lg-10">
                                                        <select class="browser-default custom-select" id="select" name="category">
                                                            <option>------Chọn danh mục------</option>
                                                            <?php
                                                                $cat = new category();
                                                                $catlist = $cat->show_category();
                                                                if($catlist){
                                                                    while($result = $catlist->fetch_assoc()){
                                                            ?>
                                                                <option value="<?php echo $result['catId']?>"><?php echo $result['catName']?></option>
                                                            <?php
                                                            }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                        <div class="col-sm-8 offset-sm-9">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                                Thêm
                                                            </button>
                                                            <button type="reset" class="btn btn-secondary waves-effect ml-1">
                                                                <a href="clbList.php" style="color:white">Trở về</a>
                                                            </button>
                                                        </div>
                                                    </div>
                                            </section>
                        
                                        </div>
                                    </form>

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