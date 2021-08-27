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
                Enroll in Election
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"> Enroll</li>
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
                            <table id="example1" class="table table-bordered">
                                <thead>
                                <th style="text-align: center;">Voting Title</th>
                                <!--<th style="text-align: center;">Enroll Deadline</th>-->
                                <th style="text-align: center;">Enroll Deadline</th>
                                <th style="text-align: center;">Candidates</th>
                                <th style="text-align: center;">Enroll</th>
                                </thead>
                                <tbody>
                                <?php
                                /*UPDATE WHERE CLAUSE TO SUBQUERY */
                                /*$query = "SELECT *, enroll.position_id AS enstat FROM enroll LEFT JOIN positions ON enroll.position_id=positions.id LEFT JOIN candidates ON positions.id=candidates.position_id where candidates.position_id NOT IN (select position_id FROM candidates where candidate_id = '".$voter['voters_id']."') GROUP BY positions.id";*/
                                /*$query = "SELECT *, votes.position_id AS posid FROM votes LEFT JOIN candidates ON votes.candidate_id=candidates.id LEFT JOIN positions ON positions.id=candidates.position_id where candidates.position_id NOT IN (select position_id FROM candidates where candidate_id = '".$voter['voters_id']."') GROUP BY positions.id";*/
                                /*$query = "SELECT * FROM candidates LEFT JOIN positions ON positions.id=candidates.position_id where position_id NOT IN (select position_id FROM candidates where candidate_id = '".$voter['voters_id']."') AND NOT IN (select position_id, status AS enstat FROM enroll where voters_id = '".$voter['voters_id']."') GROUP BY positions.id";*/
                                /*$query = "SELECT * FROM candidates LEFT JOIN positions ON positions.id=candidates.position_id where position_id NOT IN (select position_id FROM candidates where candidate_id = '".$voter['voters_id']."') GROUP BY positions.id";*/
                                $query = "SELECT * FROM candidates LEFT JOIN positions ON positions.id=candidates.position_id where position_id NOT IN (select position_id FROM candidates where candidate_id = '".$voter['voters_id']."') GROUP BY positions.id";
                                $result = mysqli_query($conn,$query)or die( mysqli_error($conn));
                                while($row = mysqli_fetch_array($result)){
                                    $id = $row['id'];
                                    $date = $row['nominationdate'];
                                    $description = $row['description'];
                                    if ($row['status'] == 'Pending'){
                                        echo "
                        <tr>
                          <td style='text-transform: uppercase; padding-left: 100px;'>".$row['description']."</td>
                          <!--<td style='text-transform: uppercase; padding-left: 100px;' id='demo'></td>-->
                        <td style='text-transform: uppercase; padding-left: 100px;'>".$row['nominationdate']."</td>

                          <td>
                          <a style='border-radius: 15px;' class='btn btn-info btn-sm btn-flat btn-block userinfo' data-id='".$id."'><i class='fa fa-search'></i> View</a>
                          </td>
                          <td>
                          <a style='border-radius: 15px;' class='btn btn-info btn-sm btn-flat btn-block enrollvote' data-id='".$id."'><i class='fa fa-search'></i> View</a>
                          </td>
                        </tr>
                      ";}
                                    /*elseif ($row['status'] == 'Finish'){
                                        echo "
                        <tr>
                          <td style='text-transform: uppercase; padding-left: 100px;'>".$row['description']."</td>
                          <td style='text-transform: uppercase; padding-left: 100px;'>".$row['enddate']."</td>
                          <td>
                          <a style='border-radius: 15px;' class='btn btn-warning btn-sm btn-flat btn-block userinfo' data-id='".$id."'><i class='fa fa-search'></i> View</a>
                          </td>
                          <td>
                          <a style='border-radius: 15px;' class='btn btn-warning btn-sm btn-flat btn-block userresult' data-id='".$id."'><i class='fa fa-search'></i> View</a>
                          </td>
                          <td>
                          <a style='border-radius: 15px;' class='btn btn-warning btn-sm btn-flat btn-block disabled enrollvote' data-id='".$id."'><i class='fa fa-search'></i> View</a>
                          </td>
                        </tr>
                      ";
                                    }*/
                                }
                                ?>
                                </tbody>
                            </table>
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

                                    /*var countDownDate = <?php
                                    echo strtotime("$date" ) ?> * 1000;
                                    var now = <?php echo time() ?> * 1000;

                                    // Update the count down every 1 second
                                    var x = setInterval(function() {
                                        now = now + 1000;
                                    // Find the distance between now an the count down date
                                        var distance = countDownDate - now;
                                    // Time calculations for days, hours, minutes and seconds
                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                    // Output the result in an element with id="demo"
                                        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
                                            minutes + "m " + seconds + "s ";
                                    // If the count down is over, write some text
                                        if (distance < 0) {
                                            clearInterval(x);
                                            document.getElementById("demo").innerHTML = "EXPIRED";
                                        }

                                    }, 1000);*/

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
    <?php include 'includes/footer.php'; ?>
</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>

</body>
</html>
