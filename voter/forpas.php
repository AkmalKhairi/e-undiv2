<?php
include 'includes/conn.php';

$voter = htmlspecialchars($_POST['voters_id']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if(empty($voter&&$password))
{
    echo '<script language="javascript">';
    echo 'alert("Please fill up the form!")';
    echo '</script>';
    echo ("<script>location.href='../respas.php'</script>");
}
else{
    $sql=mysqli_query($conn,"SELECT voters_id from voters where voters_id = '$voter'");
    if(mysqli_num_rows($sql)==0)
    {
        echo '<script language="javascript">';
        echo 'alert("Invalid ID! Please check your ID.")';
        echo '</script>';
        echo ("<script>location.href='respas.php'</script>");
    }
    else
    {
        $sql2="UPDATE voters SET password = '$password' WHERE voters_id = '$voter'";
        if($conn->query($sql2)){
            echo '<script language="javascript">';
            echo 'alert("Password has been changed successfully!")';
            echo '</script>';
            echo ("<script>location.href='index.php'</script>");
        }
    }
}
    ?>