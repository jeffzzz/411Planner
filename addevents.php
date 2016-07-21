<?php
include("db_config.php");
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$servername = $DB_SERVER_NAME;
$username = $DB_USERNAME;
$password = $DB_PASSWORD;
$dbname = $DB_NAME;
	$conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error)
    {
     die('Connection Failed: ' . $conn->connect_error);
    }
$sql = "INSERT INTO meetings (title, starttime, endtime, email) VALUES ('" . $title . "', '" . $start . "' ,'" . $end . "', '" . $_COOKIE['email'] . "' )";
$result=$conn->query($sql);
$id = mysqli_insert_id($conn);
echo $id;
$conn->close();
?>