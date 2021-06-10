<?php
session_start();
include 'includes/conn.php';

if(isset($_POST['login'])){
    $admin = ($_POST['admin']);
    $password = $_POST['password'];

    $status = "Verified";
    $sql = "SELECT * FROM admin WHERE admin_id = '$admin' AND status = '$status'";
    $query = $conn->query($sql);

    if($query->num_rows < 1){
        $_SESSION['error'] = 'Incorrect credentials or account not Verify yet.';
    }
    else{
        $row = $query->fetch_assoc();
        if(password_verify($password, $row['password'])){
            $_SESSION['admin'] = $row['id'];
        }
        else{
            $_SESSION['error'] = 'Incorrect password';
        }
    }
/*    $sql2 = "UPDATE voters SET logintime = CURRENT_TIMESTAMP WHERE voters_id = '$voter'";
    $query = $conn->query($sql2);*/
}


else{
    $_SESSION['error'] = 'Input voter credentials first';
}

header('location: index.php');

?>