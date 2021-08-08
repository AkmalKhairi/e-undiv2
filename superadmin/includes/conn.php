<?php
//DEVELOPMENT CONNECTION
/*$conn = new mysqli('localhost', 'root', '', 'votesystem');*/

//REMOTE CONNECTION
$conn = new mysqli('remotemysql.com', 'OchgSe0SEu', 'AfYgpkIlWY', 'OchgSe0SEu');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>