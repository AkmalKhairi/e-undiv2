<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$description = $_POST['description'];
		$max_vote = $_POST['max_vote'];

        $created = $user['admin_id'];
        $fname = $user['firstname'];
        $stats = "edit election name";
        $catg = "Admin";
        $logdate = date('Y/m/d H:i:s');

		$sql = "UPDATE positions SET description = '$description', max_vote = '$max_vote' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Position updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
        $sql2 = "INSERT INTO logfile (date, firstname, nric, status, description, category) VALUES ('$logdate','$fname','$created','$stats','$description','$catg')";
        $query = $conn->query($sql2);
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: positions.php');

?>