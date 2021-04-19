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
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_GET['f_receive_id'])) {
    $insertClb = $event->insert_finance_receive($_POST, $type);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['f_receive_id'])) {
    $insertClb = $event->edit_finance_reivece($_POST);
}
if (isset($_GET['f_receive_id'])) {
    $event_id = $_GET['f_receive_id'];
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
                $fReceiveList = $event->show_finance_receive_byId($event_id);
                if ($fReceiveList != null) {
            ?>
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-10">
                            <div class="page-title-box">
                                <h4 class="page-title">Chỉnh Sửa Quỹ Thu</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card-box">
                            <form id="basic-form" action="FinanceReceiveForm.php?type=<?php echo $type ?>&f_receive_id=<?php echo $event_id ?>" method="POST" enctype="multipart/form-data">
                                            <div>
                                                <h3></h3>
                                                <section>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="tenKhoanthu">Tên khoản thu</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="f_receive_id" type="text" value="<?php echo $event_id?>" hidden />
                                                            <input class="form-control" name="tenKhoanthu" type="text" value="<?php echo $fReceiveList[0][1]?>" placeholder="Tên khoản thu..." required />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="title">Số tiền</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="clb_id" value="<?php echo $fReceiveList[0][4]?>" type="text" value="<?php echo $clb_id?>" hidden />
                                                            <input class="form-control" name="sotienthu" type="number" value="<?php echo $fReceiveList[0][2]?>" placeholder="Số tiền thu" required />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="ngayThu">Ngày thu</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="ngayThu" value="<?php echo date('Y-m-d\TH:i', strtotime($fReceiveList[0][3]));?>" type="datetime-local" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="endDay">Nội dung</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="noidung" value="<?php echo $fReceiveList[0][5]?>" placeholder="Nội dung" type="text" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="image">Ảnh</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control required" name="image" src="../uploads/<?php echo $fExpenseList[0][6] ?>" data-height="300" type="file" />
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
                                        <h4 class="page-title">Thêm Quỹ Thu</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="card-box">
                                        <form id="basic-form" action="FinanceReceiveForm.php?type=<?php echo $type ?>" method="POST" enctype="multipart/form-data">
                                            <div>
                                                <h3></h3>
                                                <section>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="tenKhoanthu">Tên khoản thu</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="tenKhoanthu" type="text" placeholder="Tên khoản thu..." required />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="title">Số tiền</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="clb_id" type="text" value="<?php echo $clb_id?>" hidden />
                                                            <input class="form-control" name="sotienthu" type="number" placeholder="Số tiền thu" required />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="ngayThu">Ngày thu</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="ngayThu" type="datetime-local" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="endDay">Nội dung</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="noidung" placeholder="Nội dung" type="text" required>
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