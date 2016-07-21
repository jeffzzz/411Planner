<?php
include("db.php");
$email=$conn->real_escape_string($_POST['email']);
$password=$conn->real_escape_string($_POST['password']);
$sql = "SELECT count(*) FROM user WHERE email='" . $email . "' and password='" . $password . "'";
$result=$conn->query($sql);
if($result->fetch_row()[0] > 0){
	unset($_COOKIE['email']);
	setcookie('email',$email, strtotime("2 days"), "/");
	$row = $result->fetch_assoc();
    header("location: http://myplanner.web.engr.illinois.edu/myplanner.php");
    exit();
} else {
  echo 'Wrong Username or Password! Return to <a href="index.php">login</a>';
}
  $conn->close();
?>