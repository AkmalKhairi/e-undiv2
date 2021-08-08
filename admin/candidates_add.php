<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$position = $_POST['position'];
        $candidate = $_POST['candidate_id'];
		$platform = $_POST['platform'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
        $status = 'Approve';

        $sql = "SELECT * FROM positions ORDER BY priority DESC LIMIT 1";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();

        $description = $row['description'];
        $created = $user['admin_id'];
        $fname = $user['firstname'];
        $stats = "add candidate $firstname as a candidate for";
        $catg = "Admin";
        $logdate = date('Y/m/d H:i:s');

		$sql = "INSERT INTO candidates (position_id, candidate_id, firstname, lastname, photo, platform,status) VALUES ('$position','$candidate' ,'$firstname', '$lastname', '$filename', '$platform','$status')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Candidate added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
        $sql2 = "INSERT INTO logfile (date, firstname, nric, status, description, category) VALUES ('$logdate','$fname','$created','$stats','$description','$catg')";
        $query = $conn->query($sql2);
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: candidates.php');
?>