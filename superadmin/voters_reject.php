<?php
include 'includes/session.php';

if(isset($_POST['reject'])){
    $id = $_POST['id'];

    $sql = "SELECT * FROM voters WHERE id = $id";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    $sql = "DELETE FROM voters WHERE id = '$id'";
    if($conn->query($sql)){
        $_SESSION['success'] = 'The pending voter has been rejected!';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
    $phone = $row['phone'];
    $msg = 'Sorry your registration for E-Undi as VOTER has been rejected. Please try register again.';
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
    $_SESSION['error'] = 'Select item to delete first';
}

header('location: voters.php');

?>