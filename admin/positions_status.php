<?php
include 'includes/session.php';

if(isset($_POST['status'])){
    $id = $_POST['id'];

    $sql = "SELECT * FROM positions WHERE id = $id";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

/*    $date = date('YYYY-MM-DD HH:MM:SS');*/
    $status = "Finish";
    $sql = "UPDATE positions SET status = '$status', enddate = CURRENT_TIMESTAMP WHERE id = '$id'";
    /*    $sql = "UPDATE admin SET status = '$status' AND created_on = '$date' WHERE id = '$id'";*/

    if($conn->query($sql)){
        $_SESSION['success'] = 'Voting session has end!';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
}
else{
    $_SESSION['error'] = 'Error ending the voting session';
}

header('location: positions.php');

?>