<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $admin = $_POST['admin_id'];
    $date = $_POST['date'];
    $phone = $_POST['phone'];
    $filename = $_FILES['photo']['name'];
    if(!empty($filename)){
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);
    }

    $sql2 = mysqli_query($conn,"SELECT admin_id from admin WHERE admin_id = '$admin' AND status='Not Verified'");
    if (mysqli_num_rows($sql2)==1) {
        $_SESSION['error'] = 'User already exist';
    }
    elseif (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        // Google reCAPTCHA API secret key
        $secretKey = '6LeLeuEbAAAAAIQscuFINT8u3GIGmXi7w2bnfdjE';

        // Verify the reCAPTCHA response
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $_POST['g-recaptcha-response']);

        // Decode json data
        $responseData = json_decode($verifyResponse);

        // If reCAPTCHA response is valid
        if ($responseData->success) {
        $date = date('Y-m-d');
        $status = "Not Verified";
        $sql = "INSERT INTO `admin` (`admin_id`, `password`, `firstname`, `lastname`, `photo`,`phone`, `created_on`, `status`) VALUES ('$admin', '$password', '$firstname', '$lastname', '$filename', '$phone', '$date', '$status')";

        if($conn->query($sql)){
            $_SESSION['success'] = 'Registration success';
        }
        else{
            $_SESSION['error'] = $conn->error;
        }

        } else {
            $_SESSION['error'] = 'Robot verification failed, please try again.';
        }
    }
}
else{
    $_SESSION['error'] = 'Fill up the form first';
}
header('location: index.php');
?>