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

    $sql2 = mysqli_query($conn,"SELECT admin_id from admin WHERE admin_id = '$admin'");
    if (mysqli_num_rows($sql2)==1) {
        echo '<script language="javascript">';
        echo 'alert("Admin already exist")';
        echo '</script>';
        echo ("<script>location.href='index.php'</script>");
    }
    else
    {
        $date = date('Y-m-d');
        $status = "Not Verified";
        $sql = "INSERT INTO `admin` (`admin_id`, `password`, `firstname`, `lastname`, `photo`,`phone`, `created_on`, `status`) VALUES ('$admin', '$password', '$firstname', '$lastname', '$filename', '$phone', '$date', '$status')";

        if($conn->query($sql)){
            $_SESSION['success'] = 'Registration success';
        }
        else{
            $_SESSION['error'] = $conn->error;
        }

    }

}
else{
    $_SESSION['error'] = 'Fill up the form first';
}
header('location: index.php');
?>