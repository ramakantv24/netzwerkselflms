<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'mailer/vendor/autoload.php';
include '../admin/dbConn.php';
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
	//Request hash
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';	
	if(strcasecmp($contentType, 'application/json') == 0){
		$data->key = 'H4vy5Eez';
		$data->salt = '98VYR9A7yH';
		$data = json_decode(file_get_contents('php://input'));
		$hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$data->salt);
		$json=array();
		$json['success'] = $hash;
    	echo json_encode($json);
	
	}
	exit(0);
}
 
function getCallbackUrl(){
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	return 'https://lms.netzwerkacademy.com/landing/payment_mt.php';
}

if(isset($_GET['f']) AND isset($_GET['m']) AND isset($_GET['e'])) {
	
	$fname = $_GET['f'];
	$mobile = $_GET['m'];
	$email = $_GET['e'];

	function randomPassword() {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
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
	        <p>Signup Successful on LMS Netzwerk Academy<br>Your Password is : '.$passwordd.'<br><a href="https://lms.netzwerkacademy.com">Click Here</a> to open login page.
	        </body>
	        </html>';
	    $mail->AltBody = 'Password Update';
	    $mail->send();        
	}

	$pass_og = randomPassword();
	$pass = md5(md5($pass_og));
	
	$ip = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');
	$sql = "INSERT INTO `users`(`email`, `mobile`, `password`, `status`, `ip`, `uname`) VALUES ('$email','$mobile','$pass','1','$ip','$fname')";
	$result = mysqli_query($con, $sql);
    if($result){
        $last_id = $con->insert_id;
    }else{
        $sql = "SELECT `ID` FROM `users` WHERE `email` LIKE '$email'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        $last_id = $row[0];
    }

    $sql = "INSERT into `course_user`(`user_id`,`course_id`) VALUES('$last_id','6')";
    mysqli_query($con, $sql);

		//sendSignupEmail($email, $pass_og, $fname);
}

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Manual Testing | Netzwerk Academy</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<!-- Global site tag (gtag.js) - Google Ads: 764473008 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-764473008"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-764473008');
</script>
<script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="https://netzwerkacademy.com/wp-content/uploads/2020/01/Netzwerk-Academy-Logo-min.jpg"></script>
<style type="text/css">
	.container {
		margin: 0px;
		width: 100%;
    max-width: 100%;
    padding-left: 150px;
    padding-right: 150px;
	}
  @media only screen and (max-width: 600px) {
    .container {
			padding:0px;
      padding-left: 15px;
    }
  }
	th, td {
		font-size: 18px;
	}
	.float{
		position:fixed;
		width:60px;
		height:60px;
		bottom:40px;
		right:40px;
		background-color:#25d366;
		color:#FFF;
		border-radius:50px;
		text-align:center;
		font-size:30px;
		box-shadow: 2px 2px 3px #999;
		z-index:100;
	}

	.my-float{
		margin-top:16px;
	}
</style>
</head>
<body style="background-color: #fff;color: black !important;">
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
	<div class="containe">
			<div class="row">
				<div class="col-md-12">
					<div class="brand"> <a href="#">
							<img src="https://netzwerkacademy.com/wp-content/uploads/2020/01/Netzwerk-Academy-Logo-min.jpg" width="80px" style="padding: 10px">
							</a> </div>
					<nav  id="nav-wrap" class="main-nav"> <a id="toggle-btn" href="#"><i class="fa fa-bars"></i> </a>
					<ul class="sf-menu">
							<li class="current"> <a href="manual-testing.php">Manual Testing </a></li>
							<li class=""> <a href="core-java.php">Core Java</a></li>
							<li class=""> <a href="j2ee.php">Advance Java </a></li>
              <li class=""> <a href="software-testing.php">Software Testing</a></li>
							<li class=""> <a href="software-development.php">Software Development</a></li>
					</ul>
					</nav> </div>
			</div>
	</div>
