<?php
session_start();
if(isset($_SESSION['admin'])){
    header('location: admin/home.php');
}

if(isset($_SESSION['voter'])){
    header('location: home.php');
}
?>

<?php include 'includes/header.php';
include 'includes/conn.php';
?>
<body style="overflow-y: hidden; background-image: url('../images/bg.jpg'); " class="hold-transition login-page ">
<div style="padding-top: 100px;" class="login-box">
    <div class="login-logo">
        <img src="https://img.icons8.com/small/40/000000/elections.png">
        <b style="color: #0a0a0a " >E-Undi</b>
    </div>

    <div style="border-radius: 25px;" class="login-box-body">
        <p class="login-box-msg">Voter Verification Status</p>

        <form action="verification.php" method="POST">
            <div class="form-group has-feedback">
                <input placeholder="NRIC" maxlength="12" type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="voters_id" name="voters_id" required>                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="row">
                <p style="text-align: center;">
                    <?php
                    if (isset($_POST['status'])) {
                        $searchValue = $_POST['voters_id'];
                        $sql = "SELECT status FROM voters WHERE voters_id LIKE '%$searchValue%'";
                        $result = $conn->query($sql);
                        include 'includes/conn.php';
                        if ($result->num_rows>0) {
                            $row = $result->fetch_assoc();
                            /*                            header( "refresh:3;url=verification.php" );*/
                            echo '<img width="50" height="50" src="../images/check-mark.png">'.'<br>';
                            echo '<b style="font-size: 20px;"> NRIC: ' .$searchValue. '</b>'.'<br>';
                            echo '<b style="font-size: 20px;"> Status: '.$row['status'].'</b>'.'<br>';
                            echo '<a style="text-align: center;" href="index.php"> Return to login page </a>';

                        } elseif ($conn->connect_error) {
                            echo "connection Failed: " . $conn->connect_error;
                        }
                        else{
/*                            header( "refresh:3;url=verification.php" );*/
                            echo '<img width="50" height="50" src="../images/not-found.png">'.'<br>';
                            echo '<b style="font-size: 20px;">Result Not Found</b>'.'<br>';
                            echo '<a style="text-align: center;" href="index.php"> Return to login page </a>';

                        }
                        mysqli_free_result($result);
                        mysqli_close($conn);
                    }
                    ?></p>
                <div class="col-md-12 column">
                    <button style="border-radius: 25px;" type="submit" class="btn btn-success btn-block btn-flat" name="status"><i class="fa fa-check"></i> <a href="#addnew" data-toggle="modal"> </a> Check </button>
                </div>


        </form>
    </div>
    <?php
    if(isset($_SESSION['error'])){
        echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
        unset($_SESSION['error']);
    }
    ?>
</div>

<?php include 'includes/scripts.php' ?>
<?php include 'includes/voters_modal.php'; ?>
<?php include 'includes/scripts.php'; ?>

<script>

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
                $('.fullname').html(response.firstname+' '+response.lastname);
            }
        });
    }

    function onlyNumberKey(evt) {

        // Only ASCII charactar in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>

</body>
