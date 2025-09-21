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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<!-- Global site tag (gtag.js) - Google Ads: 764473008 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-764473008"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-764473008');
</script>
<!-- BOLT Sandbox/test //-->
<!--<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>-->
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
							<li class=""> <a href="manual-testing.php">Manual Testing </a></li>
							<li class="current"> <a href="core-java.php">Core Java</a></li>
							<li class=""> <a href="j2ee.php">Advance Java </a></li>
              <li class=""> <a href="software-testing.php">Software Testing</a></li>
							<li class=""> <a href="software-development.php">Software Development</a></li>
					</ul>
					</nav> </div>
			</div>
	</div>
</div>
</header>
<a href="https://api.whatsapp.com/send?phone=+918748000630&text=" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>

<div class="container">
<div style="margin-top:10px;box-shadow: -5px 0px 10px 0px rgb(0 0 0 / 50%);">
			<div class="row">
				<div class="col-md-6">
					<!--<img src="https://netzwerkacademy.com/wp-content/uploads/2021/02/Core-Java-min.jpg" width="100%">-->
					<iframe src="https://player.vimeo.com/video/533546716" width="100%" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
				</div>
				<div class="col-md-6">
					<h1 style="color:black">Core Java</h1>
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
						<th>Course Fees :</th>
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
					<p>Designed by Netzwerk Academy,THE FULL SUITE JAVA PROGRAMMING COURSE is the go to option for anyone with keen interest in this field, it covers wide array of topics from to Basics to OOP concepts, Packages, exception handling and much more.</p>
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
			<p style="font-size: 24px">Get the Core Java Course now at only Rs. 499</p>
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
    <input type="text" id="pinfo" name="pinfo" placeholder="Product Info" value="Core Java" hidden="" />
    
    <div class="form-group" style="width: 300px">
	    <span>
	    	<input type="text" id="fname" name="fname" placeholder="First Name" class="form-control"/>
	    </span>
    </div>
    
    <div class="form-group" style="width: 300px">
    	<span>
    		<input type="text" id="email" name="email" placeholder="Email ID" class="form-control" onfocusout="checkDetails()"/>
    	</span>
    </div>
    
    <div class="form-group" style="width: 300px">
    	<span>
    		<input type="text" id="mobile" name="mobile" placeholder="Mobile/Cell Number" class="form-control" />
    	</span>
    </div>
    <input type="text" id="hash" name="hash" placeholder="Hash" value="" hidden="" />
    <p id="errMsgN" style="font-size:14px;color:red"></p>
    <div><input type="submit" id="paynow" value="Pay Now" onclick="launchBOLT(); return false;" class="btn btn-success" disabled/></div>
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
		          <ul><li style="margin-left:10px;font-size:17px">Introduction of Java </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">What is Java?</li>
