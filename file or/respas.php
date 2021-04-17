<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <img src="https://img.icons8.com/small/40/000000/elections.png"><b>Voting System</b>
    </div>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
</head>
<body>
<div class="login-box-body">
    <form role="form" method="post" action="forpas.php">
        <h4><i class="fas fa-user-lock"></i>  Reset your password here!</h4>
                <input placeholder="Voter ID" class="form-control col-xl-8" name="voters_id" id="voters_id" type="text">
                <br>
                <input placeholder="New Password" class="form-control col-xl-8" name="password" id="password" type="password">
                <br>
                <button type="submit" name="save" class="btn btn-info float-right" >Save Password <i class="fas fa-check-circle"></i></button>
    </form>
</div>
<!--<script>-->
<!--    function sendFunction() {-->
<!--        alert("An verification has been sent to your email!");-->
<!--    }-->
<!--</script>-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>
</html>