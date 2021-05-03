<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $voter = $_POST['voters_id'];
    $date = $_POST['date'];
    $filename = $_FILES['photo']['name'];
    if(!empty($filename)){
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);
    }
    $sql2 = mysqli_query($conn,"SELECT voters_id from voters WHERE voters_id = '$voter'");
    if (mysqli_num_rows($sql2)==1) {
        echo '<script language="javascript">';
        echo 'alert("User already exist")';
        echo '</script>';
        echo ("<script>location.href='index.php'</script>");
    }
    else
    {
        $date = date('Y-m-d');
        $status = "Not Verified";
        $sql = "INSERT INTO voters (voters_id, password, firstname, lastname, created_on, photo, status) VALUES ('$voter', '$password', '$firstname', '$lastname', '$date' , '$filename', '$status')";
        if($conn->query($sql)){
            echo '<script language="javascript">';
            echo 'alert("Voters sucessfully insert")';
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