<?php
ob_start();
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'landing/mailer/vendor/autoload.php';
function sendSignupEmail($emaill,$hashh) {
    
$sender           = 'info@netzwerkself.com';
$senderName       = 'Netzwerk Academy';
$recipient        = $emaill;
$usernameSmtp     = 'info@netzwerkself.com';
$passwordSmtp     = 'Va[g~T5m9Ly)';
//$configurationSet = 'ConfigSet';
$host             = 'netzwerkself.com';
$port             = 465;
$subject          = 'Reset Password';
$bodyText =  "Netzwerk Academy Reset Password";
$bodyHtml = ' <html>
        <head>
        <title>Reset Password</title> 
        </head>
        <body>
        <p>Hello,</p>
        <p><a href="https://www.netzwerkself.com/lms/set-password.php?h='.$hashh.'">Click Here</a> to set new password.
        </body>
        </html>';
		
	$mail = new PHPMailer(true);
	
	try { 
		$mail->isSMTP();
		$mail->SMTPDebug = false; 
		$mail->setFrom($sender, $senderName);
		//$mail->setFrom('no-reply@netzwerkacademy.com', 'Netzwerk Academy');
		$mail->Username   = $usernameSmtp;
		$mail->Password   = $passwordSmtp;
		$mail->Host       = $host;
		$mail->Port       = $port;
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = 'ssl';
		$mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);
		$mail->addAddress($recipient);
		$mail->addReplyTo('info@netzwerkacademy.com', 'Netzwerk Support Team');
		$mail->isHTML(true);
		$mail->Subject    = $subject;
		$mail->Body       = $bodyHtml;
		$mail->AltBody    = $bodyText;
		$mail->Send();
		//echo "Email sent!" , PHP_EOL;
	} catch (phpmailerException $e) {
		echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
	} catch (Exception $e) {
		echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
	}        
}
$msg = '';
if(isset($_POST['email'])){
	include 'admin/dbConn.php';
	$email = $_POST['email'];
	$sql = "SELECT * FROM `users` WHERE `email` LIKE '$email'";
	if($result = mysqli_query($con, $sql)){
		$count = mysqli_num_rows($result);
		if($count!=0){
			while ($row = mysqli_fetch_row($result)) {
				$hash = md5($email.$password.mt_rand(00000000,9999999));
				$ID = $row[0];
				$sql = "UPDATE `users` SET `hash` = '$hash' WHERE `ID` LIKE '$ID'";
				if(mysqli_query($con, $sql)){
					//header("Location: forgot-password.php?ex=RESET");
                    sendSignupEmail($email, $hash);
					$msg = '<b style="color:green;">Please check email for further instructions</b>';
				}
			}
		}else{
			$msg = '<b style="color:red;">Email does not exist!.</b>';
		}
	}
}

/* $htmlTemp = ' <html>
        <head>
        <title>Reset Password</title> 
        </head>
        <body>
        <p>Hello,</p>
        <p><a href="https://netzwerkself.com/lms/set-password.php?h='.$hashh.'">Click Here</a> to set new password.
        </body>
        </html>';

   $headers  = "MIME-Version: 1.0" . "\r\n";
   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
   $headers .= 'From: <no-reply@netzwerkacademy.com>' . "\r\n";
   $headers .= 'Cc: sandeepweb1990@gmail.com' . "\r\n";
   
	echo mail("sandeepsvi1990@gmail.com","Reset Password",$htmlTemp,$headers);exit; */

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Reset Password : LMS</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Yinka Enoch Adedokun">
<meta name="apple-mobile-web-app-title" content="CodePen">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<style>
.main-content{
	width: 50%;
	border-radius: 20px;
	box-shadow: 0 5px 5px rgba(0,0,0,.4);
	margin: 5em auto;
	display: flex;
}
.company__info{
	background-color: #ffffff;
	border-top-left-radius: 20px;
	border-bottom-left-radius: 20px;
	display: flex;
	flex-direction: column;
	justify-content: center;
	color: #fff;
}
.fa-android{
	font-size:3em;
}
@media screen and (max-width: 640px) {
	.main-content{width: 100%;}
	.company__info{
		display: none;
	}
	.login_form{
		border-top-left-radius:20px;
		border-bottom-left-radius:20px;
	}
}
@media screen and (min-width: 642px) and (max-width:800px){
	.main-content{width: 100%;}
}
.row > h2{
	color:#008080;
}
.login_form{
	background-color: #fff;
	border-top-right-radius:20px;
	border-bottom-right-radius:20px;
	border-top:1px solid #ccc;
	border-right:1px solid #ccc;
}
form{
	padding: 0 2em;
}
.form__input{
	width: 100%;
	border:0px solid transparent;
	border-radius: 0;
	border-bottom: 1px solid #aaa;
	padding: 1em .5em .5em;
	padding-left: 2em;
	outline:none;
	margin:1.5em auto;
	transition: all .5s ease;
}
.form__input:focus{
	border-bottom-color: #008080;
	box-shadow: 0 0 5px rgba(0,80,80,.4); 
	border-radius: 4px;
}
.btn{
	transition: all .5s ease;
	width: 70%;
	border-radius: 30px;
	color:#008080;
	font-weight: 600;
	background-color: #fff;
	border: 1px solid #008080;
	margin-top: 1.5em;
	margin-bottom: 1em;
}
.btn:hover, .btn:focus{
	background-color: #008080;
	color:#fff;
}
</style>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-8WQ7QSEWVJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8WQ7QSEWVJ');
</script>

</head>
<body translate="no">
	<!-- Main Content -->
	<div class="container-fluid">
		<div class="row main-content bg-success text-center">
			<div class="col-md-6 col-sm-6 col-xs-12 text-center company__info">
				<span class="company__logo"><h2>
				    <img src="https://netzwerkself.com/lms_logo.png" style="height:350px;"/>
				</h2></span>
				<h4 class="company_title"></h4>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 login_form">
				<div class="container-fluid">
					<div class="row">
						<h2>Reset Password</h2>
					</div>
					<div class="row">
						<form  action="https://netzwerkself.com/lms/forgot-password.php" method="post" class="form-group">
							<div class="row">
								<input type="email" name="email" id="username" class="form__input" placeholder="Enter Your Email" required>
								<?php echo $msg; ?>
							</div>
							<div class="row">
								<input type="submit" name="submit" value="Submit" class="btn">
							</div>
						</form>
					</div>
					<div class="row">
						<a href="https://www.netzwerkself.com/lms/login.php">
						  <button type="button" class="btn">Login</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>