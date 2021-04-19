<?php
include './inc/header.php';
?>
<?php 
include '../models/EventModel.php';
include_once '../helper/format.php';
include '../models/club.php';
include '../models/NewsModel.php';
include '../models/MemberScoreModel.php';

$memberScoreModel = new MemberScoreModel();

$id = 0;
if(isset($_SESSION['student'])){
    $id = $_SESSION['student'][0][0];
}

if(isset($_POST['id_score']) && isset($_POST['feedback'])) {
    $memberScoreModel->feedback($_POST['feedback'], $_POST['id_score']);
}

$listScore = $memberScoreModel->show_memberscore_by_student_id($id);
?>
<main>
    <div class="container">
    </div><!-- /.container -->
    <!-- slider Area End-->
    <!--? Blog Area Start-->
    <section class="blog_area section-padding container">
        <table class="table">
          <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ngày nhập điểm</th>
                <th scope="col">Điểm</th>
                <th scope="col">Feedback</th>
                <th></th>
            </tr>
          </thead>
          <tbody>
            <?php 
                $len = gettype($listScore) == "array" ? count($listScore) : 0;
                for($i = 0; $i < $len; $i++){
             ?>
            <tr>
                <th scope="row"><?php echo $i + 1; ?></th>
                <td><?php echo $listScore[$i][2] ?></td>
                <td><?php echo $listScore[$i][1] ?></td>
                <?php 
                    if($listScore[$i][5] == null){
                ?>
                <form action="" method="POST">
                <td>
                    
                        <textarea class="form-control" name="feedback"  cols="50";  rows="3"  placeholder="Nhập feedback..." required></textarea>
                        <input type="hidden" name="id_score" value="<?php echo $listScore[$i][0] ?>"/>

                </td>
                <td>
                    <button data-toggle="modal" data-target="#exampleModal" class="btn-primary" style="border: 1px solid transparent;
                        padding: .375rem .75rem;
                        border-radius: .25rem;">Gửi</button>
                </td>

                <?php 
                    } else {
                 ?>
                <td><?php echo $listScore[$i][5] ?></td>

                <?php 
                    }
                 ?>
            </tr>

            <?php 
                }
             ?>
          </tbody>
        </table>
    </section>
    <!-- Blog Area End -->
</main>

<?php include './inc/footer.php'; ?>