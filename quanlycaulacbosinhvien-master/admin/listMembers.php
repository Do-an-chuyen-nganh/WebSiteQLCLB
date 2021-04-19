<?php
include 'inc/header.php';
include 'inc/leftsidemenu.php';
include '../lib/database.php';
include '../helper/format.php';
?>
<?php include '../models/studentModel.php'; ?>
<?php

$array = null;
$id = null;
$st = new studentModel();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $del_event = $st->deleteMemberClub($id);
}
$clb_id = Session::get('clb_id');
$array = $st->getMemberClub($clb_id);
?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li classs="breadcrumb-item"><a href="javascript: void(0);">Zircos</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Danh sách thành viên</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Danh sách thành viên</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="demo-box">
                                    <a class="btn btn-primary mb-2" download="somedata.xlsx" href="#" onclick="return ExcellentExport.convert({ anchor: this, filename: 'Danh sách thành viên', format: 'xlsx'},[{name: 'Danh sách thành viên', from: {table: 'list-members'}}]);">Export to Excel</a>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Tìm kiếm thành viên">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="submit">Tìm kiếm</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-success col-sm-12 col-md-12" id="listMember">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tên</th>
                                                    <th scope="col">Mã SV</th>
                                                    <th scope="col">SDT</th>
                                                    <th scope="col">Gmail</th>
                                                    <th scope="col">Tuổi</th>
                                                    <th scope="col">Lý do</th>
                                                    <th scope="col"> Ngay</th>
                                                    <th scope="col"> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($array != null)
                                                    for ($i = 0; $i < sizeof($array); $i++) {
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i ?></th>
                                                        <td><?php echo $array[$i][1] ?></td>
                                                        <th><?php echo $array[$i][3] ?></th>
                                                        <td><?php echo $array[$i][2] ?></td>
                                                        <td><?php echo $array[$i][4] ?></td>
                                                        <td><?php echo $array[$i][5] ?></td>
                                                        <td><?php echo $array[$i][6] ?></td>
                                                        <td><?php echo $array[$i][7] ?></td>
                                                        <td>
                                                            <a onclick="return confirm('Bạn có muốn xoá danh mục này không?')" href="?id=<?php echo $array[$i][0] ?>" style="color:red">
                                                                <i class="far fa-thumbs-down"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        <!-- bảng này để lấy dữ liệu xuất file excel, đừng xóa -->
                                        <table class="table table-success col-sm-12 col-md-12" style="display: none;" id="list-members">

                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Tên</th>
                                                <th scope="col">Mã SV</th>
                                                <th scope="col">SDT</th>
                                                <th scope="col">Gmail</th>
                                                <th scope="col">Tuổi</th>
                                                <th scope="col">Lý do</th>
                                                <th scope="col"> Ngay</th>
                                                <th scope="col"> </th>
                                            </tr>

                                            <?php
                                            if ($array != null)
                                                for ($i = 0; $i < sizeof($array); $i++) {
                                            ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i ?></th>
                                                    <td><?php echo $array[$i][1] ?></td>
                                                    <th><?php echo $array[$i][3] ?></th>
                                                    <td><?php echo $array[$i][2] ?></td>
                                                    <td><?php echo $array[$i][4] ?></td>
                                                    <td><?php echo $array[$i][5] ?></td>
                                                    <td><?php echo $array[$i][6] ?></td>
                                                    <td><?php echo $array[$i][7] ?></td>
                                                </tr>
                                            <?php
                                                }
                                            ?>

                                        </table>
                                        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/excellentexport@3.4.3/dist/excellentexport.min.js"></script>
                                        <a class="btn btn-primary" download="somedata.xlsx" href="#" onclick="return ExcellentExport.convert({ anchor: this, filename: 'Danh sách thành viên', format: 'xlsx'},[{name: 'Danh sách thành viên', from: {table: 'list-members'}}]);">Export to Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#listMember tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<?php include 'inc/footer.php'; ?>