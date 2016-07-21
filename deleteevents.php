<?php
include("db_config.php");
$id = $_POST['id'];

$servername = $DB_SERVER_NAME;
$username = $DB_USERNAME;
$password = $DB_PASSWORD;
$dbname = $DB_NAME;
$conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error)
{
 die('Connection Failed: ' . $conn->connect_error);
}
$sql = "DELETE from meetings WHERE meetingid= '".$id . "' and email= '" . $_COOKIE['email'] ."'";
$q = $conn->query($sql);
$conn->close();
?>