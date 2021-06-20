<?php
include 'includes/session.php';

if(isset($_POST['pending'])){
    $id = $_POST['id'];

    $sql = "SELECT * FROM positions WHERE id = $id";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    /*    $date = date('YYYY-MM-DD HH:MM:SS');*/
    $status = "Ongoing";
    $sql = "UPDATE positions SET status = '$status', startdate = CURRENT_TIMESTAMP WHERE id = '$id'";
    /*    $sql = "UPDATE admin SET status = '$status' AND created_on = '$date' WHERE id = '$id'";*/

    if($conn->query($sql)){
        $_SESSION['success'] = 'Voting session has starting!';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
}
else{
    $_SESSION['error'] = 'Error starting the voting session';
}

header('location: positions.php');

?>