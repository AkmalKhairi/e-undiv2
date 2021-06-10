<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-white sidebar-mini">
<div class="wrapper">

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

      </section>
      <!-- right col -->
    </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>

</body>
</html>
