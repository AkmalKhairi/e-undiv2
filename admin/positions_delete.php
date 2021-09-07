<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

        $sql = "SELECT * FROM positions ORDER BY priority DESC LIMIT 1";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();

        $description = $row['description'];
        $created = $user['admin_id'];
        $fname = $user['firstname'];
        $stats = "cancel election name";
        $catg = "Admin";
        $logdate = date('Y/m/d H:i:s');
        $status = "Cancelled";
        $sql = "UPDATE positions SET status = '$status' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Voting Session Cancelled Successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
        $sql2 = "INSERT INTO logfile (date, firstname, nric, status, description, category) VALUES ('$logdate','$fname','$created','$stats','$description','$catg')";
        $query = $conn->query($sql2);
	}
	else{
		$_SESSION['error'] = 'Select item to cancel first';
	}

	header('location: positions.php');
	
?>