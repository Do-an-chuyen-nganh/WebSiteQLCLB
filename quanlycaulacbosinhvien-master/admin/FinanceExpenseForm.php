<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/FinanceModel.php'; ?>
<?php include '../models/category.php'; ?>
<?php
$event = new FinanceModel();
$event_id = null;
$type = null;
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_GET['f_expense_id'])) {
    $insertClb = $event->insert_finance_expense($_POST, $type);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['f_expense_id'])) {
    $insertClb = $event->edit_finance_expense($_POST);
}
if (isset($_GET['f_expense_id'])) {
    $event_id = $_GET['f_expense_id'];
}
$clb_id = Session::get('clb_id');

?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <?php
            if (isset($insertClb)) {
                echo $insertClb;
            }
            if ($event_id != null) {
                $fExpenseList = $event->show_finance_expense_byId($event_id);
                if ($fExpenseList != null) {
            ?>
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-10">
                            <div class="page-title-box">
                                <h4 class="page-title">Chỉnh sửa Quỹ Thu</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card-box">
                            <form id="basic-form" action="FinanceExpenseForm.php?type=<?php echo $type ?>&f_expense_id=<?php echo $event_id ?>" method="POST" enctype="multipart/form-data">
                            <div>
                                                <h3></h3>
                                                <section>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="tenKhoanChi">Tên khoản chi</label>
                                                        <div class="col-lg-10">
                                                        <input class="form-control" name="khoanChi_id" type="text" value="<?php echo $event_id?>" hidden />
                                                            <input class="form-control" name="tenKhoanChi" type="text" value="<?php echo $fExpenseList[0][0]?>" placeholder="Tên khoản chi..." required />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label" for="sotienchi">Số tiền</label>
                                                        <div class="col-lg-10">
                                                            
                                                            <input class="form-control" name="sotienchi" value="<?php echo $fExpenseList[0][1]?>" type="number" placeholder="Số tiền chi" required />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="ngayChi">Ngày chi</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="ngayChi" value="<?php echo date('Y-m-d\TH:i', strtotime($fExpenseList[0][3]));?>" type="datetime-local" required>
                                                            <input class="form-control" name="clb_id" type="text" value="<?php echo $clb_id?>" hidden />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="lydo">Lý do</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="lydo"  value="<?php echo $fExpenseList[0][4]?>" placeholder="Lý do" type="text" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="ten_nguoi_chi">Tên người chi</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="ten_nguoi_chi"  value="<?php echo $fExpenseList[0][5]?>" placeholder="Tên người chi" type="text" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="image">Ảnh</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control required"  name="image" src="../uploads/<?php echo $fExpenseList[0][6] ?>" data-height="300" type="file" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-8 offset-sm-9">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                                Chỉnh sửa
                                                            </button>
                                                            <button onclick="location.href='finance.php'" type="reset" class="btn btn-secondary waves-effect ml-1">
                                                                Trở lại
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
                                        <h4 class="page-title">Thêm Quỹ Chi</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="card-box">
                                        <form id="basic-form" action="FinanceExpenseForm.php?type=<?php echo $type ?>" method="POST" enctype="multipart/form-data">
                                            <div>
                                                <h3></h3>
                                                <section>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="tenKhoanChi">Tên khoản chi</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="tenKhoanChi" type="text" placeholder="Tên khoản chi..." required />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="sotienchi">Số tiền</label>
                                                        <div class="col-lg-10">
                                                            
                                                            <input class="form-control" name="sotienchi" type="number" placeholder="Số tiền chi" required />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="ngayChi">Ngày chi</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="ngayChi" type="datetime-local" required>
                                                            <input class="form-control" name="clb_id" type="text" value="<?php echo $clb_id?>" hidden />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="lydo">Lý do</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="lydo" placeholder="Lý do" type="text" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="ten_nguoi_chi">Tên người chi</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="ten_nguoi_chi" placeholder="Tên người chi" type="text" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="image">Ảnh</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control required" name="image" data-height="300" type="file" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-8 offset-sm-9">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                                Thêm
                                                            </button>
                                                            <button onclick="location.href='finance.php'" type="reset" class="btn btn-secondary waves-effect ml-1">
                                                                Trở lại
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