</div>
</header>
<a href="https://api.whatsapp.com/send?phone=+918660785310" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>
<div class="container">
<div style="margin-top:10px;box-shadow: -5px 0px 10px 0px rgb(0 0 0 / 50%);">
			<div class="row">
				<div class="col-md-6">
					<!--<img src="https://netzwerkacademy.com/wp-content/uploads/2021/02/Manual-Testing-min.jpg" width="100%">-->
					<iframe src="https://player.vimeo.com/video/533935556" width="100%" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
				</div>
				<div class="col-md-6">
					<h1 style="color:black">Manual Testing</h1>
					<table class="table table-responsive table-bordered">
						<tbody>
						<tr>
						<th>Validity :</th>
						<td>1 Year</td>
						</tr>
						<tr>
						<th>Mode :</th>
						<td>Pre Recorded</td>
						</tr>
						<tr>
						<th>Compatibility :</th>
						<td>Mobile and Laptop</td>
						</tr>
						<tr>
						<th>Language :</th>
						<td>English</td>
						</tr>
						<tr>
						<th>Price :</th>
						<td>Rs. 499</td>
						</tr>
						</tbody>
						</table>
				</div>
			</div>
		</div>
		<div class="row">
				<div class="col-md-12">
					<h1 style="color:#033435">About Course</h1>
					<p>Netzwerk Academy provides the best-in-class Manual Testing training by a certified trainer who is currently the working professional in the same field. This course will make you proficient in performing functional and regression test automation for software applications and environments through a hands-on approach with real-world examples. Our training is designed according to the latest developments as per industry requirements and demands, and learning them will be essential for clearing the certification exams.</p>
				</div>

				<div class="col-md-12">
					<h1 style="color:#033435">Scope of learning Manual Testing:</h1>
					<div style="font-size: 14px">
						<p>More job opportunities in fields like</p>
						<ol>
							<li style="font-size: 16px">Software testing</li>
							<li style="font-size: 16px">Automation developer</li>
							<li style="font-size: 16px">Manual test engineer </li>
							<li style="font-size: 16px">App testing</li>
							<p style="margin:0px">And many more …</p>
						</ol>
					</div>
				</div>
		</div>
		
</div>
<br><br>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1 style="color:#033435">Course Highlights</h1>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Fundamental concepts in software testing, including software testing objectives, process, criteria, strategies, and methods.</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Various software testing issues and solutions in software unit test; integration, regression, and system testing.</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Planning a test project, design test cases and data, conduct testing operations, manage software problems and defects, generate a testing report.</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Expose the advanced software testing topics, such as object-oriented software testing methods, and component-based software testing issues, challenges, and solutions.</p>
		</div>
		<div class="col-md-6">
			<h1 style="color:black">&nbsp;</h1>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Gain software testing experience by applying software testing jobs and methods to practice-oriented software testing projects.</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Understand software test automation problems and solutions.</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Learn how to write software testing documents, and communicate with engineers in various forms.</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Gain the techniques and skills on how to use modern software testing tools to support software testing projects.</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h1 style="color:#033435">Requirements</h1>
			<div style="padding: 10px">
				<ul>
					<li style="font-size: 15px !important">A computer with either Windows, Mac or Linux to install all the free software and tools needed to build your new apps (I provide specific videos on installations for each platform).</li>
					<li style="font-size: 15px !important">A strong work ethic, willingness to learn, and plenty of excitement about the awesome new programs you’re about to build.</li>
					<li style="font-size: 15px !important">Nothing else! It’s just you, your computer and your hunger to get started today.</li>
					<li style="font-size: 15px !important">No other prerequisites</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h1 style="color:#033435">Demo Videos</h1>
			<div class="col-md-4">
				<iframe src="https://player.vimeo.com/video/533864596" width="100%" height="360" frameborder="0" style="border: 1px solid black" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
			</div>
			<div class="col-md-4">
				<iframe src="https://player.vimeo.com/video/533861605" width="100%" height="360" frameborder="0" style="border: 1px solid black" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
			</div>
			<div class="col-md-4">
				<iframe src="https://player.vimeo.com/video/533870387" width="100%" height="360" frameborder="0" style="border: 1px solid black" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>



<div class="container">
	<div class="row">
		<center>
			<p style="font-size: 24px">Get the Manual Testing Course now at only Rs. 499</p>
			<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
			  Buy Now
			</button>

			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Enroll for Software development package</h4>
			      </div>
			      <div class="modal-body">
			        <form action="#" id="payment_form">
    <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
	<input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />
    <input type="text" id="key" name="key" placeholder="Merchant Key" value="H4vy5Eez" hidden="" />
	<input type="text" id="salt" name="salt" placeholder="Merchant Salt" value="98VYR9A7yH" hidden="" />
	<input type="text" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "NW_TXN_" . rand(10000,99999999)?>" hidden/>
	<input type="text" id="amount" name="amount" placeholder="Amount" value="499" hidden="" />
    <input type="text" id="pinfo" name="pinfo" placeholder="Product Info" value="Manual Testing" hidden="" />
    
    <div class="form-group" style="width: 300px">
	    <span>
	    	<input type="text" id="fname" name="fname" placeholder="First Name" class="form-control"/>
	    </span>
    </div>
    
    <div class="form-group" style="width: 300px">
    	<span>
    		<input type="text" id="email" name="email" placeholder="Email ID" class="form-control" />
    	</span>
    </div>
    
    <div class="form-group" style="width: 300px">
    	<span>
    		<input type="text" id="mobile" name="mobile" placeholder="Mobile/Cell Number" class="form-control" />
    	</span>
    </div>
    <input type="text" id="hash" name="hash" placeholder="Hash" value="" hidden="" />
    <div><input type="submit" value="Pay Now" onclick="launchBOLT(); return false;" class="btn btn-success" /></div>
	</form>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
		</center>
	</div>
