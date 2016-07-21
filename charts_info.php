<?php
include("db_config.php");
$servername = $DB_SERVER_NAME;
$username = $DB_USERNAME;
$password = $DB_PASSWORD;
$dbname = $DB_NAME;
$conn = new mysqli($servername, $username, $password, $dbname);
/*  		 */

 if ($conn->connect_error)
{
 die('Connection Failed: ' . $conn->connect_error);
} 
$arr = array();
$json;
if($_POST['type'] == 0)
{
 $sql0 = "SELECT class from assignments WHERE email = '".$_COOKIE['email']."' ORDER BY duedate LIMIT 5" ;
 
 if($result = $conn->query($sql0))
 {
 	while($row = $result->fetch_array(MYSQL_ASSOC))
 	{
	 	 $sql = "SELECT IFNULL(SUM(time_spent),0) AS total FROM assignments WHERE email =  '". $_COOKIE['email'] ."' AND class =  '". $row['class'] ."'";
	 	 $sql2 = "SELECT IFNULL(AVG(time_spent),0) AS totalClass
				FROM assignments AS a
				INNER JOIN user AS u
				WHERE a.email = u.email
				AND a.class =  '".$row['class']."'
				AND a.email <> '". $_COOKIE['email']. "'
				AND u.university = ( 
				SELECT university
				FROM user
				WHERE email =  '".$_COOKIE['email']."' ) 
				GROUP BY class
				LIMIT 1";
	 	 if(($count = $conn->query($sql)) && ($classCount = $conn->query($sql2)))
	 	 {
		 	 $arr[] = array(className => $row['class'], 
		 	 hours => $count->fetch_array(MYSQL_ASSOC)['total'], 
		 	 classhours => $classCount->fetch_array(MYSQL_ASSOC)['totalClass']);
	 	 }
 	}
 	$json = json_encode($arr);
 	echo $json;

}}
else if($_POST['type'] == 1)
{
	$sql0 = "SELECT class, SUM(time_spent) as total from assignments WHERE email = '".$_COOKIE['email']."' GROUP BY class ORDER BY total LIMIT 5" ;
	if($result = $conn->query($sql0))
{
	while($row = $result->fetch_array(MYSQL_ASSOC))
 	{
		 	 $arr[] = array(label => $row['class'], 
		 	 value => $row['total']);
 	}
 	$json = json_encode($arr);
 	echo $json;
}
}

?>