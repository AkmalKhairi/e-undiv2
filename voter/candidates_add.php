<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $position = $_POST['position'];
    $platform = $_POST['platform'];
    $filename = $_FILES['photo']['name'];
    if(!empty($filename)){
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);
    }
    $status = 'Pending';
    $firstname = $voter['firstname'];
    $lastname = $voter['lastname'];
    $nric = $voter['voters_id'];
    $sql = "INSERT INTO candidates (position_id,candidate_id, firstname, lastname, photo, platform,status) VALUES ('$position','$nric', '$firstname', '$lastname', '$filename', '$platform','$status')";
    if($conn->query($sql)){
        $_SESSION['success'] = 'Candidate added successfully';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }

}
else{
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: candidates.php');
?>