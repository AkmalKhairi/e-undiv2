<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-yellow sidebar-mini">
<div  class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div  class="content-wrapper">
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
            <div  style="padding-top: 80px;" class="row">
                <div class="col-sm-10 col-sm-offset-1">

                    <?php
                    $sql = "SELECT * FROM votes WHERE voters_id = '".$voter['id']."'";
                    $vquery = $conn->query($sql);
                    if($vquery->num_rows > 0){
                        ?>
                        <div style="overflow-y: hidden;" class="text-center">
                            <h3>You have already voted for this election.</h3>
                            <a style="padding: 10px 24px; " href="#view" data-toggle="modal" class="btn btn-flat btn-info btn-lg center">View Ballot</a>
                            <?php
                            $sql = "SELECT * FROM positions ORDER BY priority ASC";
                            $query = $conn->query($sql);
                            $inc = 2;
                            while($row = $query->fetch_assoc()){
                                $inc = ($inc == 2) ? 1 : $inc+1;
                                if($inc == 1) echo "<div class='row'>";
                                echo "
              <div class='box box-solid'>
                <div class='box-header with-border'>
                                  <h3> Voting Name: </h3>
                  <h3 class='box-title'><b>".$row['description']."</b></h3>
                </div>
                <div class='box-body'>
                  <div class='chart'>
                    <canvas  id='".slugify($row['description'])."' style='height:300px'> </canvas>
                    
                  </div>
                </div>
              </div>
            </div>
          ";
                                if($inc == 2) echo "</div>";
                            }
                            if($inc == 1) echo "<div class='col-sm-6'></div></div>";
                            ?>



                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <!-- Voting Ballot -->
                        <form method="POST" id="ballotForm" action="submit_ballot.php">
                            <?php


                            $candidate = '';
                            $sql = "SELECT * FROM positions ORDER BY priority ASC";
                            $query = $conn->query($sql);
                            while($row = $query->fetch_assoc()){
                                $sql = "SELECT * FROM candidates WHERE position_id='".$row['id']."'";
                                $cquery = $conn->query($sql);
                                while($crow = $cquery->fetch_assoc()){
                                    $slug = slugify($row['description']);
                                    $checked = '';
                                    if(isset($_SESSION['post'][$slug])){
                                        $value = $_SESSION['post'][$slug];

                                        if(is_array($value)){
                                            foreach($value as $val){
                                                if($val == $crow['id']){
                                                    $checked = 'checked';
                                                }
                                            }
                                        }
                                        else{
                                            if($value == $crow['id']){
                                                $checked = 'checked';
                                            }
                                        }
                                    }
                                    $input = ($row['max_vote'] > 1) ? '<input type="checkbox" class="flat-red '.$slug.'" name="'.$slug."[]".'" value="'.$crow['id'].'" '.$checked.'>' : '<input type="radio" class="flat-red '.$slug.'" name="'.slugify($row['description']).'" value="'.$crow['id'].'" '.$checked.'>';
                                    $image = (!empty($crow['photo'])) ? '../images/'.$crow['photo'] : 'images/profile.jpg';
                                    $candidate .= '
												<li>
													'.$input.'<button type="button" class="btn btn-primary btn-sm btn-flat clist platform" data-platform="'.$crow['platform'].'" data-fullname="'.$crow['firstname'].' '.$crow['lastname'].'"><i class="fa fa-search"></i> Manifesto</button><img src="'.$image.'" height="100px" width="100px" class="clist"><span class="cname clist">'.$crow['firstname'].' '.$crow['lastname'].'</span>
												</li>
											';
                                }

                                $instruct = ($row['max_vote'] > 1) ? 'You may select up to '.$row['max_vote'].' candidates' : 'Select only one candidate';

                                echo '
											<div class="row">
												<div class="col-xs-12">
													<div class="box box-solid" id="'.$row['id'].'">
														<div class="box-header with-border">
															<h3 class="box-title"><b>'.$row['description'].'</b></h3>
														</div>
														<div class="box-body">

															<div id="candidate_list">
																<ul>
																	'.$candidate.'
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
										';

                                $candidate = '';

                            }

                            ?>
                            <div class="text-center">
<!--                                 <button type="button" class="btn btn-success btn-flat" id="preview"><i class="fa fa-file-text"></i> Preview</button>
-->                         	<button style="padding: 14px 28px; width: 100%; font-size: 20px;" type="submit" class="btn btn-success btn-flat" name="vote">
                                    <i class="fa fa-check-square-o"></i> Submit</button>
                            </div>
                        </form>
                        <!-- End Voting Ballot -->
                        <?php
                    }

                    ?>

                </div>
            </div>
        </section>
        <!-- right col -->
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/ballot_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<?php
$sql = "SELECT * FROM positions ORDER BY priority ASC";
$query = $conn->query($sql);
while($row = $query->fetch_assoc()){
    $sql = "SELECT * FROM candidates WHERE position_id = '".$row['id']."'";
    $cquery = $conn->query($sql);
    $carray = array();
    $varray = array();
    while($crow = $cquery->fetch_assoc()){
        array_push($carray, $crow['lastname']);
        $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
        $vquery = $conn->query($sql);
        array_push($varray, $vquery->num_rows);
    }
    $carray = json_encode($carray);
    $varray = json_encode($varray);
    ?>
    <script>
        $(function(){
            $('.content').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            $(document).on('click', '.platform', function(e){
                e.preventDefault();
                $('#platform').modal('show');
                var platform = $(this).data('platform');
                var fullname = $(this).data('fullname');
                $('.candidate').html(fullname);
                $('#plat_view').html(platform);
            });

            $(function(){
                var rowid = '<?php echo $row['id']; ?>';
                var description = '<?php echo slugify($row['description']); ?>';
                var barChartCanvas = $('#'+description).get(0).getContext('2d')
                var barChart = new Chart(barChartCanvas)
                var barChartData = {
                    labels  : <?php echo $carray; ?>,
                    datasets: [
                        {
                            label               : 'Votes',
                            fillColor           : 'rgba(60,141,188,0.9)',
                            strokeColor         : 'rgba(60,141,188,0.8)',
                            pointColor          : '#3b8bba',
                            pointStrokeColor    : 'rgba(60,141,188,1)',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data                : <?php echo $varray; ?>
                        }
                    ]
                }
                var barChartOptions                  = {
                    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                    scaleBeginAtZero        : true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines      : true,
                    //String - Colour of the grid lines
                    scaleGridLineColor      : 'rgba(0,0,0,.05)',
                    //Number - Width of the grid lines
                    scaleGridLineWidth      : 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines  : true,
                    //Boolean - If there is a stroke on each bar
                    barShowStroke           : true,
                    //Number - Pixel width of the bar stroke
                    barStrokeWidth          : 2,
                    //Number - Spacing between each of the X value sets
                    barValueSpacing         : 5,
                    //Number - Spacing between data sets within X values
                    barDatasetSpacing       : 1,
                    //String - A legend template
                    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    //Boolean - whether to make the chart responsive
                    responsive              : true,
                    maintainAspectRatio     : true
                }

                barChartOptions.datasetFill = false
                var myChart = barChart.HorizontalBar(barChartData, barChartOptions)
                //document.getElementById('legend_'+rowid).innerHTML = myChart.generateLegend();
            });


            $('#preview').click(function(e){
                e.preventDefault();
                var form = $('#ballotForm').serialize();
                if(form == ''){
                    $('.message').html('You must vote atleast one candidate');
                    $('#alert').show();
                }
                else{
                    $.ajax({
                        type: 'POST',
                        url: 'preview.php',
                        data: form,
                        dataType: 'json',
                        success: function(response){
                            if(response.error){
                                var errmsg = '';
                                var messages = response.message;
                                for (i in messages) {
                                    errmsg += messages[i];
                                }
                                $('.message').html(errmsg);
                                $('#alert').show();
                            }
                            else{
                                $('#preview_modal').modal('show');
                                $('#preview_body').html(response.list);
                            }
                        }
                    });
                }

            });

        });
    </script>
    <?php
}
?>
</body>
</html>
