<?php
include 'session.php';
$uid = $_GET['id'];
$return = '';
$sql = "SELECT `message`,`admin` FROM `chat` WHERE `uid` LIKE '$uid'";
if($result = mysqli_query($con, $sql)){
	while ($row = mysqli_fetch_row($result)) {
		$admin = $row[1];
		if($admin==0){
			$return .= '<div class="row msg_container base_receive"><div class="col-md-10 col-xs-10"><div class="messages msg_receive"><p>'.$row[0].'</p></div></div></div>';
		}else{
			$return .= '<div class="row msg_container base_sent"><div class="col-md-10 col-xs-10"><div class="messages msg_sent"><p>'.$row[0].'</p></div></div></div>';
		}
	}
}

$sql = "UPDATE `chat` SET `view`='1' WHERE `uid` LIKE '$uid'";
mysqli_query($con, $sql);
echo $return;