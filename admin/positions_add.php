<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$description = $_POST['description'];
		$max_vote = $_POST['max_vote'];
        $date = $_POST['date'];
        $newdate = date("Y-m-d H:i:s",strtotime($date));
        $uid=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 5);

        $sql = "SELECT * FROM positions ORDER BY priority DESC LIMIT 1";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		$priority = $row['priority'] + 1;
        $status = "Pending";
        $created = $user['admin_id'];
        $fname = $user['firstname'];
        $stats = "create election name";
        $catg = "Admin";
        $logdate = date('Y/m/d H:i:s');
        $sql = "INSERT INTO positions (u_id,created_by, description, max_vote, priority,status,nominationdate) VALUES ('$uid','$created','$description', '$max_vote', '$priority', '$status','$newdate')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Position added successfully';
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

	header('location: positions.php');
?>