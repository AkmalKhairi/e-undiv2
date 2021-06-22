<?php
include 'includes/session.php';
include 'includes/slugify.php';
include 'includes/ballot_modal.php';

$userid = $_POST['userid'];
$sql = "SELECT *,candidates.firstname AS canfirst, candidates.lastname AS canlast FROM votes LEFT JOIN candidates ON candidates.id=votes.candidate_id LEFT JOIN positions ON positions.id=votes.position_id WHERE positions.id='$userid'";
$result = mysqli_query($conn,$sql) or die( mysqli_error($conn));
if($result->num_rows > 0){
while( $row = mysqli_fetch_array($result) ){
    $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
    $fname = $row['firstname'];
    $lname = $row['lastname'];
    $dsc = $row['description'];
    echo "<div class='row votelist'>
                     <span style='padding-left: 50px;' class='col-sm-4'> <img src='".$image."' width='100px' height='100px'> </span>
                      <span style='padding-left: 70px; font-size: 30px;' class='col-sm-8'><b>".$dsc.":</b></span>
                      <span style='padding-left: 70px; font-size: 30px;' class='col-sm-8'><b>".$fname.' '.$lname."</b></span>
                    </div>";
    }


    ?>
    <div class="text-center">
        <h3>You have already voted for this election.</h3>
    </div>
<?php
}
else{
    ?>
    <!-- Voting Ballot -->
    <form method="POST" id="ballotForm" action="submit_ballot.php">
        <?php

        $userid = $_POST['userid'];
        $candidate = '';
        $status = "Ongoing";
        $sql = "SELECT * FROM positions WHERE status = '$status' AND positions.id='$userid'";
        $query = mysqli_query($conn,$sql) or die( mysqli_error($conn));
        while( $row = mysqli_fetch_array($query) ){
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
 </script>
