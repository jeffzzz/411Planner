<?php
include("db_config.php");
/* Values received via ajax */

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
    $id = $conn->real_escape_string($_POST['id']);
$hoursWorked = $conn->real_escape_string($_POST['hours']);
$percentComplete = $conn->real_escape_string($_POST['progress']);

// update the records
$sql = "UPDATE assignments SET time_spent = time_spent + '" . $hoursWorked . "', progress= '" . $percentComplete . "' WHERE assignid= '" . $id . "' and email='" . $_COOKIE['email'] . "'";
$conn->query($sql);
$conn->close();
?>