<?php
include 'includes/session.php';
$userid = $_POST['userid'];

$sql = "SELECT * FROM positions WHERE positions.id=".$userid." ORDER BY priority ASC" ;
$query = $conn->query($sql);
while($row = $query->fetch_assoc()){
    $id = $row['id'];
    echo "
           <div class='box-body'>
              <table id='example1' class=table table-bordered>
                <thead>
        		<tr>
        			<td class='text-center'><b>".$row['description']."</b></td>
        		</tr>
        		<tr>
        			<th class='text-center'><b>Candidates</b></th>
        			<th class='text-center' ><b>Votes</b></th>
        		</tr>
        		</thead>
        		</table>
        		</div>
        		
        	";

    $sql = "SELECT * FROM candidates WHERE position_id = '$id' ORDER BY firstname ASC";
    $cquery = $conn->query($sql);
    while($crow = $cquery->fetch_assoc()){
        $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
        $vquery = $conn->query($sql);
        $votes = $vquery->num_rows;

        echo"
            <div class='box-body'>
              <table id='example1' class=table table-bordered>
      				<tr>
      					<td width='80%' >".$crow['firstname']." ".$crow['lastname']."</td>
      					<td width='50%' >".$votes."</td>
      				</tr>
      				</table>
        		</div>
      			";

    }

}
?>