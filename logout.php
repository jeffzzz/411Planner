<?php
setcookie('email', "", strtotime('-2 days'));
ob_start();
header("location: http://myplanner.web.engr.illinois.edu/index.php");
ob_end_flush(); 
?>