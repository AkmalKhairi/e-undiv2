<?php
include 'includes/session.php';

if(isset($_GET['return'])){
    $return = $_GET['return'];

}
else{
    $return = 'home.php';
}

if(isset($_POST['save'])){
    $curr_password = $_POST['curr_password'];
//    $username = $_POST['username'];

    $nric = $voter['voters_id'];
    $stats = "edit profile";
    $catg = "Voter";
    $logdate = date('Y/m/d H:i:s');

    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $photo = $_FILES['photo']['name'];
    if(password_verify($curr_password, $voter['password'])){
        if(!empty($photo)){
            move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo);
            $filename = $photo;
        }
        else{
            $filename = $voter['photo'];
        }

        if($password == $voter['password']){
            $password = $voter['password'];
        }
        else{
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        $sql = "UPDATE voters SET password = '$password', firstname = '$firstname', lastname = '$lastname', photo = '$filename' WHERE id = '".$voter['id']."'";
        if($conn->query($sql)){
            $_SESSION['success'] = 'User profile updated successfully';
        }
        else{
            $_SESSION['error'] = $conn->error;
        }
        $sql2 = "INSERT INTO logfile (date, firstname, nric, status, category) VALUES ('$logdate','$firstname','$nric','$stats','$catg')";
        $query = $conn->query($sql2);

    }
    else{
        $_SESSION['error'] = 'Incorrect password';
    }
}
else{
    $_SESSION['error'] = 'Fill up required details first';
}

header('location:'.$return);

?>