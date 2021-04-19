<?php
include './inc/header.php';
?>
<?php
include '../models/EventModel.php';
include_once '../helper/format.php';
include '../models/club.php';
include '../models/NewsModel.php';
include '../models/studentModel.php';
$clb_id = null;
$clb_student = null;
$event_id = null;
$st = new studentModel();
if (isset($_GET['clb_id'])) {
    $clb_id = $_GET['clb_id'];
}
if (isset($_SESSION['student'])) {
    $clb_student = $_SESSION['student'];
}
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $register = $st->insertMemberEventClub($clb_student[0][0],$_POST,$event_id);
}
$clb = new club();
$fm = new format();
$event = new EventModel();
$news = new NewsModel();
?>
<main>
    <div class="container">
    </div><!-- /.container -->
    <!-- slider Area End-->
    <!--? Blog Area Start-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0" style="background-color: antiquewhite;padding-bottom: 20px;">
                <h2 class="text-center" style="margin-top: 20px;">Đăng Ký Tham Gia Event Câu Lạc Bộ</h2>
            <?php
            if (isset($register)) {
                echo $register;
            }
            ?>
            <form class="register-clb" id="register-clb" method="POST" action="?event_id=<?php echo $event_id?>">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="text-uppercase">Gmail</label>
                    <input type="text" class="form-control" name="gmail" placeholder="Gmail" value="<?php echo $clb_student[0][4]?>" required>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="text-uppercase">Họ Và Tên</label>
                    <input type="text" class="form-control" name="fullName" placeholder="Họ và tên" value="<?php echo $clb_student[0][1]?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="text-uppercase">Mã Số Sinh Viên</label>
                    <input type="text" class="form-control" name="studentCode" placeholder="Mã số sinh viên" value="<?php echo $clb_student[0][3]?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="text-uppercase">Năm Sinh</label>
                    <input type="date" class="form-control" name="age" placeholder="" value="<?php echo $clb_student[0][6]?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="text-uppercase">Số Điện Thoại</label>
                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại"value="<?php echo $clb_student[0][2]?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="text-uppercase">Lý Do</label>
                    <textarea class="form-control" rows="4" name="reason" cols="50" placeholder="Mong muốn" required></textarea>
                </div>
                <div class="form-check">
                    <button type="submit" class="btn btn-login float-right">Đăng Ký</button>
                </div>

            </form>
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

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Area End -->
</main>

<?php include './inc/footer.php'; ?>