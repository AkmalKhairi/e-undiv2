<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$candidate = ($_POST['candidate']);
		$password = $_POST['password'];

        $status = "Verified";
        $sql = "SELECT * FROM candidates WHERE candidate_id = '$candidate' AND status = '$status'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Incorrect credentials or account not Verify yet.';
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['candidate'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
		}
        /*$sql2 = "UPDATE voters SET logintime = CURRENT_TIMESTAMP WHERE voters_id = '$voter'";
        $query = $conn->query($sql2);*/
	}


else{
		$_SESSION['error'] = 'Input candidate credentials first';
	}

	header('location: index.php');

?>