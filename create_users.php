<?php
	include 'admin/dbConn.php';
	session_start();
	ob_clean();	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/SMTP.php';
	
	function sendSignupEmail($emaill,$otp) {
    
		$sender           = 'info@netzwerkself.com';
		$senderName       = 'Netzwerk Academy';
		$recipient        = $emaill;
		$usernameSmtp     = 'info@netzwerkself.com';
		$passwordSmtp     = 'Va[g~T5m9Ly)';
		//$configurationSet = 'ConfigSet';
		$host             = 'netzwerkself.com';
		$port             = 465;
		$subject          = 'Email verify OTP';
		$bodyText =  "Netzwerk Academy Reset Password";
		$bodyHtml = ' <html>
				<head>
				<title>Email verify OTP</title> 
				</head>
				<body>
				<p>Hello,</p>
				<p>Email verify OTP. "'. $otp .'"</p>
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
    if(isset($_POST['email'])){
		
		if ($_POST['captcha_code'] != $_SESSION['captcha']) {
			
			header("Location: create_users.php?ex=captcha");
			exit;
		}
		
		$otp = rand(1000, 9999);
		#$otp = 1234;
		
        $user_name  = $_POST['user_name'];
        $email      = $_POST['email'];
        $password   = md5(md5($_POST['password']));
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
			
			$sqlMode = "INSERT INTO users SET uname='".$user_name."',email='".$email."',password='".$password."',mobile='".$mobile_no."',status='1',ip='".$my_ip."',timestamp='".$timestamp."',hash='".$hash."',payuID='".$payuID."',internatID='".$internatID."',email_otp='".$otp."'";
		
			$response = mysqli_query($con,$sqlMode);
			$user_id  = $con->insert_id;
			
			if(isset($user_id)){
				foreach($courseIDS as $course_id){
				  $sqlCourseToUser = "INSERT INTO course_user SET user_id='".$user_id."',course_id='".$course_id."'";
				  $response = mysqli_query($con,$sqlCourseToUser);
				}
				
				sendSignupEmail($email,$otp);
				
				/* $to      = $email;
                $subject = 'Account created successfully';
                $message = 'Your account has been created successfully.';
                $headers = 'From: netzwerkself@gmail.com'       . "\r\n" .
                             'Reply-To: netzwerkself@gmail.com' . "\r\n" .
                             'X-Mailer: PHP/' . phpversion();
            
                mail($to, $subject, $message, $headers); */
				
			}
			if(isset($user_id)){
				#$msg = '<span class="badge badge-success" style="font-size:16px">Users Added</span><Br><Br>';
				header("Location: email_verify.php");
				exit;
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
		if($_GET['ex']=='captcha'){
			$msg = "Invalid CAPTCHA code.";
			header("Refresh:6; url=create_users.php");
			exit;
		}
	}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Create User : LMS</title>
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
				<h2 class="title1">Create User</h2>
				<div class="sign-up-row widget-shadow">
					<h5>Personal Information :</h5>
				<div class=""><?php echo $msg; ?></div>
				<form action="" method="post">
					<div class="sign-u">
								<input type="text" class="form-control" id="inputEmail3" name="user_name" placeholder="Full name" required> 
						<div class="clearfix"> </div>
					</div>
					
					<div class="sign-u">
								<input type="email" name="email" placeholder="Email Address" required>
						<div class="clearfix"> </div>
					</div>
					
					<div class="sign-u">
								<input type="number" class="form-control" id="inputEmail3" name="mobile_no" placeholder="Mobile.." required>
						<div class="clearfix"> </div>
					</div>
					<br>
					<div class="sign-u">
								<select name="course_id[]" id="courseID" multiple class="form-control" required>
								<?php while($courseRow = mysqli_fetch_array($resourse)) { ?>
							       <option value="<?php echo $courseRow['ID'];?>"><?php echo $courseRow['course_name'];?></option>
								<?php } ?>
							   </select>
						<div class="clearfix"> </div>
					</div>
					
					<h6>Login Information :</h6>
					<div class="sign-u">
								<input type="password" name="password" placeholder="Password" required="">
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
								<input type="password" placeholder="Confirm Password" required="">
						</div>
						<div class="clearfix"> </div>
						
					<div class="sign-u">	
						<img src="captcha.php" alt="Captcha"><br>
						<input type="text" name="captcha_code" placeholder="Enter CAPTCHA" required><br>
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

