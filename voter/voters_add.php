<?php
include 'includes/session.php';

if(isset($_POST['add'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $voter = $_POST['voters_id'];
    $date = $_POST['date'];
    $phone = $_POST['phone'];
    $filename = $_FILES['photo']['name'];
    if (!empty($filename)) {
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $filename);
    }
    $sql2 = mysqli_query($conn, "SELECT voters_id from voters WHERE voters_id = '$voter' AND status='Not Verified'");
    if (mysqli_num_rows($sql2) == 1) {
        $_SESSION['error'] = 'User already exist';
    } // Validate reCAPTCHA box
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
            $sql = "INSERT INTO voters (voters_id, password, firstname, lastname, created_on, photo, status, phone) VALUES ('$voter', '$password', '$firstname', '$lastname', '$date' , '$filename', '$status','$phone')";
            if ($conn->query($sql)) {
                $_SESSION['success'] = 'Registration success';
            } else {
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