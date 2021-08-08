<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$position = $_POST['position'];
		$platform = $_POST['platform'];

        $sql = "SELECT * FROM positions ORDER BY priority DESC LIMIT 1";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();

        $description = $row['description'];

        $created = $user['admin_id'];
        $fname = $user['firstname'];
        $stats = "edit candidate $firstname as a candidate for";
        $catg = "Admin";
        $logdate = date('Y/m/d H:i:s');

		$sql = "UPDATE candidates SET firstname = '$firstname', lastname = '$lastname', position_id = '$position', platform = '$platform' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Candidate updated successfully';
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

	header('location: candidates.php');

?>