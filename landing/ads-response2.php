<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'mailer/vendor/autoload.php';
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

function sendSignupEmail($emaill,$passwordd, $fname) {
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                             // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.zoho.in';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'no-reply@netzwerkacademy.com';                 // SMTP username
    $mail->Password = 'Website@123';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;
    $mail->setFrom('no-reply@netzwerkacademy.com', 'Netzwerk Academy');
    $mail->addAddress($emaill);     // Add a recipient
    $mail->addReplyTo('info@netzwerkacademy.com', 'Netzwerk Support Team');
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Account Created';
    $mail->Body = ' <html>
        <head>
        <title>Account Creation</title>
        </head>
        <body>
        <p>Hello '.$fname.',</p>
        <p>Signup Successful on LMS Netzwerk Academy<br>Login using your Email ID : '.$emaill.'<br>Your Password is : '.$passwordd.'<br><a href="https://lms.netzwerkacademy.com">Click Here</a> to open login page.
        </body>
        </html>';
    $mail->AltBody = 'Password Update';
    $mail->send();        
}

function sendThankYouEmail($emaill, $fname) {
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                             // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.zoho.in';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'no-reply@netzwerkacademy.com';                 // SMTP username
    $mail->Password = 'Website@123';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;
    $mail->setFrom('no-reply@netzwerkacademy.com', 'Netzwerk Academy');
    $mail->addAddress($emaill);     // Add a recipient
    $mail->addReplyTo('info@netzwerkacademy.com', 'Netzwerk Support Team');
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Congrats! You have enrolled for Core Java';
    $mail->Body = ' <html>
        <head>
        <title>Account Creation</title>
        </head>
        <body>
        <p>Hello '.$fname.',</p>
        <p>Thanks for joining our Core Java course. We are excited to have you onboard.</p>
        <p>You can access the course using the following details:</p>
        <p>Course will be accessible for 1 year from today</p>
        <p><a href="https://lms.netzwerkacademy.com">Click Here to Login</a> OR Copy-Paste following url <a href="https://lms.netzwerkacademy.com">https://lms.netzwerkacademy.com</a></p>
        <p>Login Credentials will be shared in another email if you don\'t have account</p>
        </body>
        </html>';
    $mail->AltBody = 'Password Update';
    $mail->send();        
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
    if($amount=="499" AND $status=='success' AND $productInfo=="Core Java"){
        $password = randomPassword();
        $enc_password = md5(md5($password));
        $ip = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');
        $sql = "INSERT into `users`(`email`,`mobile`,`password`,`ip`,`uname`,`payuID`,`internatID`) VALUES('$email','$mobile','$enc_password','$ip','$firstname','$payuID','$txnid')";
        $result = mysqli_query($con, $sql);
        if($result){
            $last_id = $con->insert_id;
            sendSignupEmail($email, $password, $firstname);
            sendThankYouEmail($email, $firstname);
        }else{
            $sql = "SELECT `ID` FROM `users` WHERE `email` LIKE '$email'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($result);
            $last_id = $row[0];
            sendThankYouEmail($email, $firstname);
        }

        $sql = "INSERT into `course_user`(`user_id`,`course_id`) VALUES('$last_id','1')";
        mysqli_query($con, $sql);

        $msg = 'Your Transaction ID : '.$txnid;
    }
}
else exit('Error with Payment.');
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>LMS</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css'><link rel="stylesheet" href="./style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<!-- BOLT Sandbox/test //-->
<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
<!--<script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="https://netzwerkacademy.com/wp-content/uploads/2020/01/Netzwerk-Academy-Logo-min.jpg"></script>-->
</head>
<body style="background-color: #fff;color: black !important">
<header class="site-header"> <nav class="navbar navbar-default">
<!--<div class="top-line">
		<div class="container">
				<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
								<p> <span><i class="fa fa-phone"></i><a href="tel:0123 - 45678">0123 - 45678</a></span> <span><i class="fa fa-envelope-o"></i><a href="mailto:info@company.com">info@company.com</a></span> </p>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6 text-right">
								<p> <span><i class="fa fa-certificate"></i><a href="certificates.html">Our Certifications</a></span> <span><i class="fa fa-file-pdf-o"></i><a href="brochure.pdf">Download Brochure</a></span> </p>
						</div>
				</div>
		</div>
