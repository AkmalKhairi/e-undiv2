<?php
include 'includes/conn.php';
session_start();

if(isset($_SESSION['voter'])){
    $sql = "SELECT * FROM voters WHERE id = '".$_SESSION['voter']."'";
    $query = $conn->query($sql);
    $voter = $query->fetch_assoc();
}
elseif (!isset($_SESSION['superadmin']) || trim($_SESSION['superadmin']) == ''){
    header('location: index.php');

    $sql = "SELECT * FROM superadmin WHERE id = '".$_SESSION['superadmin']."'";
    $query = $conn->query($sql);
    $user = $query->fetch_assoc();
}

else{
    header('location: index.php');
    exit();
}

?>