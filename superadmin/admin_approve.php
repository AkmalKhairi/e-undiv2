<?php
include 'includes/session.php';

if(isset($_POST['approval'])){
    $id = $_POST['id'];

    $sql = "SELECT * FROM admin WHERE id = $id";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    /*    $date = date('Y-m-d');*/
    $status = "Verified";
    $sql = "UPDATE admin SET status = '$status' WHERE id = '$id'";
    /*    $sql = "UPDATE admin SET status = '$status' AND created_on = '$date' WHERE id = '$id'";*/

    if($conn->query($sql)){
        $_SESSION['success'] = 'Admin successfully approved!';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
    $sql2 = "UPDATE admin SET admin_id = CONCAT(REPEAT('*', CHAR_LENGTH(admin_id) - 12), SUBSTR(admin_id, -4)) WHERE id = '$id'";
    $query = $conn->query($sql2);

    $phone = $row['phone'];
    $msg = 'Your registration for E-Undi account as ADMIN has been approved!';
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
    $_SESSION['error'] = 'Error approving admin';
}

header('location: admin.php');

?>