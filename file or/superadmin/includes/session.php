<?php
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['superadmin']) || trim($_SESSION['superadmin']) == ''){
		header('location: index.php');
	}

	$sql = "SELECT * FROM superadmin WHERE id = '".$_SESSION['superadmin']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();
	
?>