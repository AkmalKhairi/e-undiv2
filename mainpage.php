<?php
session_start();

if(isset($_SESSION['superadmin'])){
    header('location: superadmin/home.php');
}

if(isset($_SESSION['admin'])){
    header('location: admin/home.php');
}

if(isset($_SESSION['voter'])){
    header('location: voter/home.php');
}
?>

<?php include 'includes/header.php'; ?>
<body style="background-image: url('images/bg.jpg'); overflow-y: hidden; " class="hold-transition login-page ">
<div style="padding-top: 100px;" class="login-box">

    <div class="login-logo">
        <img src="https://img.icons8.com/small/40/000000/elections.png">
        <b style="color: #0a0a0a" >E-Undi</b>
    </div>

    <div style="border-radius: 25px;" class="login-box-body">
        <p style="font-size: large; color: #0a0a0a;" class="login-box-msg">Welcome to E-Undi</p>

        <div class="row">
            <div class="col-md-12 column text-center">
                <a style="padding: 20px; font-size: large; border-radius: 15px; " href="#voting" data-toggle="modal" class="btn btn-info"> <i class="fa fa-user"></i> Sign in</a>
            </div>

        <!--
-->

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
    <?php include 'mainpage_modal.php'; ?>


</body>
