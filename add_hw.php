<?php
/**
 * Created by PhpStorm.
 * User: enriqueespaillat
 * Date: 4/15/15
 * Time: 11:36 PM
 * "clas" : $("#class").val(),
"desc" : $("#desc").val(),
"due" : $("#due").val(),
"est" : $("#est").val,
"hoursWorked" : $("hoursworked").val(),
"percentComplete" : $("percentcomp").val()
 */
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
$class = $conn->real_escape_string($_POST['clas']);
$desc = $conn->real_escape_string($_POST['desc']);
$due = $conn->real_escape_string($_POST['due']);
$est = $conn->real_escape_string($_POST['est']);
$hoursWorked = $conn->real_escape_string($_POST['hoursWorked']);
$percentComplete = $conn->real_escape_string($_POST['percentComplete']);

$sql = "INSERT INTO assignments (email, class, description, estimated_time, time_spent, duedate, progress)
VALUES ('" . $_COOKIE['email']  . "', '" . $class . "' ,'" . $desc . "', '" . $est . "',
'" . $hoursWorked . "', '" . $due . "', '" . $percentComplete . "' )";
$result=$conn->query($sql);
$id = mysqli_insert_id($conn);
echo $class;

$conn->close();

?>