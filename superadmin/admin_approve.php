<?php
include 'includes/session.php';

if(isset($_POST['approval'])){
    $id = $_POST['id'];

    $sql = "SELECT * FROM admin WHERE id = $id";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    /*    $date = date('Y-m-d');*/
    $status = "Verified";
    $sql = "UPDATE admin SET status = '$status' WHERE id = '$id'";
    /*    $sql = "UPDATE admin SET status = '$status' AND created_on = '$date' WHERE id = '$id'";*/

    if($conn->query($sql)){
        $_SESSION['success'] = 'Admin successfully approved!';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
    $sql2 = "UPDATE admin SET admin_id = CONCAT(REPEAT('*', CHAR_LENGTH(admin_id) - 12), SUBSTR(admin_id, -4)) WHERE id = '$id'";
    $query = $conn->query($sql2);
}
else{
    $_SESSION['error'] = 'Error approving admin';
}

header('location: admin.php');

?>