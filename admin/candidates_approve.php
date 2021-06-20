<?php
include 'includes/session.php';

if(isset($_POST['approval'])){
    $id = $_POST['id'];
    $sql = "SELECT * FROM candidates WHERE id = $id";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    /*    $date = date('Y-m-d');*/
    $status = "Approve";
    $sql = "UPDATE candidates SET status = '$status' WHERE id = '$id'";
    /*    $sql = "UPDATE admin SET status = '$status' AND created_on = '$date' WHERE id = '$id'";*/

    if($conn->query($sql)){
        $_SESSION['success'] = 'Candidate successfully approved!';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
}
else{
    $_SESSION['error'] = 'Error approving Candidate';
}

header('location: candidates.php');

?>