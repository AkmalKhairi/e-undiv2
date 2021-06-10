<?php
include 'includes/session.php';

if(isset($_POST['approval'])){
    $id = $_POST['id'];

    $sql = "SELECT * FROM voters WHERE id = $id";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

/*    $date = date('Y-m-d');*/
    $status = "Verified";
    $sql = "UPDATE voters SET status = '$status' WHERE id = '$id'";
/*    $sql = "UPDATE admin SET status = '$status' AND created_on = '$date' WHERE id = '$id'";*/

    if($conn->query($sql)){
        $_SESSION['success'] = 'Voter successfully approved!';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
    $sql2 = "UPDATE voters SET voters_id = CONCAT(REPEAT('*', CHAR_LENGTH(voters_id) - 12), SUBSTR(voters_id, -4)) WHERE id = '$id'";
    $query = $conn->query($sql2);
    }
else{
    $_SESSION['error'] = 'Error approving Voter';
}

header('location: voters.php');

?>