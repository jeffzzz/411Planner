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
$arr = array();
if(!empty($_POST['val'])){
		$val = $conn->real_escape_string($_POST['val']);
		$sql = "SELECT meetingid AS id, title, starttime, endtime FROM meetings WHERE email='" . $_COOKIE['email'] . "' and title LIKE '" . $val . "%'";
		$result = $conn->query($sql);
		if(($result->num_rows) > 0)
		{
			while($row = $result->fetch_object()){
				$stime = date("h:i:s A",strtotime($row->starttime));
				$etime = date("h:i:s A",strtotime($row->endtime));
				$sday = date("m/d/Y",strtotime($row->starttime));
				$arr[] = array('id' => $row->id, 'title' => $row->title, 'day' => $sday, 'stime' => $stime, 'etime' => $etime);
			}
		}
}
echo json_encode($arr);
?>