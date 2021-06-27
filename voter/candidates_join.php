<?php
include 'includes/session.php';
$userid = $_POST['userid'];

$sql = "SELECT * FROM candidates LEFT JOIN positions ON positions.id=candidates.position_id WHERE positions.id=".$userid;
$result = mysqli_query($conn,$sql) or die( mysqli_error($conn));

$response = "<table  class='table table-bordered align-middle'>";
$response .= "<thead>";
$response .= "<tr>";
$response .= "<th class='text-center'>Image</th>";
$response .= "<th class='text-center'>Name</th>";
$response .= "<th class='text-center'>Manifesto</th>";
$response .= "</tr>";
$response .= "</thead>";
while( $row = mysqli_fetch_array($result) ){
    $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
    $fname = $row['firstname'];
    $lname = $row['lastname'];
    $platform = $row['platform'];
    $response .= "<tbody>";
    $response .= "<tr>";
    $response .= "<td class='center-block'><img src='".$image."' width='80px' height='80px'></td>";
    $response .= "<td class='text-center' style='font-size: 18px;'> ".$fname.' '.$lname."</td>";
    $response .= "<td style='font-size: 18px;'>".$platform."</td>";
    $response .= "</tr>";
    $response .= "</tbody>";

}
$response .= "</table>";

echo $response;
exit;
?>