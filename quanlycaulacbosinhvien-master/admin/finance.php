<?php include './inc/header.php'; ?>
<?php include './inc/leftsidemenu.php'; ?>
<?php include '../models/FinanceModel.php'; ?>
<?php include '../models/category.php'; ?>
<?php include_once '../helper/format.php'; ?>
<?php
$finance = new FinanceModel();
$fm = new format();
$result = null;
$result2 = null;
$clb_id = $_SESSION['clb_id'];
if (isset($_GET['f_receive_id'])) {
    $id = $_GET['f_receive_id'];
    $del_event = $finance->delete_finance_receive($id);
}
if (isset($_GET['f_expense_id'])) {
    $id = $_GET['f_expense_id'];
    $del_event = $finance->delete_finance_expense($id);
}
$result = $finance->show_finance_receive($clb_id );
$result2 = $finance->show_finance_expense($clb_id );
$total = $finance->total_finance(Session::get('clb_id'));

?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Quản lý Quỹ CLB</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">Quản Lý Thu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Quản Lý Chi</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane container active" id="home">
                            <div class="table-responsive">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <table class="table col-sm-12 ">
                                        <thead>
                                            <?php
                                            if (isset($del_event)) {
                                                echo $del_event;
                                            }
                                            ?>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên khoản thu</th>
                                                <th>Số tiền Thu</th>
                                                <th>Ngày Thu</th>
                                                <th>Ghi chú</th>
                                                <th style="max-width: 120px;"> <a href="FinanceReceiveForm.php?type=1">
                                                        <i class="fas fa-plus-square" style="color:green"> Thêm Khoản Thu</i>
                                                    </a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result != null) {
                                                for ($i = 0; $i < sizeof($result); $i++) {

                                            ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i + 1 ?></th>
                                                        <td><?php echo $result[$i][1] ?></td>
                                                        <td><?php echo number_format($result[$i][2]) ?>đ</td>
                                                        <td><?php echo $result[$i][3] ?></td>
                                                        <td style="max-width: 200px;">
                                                            <?php echo $result[$i][5] ?>
                                                        </td>
                                                        <td>
                                                            <a href="FinanceReceiveForm.php?type=2&f_receive_id=<?php echo $result[$i][0] ?>">
                                                                <i class="fas fa-edit"></i>
                                                            </a> |
                                                            <a onclick="return confirm('Bạn có muốn xoá danh mục này không?')" href="?f_receive_id=<?php echo $result[$i][0] ?>">
                                                                <i class="fas fa-trash-alt" style="color:red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu1">
                            <div class="table-responsive">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <table class="table col-sm-12 ">
                                        <thead>
                                            <?php
                                            if (isset($del_event)) {
                                                echo $del_event;
                                            }
                                            ?>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên khoản chi</th>
                                                <th>Số tiền chi</th>
                                                <th>Ngày chi</th>
                                                <th>Ghi chú</th>
                                                <th>Người chi</th>
                                                <th style="max-width: 100px;"> <a href="FinanceExpenseForm.php?type=1">
                                                        <i class="fas fa-plus-square" style="color:green"> Thêm Khoản Chi</i>
                                                    </a>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result2 != null) {
                                                for ($i = 0; $i < sizeof($result2); $i++) {

                                            ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i + 1 ?></th>
                                                        <td><?php echo $result2[$i][1] ?></td>
                                                        <td><?php echo number_format($result2[$i][2]) ?>đ</td>
                                                        <td><?php echo $result2[$i][3] ?></td>
                                                        <td style="max-width: 200px;">
                                                            <?php echo $result2[$i][5] ?>
                                                        </td>
                                                        <td><?php echo $result2[$i][6] ?></td>
                                                        <td>
                                                            <a href="FinanceExpenseForm.php?type=2&f_expense_id=<?php echo $result2[$i][0] ?>">
                                                                <i class="fas fa-edit"></i>
                                                            </a> |
                                                            <a onclick="return confirm('Bạn có muốn xoá danh mục này không?')" href="?f_expense_id=<?php echo $result2[$i][0] ?>">
                                                                <i class="fas fa-trash-alt" style="color:red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width:400px">
                        <div class="card-header">
                            <b>Tổng quỹ CLB</b> (<?php echo date("d/m/Y h:i:sa") ?>)
                        </div>
                        <div class="card-body">
                            <h2 class="card-text"><?php echo number_format($total) ?> đ</h2>
                            <div>
                                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                                <canvas id="myChart" width="400" height="400"></canvas>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
</div>
<script>
            //thu chi chart
            var ctxThuChi = document.getElementById('myChart').getContext('2d');
            var thu = [];
            var chi = []
            <?php 
                for($i = 0; $i < 12; $i++) {
                    $thuMoiThang =  $finance->show_finance_receive_by_month_year($clb_id, $i + 1, 2021)[0][0] ? $finance->show_finance_receive_by_month_year($clb_id, $i + 1, 2021)[0][0] : 0;
                    $chiMoiThang =  $finance->show_finance_expense_by_month_year($clb_id, $i + 1, 2021)[0][0] ? $finance->show_finance_expense_by_month_year($clb_id, $i + 1, 2021)[0][0] : 0;
            
             ?>
                thu[parseInt(<?php echo $i?>)] = parseInt(<?php echo $thuMoiThang ?>);
                chi[parseInt(<?php echo $i?>)] = parseInt(<?php echo $chiMoiThang ?>);
             
            <?php 
                }
             ?>
            
            var myChart = new Chart(ctxThuChi, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Tổng số quỹ thu mỗi tháng',
                        data: thu,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Tổng số quỹ chi mỗi tháng',
                        data: chi,
                        backgroundColor: [
                            'rgba(100, 99, 132, 0.2)',
                            
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    } 
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script> 
<?php include './inc/footer.php'; ?>