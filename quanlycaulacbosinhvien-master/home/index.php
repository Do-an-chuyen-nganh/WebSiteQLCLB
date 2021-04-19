<?php
include './inc/header.php';
?>
<?php 
include '../models/EventModel.php';
include_once '../helper/format.php';
include '../models/club.php';
include '../models/NewsModel.php';
$clb = new club();
$fm = new format();
$event = new EventModel();
$news = new NewsModel();
$newsList = $news->show_news();
?>
<main>
    <div class="container">
        <div class="carousel slide" id="main-carousel" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#main-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#main-carousel" data-slide-to="1"></li>
                <li data-target="#main-carousel" data-slide-to="2"></li>
            </ol><!-- /.carousel-indicators -->

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block img-fluid" src="assets/img/12.png" alt="">
                    <div class="carousel-caption d-none d-md-block">

                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block img-fluid" src="assets/img/ss4.png" alt="">
                    <div class="carousel-caption d-none d-md-block">


                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block img-fluid" src="assets/img/ss3.png" alt="">
                    <div class="carousel-caption d-none d-md-block">


                    </div>
                </div>
            </div><!-- /.carousel-inner -->

            <a href="#main-carousel" class="carousel-control-prev" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="sr-only" aria-hidden="true">Prev</span>
            </a>
            <a href="#main-carousel" class="carousel-control-next" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="sr-only" aria-hidden="true">Next</span>
            </a>
        </div><!-- /.carousel -->
    </div><!-- /.container -->
    <!-- slider Area End-->
    <!--? Blog Area Start-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <?php
                        for ($i = 0; $i < sizeof($newsList); $i++) {
                        ?>
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="../uploads/<?php echo $newsList[$i][6] ?>" alt="">
                                    <a href="#" class="blog_item_date">
                                        <h3><?php echo date('d-m-Y', strtotime($newsList[$i][5]))?></h3>
                                    </a>
                                </div>
                                <div class="blog_details">
                                    <a class="d-inline-block" href="detail_news.php?news_id=<?php echo $newsList[$i][0]?>">
                                        <h2 class="blog-head" style="color: #2d2d2d;"><?php echo $newsList[$i][1]?></h2>
                                    </a>
                                    <?php echo $newsList[$i][2]?>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="fas fa-clock"></i><?php echo $newsList[$i][5]?></a></li>
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
                </div>
                <?php include './inc/rightmenu.php'; ?>
            </div>
        </div>
    </section>
    <!-- Blog Area End -->
</main>

<?php include './inc/footer.php'; ?>