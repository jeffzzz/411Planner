<?php
include("db_config.php");
try{
 $json = array();
 $sql = "SELECT meetingid AS id, title, starttime AS start, endtime AS end, allDay FROM `meetings` WHERE email= '" . $_COOKIE['email'] . "' ORDER BY `meetingid`";
$servername = $DB_SERVER_NAME;
$username = $DB_USERNAME;
$password = $DB_PASSWORD;
$dbname = $DB_NAME;
$conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error)
{
 die('Connection Failed: ' . $conn->connect_error);
} 
if($result = $conn->query($sql))
 {
 	// echo "New record submitted";
 }else{
 	// echo "Error: " . $sql . "<br>" . $conn->error;
 }
while($row = $result->fetch_array(MYSQL_ASSOC))
{
	$e = array();
	$e['id'] = $row['id'];
	$e['title'] = $row['title'];
	$e['start'] = $row['start'];
    $e['end'] = $row['end'];
    $e['allDay'] = false;
	array_push($json, $e);
}
echo json_encode($json);
exit();
} catch (mysqli_sql_exception $except)
{
	echo $except->getMessage();
}
?>