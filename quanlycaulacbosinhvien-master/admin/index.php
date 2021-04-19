<?php include './inc/header.php';?>
<?php include './inc/leftsidemenu.php';?>
<?php include '../models/MemberScoreModel.php'; ?>
<?php include "../models/studentModel.php"; ?>
<?php include '../models/FinanceModel.php'; ?>
<?php include '../models/EventModel.php'; ?>
<?php 
    $memberScoreModel = new MemberScoreModel();

    $homeModel = new studentModel();

    $financeModel = new FinanceModel();

    $eventModel = new EventModel();

    // $name = array("Vương Triệu", "Tấn Trình", "Ðắc Trọng", "Khắc Trọng", "Quang Trọng", "Ngọc Trụ", "Quốc Trụ", "Ðình Trung");
    // for($i = 0; $i < 30; $i++) {
    //     $add["fullName"] = $name[rand(1, 7)];
    //     $add["phone"] = "09" . rand(12345021, 99999999);
    //     $add["studentCode"] = "CE" . rand(1000, 9999);
    //     $add["gmail"] = "nguyen" . rand(1230, 9999) . "@gmail.com";
    //     $add["password"] = "123";
    //     $add["age"] = rand(18, 22);

    //     $homeModel->register_student($add);
    // }
    $clb_id = $_SESSION['clb_id'];

    $numberOfMem = $memberScoreModel->count_mem_by_clbId($clb_id);
    $totalFinance = $financeModel->total_finance(Session::get('clb_id'));
    $numberOfEvent = $eventModel->count_all_event_by_type(2);

 ?>

<!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <h1>Chào mừng đến với trang quản trị</h1>
                    </div>
                    <!-- end container-fluid -->
                    <div class="row">
                        <div class="col-6">
                            
                                <canvas id="myChart" width="500" height="500" style="max-height: 500px; max-width: 600px;"></canvas>
                            <h3 style="margin-left: 5rem;">Tổng thành viên câu lạc bộ :<span><?php echo $numberOfMem[0][0] ?></span></h3>
                            
                        </div>
                        <div class="col-6">
                            <canvas id="myRadarChart" width="500" height="500" style="max-height: 500px; max-width: 600px;"></canvas>
                            <h3 style="margin-left: 5rem;">Tổng số quỹ còn lại :<span><?php echo number_format($totalFinance) ?>đ</span></h3>
                        </div>
                        <div class="col-6">
                            <canvas id="event_chart" width="500" height="500" style="max-height: 500px; max-width: 600px;"></canvas>
                            <h3 style="margin-left: 5rem;">Tổng số event :<span><?php echo $numberOfEvent[0][0] ?></span></h3>
                        </div>

                    </div>
                      
                      
                </div>
                <!-- end content -->

                

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                    
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
          

        </div>
         <script>
            //member chart
            var ctx = document.getElementById('myChart').getContext('2d');
            var data = [];
            <?php 
                for($i = 0; $i < 12; $i++) {

                    $memOfmonth =  $memberScoreModel->count_mem_by_month_year_clbId($clb_id, 2020, $i + 1)[0][0];
            
             ?>
                data[parseInt(<?php echo $i?>)] = parseInt(<?php echo $memOfmonth ?>);
             
            <?php 
                }
             ?>
            
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Số lượng tham gia qua mỗi tháng',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
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
        <script>
            //event chart
            var ctx = document.getElementById('event_chart').getContext('2d');
            var data = [];
            <?php 
                for($i = 0; $i < 12; $i++) {
                    $numOfEvent =  $eventModel->count_event_by_type_month_year(2,  $i + 1, 2021)[0][0] ? $eventModel->count_event_by_type_month_year(2,  $i + 1, 2021)[0][0] : 0;
            
             ?>
                data[parseInt(<?php echo $i?>)] = parseInt(<?php echo $numOfEvent ?>);
             
            <?php 
                }
             ?>
            
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Số lượng event mỗi tháng',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
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

        <script>
            //thu chi chart
            var ctxThuChi = document.getElementById('myRadarChart').getContext('2d');
            var thu = [];
            var chi = []
            <?php 
                for($i = 0; $i < 12; $i++) {
                    $thuMoiThang =  $financeModel->show_finance_receive_by_month_year($clb_id, $i + 1, 2021)[0][0] ? $financeModel->show_finance_receive_by_month_year($clb_id, $i + 1, 2021)[0][0] : 0;
                    $chiMoiThang =  $financeModel->show_finance_expense_by_month_year($clb_id, $i + 1, 2021)[0][0] ? $financeModel->show_finance_expense_by_month_year($clb_id, $i + 1, 2021)[0][0] : 0;
            
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
               
        <!-- END wrapper -->
<?php include './inc/footer.php';?>