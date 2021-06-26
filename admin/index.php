<?php
session_start();
if(isset($_SESSION['admin'])){
    header('location:home.php');
}
?>
<?php include 'includes/header.php'; ?>
<body style="background-image: url('../images/bg.jpg'); overflow-y: hidden; " class="hold-transition login-page ">
<div style="padding-top: 100px;" class="login-box">
    <div class="login-logo">
        <img src="https://img.icons8.com/small/40/000000/elections.png">
        <b style="color: #0a0a0a" >E-Undi</b>
    </div>

    <div style="border-radius: 25px;" class="login-box-body">
        <p class="login-box-msg">Admin sign in</p>

        <form action="login.php" method="POST">
            <div class="form-group has-feedback">
                <input placeholder="Last 4-Digits of NRIC" type="text" maxlength="4" onkeypress="return onlyNumberKey(event)" class="form-control" id="admin" name="admin" required>                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password" id="password" required>
                <input type="checkbox" onclick="viewPassword()"> Show Password
                <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-md-12 column">
                    <button style="border-radius: 25px;" type="submit" class="btn btn-success btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
                </div>
        </form>

    </div>
    <div class="row">
        <p style="padding-left: 80px;"> No Account yet? <a href="#addnew" data-toggle="modal"> REGISTER HERE</a></p>
        <a style="padding-left: 90px;" href="verification.php"> Account Verification Status </a>
    </div>
    <!--<div class="row">
        <div class="col-md-6 column">
            <button style="border-radius: 25px;" href="#addnew" data-toggle="modal" class="btn btn-primary btn-block btn-flat"><i class="fa fa-user-plus"></i> Register </button>
        </div>
    </div>-->
    <?php
    if(isset($_SESSION['error'])){
        echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
        unset($_SESSION['error']);
    }
    elseif (isset($_SESSION['success'])){
        echo "
  				<div class='callout callout-success text-center mt20'>
			  		<p>".$_SESSION['success']."</p> 
			  	</div>
  			";
        unset($_SESSION['success']);
    }
    ?>
</div>

<script>
    function onlyNumberKey(evt) {

        // Only ASCII charactar in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

    function viewPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>

<?php include 'includes/scripts.php' ?>
<?php include 'includes/admin_modal.php'; ?>



</body>
