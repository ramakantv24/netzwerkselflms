<?php
include 'dbConn.php';
if(isset($_GET['i']) AND isset($_GET['c']) AND isset($_GET['ogValue'])){

	$sql_id 		= $_GET['ogValue'];
	$orderStructure = $_GET['c'];
	$chapterId 		= $_GET['i'];
	$sql = "UPDATE `chapters` SET `orderStructure` = '$orderStructure' WHERE `ID` LIKE '$sql_id' AND `course_id` = '$chapterId'";
	if(mysqli_query($con, $sql))
		echo '{"success":true}';
}
?>