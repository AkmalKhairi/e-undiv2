<?php
include 'includes/session.php';
$userid = $_POST['userid'];
$sql = "SELECT *, positions.id AS posid FROM candidates LEFT JOIN positions ON candidates.position_id=positions.id WHERE positions.id='$userid'";
$result = mysqli_query($conn,$sql) or die( mysqli_error($conn));
    while ($row = mysqli_fetch_array($result)) {
        $p_id = $row['posid'];
        $dsc = $row['description'];
        $votid = $voter['id'];
    }

$sql3 = "SELECT COUNT(*) AS count FROM enroll WHERE position_id='$p_id' AND voters_id = '$votid'";
$squery = $conn->query($sql3);


while($vrow = $squery->fetch_assoc()){
    $countrow = $vrow['count'];
}
if ($countrow == 0) {
echo "
            <form class='form-horizontal' method='POST' action='votes_enrolled.php'>
                <input type='hidden' class='id' name='id'>
                <div class='text-center'>
                    <p>ENROLL IN THE ELECTION?</p>
                    <input type='hidden' class='posid' name='posid' value='" .$p_id. "'>
                    <h2 class='bold'>".$dsc."</h2>
                </div>
            </div>
            <div class='modal-footer'>
            <div class='form-group'>
                    <label for='u_id' class='col-sm-3 control-label'>Election Code:</label>

                    <div class='col-sm-9'>
                    	<input type='text' class='form-control' id='u_id' name='u_id' maxlength='5' minlength='5' required >
                    </div>
                </div>
            <button style='padding: 5px 15px; width: 100%; font-size: 20px;' type='submit' class='btn btn-success btn-flat' name='enroll'><i class='fa fa-check-square-o'></i> Enroll</button>
              </form>";
}
elseif ($countrow > 0){
        echo "
        <div class='text-center'>
        <img src='../images/check.gif' style='width:60px;height:60px;'>
        <h3><b>You have already enrolled for this election.</b></h3>
        <p>Please wait for the election to start</p>

    </div>
    ";

}
?>
