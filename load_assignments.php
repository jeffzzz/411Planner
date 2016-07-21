<?php
include("db_config.php");
 $sql = "SELECT assignid, class, description, progress, time_spent, duedate FROM `assignments` WHERE email= '" . $_COOKIE['email'] . "' ORDER BY duedate";
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
 	while($row = $result->fetch_array(MYSQL_ASSOC))
{
	$tr = "<tr id=". $row['assignid'] . "><td>".$row['class']."</td>";
	$tr .= "<td>".$row['duedate']."</td>";
	$tr .= "<td>".$row['description']."</td>";
	$tr .= "<td class=\"progress_cell\"><div class=\"progress\"><div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"". $row['progress'] ."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: " . $row['progress'] . "%\"></div></div><p class=\"text-center\">Hours Worked: ". $row['time_spent'] ."</p></td>";
	$tr .= "<td><button class=\"remove-btn btn btn-default btn-sm\"><i class=\"glyphicon glyphicon-remove\"></i></button></span></td></tr>";
	echo $tr;
}
 }else{
 	echo "alert(\"error\")";
}
?>
