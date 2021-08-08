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
        $stats = "delete election name";
        $catg = "Admin";
        $logdate = date('Y/m/d H:i:s');
		$sql = "DELETE FROM positions WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Position deleted successfully';
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

	header('location: positions.php');
	
?>