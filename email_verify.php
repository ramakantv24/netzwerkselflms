<?php
	include 'admin/dbConn.php';
	session_start();
	ob_clean();
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/SMTP.php';
	
	function sendSignupEmail($emaill) {
    
		$sender           = 'info@netzwerkself.com';
		$senderName       = 'Netzwerk Academy';
		$recipient        = $emaill;
		$usernameSmtp     = 'info@netzwerkself.com';
		$passwordSmtp     = 'Va[g~T5m9Ly)';
		//$configurationSet = 'ConfigSet';
		$host             = 'netzwerkself.com';
		$port             = 465;
		$subject          = 'Account created successfully';
		$bodyText =  "Netzwerk Academy Account created";
		$bodyHtml = ' <html>
				<head>
				<title>Account created successfully</title> 
				</head>
				<body>
				<p>Hello,</p>
				<p>Your account has been created successfully.</p>
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
				$mail->addReplyTo('info@netzwerkself.com', 'Netzwerk Support Team');
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
    if(isset($_POST['otp'])){
		
        $otp  = $_POST['otp'];
		
		$sql22 = "SELECT * FROM `users` WHERE `email_otp` = '$otp'";
		$user22SQLRes     = mysqli_query($con,$sql22); 
		$user22Row        = mysqli_fetch_assoc($user22SQLRes);
		
		if(empty($user22Row['ID'])){
			
			$email = $user22Row['email'];
			
			$sqlMode = "UPDATE INTO users SET email_verify='1', email_otp='null' WHERE email_otp = '".$email."'";
		
			$response = mysqli_query($con,$sqlMode);
			
			sendSignupEmail($email);				
			
			if(isset($user_id)){
				$msg = '<span class="badge badge-success" style="font-size:16px">Otp verify, Users Added</span><Br><Br>';
			}
		}else{
			header("Location: create_users.php?ex=out");
			exit;
		}
    }
	
	$courseSQL     = "SELECT * FROM `courses` WHERE `status` LIKE '1'";
	$resourse      = mysqli_query($con,$courseSQL);
	
	if(isset($_GET['ex'])){
		if($_GET['ex']=='out'){
			$msg = '<p>You have already purchased a course with us.</p>';
			$msg .= '<p>Use the same email id & password to access this new course New course will be available in the MY COURSE  section.</p>';
			$msg .= '<a href="https://netzwerkself.com/lms/login.php">Login Here</a><br><br>';
		}		
	}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Email Otp Verify : LMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">

<script async src="https://www.googletagmanager.com/gtag/js?id=G-8WQ7QSEWVJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8WQ7QSEWVJ');
</script>

</head> 
<body class="cbp-spmenu-push">
<div class="main-content">
		<div id="page-wrapper">
			<div class="main-page signup-page">
				<h2 class="title1">Email Otp Verify</h2>
				<div class="sign-up-row widget-shadow">
					<h5>Otp Verify :</h5>
				<div class=""><?php echo $msg; ?></div>
				<form action="" method="post">
					<div class="sign-u">
								<input type="text" class="form-control" id="inputEmail3" name="otp" placeholder="Otp Verify" required> 
						<div class="clearfix"> </div>
					</div>
						
					<div class="col-sm-offset-2"><?php echo $msg; ?></div>	
					<div class="sub_home">
							<input type="submit" value="Submit">
						<div class="clearfix"> </div>
					</div>
					
				</form>
				</div>
			</div>
		</div>
		<div class="footer">
		   <p>&copy; 2020 LMS - Netzwerk Academy</p></div>
	</div>
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
   <script src="js/bootstrap.js"> </script>
</body>
</html>

