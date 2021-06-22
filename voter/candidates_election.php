<?php
include 'includes/session.php';
$userid = $_POST['userid'];

$sql = "SELECT * FROM positions LEFT JOIN candidates ON positions.id=candidates.position_id WHERE positions.id=".$userid." ORDER BY priority ASC" ;
$query = $conn->query($sql);
while($row = $query->fetch_assoc()){
    $id = $row['id'];
    if ($row['candidate_id'] != $voter['voters_id']) {
        $sql2 = "SELECT * FROM positions WHERE positions.id=" . $userid . " ORDER BY priority ASC";
        $vquery = $conn->query($sql2);
        while ($crow = $vquery->fetch_assoc()) {
            $id = $crow['id'];
            echo "
<form class='form-horizontal' method='POST' action='candidates_add.php' enctype='multipart/form-data'>
<div class='form-group'>
     <label for='firstname' class='col-sm-3 control-label'>Firstname</label>

    <div class='col-sm-9'>
    <input type='text' class='form-control' id='firstname' name='firstname' disabled value='" . $voter['firstname'] . "'>
</div>
</div>

<div class='form-group'>
    <label for='lastname' class='col-sm-3 control-label'>Lastname</label>
                    <div class='col-sm-9'>
        <input type='text' class='form-control' id='lastname' name='lastname' disabled value='" . $voter['lastname'] . "'>
</div>
</div>

<div class='form-group'>
    <label for='nric' class='col-sm-3 control-label'>ID</label>

<div class='col-sm-9'>
        <input type='text' class='form-control' id='nric' name='nric' disabled value='" . $voter['voters_id'] . "'>
</div>
</div>

<div class='form-group'>
    <label for='position' class='col-sm-3 control-label'>Position</label>

<div class='col-sm-9'>
                      <select class='form-control' id='position' name='position'>
                        <option value='" . $crow['id'] . "'>" . $crow['description'] . "</option>
                      </select>
                    </div>
                </div>

<div class='form-group'>
    <label for='photo' class='col-sm-3 control-label'>Photo</label>

    <div class='col-sm-9'>
        <input type='file' id='photo' name='photo'>
    </div>
</div>
<div class='form-group'>
    <label for='platform' class='col-sm-3 control-label'>Manifesto</label>

    <div class='col-sm-9'>
        <textarea class='form-control' id='platform' name='platform' rows='7'></textarea>
    </div>
</div>

    <div class='modal-footer'>
              <button type='submit' class='btn btn-success btn-flat btn-block' name='add'><i class='fa fa-check'></i> Submit</button>
              </form>
     </div>
        		
        	";
        }
    }
    elseif ($row['candidate_id'] == $voter['voters_id']){
        echo "
        <div class='text-center'>
        <img src='../images/check.gif' style='width:60px;height:60px;'>
        <h3><b>You have already register for this election.</b></h3>
        <p>Please wait for the confirmation</p>

    </div>
    ";
    }
}
?>