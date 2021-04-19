<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/EventModel.php'; ?>
<?php include '../models/category.php'; ?>
<?php
$event = new EventModel();
$event_id = null;
$type = null;
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_GET['event_id'])) {
    $insertClb = $event->insert_event($_POST, $type, Session::get('clb_id'));
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['event_id'])) {
    $insertClb = $event->edit_event($_POST);
}
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
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
            if ($event_id != null) {
                $eventList = $event->show_event_byId($event_id);
                if ($eventList != null) {
            ?>
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-10">
                            <div class="page-title-box">
                                <h4 class="page-title">Chỉnh sửa sự kiện</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card-box">

                                <form id="basic-form" action="eventForm.php?type=<?php echo $type ?>&event_id=<?php echo $event_id ?>" method="POST" enctype="multipart/form-data">
                                    <div>
                                        <h3></h3>
                                        <section>
                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="nameEvent">Tên sự kiện</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" name="event_id" type="text" value="<?php echo $event_id ?>" hidden />
                                                    <input class="form-control" name="nameEvent" type="text" placeholder="Tên sự kiện..." required value="<?php echo $eventList[0][1] ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="title">Tiêu đề nội dung</label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" name="title" rows="4" cols="50" placeholder="Tiêu đề nội dung"><?php echo $eventList[0][2] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="short_content">Nội dung ngắn</label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" name="short_content" rows="4" cols="50" placeholder="Nội dung ngắn"><?php echo $eventList[0][3] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="content">Nội dung</label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" name="content" rows="4" cols="50" placeholder="Nội dung sự kiện"><?php echo $eventList[0][4] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="startDay">Ngày bắt đầu</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" name="startDay" type="datetime-local" value="<?php echo date('Y-m-d\TH:i', strtotime($eventList[0][5])); ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="endDay">Ngày kết thúc</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" name="endDay" type="datetime-local" value="<?php echo date('Y-m-d\TH:i', strtotime($eventList[0][6])) ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="place">Địa điểm</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" name="place" type="text" placeholder="Địa điểm" value="<?php echo $eventList[0][7] ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="request">Yêu Cầu</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" name="request" type="text" placeholder="Yêu Cầu" value="<?php echo $eventList[0][8] ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 control-label " for="image">Ảnh</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control required" name="image" data-height="300" type="file" src="../uploads/<?php echo $eventList[0][9] ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-8 offset-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Chỉnh sửa
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect ml-1">
                                                        <?php
                                                        if ($type == 1) {
                                                        ?>
                                                            <a href="event.php" style="color:white">Trở về</a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a href="eventCLB.php" style="color:white">Trở về</a>
                                                        <?php
                                                        }
                                                        ?>
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
                                        <h4 class="page-title">Thêm sự kiện</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="card-box">
                                        <form id="basic-form" action="eventForm.php?type=<?php echo $type ?>" method="POST" enctype="multipart/form-data">
                                            <div>
                                                <h3></h3>
                                                <section>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="nameEvent">Tên sự kiện</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="nameEvent" type="text" placeholder="Tên sự kiện..." required />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="title">Tiêu đề nội dung</label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" name="title" rows="4" cols="50" placeholder="Tiêu đề nội dung"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="short_content">Nội dung ngắn</label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" name="short_content" rows="4" cols="50" placeholder="Nội dung ngắn"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="content">Nội dung</label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" name="content" rows="4" cols="50" placeholder="Nội dung sự kiện"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="startDay">Ngày bắt đầu</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" id="startDay" name="startDay" type="datetime-local" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="endDay">Ngày kết thúc</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" id="endDay"  name="endDay" type="datetime-local">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="place">Địa điểm</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="place" type="text" placeholder="Địa điểm" required />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="request">Yêu Cầu</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="request" type="text" placeholder="Yêu Cầu" required />
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
                                                            <button type="reset" class="btn btn-secondary waves-effect ml-1">
                                                                <?php
                                                                if ($type == 1) {
                                                                ?>
                                                                    <a href="event.php" style="color:white">Trở về</a>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <a href="eventCLB.php" style="color:white">Trở về</a>
                                                                <?php
                                                                }
                                                                ?>
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
                    <script>
                        CKEDITOR.replace('content');
                        CKEDITOR.replace('title');
                        CKEDITOR.replace('short_content');
                    </script>
                    <!-- End content-page -->
                    <script type="text/javascript">
                    
                        $(document).ready(function() {
                            $("#basic-form").validate({
                                onfocusout: false,
                                onkeyup: false,
                                onclick: false,
                                rules: {
                                    "endDay": {
                                        required: true,
                                        greaterThan : "#startDay"
                                    },
                                    "startDay": {
                                        required: true,
                                        
                                    },
                                    "nameEvent": {
                                        required: true,
                                    }
                                    ,
                                    "title": {
                                        required: true,
                                    }
                                    ,
                                    "short_content": {
                                        required: true,
                                    }
                                    ,
                                    "content": {
                                        required: true,
                                    }
                                    ,
                                    "place": {
                                        required: true,
                                    }
                                    ,
                                    "request": {
                                        required: true,
                                    }
                                },
                                messages: {
                                    "endDay": {
                                        required: "ngày kết thúc không được để trống !",
                                    },
                                    "startDay": {
                                        required: "ngày bắt đầu không được để trống !",
                                    }
                                    ,
                                    "request": {
                                        required: "yêu cầu không được để trống !",
                                    }
                                    ,
                                    "content": {
                                        required: "mô tả không được để trống !",
                                    }
                                    ,
                                    "short_content": {
                                        required: "mô tả ngắn không được để trống !",
                                    }
                                    ,
                                    "title": {
                                        required: "tiêu đề không được để trống !",
                                    }
                                    ,
                                    "nameEvent": {
                                        required: "Tên sự kiện không được để trống !",
                                    }
                                    ,
                                    "place": {
                                        required: "Địa điểm không được để trống !",
                                    }
                                }
                            });
                            $.validator.addMethod("greaterThan",
                                function(value, element, params) {
                                    if (!/Invalid|NaN/.test(new Date(value))) {
                                        return new Date(value) > new Date($(params).val());
                                    }
                                    return isNaN(value) && isNaN($(params).val()) ||
                                        (Number(value) > Number($(params).val()));
                                }, 'Ngày kết thúc phải lớn hơn ngày tạo.');
                        });
                    </script>
                    <?php include './inc/footer.php'; ?>
