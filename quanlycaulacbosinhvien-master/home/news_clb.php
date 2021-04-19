<?php
include './inc/header.php';
?>
<?php
include '../models/EventModel.php';
include_once '../helper/format.php';
include '../models/club.php';
include '../models/NewsModel.php';
$clb_id = null;
$clb_student = null;
if (isset($_GET['clb_id'])) {
    $clb_id = $_GET['clb_id'];
}
if (isset($_SESSION['student'])) {
    $clb_student = $_SESSION['student'];
}
$clb = new club();
$fm = new format();
$event = new EventModel();
$news = new NewsModel();
$newsList = $event->show_event_by_clb($clb_id);
$clbDetail = $clb->getCLBById($clb_id)->fetch_all();
?>
<main>
    <div class="container">
    </div><!-- /.container -->
    <!-- slider Area End-->
    <!--? Blog Area Start-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <?php if($newsList != null){ ?>

                    <h2>Sự kiện <?php echo $clbDetail[0][1] ?></h2>
                    <div class="blog_left_sidebar">
                        <?php
                        for ($i = 0; $i < sizeof($newsList); $i++) {
                        ?>
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="../uploads/<?php echo $newsList[$i][11] ?>" alt="">
                                    <a href="#" class="blog_item_date">
                                        <h3><?php echo date('d-m-Y', strtotime($newsList[$i][5])) ?></h3>
                                    </a>
                                </div>
                                <div class="blog_details">
                                    <a class="d-inline-block" href="detail.php?id=<?php echo $newsList[$i][0] ?>">
                                        <h2 class="blog-head" style="color: #2d2d2d;"><?php echo $newsList[$i][1] ?></h2>
                                    </a>
                                    <?php echo $newsList[$i][2] ?>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="fas fa-clock"></i><?php echo $newsList[$i][5] ?></a></li>
                                        <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                    </ul>
                                </div>
                            </article>
                        <?php
                        }
                        ?>
                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Previous">
                                        <i class="ti-angle-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a href="?page=1" class="page-link">1</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Next">
                                        <i class="ti-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <?php } ?>
                </div>

                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Tìm kiếm' onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btns" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Tìm kiếm</button>
                            </form>
                        </aside>
                        <?php

                        ?>
                        <aside class="single_sidebar_widget newsletter_widget">
                            <?php
                            if (isset($_SESSION['homeLogin'])) {
                                if ($clb_student[0][7] == -1) {
                            ?>
                                    <h4 class="widget_title" style="color: #2d2d2d;"> Đăng ký tham gia câu lạc bộ</h4>
                                    <p><?php echo $clbDetail[0][4]?></p>
                                    <p>Bạn chưa gia nhập câu lạc bộ nào cả, bạn có muốn gia nhập <?php echo $clbDetail[0][1] ?> không ?</p>
                                    <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" onclick="location.href='form_register_club.php?clb_id=<?php echo $clb_id ?>'" type="submit">Đăng ký ngay</button>
                                <?php
                                }
                            } else {
                                ?>
                                <p><?php echo $clbDetail[0][4]?></p>
                                <h4 class="widget_title" style="color: #2d2d2d;"> Đăng ký tham gia câu lạc bộ</h4>
                                <p>Bạn chưa gia nhập câu lạc bộ nào cả, bạn có muốn gia nhập <?php echo $clbDetail[0][1] ?> không ?</p>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" onclick="location.href='login.php'" type="submit">Đăng ký ngay</button>
                            <?php
                            }
                            ?>
                        </aside>
                        <?php

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Area End -->
</main>

<?php include './inc/footer.php'; ?>