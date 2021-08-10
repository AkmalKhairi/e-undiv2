<?php
//DEVELOPMENT CONNECTION
/*$conn = new mysqli('localhost', 'root', '', 'votesystem');*/

//REMOTE CONNECTION
/*$conn = new mysqli('remotemysql.com', 'OchgSe0SEu', 'AfYgpkIlWY', 'OchgSe0SEu');*/

//JAWSDB CONNECTION
$conn = new mysqli('ro2padgkirvcf55m.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'gzrevp3i7iopfcb5', 'z9ocealdamxnd3r2', 'b4dnswyw8qdfmmbd');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>