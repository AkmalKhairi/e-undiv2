<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$description = $_POST['description'];
		$max_vote = $_POST['max_vote'];


		$sql = "SELECT * FROM positions ORDER BY priority DESC LIMIT 1";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		$priority = $row['priority'] + 1;
        $status = "Pending";
        $created = $user['admin_id'];
        $sql = "INSERT INTO positions (created_by, description, max_vote, priority,status) VALUES ('$created','$description', '$max_vote', '$priority', '$status')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Position added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: positions.php');
?>