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
                Dashboard
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

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
                        <div class="box-body">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                <th style="text-align: center;">Voting Title</th>
                                <th style="text-align: center;">Candidates</th>
                                <th style="text-align: center;">Result</th>
                                <th style="text-align: center;">Voting</th>
                                </thead>
                                <tbody>
                                <?php
                                /*UPDATE WHERE CLAUSE*/
                                $query = "SELECT * FROM candidates LEFT JOIN positions ON positions.id=candidates.position_id WHERE candidates.candidate_id =! '".$voter['id']."' GROUP BY positions.priority DESC";
                                $result = mysqli_query($conn,$query);
                                while($row = mysqli_fetch_array($result)){
                                    $id = $row['id'];
                                    $description = $row['description'];
                                if ($row['status'] == 'Ongoing'){
                                    echo "
                        <tr>
                          <td style='text-transform: uppercase; padding-left: 100px;'>".$row['description']."</td>
                          <td>
                          <a style='border-radius: 15px;' class='btn btn-info btn-sm btn-flat btn-block userinfo' data-id='".$id."'><i class='fa fa-search'></i> View</a>
                          </td>
                          <td>
                          <a style='border-radius: 15px;' class='btn btn-info btn-sm btn-flat btn-block userresult' data-id='".$id."'><i class='fa fa-search'></i> View</a>
                          </td>
                          <td>
                          <a style='border-radius: 15px;' class='btn btn-info btn-sm btn-flat btn-block uservoting' data-id='".$id."'><i class='fa fa-search'></i> View</a>
                          </td>
                        </tr>
                      ";}
                                elseif ($row['status'] == 'Finish'){
                                    echo "
                        <tr>
                          <td style='text-transform: uppercase; padding-left: 100px;'>".$row['description']."</td>
                          <td>
                          <a style='border-radius: 15px;' class='btn btn-info btn-sm btn-flat btn-block userinfo' data-id='".$id."'><i class='fa fa-search'></i> View</a>
                          </td>
                          <td>
                          <a style='border-radius: 15px;' class='btn btn-info btn-sm btn-flat btn-block userresult' data-id='".$id."'><i class='fa fa-search'></i> View</a>
                          </td>
                          <td>
                          <a style='border-radius: 15px;' class='btn btn-warning btn-sm btn-flat btn-block disabled uservoting' data-id='".$id."'><i class='fa fa-search'></i> View</a>
                          </td>
                        </tr>
                      ";
                                }
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
    <?php include 'includes/footer.php'; ?>
</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>

</body>
</html>
