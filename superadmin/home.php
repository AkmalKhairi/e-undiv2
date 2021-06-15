<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-white sidebar-mini">
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
        Dashboard
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
                <!-- small box -->
        <!-- ./col -->
          <!-- small box -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM admin where status='verified'";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>
             
              <p>Total Verified Admin</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="admin.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                  <div class="inner">
                      <?php
                      $sql = "SELECT * FROM admin where status='not verified'";
                      $query = $conn->query($sql);

                      echo "<h3>".$query->num_rows."</h3>";
                      ?>

                      <p>Total Pending Admin</p>
                  </div>
                  <div class="icon">
                      <i class="fa fa-users"></i>
                  </div>
                  <a href="admin_not.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>

          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                  <div class="inner">
                      <?php
                      $sql = "SELECT * FROM voters where status='verified'";
                      $query = $conn->query($sql);

                      echo "<h3>".$query->num_rows."</h3>";
                      ?>

                      <p>Total Verified Voters</p>
                  </div>
                  <div class="icon">
                      <i class="fa fa-users"></i>
                  </div>
                  <a href="voters.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>

          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                  <div class="inner">
                      <?php
                      $sql = "SELECT * FROM voters where status='not verified'";
                      $query = $conn->query($sql);

                      echo "<h3>".$query->num_rows."</h3>";
                      ?>

                      <p>Total Pending Voters</p>
                  </div>
                  <div class="icon">
                      <i class="fa fa-users"></i>
                  </div>
                  <a href="voters_not.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>

      </div>

        <!--GRAPH BAR-->

        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
        <div class="col" align="center">
            <?php
            $sql ="SELECT status, Count(id) as total FROM voters GROUP BY status";
            $result = mysqli_query($conn,$sql);
            $chart_data="";
            while ($row = mysqli_fetch_array($result)) {

                $status[]  = $row['status']  ;
                $total[] = $row['total'];
            }
            ?>
            <div style="width:60%;height:40%;text-align:center">
                <h2 class="page-header" >Voter Status Report </h2>
                <div>Status </div>
                <canvas  id="chartjs_bar"></canvas>
            </div>

            <script type="text/javascript">
                var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels:<?php echo json_encode($status); ?>,
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
            $sql2 ="SELECT status, Count(id) as total FROM admin GROUP BY status";
            $result2 = mysqli_query($conn,$sql2);
            $chart_data2="";
            while ($row = mysqli_fetch_array($result2)) {

                $status_admin[]  = $row['status']  ;
                $total_admin[] = $row['total'];
            }
            ?>
            <div style="width:60%;height:40%;text-align:center">
                <h2 class="page-header" >Admin Status Report </h2>
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
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e",
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
