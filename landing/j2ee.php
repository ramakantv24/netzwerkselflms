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
	return 'https://lms.netzwerkacademy.com/landing/ads-response2.php';
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

    $sql = "INSERT into `course_user`(`user_id`,`course_id`) VALUES('$last_id','10')";
    mysqli_query($con, $sql);

		//sendSignupEmail($email, $pass_og, $fname);
}

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
<!-- Global site tag (gtag.js) - Google Ads: 764473008 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-764473008"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-764473008');
</script>
<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
<!--<script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="https://netzwerkacademy.com/wp-content/uploads/2020/01/Netzwerk-Academy-Logo-min.jpg"></script>-->
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
							<li class=""> <a href="manual-testing.php">Manual Testing </a></li>
							<li class=""> <a href="core-java.php">Core Java</a></li>
							<li class="current"> <a href="j2ee.php">Advance Java </a></li>
              <li class=""> <a href="software-testing.php">Software Testing</a></li>
							<li class=""> <a href="software-development.php">Software Development</a></li>
					</ul>
					</nav> </div>
			</div>
	</div>
</div>
</header>

<div class="container">
<div style="margin-top:10px;box-shadow: -5px 0px 10px 0px rgb(0 0 0 / 50%);">
			<div class="row">
				<div class="col-md-6">
					<img src="https://netzwerkacademy.com/wp-content/uploads/2021/02/Advance-JAva-min.jpg" width="100%">
				</div>
				<div class="col-md-6">
					<h1 style="color:black">Advance Java - J2EE</h1>
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
						<td>Rs. 699</td>
						</tr>
						</tbody>
						</table>
				</div>
			</div>
		</div>
		<div class="row">
				<div class="col-md-12">
					<h1 style="color:#033435">About Course</h1>
					<p>Designed by Netzwerk Academy, THE Advanced JAVA PROGRAMMING COURSE is the go to option for anyone with keen interest in this field, it covers wide array of topics from Basics of HTML & XML, servlet, JSP, EJB and many more. </p>
					<p>It is a beginner friendly course that is suitable for learners, designers, to be programmers and even for job seekers</p>
					<p>This course is a strategic blend of perfect theories, examples, and module wise interview questions that makes it a complete toolbox to become a Java developer</p>
					<p>This demand of Java developer is increasing every day in every field, the goal is to transform the code into working software module, and software module to business, which is possible with Java development course</p>
				</div>

				<div class="col-md-12">
					<h1 style="color:#033435">Scope of learning Java programming:</h1>
					<div style="font-size: 14px">
						<p>More job opportunities in fields like</p>
						<ol>
							<li style="font-size: 16px">Java developer</li>
							<li style="font-size: 16px">Automation developer</li>
							<li style="font-size: 16px">Back end development </li>
							<li style="font-size: 16px">Application development</li>
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
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;The course provides entire toolbox to become a Java developer</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Start coding in Java and learn to use it for solving business problems</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Understand the logic behind the coding</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Several examples from scratch</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Project explained for self-practice</p>
		</div>
		<div class="col-md-6">
			<h1 style="color:black">&nbsp;</h1>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Improve logical skills by working on basic coding methodologies</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Access to study resources for getting all the codes and new resources to work on and stay updated everyday</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Regular updates on FAQ and projects for self-study</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;You will be able to create simple coding snippets, and small projects using Java</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h1 style="color:#033435">Requirements</h1>
			<div style="padding: 10px">
				<ul>
					<li style="font-size: 15px !important">An intermediate level Core Java programming</li>
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
				<iframe src="https://player.vimeo.com/video/523095321" width="100%" height="360" frameborder="0" style="border: 1px solid black" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
			</div>
			<div class="col-md-4">
				<iframe src="https://player.vimeo.com/video/523097568" width="100%" height="360" frameborder="0" style="border: 1px solid black" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
			</div>
			<div class="col-md-4">
				<iframe src="https://player.vimeo.com/video/523100504" width="100%" height="360" frameborder="0" style="border: 1px solid black" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>



