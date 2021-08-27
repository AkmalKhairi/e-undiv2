<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$voter = ($_POST['voter']);
		$password = $_POST['password'];

        $status = "Verified";
        $sql = "SELECT * FROM voters WHERE voters_id = '$voter' AND status = '$status'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Incorrect credentials or account not Verify yet.';
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['voter'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
		}
        $sql2 = "UPDATE voters SET logintime = CURRENT_TIMESTAMP WHERE voters_id = '$voter'";
        $vquery = $conn->query($sql2);
	}


else{
		$_SESSION['error'] = 'Input voter credentials first';
	}

	header('location: testmodal.php');

?>