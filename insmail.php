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
    <h4><i class="fas fa-user-lock"></i> Recover your account now!</h4>
                <p class="text-muted">Let us help you to reset your password by entering your email.</p>
                <form role="form" method="post" action="send_mail.php">
                <input class="form-control col-xl-8" placeholder="Email" name="mail" id="mail" type="email">
                <br>
                <div class="float-right">
                    <button type="submit" name="sendmail" class="btn btn-info" >Send <i class="fas fa-paper-plane"></i></button>
                    <a class="btn btn-secondary" href="login.php">Back</a>
                </div>
                </form>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>
</html>