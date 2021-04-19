<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/AdminModel.php'; ?>
<?php include '../models/club.php'; ?>

<?php
$adminModel = new AdminModel();
$clubModel = new club();

$listCLB = $clubModel->get_all_club();

$admin_id = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_GET['admin_id'])) {
    $insertClb = $adminModel->insert_new_admin($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['admin_id'])) {
    $insertClb = $adminModel->edit_admin($_POST);
}
if (isset($_GET['admin_id'])) {
    $admin_id = $_GET['admin_id'];
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
            if ($admin_id != null) {
                $admin_edit = $adminModel->get_all_admin_by_id($admin_id);
                if ($admin_edit != null) {
            ?>
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-10">
                            <div class="page-title-box">
                                <h4 class="page-title">Chỉnh sửa thông tin admin</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card-box">

                                <form id="basic-form" action="?admin_id=<?php echo $admin_id ?>" method="POST">
                                    <div>
                                        <h3></h3>
                                        <section>
                                            <input type="hidden" name="admin_id" value="<?php echo $admin_id ?>">
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="totalScore">Họ và tên</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="adminName" type="text" placeholder="Họ và tên" value="<?php echo $admin_edit[0][1] ?>" required/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="totalScore">Username</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="adminUser" type="text" placeholder="Username" value="<?php echo $admin_edit[0][3] ?>" disabled />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="totalScore">Gmail</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="adminEmail" type="text" placeholder="Gmail" value="<?php echo $admin_edit[0][2] ?>" required/>
                                                        </div>
                                                    </div>

                                                      <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="namememberScore">Tên câu lạc bộ</label>
                                                        <div class="col-lg-10">
                                                             <select class="form-control" name="clb_id" aria-label="Default select example">
                                                              <option selected>Chọn câu lạc bộ</option>
                                                              <?php 
                                                                    for($i = 0; $i < count($listCLB); $i++){
                                                                        if($admin_edit[0][6] == $listCLB[$i][0]) {
                                                               ?>
                                                                    <option value="<?php echo $listCLB[$i][0] ?>" selected><?php echo $listCLB[$i][1] ?></option>
                                                               <?php 
                                                                        } else {
                                                                ?>
                                                                    <option value="<?php echo $listCLB[$i][0] ?>"><?php echo $listCLB[$i][1] ?></option>
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
                                                        Chỉnh sửa
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect ml-1">
                                                        
                                                            <a href="listAdmin.php" style="color:white">Trở về</a>
                                                        
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
                                        <h4 class="page-title">Thêm mới admin</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="card-box">
                                        <form action="" method="POST" id="form-register" enctype="multipart/form-data">
                                                <h3></h3>
                                                <section>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="totalScore">Họ và tên</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="adminName" type="text" placeholder="Họ và tên" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="totalScore">Gmail</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="adminEmail" type="text" placeholder="Gmail" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="totalScore">Username</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="adminUser" type="text" placeholder="Username" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="totalScore">Password</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" id="adminPass" name="adminPass" type="password" placeholder="Password" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="totalScore">Re-Password</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="re-password" type="password" placeholder="Re-Password" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="totalScore">Level</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="level" type="number" placeholder="Level" />
                                                        </div>
                                                    </div>

                                                     <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="namememberScore">Tên câu lạc bộ</label>
                                                        <div class="col-lg-10">
                                                             <select class="form-control" name="clb_id" aria-label="Default select example">
                                                              <option selected>Chọn câu lạc bộ</option>
                                                              <?php 
                                                                    for($i = 0; $i < count($listCLB); $i++){
                                                                       
                                                               ?>
                                                                    <option value="<?php echo $listCLB[$i][0] ?>"><?php echo $listCLB[$i][1] ?></option>
                                                               <?php 
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
                                                                
                                                                    <a href="listAdmin.php" style="color:white">Trở về</a>
                                                                
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
                    <!-- End content-page -->
                    <?php include './inc/footer.php'; ?>
<script>
    $().ready(function() {
        $("#form-register").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "adminEmail": {
                    required: true,
                    validateGmail :true
                },
                "adminPass": {
                    required: true,
                    validatePassword: true,
                    minlength: 8
                },
                "re-password": {
                    equalTo: "#adminPass",
                    minlength: 8
                },
                "adminName": {
                    required: true,
                    minlength: 8
                },
                "adminUser": {
                    required: true,
                    minlength: 8
                },
                "level": {
                    required: true
                }
            },
            messages: {
                "adminEmail": {
                    required: "Gmail không được để trống !",
                    maxlength: "Hãy nhập tối đa 15 ký tự"
                },
                "adminPass": {
                    required: "Mật Khẩu không được để trống !",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                },
                "re-password": {
                    equalTo: "Mật khẩu nhập lại không đúng !",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                },
                "adminName": {
                    required: "Họ và tên không được để trống !",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                },
                "adminUser": {
                    required: "Username không được để trống !",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                },
                "level": {
                    required: "Level không được để trống !"
                }
            }
        });
        $.validator.addMethod("validatePassword", function(value, element) {
            return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/i.test(value);
        }, "Hãy nhập password từ 8 đến 16 ký tự bao gồm chữ hoa, chữ thường và ít nhất một chữ số");
        $.validator.addMethod("validatePhone", function(value, element) {
            return this.optional(element) || /((09|03|07|08|05)+([0-9]{8})\b)/i.test(value);
        }, "Số điện thoại không hợp lệ !");
        $.validator.addMethod("validateGmail", function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(value);
        }, "Gmail không hợp lệ !");
    });
</script> 