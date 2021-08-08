<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

        $sql = "SELECT * FROM positions LEFT JOIN candidates ON positions.id=candidates.position_id ORDER BY priority DESC LIMIT 1";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();

        $firstname = $row['firstname'];
        $description = $row['description'];
        $created = $user['admin_id'];
        $fname = $user['firstname'];
        $stats = "remove candidate $firstname as a candidate for";
        $catg = "Admin";
        $logdate = date('Y/m/d H:i:s');

		$sql = "DELETE FROM candidates WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Candidate deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
        $sql2 = "INSERT INTO logfile (date, firstname, nric, status, description, category) VALUES ('$logdate','$fname','$created','$stats','$description','$catg')";
        $query = $conn->query($sql2);
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: candidates.php');
	
?>