</div>-->
<div class="header-inner">
	<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="brand"> <a href="#">
							<img src="https://netzwerkacademy.com/wp-content/uploads/2020/01/Netzwerk-Academy-Logo-min.jpg" width="80px" style="padding: 10px">
							</a> </div>
					<nav  id="nav-wrap" class="main-nav"> <a id="toggle-btn" href="#"><i class="fa fa-bars"></i> </a>
					<ul class="sf-menu">
							<li style="font-size:16px"> <a href="index.html">Home</a> </li>
							<li class=""> <a href="manual-testing.php">Manual Testing </a></li>
							<li class="current"> <a href="core-java.php">Core Java</a></li>
							<li class=""> <a href="j2ee.php">Advance Java </a></li>
					</ul>
					</nav> </div>
			</div>
	</div>
</div>
</header>
<div class="jumbotron text-xs-center" style="padding: 40px;">
  <h1 class="display-3" style="font-size:22px;font-weight: 600">You are almost done with the process of enrolment</h1>
  <p class="lead" style="font-size:16px;font-weight: 400">You will receive a mail having URL, username and password in a while and you can start your course right away.</p>
  <p class="lead" style="font-size:16px;font-weight: 400;margin:0px">Please find the mail in your inbox/spam/promotion or search &quot;Netzwerk&quot; in your mail search bar.</p>
  <p class="lead" style="font-size:16px;font-weight: 400"><?php echo $msg; ?></p>
  <hr>
  <p>
    Having trouble? <a href="mailto:admin@netzwerkacademy.com" class="btn btn-info">Contact us</a>
  </p>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="https://lms.netzwerkacademy.com/" role="button">Login</a>
  </p>
</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/superfish/1.7.4/superfish.min.js'></script><script  src="./script.js"></script>
<script type="text/javascript"><!--
$('#payment_form').bind('keyup blur', function(){
	$.ajax({
          url: 'index.php',
          type: 'post',
          data: JSON.stringify({ 
            key: $('#key').val(),
			salt: $('#salt').val(),
			txnid: $('#txnid').val(),
			amount: $('#amount').val(),
		    pinfo: $('#pinfo').val(),
            fname: $('#fname').val(),
			email: $('#email').val(),
			mobile: $('#mobile').val(),
			udf5: $('#udf5').val()
          }),
		  contentType: "application/json",
          dataType: 'json',
          success: function(json) {
            if (json['error']) {
			 $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
            }
			else if (json['success']) {	
				$('#hash').val(json['success']);
            }
          }
        }); 
});
//-->
</script>
<script type="text/javascript"><!--
function launchBOLT()
{
	bolt.launch({
	key: $('#key').val(),
	txnid: $('#txnid').val(), 
	hash: $('#hash').val(),
	amount: $('#amount').val(),
	firstname: $('#fname').val(),
	email: $('#email').val(),
	phone: $('#mobile').val(),
	productinfo: $('#pinfo').val(),
	udf5: $('#udf5').val(),
	surl : $('#surl').val(),
	furl: $('#surl').val(),
	mode: 'dropout'	
},{ responseHandler: function(BOLT){
	console.log( BOLT.response.txnStatus );		
	if(BOLT.response.txnStatus != 'CANCEL')
	{
		//Salt is passd here for demo purpose only. For practical use keep salt at server side only.
		var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
		'<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
		'<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
		'<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
		'<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
		'<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
		'<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
		'<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
		'<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
		'<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
		'<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
		'<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
		'</form>';
		var form = jQuery(fr);
		jQuery('body').append(form);								
		form.submit();
	}
},
	catchException: function(BOLT){
 		alert( BOLT.message );
	}
});
}
//--
</script>
</body>
</html>