<li style="font-size:16px">Why Java ?</li>
<li style="font-size:16px">Setting up the environment in Java</li>
<li style="font-size:16px">A First Java Program </li>
<li style="font-size:16px">Java Naming Conventions</li>
<li style="font-size:16px">How JVM Works – JVM Architecture?</li>
<li style="font-size:16px">Differences between JDK, JRE and JVM</li>
<li style="font-size:16px">Run Program in Different IDE(Eclipse , NetBeans) and Command Prompt.</li>
		        </ol>
		      </div>
		    </div>
		  </div>
			
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          <ul><li style="margin-left:10px;font-size:17px">OOP concept</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Introduction to OOP Concept</li>
<li style="font-size:16px">Inheritance in Java</li>
<li style="font-size:16px">Encapsulation in Java</li>
<li style="font-size:16px">Abstraction in Java</li>
<li style="font-size:16px">Polymorphism in Java </li>
<li style="font-size:16px">Why Java is not a purely Object-Oriented Language?</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
		          <ul><li style="margin-left:10px;font-size:17px">Data types , Variables and Arrays</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Java Identifiers</li>
		        	<li style="font-size:16px">Data types </li>
		        	<li style="font-size:16px">How to define our own data type in java(enum) </li>
		        	<li style="font-size:16px">Literals in Java (Numeric Literals, Character Literals, String Literals)</li>
		        	<li style="font-size:16px">Variable & Declarations of Variable</li>
		        	<li style="font-size:16px">Scope of Variables</li>
		        	<li style="font-size:16px">Final Variable</li>
		        	<li style="font-size:16px">Type Conversion and Casting</li>
		        	<li style="font-size:16px">Arrays</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
		          <ul><li style="margin-left:10px;font-size:17px">Operators and Expressions</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Expressions </li>
		        	<li style="font-size:16px">Arithmetic Operators </li>
		        	<li style="font-size:16px">Bitwise Operators</li>
		        	<li style="font-size:16px">Relational Operators </li>
		        	<li style="font-size:16px">Logical Operators </li>
		        	<li style="font-size:16px">Assignment Operator </li>
		        	<li style="font-size:16px">Increment and Decrement Operators </li>
		        	<li style="font-size:16px">The Conditional Operator </li>
		        	<li style="font-size:16px">Operator Precedence </li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo3" aria-expanded="false" aria-controls="collapseTwo3">
		          <ul><li style="margin-left:10px;font-size:17px">Control Flow Statements</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Selection Statement (if , Switch)</li>
							<li style="font-size:16px">Iteration Statements (while, do-while , for , for each & Nested Loop)</li>
		        	<li style="font-size:16px">Jump Statements (break , Continue, Return) </li>
		        	<li style="font-size:16px">Does Java support goto?</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4">
		          <ul><li style="margin-left:10px;font-size:17px">Important Keywords</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">List of all Java Keywords</li>
		        	<li style="font-size:16px">Important Keywords in Java</li>
		        	<li style="font-size:16px">this keyword</li>
		        	<li style="font-size:16px">super Keyword</li>
		        	<li style="font-size:16px">static keyword</li>
		        	<li style="font-size:16px">final keyword</li>
		        	<li style="font-size:16px">final, finally and finalize in Java</li>
		        	<li style="font-size:16px">abstract Keyword</li>
		        	<li style="font-size:16px">transient keyword in Java</li>
		        	<li style="font-size:16px">volatile keyword in Java</li>
		        	<li style="font-size:16px">strictfp keyword</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo5" aria-expanded="false" aria-controls="collapseTwo5">
		          <ul><li style="margin-left:10px;font-size:17px">Classes and objects </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Classes and Objects</li>
		        	<li style="font-size:16px">Java object storage</li>
		        	<li style="font-size:16px">Different ways to create objects in Java</li>
		        	<li style="font-size:16px">Association, Composition and Aggregation</li>
		        	<li style="font-size:16px">Access and Non-Access Modifiers in Java</li>
		        	<li style="font-size:16px">Access Modifiers</li>
		        	<li style="font-size:16px">this reference </li>
		        	<li style="font-size:16px">Object class</li>
		        	<li style="font-size:16px">Static class in Java</li>
		        	<li style="font-size:16px">Method Overloading</li>
		        	<li style="font-size:16px">Method Overriding</li>
		        	<li style="font-size:16px">Understanding “static” in “public static void main” in Java</li>
		        	<li style="font-size:16px">Overloading or Overriding static methods</li>
		        	<li style="font-size:16px">Shadowing of static methods(Also called Method Hiding)</li>
		        	<li style="font-size:16px">Static methods vs Instance methods in Java</li>
		        	<li style="font-size:16px">Assigning values to static final variables in Java</li>
		        	<li style="font-size:16px">Covariant return types</li>
		        	<li style="font-size:16px">Flexible nature of java.lang.Object</li>
		        	<li style="font-size:16px">Overriding equals method of Object class</li>
		        	<li style="font-size:16px">Overriding toString() method of Object class</li>
		        	<li style="font-size:16px">Instance Variable Hiding </li>
		        	<li style="font-size:16px">Static blocks in Java</li>
		        	<li style="font-size:16px">initializer block in java</li>
		        	<li style="font-size:16px">instance initializer block in java(non-static block)</li>
		        	<li style="font-size:16px">Static vs Dynamic Binding</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo6" aria-expanded="false" aria-controls="collapseTwo6">
		          <ul><li style="margin-left:10px;font-size:17px">Constructor in Java</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Constructors</li>
		        	<li style="font-size:16px">Constructors in Java</li>
		        	<li style="font-size:16px">Default constructor</li>
		        	<li style="font-size:16px">Assigning values to static final variables</li>
		        	<li style="font-size:16px">Copy Constructor</li>
		        	<li style="font-size:16px">Constructor Chaining</li>
		        	<li style="font-size:16px">Private Constructors and Singleton Classes</li>
		        	<li style="font-size:16px">Singleton Class</li>
		        	<li style="font-size:16px">Constructor Overloading</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo7" aria-expanded="false" aria-controls="collapseTwo7">
		          <ul><li style="margin-left:10px;font-size:17px">Inheritance in Java</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Inheritance in Java</li>
		        	<li style="font-size:16px">Multiple Inheritance</li>
		        	<li style="font-size:16px">Why Java does’nt support Multiple Inheritance – The Diamond Problem</li>
		        	<li style="font-size:16px">Java Object Creation of Inherited Class</li>
		        	<li style="font-size:16px">Inheritance and constructors</li>
		        	<li style="font-size:16px">Interfaces and Inheritance</li>
		        	<li style="font-size:16px">Using final with Inheritance</li>
		        	<li style="font-size:16px">Override private methods</li>
		        	<li style="font-size:16px">More restrictive access to a derived class method in Java</li>
		        	<li style="font-size:16px">Parent and Child classes having same data member </li>
		        	<li style="font-size:16px">Object Serialization with Inheritance</li>
		        	<li style="font-size:16px">Referencing Subclass objects with Subclass vs Superclass reference</li>
		        	<li style="font-size:16px">Does overloading work with inheritance</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo8" aria-expanded="false" aria-controls="collapseTwo8">
		          <ul><li style="margin-left:10px;font-size:17px">Packages</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Packages Introduction</li>
		        	<li style="font-size:16px">java.io package</li>
		        	<li style="font-size:16px">java.lang package</li>
		        	<li style="font-size:16px">java.util package</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo9" aria-expanded="false" aria-controls="collapseTwo9">
		          <ul><li style="margin-left:10px;font-size:17px">Exception Handling</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Exceptions</li>
		        	<li style="font-size:16px">OutOfMemoryError Exception</li>
		        	<li style="font-size:16px">Different ways to print Exception messages in Java</li>
		        	<li style="font-size:16px">flow control in try-catch-finally</li>
		        	<li style="font-size:16px">Types of Exceptions</li>
		        	<li style="font-size:16px">Catching base and derived classes as exceptions</li>
		        	<li style="font-size:16px">Checked vs Unchecked Exceptions</li>
		        	<li style="font-size:16px">Throw and Throws</li>
		        	<li style="font-size:16px">User-defined Custom Exception</li>
		        	<li style="font-size:16px">Infinity or Exception?</li>
		        	<li style="font-size:16px">Multicatch</li>
		        	<li style="font-size:16px">Chained Exceptions</li>
		        	<li style="font-size:16px">Null Pointer Exception </li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwoa" aria-expanded="false" aria-controls="collapseTwoa">
		          <ul><li style="margin-left:10px;font-size:17px">Input/output Streams</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwoa" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Character Stream Vs Byte Stream</li>
		        	<li style="font-size:16px">DoubleStream mapToObj() in Java</li>
		        	<li style="font-size:16px">Command Line arguments</li>
		        	<li style="font-size:16px">Scanner Class</li>
		        	<li style="font-size:16px">Scanner and nextChar()</li>
		        	<li style="font-size:16px">Scanner vs BufferReader Class</li>
		        	<li style="font-size:16px">Formatted output</li>
		        	<li style="font-size:16px">Fast I/O for Competitive Programming</li>
		        	<li style="font-size:16px">Reading input from console</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwob" aria-expanded="false" aria-controls="collapseTwob">
		          <ul><li style="margin-left:10px;font-size:17px">Collection Framework</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwob" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">The Collections Framework</li>
		        	<li style="font-size:16px">The Set Interface </li>
		        	<li style="font-size:16px">Set Implementation Classes </li>
		        	<li style="font-size:16px">The List Interface </li>
		        	<li style="font-size:16px">List Implementation Classes </li>
		        	<li style="font-size:16px">The Map Interface </li>
		        	<li style="font-size:16px">Map Implementation Classes </li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwoc" aria-expanded="false" aria-controls="collapseTwoc">
		          <ul><li style="margin-left:10px;font-size:17px">Interfaces and Abstract Classes</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwoc" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Interfaces</li>
		        	<li style="font-size:16px">Access specifier for methods in interfaces</li>
		        	<li style="font-size:16px">Access specifiers for classes or interfaces</li>
		        	<li style="font-size:16px">Abstract Classes</li>
		        	<li style="font-size:16px">Difference between Abstract Class and Interface in Java</li>
		        	<li style="font-size:16px">Comparator Interface</li>
		        	<li style="font-size:16px">Java Interface methods</li>
		        	<li style="font-size:16px">Nested Interface</li>
		        	<li style="font-size:16px">Nested Classes in Java</li>
		        	<li style="font-size:16px">Inner class in java</li>
		        	<li style="font-size:16px">Local Inner Class in Java</li>
		        	<li style="font-size:16px">Anonymous Inner Class in Java</li>
		        	<li style="font-size:16px">Functional Interfaces</li>
		        	<li style="font-size:16px">What is a Marker interface</li>
		        	<li style="font-size:16px">Questions on Abstract Classes and Interfaces</li>
		        	<li style="font-size:16px">Static method in Interface in Java</li>
		        	<li style="font-size:16px">Function Interface in Java </li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwod" aria-expanded="false" aria-controls="collapseTwod">
		          <ul><li style="margin-left:10px;font-size:17px">Multithreading</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwod" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Introduction to Multithreading</li>
		        	<li style="font-size:16px">Lifecycle and states of a thread</li>
		        	<li style="font-size:16px">Main thread</li>
		        	<li style="font-size:16px">Methods to prevent thread execution</li>
		        	<li style="font-size:16px">inter thread communication</li>
		        	<li style="font-size:16px">Java.lang.Thread class</li>
		        	<li style="font-size:16px">Start() function in multithreading </li>
		        	<li style="font-size:16px">Java Thread Priority</li>
		        	<li style="font-size:16px">Joining Threads in Java</li>
		        	<li style="font-size:16px">Naming a thread and fetching name of current thread in Java</li>
		        	<li style="font-size:16px">Synchronization</li>
		        	<li style="font-size:16px">Method and Block Synchronization</li>
		        	<li style="font-size:16px">Producer-Consumer solution</li>
		        	<li style="font-size:16px">Thread Pools in Java</li>
		        	<li style="font-size:16px">Semaphore in Java</li>
		        	<li style="font-size:16px">Java.util.concurrent.Semaphore class in Java</li>
		        	<li style="font-size:16px">CountDownLatch</li>
		        	<li style="font-size:16px">Deadlock in java</li>
		        	<li style="font-size:16px">Daemon thread</li>
		        	<li style="font-size:16px">Reentrant Lock</li>
		        	<li style="font-size:16px">Cyclic Barrier in Java</li>
		        	<li style="font-size:16px">Callable and Future in Java</li>
		        	<li style="font-size:16px">Runtime Class</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwoe" aria-expanded="false" aria-controls="collapseTwoe">
		          <ul><li style="margin-left:10px;font-size:17px">File Handling in Java</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwoe" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">File class</li>
		        	<li style="font-size:16px">Ways of Reading a text file in Java</li>
		        	<li style="font-size:16px">file permissions in java</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwof" aria-expanded="false" aria-controls="collapseTwof">
		          <ul><li style="margin-left:10px;font-size:17px">Strings in Java</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwof" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">String Class</li>
		        	<li style="font-size:16px">StringBuffer Class</li>
		        	<li style="font-size:16px">StringBuilder Class</li>
		        	<li style="font-size:16px">StringTokenizer class</li>
		        	<li style="font-size:16px">StringJoiner in Java8</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwog" aria-expanded="false" aria-controls="collapseTwog">
		          <ul><li style="margin-left:10px;font-size:17px">Reflection</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwog" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Reflection in Java</li>
		        	<li style="font-size:16px">Method Class in Java</li>
		        	<li style="font-size:16px">Reflect Array class in Java</li>
		        	<li style="font-size:16px">util.Arrays vs reflect.Array in Java</li>
		        	<li style="font-size:16px">new operator vs newInstance()</li>
		        	<li style="font-size:16px">instanceof operator vs isInstance() </li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwoh" aria-expanded="false" aria-controls="collapseTwoh">
		          <ul><li style="margin-left:10px;font-size:17px">Annotations  in Java</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwoh" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Introduction </li>
							<li style="font-size:16px">Built-In Java Annotations</li>
							<li style="font-size:16px">Java Custom Annotations</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwoi" aria-expanded="false" aria-controls="collapseTwoi">
		          <ul><li style="margin-left:10px;font-size:17px">Useful and/or Advanced Features </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwoi" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Generics</li>
		        	<li style="font-size:16px">Wildcards in Java</li>
		        	<li style="font-size:16px">Assertions</li>
		        	<li style="font-size:16px">Annotations</li>
		        	<li style="font-size:16px">Serialization and Deserialization</li>
		        	<li style="font-size:16px">Lambda Expressions – Java 8</li>
		        	<li style="font-size:16px">Stream</li>
		        	<li style="font-size:16px">BigInteger Class</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwoj" aria-expanded="false" aria-controls="collapseTwoj">
		          <ul><li style="margin-left:10px;font-size:17px">Applets , AWT and Swing in Java </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwoj" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Introduction to applets</li>
		        	<li style="font-size:16px">Architecture of Applets</li>
		        	<li style="font-size:16px">Event Handling in Applets</li>
		        	<li style="font-size:16px">AWT Controls</li>
		        	<li style="font-size:16px">Event Handling in AWT</li>
		        	<li style="font-size:16px">Basic Difference Between Swing and Applets</li>
		        	<li style="font-size:16px">Swing Controls</li>
		        	<li style="font-size:16px">Event Handling in Swing</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwok" aria-expanded="false" aria-controls="collapseTwok">
		          <ul><li style="margin-left:10px;font-size:17px">JDBC</li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwok" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Introduction to JDBC</li>
		        	<li style="font-size:16px">Architecture of JDBC</li>
		        	<li style="font-size:16px">Type of JDBC Architecture </li>
		        	<li style="font-size:16px">Difference Between ODBC and JDBC</li>
		        	<li style="font-size:16px">Driver Types</li>
		        	<li style="font-size:16px">Statement Ojects</li>
		        	<li style="font-size:16px">Resultset</li>
		        	<li style="font-size:16px">Transaction Processing</li>
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
</div>-->
<br><br>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1 style="color:#033435">Support</h1>
				<p style="line-height: 10px">Ph No. <a href="telno:+918748000630">8748000630</a></p>
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
<script type="text/javascript">
function checkDetails() {
    var email = document.getElementById("email").value;
     $.ajax({
        url: 'check_c.php?cid=1&email='+email,
        dataType: 'json',
        success: function(data){
        if(data['success']==true){
            document.getElementById("paynow").disabled = true;
            document.getElementById("errMsgN").innerHTML = 'Your account already exist with Core Java Course';
        }else{
            document.getElementById("paynow").disabled = false;
            document.getElementById("errMsgN").innerHTML = '';
        }
    },
    error: function (err) {
        console.error('Error: ', err);
    }
    });
}
</script>
</body>
</html>
