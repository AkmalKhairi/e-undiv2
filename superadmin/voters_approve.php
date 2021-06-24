<?php
include 'includes/session.php';

if(isset($_POST['approval'])){
    $id = $_POST['id'];

    $sql = "SELECT * FROM voters WHERE id = $id";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

/*    $date = date('Y-m-d');*/
    $status = "Verified";
    $sql = "UPDATE voters SET status = '$status' WHERE id = '$id'";
/*    $sql = "UPDATE admin SET status = '$status' AND created_on = '$date' WHERE id = '$id'";*/

    if($conn->query($sql)){
        $_SESSION['success'] = 'Voter successfully approved!';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
    $sql2 = "UPDATE voters SET voters_id = CONCAT(REPEAT('*', CHAR_LENGTH(voters_id) - 12), SUBSTR(voters_id, -4)) WHERE id = '$id'";
    $query = $conn->query($sql2);
    $phone = $row['phone'];
    $msg = 'Your registration for E-Undi as VOTER has been approved!';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://terminal.adasms.com/api/v1/send?_token=Ttt0CyBcykoisEHdUS609mcRSbinOwpR&phone=6".$phone."&message=".$msg,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
    }
else{
    $_SESSION['error'] = 'Error approving Voter';
}

header('location: voters.php');

?>