<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $date = $_POST['date'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $filename = $_FILES['photo']['name'];
    if(!empty($filename)){
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);
    }

    $sql2 = mysqli_query($conn,"SELECT username from admin WHERE username = '$username'");
    if (mysqli_num_rows($sql2)==1) {
        echo '<script language="javascript">';
        echo 'alert("Admin already exist")';
        echo '</script>';
        echo ("<script>location.href='index.php'</script>");
    }
    else
    {
        $sql = "INSERT INTO `admin` (`username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES ('$username', '$password', '$firstname', '$lastname', '$filename', '$date')";

        if($conn->query($sql)){
            echo '<script language="javascript">';
            echo 'alert("Admin sucessfully insert")';
            echo '</script>';
            echo ("<script>location.href='index.php'</script>");
        }
        else{
            $_SESSION['error'] = $conn->error;
        }

    }

}
else{
    $_SESSION['error'] = 'Fill up add form first';
}
header('location: index.php');
?>