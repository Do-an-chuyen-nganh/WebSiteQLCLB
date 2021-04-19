<?php include './inc/header.php';?>
<?php include './inc/leftsidemenu.php';?>
<?php include '../models/category.php';?>
<?php
    $cat = new category();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catName    = $_POST['catName'];
        $insertCat  = $cat->insert_category($catName);
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
                        <h4 class="page-title">Thêm danh mục</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                <?php
                                    if(isset($insertCat)){
                                        echo $insertCat;
                                    }
                                ?>
                                    <form id="basic-form" action="catAdd.php" method="POST" enctype="multipart/form-data">
                                        <div>
                                            <h3></h3>
                                            <section>
                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label " for="catName">Tên danh mục </label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control required" name="catName" type="text" placeholder="Thêm danh mục...">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                        <div class="col-sm-8 offset-sm-9">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                                Thêm
                                                            </button>
                                                            <button type="reset" class="btn btn-secondary waves-effect ml-1">
                                                                <a href="catList.php" style="color:white">Trở về</a>
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