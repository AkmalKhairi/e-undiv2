<?php
include 'includes/session.php';

$userid = $_POST['userid'];

$sql = "SELECT * FROM votes LEFT JOIN candidates ON candidates.id=votes.candidate_id LEFT JOIN positions ON positions.id=votes.position_id WHERE votes.voters_id=".$userid;
$result = mysqli_query($conn,$sql) or die( mysqli_error($conn));

$response = "<table border='0' width='100%'>";
while( $row = mysqli_fetch_array($result) ){
    $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
    $fname = $row['firstname'];
    $lname = $row['lastname'];

    $response .= "<tr>";
    $response .= "<td><span style='padding-left: 50px;'><img src='".$image."' width='80px' height='80px'></td>";
    $response .= "<td style='padding-left: 50px; font-size: 20px;'> Name :".$fname.' '.$lname."</span></td>";
    $response .= "</tr>";

}
$response .= "</table>";

echo $response;
exit;