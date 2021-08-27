<?php
include 'includes/session.php';

if(isset($_POST['enroll'])){
    $position = $_POST['posid'];
    $u_id = $_POST['u_id'];
    $status = 'Enrolled';
    $voterid = $voter['id'];

    $sql2 = mysqli_query($conn,"SELECT u_id from positions WHERE u_id = '$u_id' AND id = '$position'");
    if (mysqli_num_rows($sql2)==1) {
        $sql = "INSERT INTO enroll (voters_id, position_id,status) VALUES ('$voterid', '$position','$status')";
        if($conn->query($sql)){
            $_SESSION['success'] = 'Election enroll successfully';
        }
        else{
            $_SESSION['error'] = $conn->error;
        }
    }
    else
    {
        $_SESSION['error'] = 'Could not join this election with that code. Double-check the code or try another one. ';

    }


}
else{
    $_SESSION['error'] = 'Error while enrolling the election';
}

header('location: votes_enrolling.php');
?>