<div class="container">
	<div class="row">
		<center>
			<p style="font-size: 24px">Get the Advance Java - J2EE Course now at only Rs. 699</p>
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
	<input type="text" id="amount" name="amount" placeholder="Amount" value="699" hidden="" />
    <input type="text" id="pinfo" name="pinfo" placeholder="Product Info" value="J2EE" hidden="" />
    
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
		          <ul><li style="margin-left:10px;font-size:17px">Introduction to Enterprise Edition </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Introduction to Web Application </li>
							<li style="font-size:16px">Installing Eclipse IDE for Web Application</li>
							<li style="font-size:16px">Installation, Configuring Tomcat Server</li>
							<li style="font-size:16px">Connecting Eclipse to Tomcat </li>
		        </ol>
		      </div>
		    </div>
		  </div>
			
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          <ul><li style="margin-left:10px;font-size:17px">HTML & XML</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Basic Concepts of HTML</li>
							<li style="font-size:16px">The Skeleton of WebPage </li>
							<li style="font-size:16px">Creating a Form</li>
							<li style="font-size:16px">Tables</li>
							<li style="font-size:16px">Overview of XML </li>
							<li style="font-size:16px">Creating XML File in Eclipse</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          <ul><li style="margin-left:10px;font-size:17px">Java Servlet Technology</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Servlet Introduction</li>
							<li style="font-size:16px">Servlet API</li>
							<li style="font-size:16px">Servlet Interface</li>
							<li style="font-size:16px">Generic Servlet</li>
							<li style="font-size:16px">HttpServlet</li>
							<li style="font-size:16px">Servlet in Eclipse</li>
							<li style="font-size:16px">Servlet Life cycle</li>
							<li style="font-size:16px">Working of Servlet</li>
							<li style="font-size:16px">Welcome-file-list</li>
							<li style="font-size:16px">load-on-startup tag</li>
							<li style="font-size:16px">ServletRequest</li>
							<li style="font-size:16px">RequestDispatcher</li>
							<li style="font-size:16px">ServletConfig</li>
							<li style="font-size:16px">ServletContext</li>
							<li style="font-size:16px">ServletResponse</li>
							<li style="font-size:16px">HttpSession</li>
							<li style="font-size:16px">Cookies</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          <ul><li style="margin-left:10px;font-size:17px">JSP Technology</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Introduction of JSP</li>
							<li style="font-size:16px">The Life Cycle of a JSP Page</li>
							<li style="font-size:16px">Directives in JSP</li>
							<li style="font-size:16px">Scriptlets in JSP</li>
							<li style="font-size:16px">Action Tag in JSP</li>
							<li style="font-size:16px">Expression in JSP</li>
							<li style="font-size:16px">Declaration in JSP</li>
							<li style="font-size:16px">JSP Implicit Objects</li>
							<li style="font-size:16px">Expression language(EL) in JSP</li>
							<li style="font-size:16px">Exception handling</li>
							<li style="font-size:16px">Custom Tags</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          <ul><li style="margin-left:10px;font-size:17px">EJB(Enterprise Java Beans)</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Introduction to EJB</li>
							<li style="font-size:16px">Environment Setup</li>
							<li style="font-size:16px">Create Application</li>
							<li style="font-size:16px">Stateless Bean</li>
							<li style="font-size:16px">Stateful Bean</li>
							<li style="font-size:16px">Persistence</li>
							<li style="font-size:16px">Message Driven Beans</li>
							<li style="font-size:16px">Annotations</li>
							<li style="font-size:16px">Callbacks</li>
							<li style="font-size:16px">Timer Service</li>
							<li style="font-size:16px">Dependency Injection</li>
							<li style="font-size:16px">Interceptors</li>
							<li style="font-size:16px">Embeddable Objects</li>
							<li style="font-size:16px">Blobs/Clobs</li>
							<li style="font-size:16px">Transactions</li>
							<li style="font-size:16px">Security</li>
							<li style="font-size:16px">JNDI Bindings</li>
							<li style="font-size:16px">Entity Relationships</li>
							<li style="font-size:16px">Access Database</li>
							<li style="font-size:16px">Query Language</li>
							<li style="font-size:16px">Exception Handling</li>
							<li style="font-size:16px">Web Services</li>
							<li style="font-size:16px">Packaging Applications</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          <ul><li style="margin-left:10px;font-size:17px">Java Server Faces (JSF)</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Introduction of JSF</li>
							<li style="font-size:16px">Environment Setup</li>
							<li style="font-size:16px">Architecture of JSF</li>
							<li style="font-size:16px">Life Cycle of JSF</li>
							<li style="font-size:16px">First Application</li>
							<li style="font-size:16px">Managed Beans</li>
							<li style="font-size:16px">Page Navigation</li>
							<li style="font-size:16px">Basic Tags</li>
							<li style="font-size:16px">Facelet Tags</li>
							<li style="font-size:16px">Convertor Tags</li>
							<li style="font-size:16px">Validator Tags</li>
							<li style="font-size:16px">DataTable</li>
							<li style="font-size:16px">Composite Components</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          <ul><li style="margin-left:10px;font-size:17px">Java Persistence API</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Introduction to Java Persistence API (JPA)</li>
							<li style="font-size:16px">CRUD Operations</li>
							<li style="font-size:16px">JPA & CRUD Benefits</li>
							<li style="font-size:16px">How it can be achieved?</li>
							<li style="font-size:16px">Download & Install Eclipse & MySQL</li>
							<li style="font-size:16px">Install MySQL Connector Jar</li>
							<li style="font-size:16px">Application Building</li>
							<li style="font-size:16px">Database & Table Creation</li>
							<li style="font-size:16px">Project Deploy</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          <ul><li style="margin-left:10px;font-size:17px">Java Mail API</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Java Mail Introduction</li>
							<li style="font-size:16px">Sending Email</li>
							<li style="font-size:16px">Sending email by Gmail</li>
							<li style="font-size:16px">Receiving Email</li>
							<li style="font-size:16px">Sending attachment</li>
							<li style="font-size:16px">Receiving attachment</li>
							<li style="font-size:16px">Sending HTML</li>
							<li style="font-size:16px">Forwarding email</li>
							<li style="font-size:16px">Deleting email</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          <ul><li style="margin-left:10px;font-size:17px">Web Services</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">What is web service</li>
							<li style="font-size:16px">WS Components</li>
							<li style="font-size:16px">SOAP Web Service</li>
							<li style="font-size:16px">RESTful Web Service</li>
							<li style="font-size:16px">SOAP vs RESTSOA</li>
							<li style="font-size:16px">Web Services in Java</li>
							<li style="font-size:16px">Difference between RPC and Document web services</li>
							<li style="font-size:16px">JAX-WS (SOAP)</li>
							<li style="font-size:16px">JAX-RS (REST) </li>
		        </ol>
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

			

  
	</div>
	</div>
</div>

<div class="container">
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
<br><br>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1 style="color:#033435">Support</h1>
				<p style="line-height: 10px">Ph No. <a href="telno:9686844724">9686844724</a></p>
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
