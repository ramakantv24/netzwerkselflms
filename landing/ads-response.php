<?php
include '../admin/dbConn.php';
$postdata = $_POST;
$msg = '';
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 12; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

if (isset($postdata ['key'])) {
	$key				=   $postdata['key'];
	$salt				=   '98VYR9A7yH';
	$txnid 				= 	$postdata['txnid'];
    $amount      		= 	$postdata['amount'];
	$productInfo  		= 	$postdata['productinfo'];
    $mobile             =   $postdata['phone'];
	$firstname    		= 	$postdata['firstname'];
	$email        		=	$postdata['email'];
	$udf5				=   $postdata['udf5'];
	$mihpayid			=	$postdata['mihpayid'];
	$status				= 	$postdata['status'];
	$resphash			= 	$postdata['hash'];
    $payuID             =   $postdata['payuMoneyId'];
	//Calculate response hash to verify	
	$keyString 	  		=  	$key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||'.$udf5.'|||||';
	$keyArray 	  		= 	explode("|",$keyString);
	$reverseKeyArray 	= 	array_reverse($keyArray);
	$reverseKeyString	=	implode("|",$reverseKeyArray);
	$CalcHashString 	= 	strtolower(hash('sha512', $salt.'|'.$status.'|'.$reverseKeyString));
	//echo $productInfo;
    if($amount=="2499" AND $status=='success' AND $productInfo=="Advance Data Science"){
        $password = randomPassword();
        $enc_password = md5(md5($password));
        $ip = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');
        $sql = "INSERT into `users`(`email`,`mobile`,`password`,`ip`,`uname`,`payuID`,`internatID`) VALUES('$email','$mobile','$enc_password','$ip','$firstname','$payuID','$txnid')";
        $result = mysqli_query($con, $sql);
        if($result){
            $last_id = $con->insert_id;
        }else{
            $sql = "SELECT `ID` FROM `users` WHERE `email` LIKE '$email'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($result);
            $last_id = $row[0];
        }

        $sql = "INSERT into `course_user`(`user_id`,`course_id`) VALUES('$last_id','1')";
        mysqli_query($con, $sql);

        $msg = 'Thank you. Your Transaction ID is <b>'.$txnid.'.</b> You will receive E-Mail with login ID and password soon.';
        echo $msg;
    }
}
else exit(':)');
?>