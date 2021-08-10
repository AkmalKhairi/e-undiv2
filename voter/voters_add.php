<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $voter = $_POST['voters_id'];
    $date = $_POST['date'];
    $phone = $_POST['phone'];
    $filename = $_FILES['photo']['name'];

    $PRIVATE_KEY = '6LeLeuEbAAAAAIQscuFINT8u3GIGmXi7w2bnfdjE';
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];

    if(!empty($filename)){
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);
    }

    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$PRIVATE_KEY&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $response = json_decode($response);

    $sql2 = mysqli_query($conn,"SELECT voters_id from voters WHERE voters_id = '$voter' AND status='Not Verified'");
    if (mysqli_num_rows($sql2)==1) {
        $_SESSION['error'] = 'User already exist';
    }

    elseif ($response->success)
    {
        $date = date('Y-m-d');
        $status = "Not Verified";
        $sql = "INSERT INTO voters (voters_id, password, firstname, lastname, created_on, photo, status, phone) VALUES ('$voter', '$password', '$firstname', '$lastname', '$date' , '$filename', '$status','$phone')";
        if($conn->query($sql)){
            $_SESSION['success'] = 'Registration success';
        }
        else{
            $_SESSION['error'] = $conn->error;
        }

    }
    else{
        $_SESSION['error'] = 'Robot verification failed, please try again.';
    }
}
else{
    $_SESSION['error'] = 'Fill up the form first';
}
header('location: index.php');
?>