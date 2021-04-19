<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/NewsModel.php'; ?>
<?php include '../models/category.php'; ?>
<?php
$news = new NewsModel();
$news_id = null;
$type = null;
$newsList = null;
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_GET['news_id'])) {
    $insertnews = $news->insert_news($_POST,$type);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['news_id'])) {
    $insertnews = $news->edit_news($_POST);
}
if (isset($_GET['news_id'])) {
    $news_id = $_GET['news_id'];
    $newsList = $news->show_news_byId($news_id);
}

?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <?php
            if (isset($insertnews)) {
                echo $insertnews;
            }
            if ($news_id != null) {
                  $newslist = $news->show_news_byId($news_id);
                if ($newslist != null) {  
            ?>
                <!-- start page title -->
                <div class="row">
                    <div class="col-10">
                        <div class="page-title-box">
                            <h4 class="page-title">Chỉnh sửa Tin Tức</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="card-box">

                            <form id="basic-form" action="NewsForm.php?news_id=<?php echo $news_id ?>&type=<?php echo $type ?>" method="POST" enctype="multipart/form-data">
                                <div>
                                    <h3></h3>
                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="nameNews">Tên Tin Tức</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" name="news_id" type="text" value="<?php echo $news_id ?>" hidden />
                                                <input class="form-control" name="nameNews" type="text" placeholder="Tên Tin Tức..." required value="<?php echo $newsList[0][1] ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="tieude">Tiêu đề nội dung</label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control" name="tieude" rows="4" cols="50" placeholder="Tiêu đề nội dung"><?php echo $newsList[0][6] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="short_content">Nội dung ngắn</label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control" name="short_content" rows="4" cols="50" placeholder="Nội dung ngắn"><?php echo $newsList[0][2] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="newsContens">Nội dung</label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control" name="newsContens" rows="4" cols="50" placeholder="Nội dung Tin Tức"><?php echo $newsList[0][5] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="image">Ảnh</label>
                                            <div class="col-lg-10">
                                                <input class="form-control required" name="image" data-height="300" type="file" value="../uploads/<?php echo $newsList[0][4] ?>" />
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
                                                        <a href="Newslist.php" style="color:white">Trở về</a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="Newslist.php" style="color:white">Trở về</a>
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
                                        <h4 class="page-title">Thêm tin tuc</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="card-box">
                                        <form id="basic-form" action="NewsForm.php?type=<?php echo $type ?>" method="POST" enctype="multipart/form-data">
                                            <div>
                                                <h3></h3>
                                                <section>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 control-label " for="nameNews">Tên Tin Tức</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="nameNews" type="text" placeholder="Tên Tin Tức..." required />
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
                                                        <label class="col-lg-2 control-label " for="newsContent">Nội dung</label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" name="newsContents" rows="4" cols="50" placeholder="Nội dung Tin Tức"></textarea>
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
                                                                <a href="Newslist.php" style="color:white">Trở về</a>
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
                    CKEDITOR.replace('tieude');
                    CKEDITOR.replace('newsContens');
                    CKEDITOR.replace('short_content');
                </script>
                <!-- End content-page test push github-->
                <?php include './inc/footer.php'; ?>