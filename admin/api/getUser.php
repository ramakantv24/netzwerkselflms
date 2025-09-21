<?php
include 'session.php';
$uid = $_GET['id'];
$cname = array();
$sql = "SELECT `email`,`mobile`,`uname` FROM `users` WHERE `ID` LIKE '$uid'";
if($result = mysqli_query($con, $sql)){
	while ($row = mysqli_fetch_row($result)) {
		$email = $row[0];
		$mobile = $row[1];
		$uname = $row[2];
		$sql = "SELECT `course_name` FROM `courses` WHERE ID IN (SELECT `course_id` FROM `course_user` WHERE `user_id` LIKE '$uid')";
		if($result = mysqli_query($con, $sql)){
			while ($row = mysqli_fetch_row($result)) {
				array_push($cname, $row[0]);
			}
		}
	}
}

echo '<tr><td>'.$uname.'</td><td>'.$email.'</td><td>'.$mobile.'</td><td>'.json_encode($cname).'</td></tr>';