<?php
include("db_config.php");
/* Values received via ajax */
$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

// connection to the database
$servername = $DB_SERVER_NAME;
$username = $DB_USERNAME;
$password = $DB_PASSWORD;
$dbname = $DB_NAME;
	$conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error)
    {
     die('Connection Failed: ' . $conn->connect_error);
    }
// update the records
$sql = "UPDATE meetings SET title='" . $title . "', starttime='" . $start . "', endtime='" . $end . "' WHERE meetingid='" . $id . "' and email='" . $_COOKIE['email'] . "'";
echo $sql;
$conn->query($sql);
?>