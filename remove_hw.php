<?php
include("db_config.php");
$servername = $DB_SERVER_NAME;
$username = $DB_USERNAME;
$password = $DB_PASSWORD;
$dbname = $DB_NAME;
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
{
    die('Connection Failed: ' . $conn->connect_error);
}
$id = $_POST['id'];
$sql = "DELETE from assignments WHERE assignid= '".$id . "' and email= '" . $_COOKIE['email'] ."'";
$result=$conn->query($sql);

$conn->close();
?>