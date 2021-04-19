<?php
include './inc/header.php';
include '../models/EventModel.php';
include_once '../helper/format.php';
include '../models/club.php';
$clb = new club();
$fm = new format();
$clb_student = null;
$event = new EventModel();
$event_id = null;
$result = null;
$checkDate = null;
if (isset($_GET['id'])) {
  $event_id = $_GET['id'];
  $result = $event->show_event_byId($event_id);
}
if (isset($_GET['news_id'])) {
  $event_id = $_GET['news_id'];
  $result = $event->show_event_byId($event_id);
}
if (isset($_SESSION['student'])) {
  $clb_student = $_SESSION['student'];
  $check = $event->checkRegisterEvent($clb_student[0][0],$event_id);
}
$curdate=strtotime(date('Y-m-d'));
$mydate=strtotime($result[0][6]);  
$checkDate = $event->checkDate($curdate,$mydate);
 
?>
<!--? Blog Area Start-->
<section class="blog_area section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 posts-list">
        <div class="single-post">
          <div class="feature-img">
            <img class="img" src="../uploads/<?php echo $result[0][11] ?>" alt="" width="770" height="404">
          </div>
          <div class="blog_details">
            <h2 style="color: #2d2d2d;"><?php echo $result[0][1] ?>
            </h2>
            <p>
              <?php echo $result[0][3] ?>
            </p>
            <ul class="blog-info-link mt-3 mb-4">
              <li><a href="#"><i class="fas fa-clock"></i><?php echo $result[0][5] ?> </a></li>
              <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
            </ul>
            <p class="excert">
              <?php echo $result[0][2] ?>
            </p>

            <p>
              <?php echo $result[0][4] ?>
            </p>
          </div>
          <?php
          if ($check == true && $checkDate == true) {
          ?>
            <aside class="single_sidebar_widget newsletter_widget">
              <?php
              if (isset($_SESSION['homeLogin'])) {
              ?>
                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" onclick="location.href='from-regsiter-event.php?event_id=<?php echo $result[0][0] ?>'" type="submit">Đăng ký tham gia ngay</button>
              <?php
              } else {
              ?>
                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" onclick="location.href='login.php'" type="submit">Đăng ký tham gia ngay</button>
              <?php
              }
              ?>
            </aside>
          <?php
          }
          ?>
        </div>

        <div class="comments-area">
          <h4>05 Comments</h4>
          <div class="comment-list">
            <div class="single-comment justify-content-between d-flex">
              <div class="user justify-content-between d-flex">
                <div class="thumb">
                  <img src="assets/img/blog/comment_1.png" alt="">
                </div>
                <div class="desc">
                  <p class="comment">
                    Multiply sea night grass fourth day sea lesser rule
                    open subdue female fill which them
                    Blessed, give fill lesser bearing multiply sea night
                    grass fourth day sea lesser
                  </p>
                  <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                      <h5>
                        <a href="#">Emilly Blunt</a>
                      </h5>
                      <p class="date">December 4, 2017 at 3:12 pm </p>
                    </div>
                    <div class="reply-btn">
                      <a href="#" class="btn-reply text-uppercase">reply</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="comment-list">
            <div class="single-comment justify-content-between d-flex">
              <div class="user justify-content-between d-flex">
                <div class="thumb">
                  <img src="assets/img/blog/comment_2.png" alt="">
                </div>
                <div class="desc">
                  <p class="comment">
                    Multiply sea night grass fourth day sea lesser rule
                    open subdue female fill which them
                    Blessed, give fill lesser bearing multiply sea night
                    grass fourth day sea lesser
                  </p>
                  <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                      <h5>
                        <a href="#">Emilly Blunt</a>
                      </h5>
                      <p class="date">December 4, 2017 at 3:12 pm </p>
                    </div>
                    <div class="reply-btn">
                      <a href="#" class="btn-reply text-uppercase">reply</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="comment-list">
            <div class="single-comment justify-content-between d-flex">
              <div class="user justify-content-between d-flex">
                <div class="thumb">
                  <img src="assets/img/blog/comment_3.png" alt="">
                </div>
                <div class="desc">
                  <p class="comment">
                    Multiply sea night grass fourth day sea lesser rule
                    open subdue female fill which them
                    Blessed, give fill lesser bearing multiply sea night
                    grass fourth day sea lesser
                  </p>
                  <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                      <h5>
                        <a href="#">Emilly Blunt</a>
                      </h5>
                      <p class="date">December 4, 2017 at 3:12 pm </p>
                    </div>
                    <div class="reply-btn">
                      <a href="#" class="btn-reply text-uppercase">reply</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="comment-form">
          <h4>Leave a Reply</h4>
          <form class="form-contact comment_form" action="#" id="commentForm">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                </div>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="button button-contactForm btn_1
                      boxed-btn">Post Comment</button>
            </div>
          </form>
        </div>
      </div>
      <?php include './inc/rightmenu.php'; ?>
    </div>
  </div>
</section>
<!-- Blog Area End -->
<?php include './inc/footer.php'; ?>