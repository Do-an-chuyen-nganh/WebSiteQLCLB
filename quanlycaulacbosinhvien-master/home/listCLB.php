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
$show_club = $clb->show_club();
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
                    <div class="blog_left_sidebar">
                        <?php
                        $show_club = $clb->show_club();
                        if ($show_club) {
                            $i = 0;
                            while ($result = $show_club->fetch_assoc()) {
                                $i++;
                        ?>
                                <article class="blog_item">
                                    <div class="blog_item_img">
                                        <img class="card-img rounded-0" src="../uploads/<?php echo $result['img'] ?>" alt="">
                                        <a href="#" class="blog_item_date">
                                            <h3><?php echo date('d-m-Y', strtotime($result['create_at'])) ?></h3>
                                        </a>
                                    </div>
                                    <div class="blog_details">
                                        <a class="d-inline-block" href="news_clb.php?clb_id=<?php echo $result['clb_id'] ?>">
                                            <h2 class="blog-head" style="color: #2d2d2d;"><?php echo $result['clbName'] ?></h2>
                                        </a>                                       
                                        <ul class="blog-info-link">
                                            <li><?php echo $result['content'] ?></li>
                                        </ul>
                                    </div>
                                </article>
                            <?php
                            }
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