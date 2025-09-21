<?php
include 'session.php';
$msg = $_GET['msg'];
$uid = $_GET['uid'];
$sql = "INSERT into `chat` (`uid`,`message`,`admin`) VALUES('$uid','$msg','1')";
if(mysqli_query($con, $sql)){
	//echo 'Thank you for your message. We will get back to you shortly';
}