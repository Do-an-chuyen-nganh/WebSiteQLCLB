<?php
include './inc/header.php';
include '../models/EventModel.php';
include '../models/NewsModel.php';
include_once '../helper/format.php';
include '../models/club.php';
$clb = new club();
$fm = new format();
$event = new EventModel();
$news = new NewsModel();
$event_id = null;
$result = null;
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];
    $result = $event->show_event_byId($event_id);
}
if (isset($_GET['news_id'])) {
  $event_id = $_GET['news_id'];
  $result = $news->show_news_byId($event_id);
}

?>
    <!--? Blog Area Start-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
            <div class="col-lg-8 posts-list">
              <div class="single-post">
                <div class="feature-img">
                  <img class="img" src="../uploads/<?php echo $result[0][4] ?>"
                    alt="" width="770" height="404">
                </div>
                <div class="blog_details">
                  <h2 style="color: #2d2d2d;"><?php echo $result[0][1] ?>
                  </h2>
                  <?php echo $result[0][2] ?>
                  <ul class="blog-info-link mt-3 mb-4">
                    <li><a href="#"><i class="fas fa-clock"></i><?php echo $result[0][3] ?> </a></li>
                    <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                  </ul>
                  <p class="excert">
                  <?php echo $result[0][6] ?>
                  </p>

                  <p>
                  <?php echo $result[0][5] ?>
                  </p>
                </div>
              </div>
              
            </div>
                <?php include './inc/rightmenu.php'; ?>
            </div>
        </div>
    </section>
    <!-- Blog Area End -->
<?php include './inc/footer.php'; ?>