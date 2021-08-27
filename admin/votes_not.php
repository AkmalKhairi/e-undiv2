<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-black-light sidebar-mini">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Pending Voting
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"> Pending Voting</li>
            </ol>
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

            <div class="modal fade" id="empModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Candidates</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
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
                        </div>                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <!--<a href="#reset" data-toggle="modal" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i> Reset</a>-->
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                <th class="hidden"></th>
                                <th>NRIC</th>
                                <th>Name</th>
                                <th>Election</th>
                                <th>Voting Status</th>
                                <th>Tools</th>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT *,voters.id, voters.voters_id, voters.firstname,positions.description FROM voters LEFT JOIN enroll ON voters.id=enroll.voters_id LEFT JOIN positions ON enroll.position_id=positions.id WHERE enroll.status = 'Enrolled'";
                                /*SELECT * FROM candidates LEFT JOIN positions ON positions.id=candidates.position_id where position_id IN (select position_id FROM candidates where candidate_id = '".$voter['voters_id']."') GROUP BY positions.id*/
                                /*SELECT *, voters.firstname AS votfirst, voters.lastname AS votlast FROM votes LEFT JOIN voters ON voters.id=votes.voters_id WHERE votes.voters_id != voters.voters_id AND voters.status = 'VERIFIED'*/
                                $query = $conn->query($sql) or die($conn->error);
                                while($row = $query->fetch_assoc()){
                                    echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>********".$row['voters_id']."</td>
                          <td>".$row['firstname']."</td>
                          <td>".$row['description']."</td>
                          <td>PENDING VOTING</td>
                          <td><button class='btn btn-warning btn-sm notify btn-flat' data-id='".$row['id']."'><i class='fa fa-bell'></i> Notify</button></td>
                        </tr>
                      ";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/votes_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
    $(function(){
        <!-- Edit button Function -->
        $(document).on('click', '.notify', function(e){
            e.preventDefault();
            $('#notify').modal('show');
            var id = $(this).data('id');
            getRow(id);
        });
    });

    function getRow(id){
        $.ajax({
            type: 'POST',
            url: 'voters_row.php',
            data: {id:id},
            dataType: 'json',
            success: function(response){
                $('.id').val(response.id);
                $('#edit_firstname').val(response.firstname);
                $('#edit_lastname').val(response.lastname);
                $('#edit_password').val(response.password);
                $('.phone').val(response.phone);
                $('.fullname').html(response.firstname+' '+response.lastname);
            }
        });
    }

</script>
</body>
</html>
