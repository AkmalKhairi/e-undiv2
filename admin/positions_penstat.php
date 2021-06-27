<?php
include 'includes/session.php';

if(isset($_POST['pending'])){
    $id = $_POST['id'];
    $date = $_POST['date'];
    $findate = date("Y-m-d H:i:s",strtotime($date));

    $sql = "SELECT * FROM positions WHERE id = $id";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    /*    $date = date('YYYY-MM-DD HH:MM:SS');*/
    $status = "Ongoing";
    $sql = "UPDATE positions SET status = '$status', startdate = CURRENT_TIMESTAMP, enddate = '$findate' WHERE id = '$id'";
    /*    $sql = "UPDATE admin SET status = '$status' AND created_on = '$date' WHERE id = '$id'";*/

    if($conn->query($sql)){
        $_SESSION['success'] = 'Voting session has start!';
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