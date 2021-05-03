<form action="" method="POST">
    <input type="text" name="search">
    <input type="submit" name="submit" value="Search">
</form>
<?php
if (isset($_POST['voters_id'])) {
    $searchValue = $_POST['status'];
    include 'includes/conn.php';
    if ($conn->connect_error) {
        echo "connection Failed: " . $conn->connect_error;
    } else {
        $sql = "SELECT status FROM voters WHERE voters_id LIKE '%$searchValue%'";

        $result = $conn->query($sql);
        if ($result->num_rows>0){
            $row = $result->fetch_assoc();
            header( "refresh:3;url=verification.php" );
            echo 'Page will auto refresh';
            echo $row['status'];
        }
        mysqli_free_result($result);
        mysqli_close($conn);

    }
}
?>