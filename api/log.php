<?php
include 'session.php';
$msg = $_GET['msg'];
//echo $msg.$uid;
$sql = "INSERT into `chat` (`uid`,`message`) VALUES('$uid','$msg')";
if(mysqli_query($con, $sql)){
	echo 'Thank you for your message. We will get back to you shortly';
}