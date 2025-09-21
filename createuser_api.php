<?php
	echo "<pre>";
	print_r($_REQUEST);
	
	echo "<pre>";
	print_r($_SERVER);exit;
	
	include 'admin/dbConn.php';
    $msg = '';
    if(isset($_POST['email'])){
		
		$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
		$password = substr(str_shuffle($data), 0, 8);
		
        $user_name  = $_POST['user_name'];
        $email      = $_POST['email'];
        $password   = md5(md5($password));
        $mobile_no  = $_POST['mobile_no'];
        $courseIDS  = $_POST['course_id'];
        $my_ip      = $_SERVER['REMOTE_HOST'];
        $timestamp  = date('Y-m-d H:i:s');
        $payuID     = $_POST['payuID'];
        $internatID = $_POST['internatID'];
        $hash       = md5($email.$password.mt_rand(00000000,9999999));
		
		
		$sql22 = "SELECT * FROM `users` WHERE `email` = '$email'";
		$user22SQLRes     = mysqli_query($con,$sql22); 
		$user22Row        = mysqli_fetch_assoc($user22SQLRes);
		
		if(empty($user22Row['ID'])){
			
			$sqlMode = "INSERT INTO users SET uname='".$user_name."',email='".$email."',password='".$password."',mobile='".$mobile_no."',status='1',ip='".$my_ip."',timestamp='".$timestamp."',hash='".$hash."',payuID='".$payuID."',internatID='".$internatID."'";
		
			$response = mysqli_query($con,$sqlMode);
			$user_id  = $con->insert_id;
			
			if(isset($user_id)){
				foreach($courseIDS as $course_id){
				  $sqlCourseToUser = "INSERT INTO course_user SET user_id='".$user_id."',course_id='".$course_id."'";
				  $response = mysqli_query($con,$sqlCourseToUser);
				}
			}
			if(isset($user_id)){
				echo "Successfully create user!";
			}
		}
    }
	
?>