</div>

<div class="container">
	<div class="row">
		<h1 style="color: #033435">Syllabus</h1>
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingOne">
		      <h4 class="panel-title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		          <ul><li style="margin-left:10px;font-size:17px">Introduction of the course </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">What is software testing</li>
							<li style="font-size:16px">Why it is necessary </li>
							<li style="font-size:16px">Advantages of software testing</li>
		        </ol>
		      </div>
		    </div>
		  </div>
			
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          <ul><li style="margin-left:10px;font-size:17px">Software development life cycle [SDLC]</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">What is SDLC?</li>
							<li style="font-size:16px">What are the different types of SDLC MODELS? </li>
							<li style="font-size:16px">What is waterfall model? Advantages and disadvantages </li>
							<li style="font-size:16px">What is spiral model? Advantages and disadvantages</li>
							<li style="font-size:16px">What is prototype model? Advantages and disadvantages</li>
							<li style="font-size:16px">What is V-V model? Advantages and disadvantages </li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo1">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
		          <ul><li style="margin-left:10px;font-size:17px">White box testing /Unit testing </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo1">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">What is Unit testing? Its types.</li>
							<li style="font-size:16px">What is Statement coverage with example </li>
							<li style="font-size:16px">What is decision coverage with example </li>
							<li style="font-size:16px">What is Branch coverage with example </li>
							<li style="font-size:16px">What is condition coverage with example </li>
							<li style="font-size:16px">Advantages and disadvantages of Unit testing.</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
		          <ul><li style="margin-left:10px;font-size:17px">Black Box Testing </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">What is black box testing </li>
							<li style="font-size:16px">Types of Black box testing </li>
							<li style="font-size:16px">What is functional testing? and its types</li>
							<li style="font-size:16px">What is component testing? With example </li>
							<li style="font-size:16px">What is Smoke testing? With example</li>
							<li style="font-size:16px">What is Integration testing? its types ?with example </li>
							<li style="font-size:16px">What is Regression testing? With example </li>
							<li style="font-size:16px">What is system testing? With example </li>
							<li style="font-size:16px">What is UAT?</li>
							<li style="font-size:16px">What is compatibility testing? With example .And its advantages and disadvantages</li>
							<li style="font-size:16px">What is exploratory testing? With example and its advantages and disadvantages</li>
							<li style="font-size:16px">What is API testing ?and its types </li>
							<li style="font-size:16px">What is Globalization testing? And its types</li>
							<li style="font-size:16px">What is Internationalization testing [I18N testing]?</li>
							<li style="font-size:16px">What is Localization testing [L10N testing]?</li>
							<li style="font-size:16px">What is Ad-hoc testing?</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo3" aria-expanded="false" aria-controls="collapseTwo3">
		          <ul><li style="margin-left:10px;font-size:17px">Non-Functional Testing </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">What is Performance testing?</li>
							<li style="font-size:16px">What is Security testing?</li>
							<li style="font-size:16px">What is Reliability testing?</li>
							<li style="font-size:16px">What is survivalability testing?</li>
							<li style="font-size:16px">What is Availability testing?</li>
							<li style="font-size:16px">What is Usability testing?</li>
							<li style="font-size:16px">What is Scalability testing?</li>
							<li style="font-size:16px">What is interoperability testing?</li>
							<li style="font-size:16px">What is efficiency testing?</li>
							<li style="font-size:16px">What is flexibility testing?</li>
							<li style="font-size:16px">What is portability testing?</li>
							<li style="font-size:16px">What is load testing?</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4">
		          <ul><li style="margin-left:10px;font-size:17px">Test Plan </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">What is test plan? Different components of Test plan </li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwooo" aria-expanded="false" aria-controls="collapseTwooo">
		          <ul><li style="margin-left:10px;font-size:17px">Test Case</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwooo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">What is test case document </li>
							<li style="font-size:16px">Practices to write good test case </li>
							<li style="font-size:16px">Why do we write test case </li>
							<li style="font-size:16px">What is Test scenario </li>
							<li style="font-size:16px">How to write test scenario </li>
							<li style="font-size:16px">What is RTM?</li>
							<li style="font-size:16px">How to prepare RTM document and its advantages </li>
							<li style="font-size:16px">What are test design techniques</li>
							<li style="font-size:16px">What is boundary value analysis [BVA]</li>
							<li style="font-size:16px">What is Equivalence class partitioning [ECP]</li>
							<li style="font-size:16px">What is Error guessing </li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo5" aria-expanded="false" aria-controls="collapseTwo5">
		          <ul><li style="margin-left:10px;font-size:17px">Test Data </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">What is test data </li>
							<li style="font-size:16px">Criteria of test data </li>
							<li style="font-size:16px">Test data generation approaches </li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo6" aria-expanded="false" aria-controls="collapseTwo6">
		          <ul><li style="margin-left:10px;font-size:17px">Software test life cycle [STLC]</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">What is STLC?  </li>
							<li style="font-size:16px">What are different steps in STLC </li>
							<li style="font-size:16px">Advantages of STLC </li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo7" aria-expanded="false" aria-controls="collapseTwo7">
		          <ul><li style="margin-left:10px;font-size:17px">Defect Life cycle </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">What is defect life cycle?</li>
							<li style="font-size:16px">Different steps of Defect life cycle </li>
							<li style="font-size:16px">What is Defect Report?</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo8" aria-expanded="false" aria-controls="collapseTwo8">
		          <ul><li style="margin-left:10px;font-size:17px">Interview Questions </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        
		      </div>
		    </div>
		  </div>

			

			
		  <!--end-->
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1 style="color:#033435">Bonus</h1>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Resume building tips</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Job hunt hacks</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Downloadable materials of FAQ on each topic</p>
		</div>
		<div class="col-md-6">
			<h1 style="color:black">&nbsp;</h1>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Optimization of employment portals to attract interviews</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Email support which replies within 2hrs to solve all your queries and dedicated</p>
		</div>
	</div>
	<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
			  Buy Now
			</button>
