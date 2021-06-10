<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='bootstrap/js/bootstrap.bundle.min.js' type='text/javascript'></script>
<body class="hold-transition skin-black-light sidebar-mini">
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

            <div class="container" >
                <!-- Modal -->
                <div class="modal fade" id="empModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">User Info</h4>
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

                <br/>
                <table border='1' style='border-collapse: collapse;'>
                    <tr>
                        <th>Voting Title</th>
                        <th>Candidates</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM candidates LEFT JOIN positions ON positions.id=candidates.position_id GROUP BY positions.priority ASC";
                    $result = mysqli_query($conn,$query);
                    while($row = mysqli_fetch_array($result)){
                        $id = $row['id'];
                        $description = $row['description'];
                        echo "<tr>";
                        echo "<td>".$description."</td>";
                        echo "<td><button data-id='".$id."' class='userinfo'>Info</button></td>";
                        /*                    echo "<td><button data-id='".$id."' class='userinfo'>Info</button></td>";*/
                        echo "</tr>";
                    }
                    ?>
            </table>

                <script type='text/javascript'>
                    $(document).ready(function(){

                        $('.userinfo').click(function(){

                            var userid = $(this).data('id');

                            // AJAX request
                            $.ajax({
                                url: 'candidates_row.php',
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

        </section>
        <!-- right col -->
    </div>
    <?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
