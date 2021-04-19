<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/club.php';?>
<?php include '../models/AdminModel.php';?>
<?php
$clb = new club();
$fm = new format();
$club = $clb->get_club_by_id(Session::get('clb_id'));
$name = Session::get('adminName');
$admin_id = Session::get('adminId');
$am = new AdminModel();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $change = $am->changePassword($_POST,$admin_id);
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
                        <h4 class="page-title">Thông tin cá nhân</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="demo-box">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Câu lạc bộ</label>
                                                <input type="text" class="form-control" disabled placeholder="<?php echo $club[0][1] ?>" value="" name="nameUni">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mô tả</label>
                                                <textarea class="form-control" cols="50" rows="5" disabled placeholder="<?php echo $club[0][4] ?>" value="" name="nameUni"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <h5>Thay đổi mật khẩu</h5>
                                    <?php
                                    if (isset($change)) {
                                        echo $change;
                                    }
                                    ?>
                                    <form class="register-form" id="form-register" method="POST">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Mật khẩu cũ</label>
                                                    <input type="password" id="password" name="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Mật khẩu mới</label>
                                                    <input type="password" id="new-password" name="new-password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nhập lại mật khẩu mới</label>
                                                    <input type="password" id="re-password" name="re-password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Thay đổi mật khẩu</button>
                                    
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-user">
                        <div class="image text-center">
                            <img src="./assets/images/face-0.jpg" alt="..." />
                        </div>
                        <div class="content">
                            <div class="author">
                                <a href="#">
                                    <h4 class="title text-center"><?php echo $name ?></h4>
                                </a>
                            </div>
                            <p class="description text-center"> "Cuộc sống là <br>
                                Your chick she so thirsty <br>
                                I'm in that two seat Lambo"
                            </p>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button href="#" class="btn btn-simple"><i class="fab fa-facebook-square"></i></button>
                            <button href="#" class="btn btn-simple"><i class="fab fa-twitter-square"></i></button>
                            <button href="#" class="btn btn-simple"><i class="fab fa-google-plus-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#form-register").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "password": {
                    required: true,
                },
                "new-password": {
                    required: true,
                    validatePassword: true,
                    minlength: 8
                },
                "re-password": {
                    equalTo: "#new-password",
                    minlength: 8
                }
            },
            messages: {
                "password": {
                    required: "Mật khẩu không được để trống !",
                },
                "new-password": {
                    required: "Mật Khẩu không được để trống !",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                },
                "re-password": {
                    equalTo: "Mật khẩu nhập lại không đúng !",
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
<?php include './inc/footer.php'; ?>