</div>

<div class="container">
	<div class="row">
		<h1 style="color:#033435">FAQ</h1>
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne11" aria-expanded="true" aria-controls="collapseOne11">
							When Can I Take This Course? Is There Any Timings?
						</a>
					</h4>
				</div>
				<div id="collapseOne11" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body" style="color:black">
						<p>You can take this course at any time at anyplace. All your study materials will be pre-recorded videos. We also provide you email support if you have any doubts.</p>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo12" aria-expanded="false" aria-controls="collapseTwo12">
		          What's the validity of the course?
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo12" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
						<p>Your course is valid for one year. You can finish this course anytime in this one year.</p>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo13" aria-expanded="false" aria-controls="collapseTwo13">
		          How this program works?
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo13" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <p>It’s a 1-year valid course, you will be given access to your dashboard, where guided course videos are ready for you to start course. You will get email support with the course.</p>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo1">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo131" aria-expanded="false" aria-controls="collapseTwo13">
		          Do I get placement/Job assistance or guarantee?
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo131" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo1">
		      <div class="panel-body" style="color:black">
		        <p>No, but we provide the ultimate job hunt hack , resume building and tips to clear interviews on your at absolute zero cost with all courses.</p>
		      </div>
		    </div>
		  </div>

  
	</div>
	</div>
</div>

<!--<div class="container">
	<div class="row">
		<h1 style="color:#033435">WHAT OUR STUDENTS HAVE TO SAY</h1>
		<div class="col-md-4">
			<center>
				<img src="https://netzwerkacademy.com/wp-content/uploads/2020/05/advancedatascience-min.png" width="200px">
			</center>
		</div>
		<div class="col-md-4">
			<center>
				<img src="https://netzwerkacademy.com/wp-content/uploads/2020/05/advancedatascience-min.png" width="200px">
			</center>
		</div>
		<div class="col-md-4">
			<center>
				<img src="https://netzwerkacademy.com/wp-content/uploads/2020/05/advancedatascience-min.png" width="200px">
			</center>
		</div>
	</div>
</div>
<br><br>-->
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1 style="color:#033435">Support</h1>
				<p style="line-height: 10px">Ph No. <a href="telno:+918660785310">8660785310</a></p>
				<p style="line-height: 10px">Email: <a href="mailto:info@netzwerkacademy.com">info@netzwerkacademy.com</a></p>
				<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
			  Buy Now
			</button>
	</div>
		</div>
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
	function testSignup() {
		var fname = document.getElementById('fname').value;
		var email = document.getElementById('email').value;
		var mobile= document.getElementById('mobile').value;
		window.location.href = "core-java.php?f="+fname+"&e="+email+"&m="+mobile;
	}

function launchBOLT() {
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
