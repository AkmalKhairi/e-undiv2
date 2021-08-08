<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='bootstrap/js/bootstrap.bundle.min.js' type='text/javascript'></script>
<head>
    <!--BarGraph-->
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <!--BarGraph-->
</head>
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Available Election
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"> Available Election</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <?php
            if(isset($_SESSION['error'])){
                echo "
                <div class='alert alert-danger alert-dismissible'>
             <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>

                    <p>".$_SESSION['error']."</p> 
                </div>
            ";
                unset($_SESSION['error']);
            }
            elseif (isset($_SESSION['success'])){
                echo "
                <div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <p>".$_SESSION['success']."</p> 
                </div>
            ";
                unset($_SESSION['success']);
            }
            ?>

            <div class="modal fade" id="empModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Candidates</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            <!--TEST-->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                        </div>
                        <div class="box-body">
                            <form action="votes_enrolling.php" method="POST">
                                <div class="form-group has-feedback">
                                    <input placeholder="Unique Code" maxlength="5" type="text" class="form-control" id="u_id" name="u_id" required>                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>
                                <div class="row">
                                    <p style="text-align: center;">
                                        <?php
                                        if (isset($_POST['status'])) {
                                            $searchValue = $_POST['u_id'];
                                            $sql = "SELECT * FROM positions WHERE u_id LIKE '%$searchValue%'";
                                            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                            while ($row = mysqli_fetch_row($result)) {
                                                $id = $row['id'];
                                                include 'includes/conn.php';
                                                if ($result->num_rows > 0) {
                                                    $row = $result->fetch_assoc();
                                                    /*                            header( "refresh:3;url=verification.php" );*/
                                                    echo '<img width="50" height="50" src="../images/check-mark.png">' . '<br>';
                                                    echo '<b style="font-size: 20px;"> Enroll Code: ' . $searchValue . '</b>' . '<br>';
                                                    echo '<b style="font-size: 20px;"> Description: ' . $row['description'] . '</b>' . '<br>';
                                                    echo '<a style="border-radius: 15px;" class="btn btn-info btn-sm btn-flat btn-block enrollvote" data-id=".$id."><i class="fa fa-search"></i> Join</a>';

                                                } elseif ($conn->connect_error) {
                                                    echo "connection Failed: " . $conn->connect_error;
                                                } else {
                                                    /*                            header( "refresh:3;url=verification.php" );*/
                                                    echo '<img width="50" height="50" src="../images/not-found.png">' . '<br>';
                                                    echo '<b style="font-size: 20px;">Result Not Found</b>' . '<br>';
                                                    echo '<a style="text-align: center;" href="index.php"> Return to login page </a>';

                                                }
                                                mysqli_free_result($result);
                                                mysqli_close($conn);
                                            }
                                        }
                                        ?></p>
                                    <div class="col-md-12 column">
                                        <button style="border-radius: 25px;" type="submit" class="btn btn-success btn-block btn-flat" name="status"><i class="fa fa-check"></i> <a href="#addnew" data-toggle="modal"> </a> Check </button>
                                    </div>


                            </form>
                            <script type='text/javascript'>
                                $(document).ready(function(){

                                    $('.userinfo').click(function(){

                                        var userid = $(this).data('id');

                                        // AJAX request
                                        $.ajax({
                                            url: 'candidates_join.php',
                                            type: 'post',
                                            data: {userid: userid},
                                            success: function(response){
                                                // Add response in Modal body
                                                $('.modal-body').html(response);

                                                // Display Modal
                                                $('#empModal').modal('show');
                                            }
                                        });
                                    });

                                    $('.enrollvote').click(function(){

                                        var userid = $(this).data('id');

                                        // AJAX request
                                        $.ajax({
                                            url: 'votes_enroll.php',
                                            type: 'post',
                                            data: {userid: userid},
                                            success: function(response){
                                                // Add response in Modal body
                                                $('.modal-body').html(response);

                                                // Display Modal
                                                $('#empModal').modal('show');
                                            }
                                        });
                                    });

                                    $('.userresult').click(function(){

                                        var userid = $(this).data('id');

                                        // AJAX request
                                        $.ajax({
                                            url: 'candidates_result.php',
                                            type: 'post',
                                            data: {userid: userid},
                                            success: function(response){
                                                // Add response in Modal body
                                                $('.modal-body').html(response);

                                                // Display Modal
                                                $('#empModal').modal('show');
                                            }
                                        });
                                    });

                                    $('.uservoting').click(function(){

                                        var userid = $(this).data('id');

                                        // AJAX request
                                        $.ajax({
                                            url: 'candidates_voting.php',
                                            type: 'post',
                                            data: {userid: userid},
                                            success: function(response){
                                                // Add response in Modal body
                                                $('.modal-body').html(response);

                                                // Display Modal
                                                $('#empModal').modal('show');
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <!--TEST-->

            <!--      <div class="row">
                    <div class="col-xs-12">
                      <h3>Votes Tally
                        <span class="pull-right">
                          <a href="print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Print</a>
                        </span>
                      </h3>
                    </div>
                  </div>-->

            <?php
            /*        $sql = "SELECT * FROM positions ORDER BY priority ASC";
                    $query = $conn->query($sql);
                    $inc = 2;
                    while($row = $query->fetch_assoc()){
                      $inc = ($inc == 2) ? 1 : $inc+1;
                      if($inc == 1) echo "<div class='row'>";
                      echo "
                        <div class='col-sm-6'>
                          <div class='box box-solid'>
                            <div class='box-header with-border'>
                              <h4 class='box-title'><b>".$row['description']."</b></h4>
                            </div>
                            <div class='box-body'>
                              <div class='chart'>
                                <canvas id='".slugify($row['description'])."' style='height:200px'></canvas>
                              </div>
                            </div>
                          </div>
                        </div>
                      ";
                      if($inc == 2) echo "</div>";
                    }
                    if($inc == 1) echo "<div class='col-sm-6'></div></div>";
                  */?>
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
        </section>
        <!-- right col -->
    </div>
    <?php include 'includes/voters_modal.php'; ?>
    <?php include 'includes/footer.php'; ?>
</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>

</body>
</html>
