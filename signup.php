<?php
include("db.php");
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);
$university = $conn->real_escape_string($_POST['university']);
$exists = $conn->query("SELECT `email` FROM `user` WHERE `email` = '".$email."'");
if(mysqli_num_rows($exists))
{
    header("location:http://myplanner.web.engr.illinois.edu/index.php");
}
$sql = "INSERT INTO `user` (`email`, `password`, `university`) VALUES ('" . $email . "' , '" . $password . "', '" . $university . "')";
if($conn->query($sql) === true)
{
    header("location:http://myplanner.web.engr.illinois.edu/myplanner.php");
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>