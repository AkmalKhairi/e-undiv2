<?php
	include 'includes/session.php';

	if(isset($_POST['add'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $position = $_POST['position'];
        $candidate = $_POST['candidate'];
        $platform = $_POST['platform'];
        $filename = $_FILES['photo']['name'];
        if (!empty($filename)) {
            move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $filename);
        }
        $sql2 = mysqli_query($conn, "SELECT candidate_id from candidates WHERE candidate_id = '$candidate'");
        if (mysqli_num_rows($sql2) == 1) {
            echo '<script language="javascript">';
            echo 'alert("Candidate already exist")';
            echo '</script>';
            echo("<script>location.href='index.php'</script>");
        } else {
            $date = date('Y-m-d');
            $status = "Not Verified";
            $sql = "INSERT INTO candidates (position_id, candidate_id, firstname, lastname, password, photo, platform, status) VALUES ('$position', '$candidate', '$firstname', '$lastname', '$password', '$filename', '$platform', '$status')";
            if ($conn->query($sql)) {
                $_SESSION['success'] = 'Candidate added successfully';
            } else {
                $_SESSION['error'] = $conn->error;
            }

        }
    }
	else{
		$_SESSION['error'] = 'Fill up the form first';
	}

	header('location: index.php');
?>