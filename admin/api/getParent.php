<?php
include '../dbConn.php';
header('Content-Type: application/json');
if(isset($_GET['id'])){
	$cid = $_GET['id'];
	$sql = "SELECT * FROM `chapters` WHERE `course_id` LIKE '$cid' AND `is_parent` LIKE '0'";
	$option = '';
	if($result = mysqli_query($con, $sql)){
		while($row=mysqli_fetch_row($result)){
			$option .= '<option value='.$row[0].'>'.$row[2].'</option>';
		}
	}
}
echo '{"success":true, "values":"'.$option.'"}';
?>