<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-black-light sidebar-mini">
<div class="wrapper">

    <head>
        <!--BarGraph-->
        <script src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <!--BarGraph-->
    </head>

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                E-Undi Statistic
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <?php
                            $sql = "SELECT * FROM positions";
                            $query = $conn->query($sql);

                            echo "<h3>".$query->num_rows."</h3>";
                            ?>

                            <p>No. of Positions</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>
                        <a href="positions.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <?php
                            $sql = "SELECT * FROM candidates";
                            $query = $conn->query($sql);

                            echo "<h3>".$query->num_rows."</h3>";
                            ?>

                            <p>No. of Candidates</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-black-tie"></i>
                        </div>
                        <a href="candidates.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <?php
                            $sql = "SELECT * FROM voters";
                            $query = $conn->query($sql);

                            echo "<h3>".$query->num_rows."</h3>";
                            ?>

                            <p>Total Voters</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="voters.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <?php
                            $sql = "SELECT * FROM votes GROUP BY voters_id";
                            $query = $conn->query($sql);

                            echo "<h3>".$query->num_rows."</h3>";
                            ?>

                            <p>Voters Voted</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-edit"></i>
                        </div>
                        <a href="votes.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <!--PRINT-->
            <!--<div class="row">
                <div class="col-xs-12">
                    <h3>Votes Tally
                        <span class="pull-right">
              <a href="print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Print</a>
            </span>
                    </h3>
                </div>
            </div>-->

            <!--GRAPH BAR-->

            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="col" align="center">
                                <?php
                                $sql ="SELECT description, Count(position_id) as total FROM candidates LEFT JOIN positions ON positions.id=candidates.position_id GROUP BY position_id";
                                $result = mysqli_query($conn,$sql);
                                $chart_data="";
                                while ($row = mysqli_fetch_array($result)) {

                                    $description[]  = $row['description']  ;
                                    $total[] = $row['total'];
                                }
                                ?>
                                <div style="width:60%;height:40%;text-align:center">
                                    <h2 class="page-header" >Number of Candidates in Every Election </h2>
                                    <div>Election </div>
                                    <canvas  id="chartjs_bar"></canvas>
                                </div>

                                <script type="text/javascript">
                                    var ctx = document.getElementById("chartjs_bar").getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'doughnut',
                                        data: {
                                            labels:<?php echo json_encode($description); ?>,
                                            datasets: [{
                                                backgroundColor: [
                                                    "#5969ff",
                                                    "#ff407b",
                                                    "#25d5f2",
                                                    "#ffc750",
                                                    "#2ec551",
                                                    "#7040fa",
                                                    "#ff004e"
                                                ],
                                                data:<?php echo json_encode($total); ?>,
                                            }]
                                        },
                                        options: {
                                            legend: {
                                                display: true,
                                                position: 'bottom',

                                                labels: {
                                                    fontColor: '#71748d',
                                                    fontFamily: 'Circular Std Book',
                                                    fontSize: 14,
                                                }
                                            },


                                        }
                                    });

                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <!--GRAPH BAR-->

                <!--GRAPH BAR-->
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="col" align="center">
                                <?php
                                $sql2 ="SELECT status, Count(id) as total FROM positions GROUP BY status";
                                $result2 = mysqli_query($conn,$sql2);
                                $chart_data2="";
                                while ($row = mysqli_fetch_array($result2)) {

                                    $status_admin[]  = $row['status']  ;
                                    $total_admin[] = $row['total'];
                                }
                                ?>
                                <div style="width:60%;height:40%;text-align:center">
                                    <h2 class="page-header" >Election Status Report </h2>
                                    <div>Status </div>
                                    <canvas  id="chartjs_admin"></canvas>
                                </div>

                                <script type="text/javascript">
                                    var ctx2 = document.getElementById("chartjs_admin").getContext('2d');
                                    var myChart2 = new Chart(ctx2, {
                                        type: 'doughnut',
                                        data: {
                                            labels:<?php echo json_encode($status_admin); ?>,
                                            datasets: [{
                                                backgroundColor: [
                                                    "#2ec551",
                                                    "#ffc750",
                                                    "#ff004e",
                                                    "#25d5f2",
                                                    "#7040fa",
                                                    "#5969ff",
                                                    "#ff407b"
                                                ],
                                                data:<?php echo json_encode($total_admin); ?>,
                                            }]
                                        },
                                        options: {
                                            legend: {
                                                display: true,
                                                position: 'bottom',

                                                labels: {
                                                    fontColor: '#71748d',
                                                    fontFamily: 'Circular Std Book',
                                                    fontSize: 14,
                                                }
                                            },


                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--GRAPH BAR-->

        </section>
        <!-- right col -->
    </div>
    <?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>



</body>
</html>
