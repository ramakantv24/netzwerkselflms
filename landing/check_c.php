<?php
header('Content-type: application/json');
include '../admin/dbConn.php';
$course_id = $_GET['cid'];
$email = $_GET['email'];

$sql = "SELECT `ID` FROM `users` WHERE `email` LIKE '$email'";
if($result = mysqli_query($con, $sql)){
    $row = mysqli_fetch_row($result);
    if($row[0]){
        $user_id = $row[0];
        $sql = "SELECT * FROM `course_user` WHERE `user_id` LIKE '$user_id' AND `course_id` LIKE '$course_id'";
		//echo $sql;
        if($result=mysqli_query($con, $sql)){
            $count = mysqli_num_rows($result);
            if($count>0){
                echo '{"success":true}';
                exit();
            }else{
                echo '{"success":false,"message":"Account exist but not the course"}';
                exit();    
            }
        }
    }else{
        echo '{"success":false,"message":"Account email not exist"}';
        exit();
    }
}else{
    echo '{"success":false}';
    exit();
}