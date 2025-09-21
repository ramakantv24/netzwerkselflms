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
  <title>Software Testing Course | Netzwerk Academy</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css'><link rel="stylesheet" href="./style.css">
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
							<li class=""> <a href="j2ee.php">Advance Java </a></li>
              <li class="current"> <a href="software-testing.php">Software Testing</a></li>
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
					<img src="https://netzwerkacademy.com/wp-content/uploads/2021/02/Software-testing-min.jpg" width="100%">
				</div>
				<div class="col-md-6">
					<h1 style="color:black">Software Testing Course</h1>
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
						<td>Rs. 1799</td>
						</tr>
						</tbody>
						</table>
				</div>
			</div>
		</div>
		<div class="row">
				<div class="col-md-12">
					<h1 style="color:#033435">About Course</h1>
					<p>Netzwerk Academy provides a complete Software Testing training by a certified trainers who are currently the working professional in the same field. This course will make you proficient in performing functional and regression test automation for software applications and environments through a hands-on approach with real-world examples. Our training is designed according to the latest developments as per industry requirements and demands, and learning them will be essential for clearing the certification exams.</p>
				</div>

				<div class="col-md-12">
					<h1 style="color:#033435">Scope of learning Software Testing:</h1>
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
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Fundamental concepts in software testing, including software testing objectives, process, criteria, strategies, and methods</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Various software testing issues and solutions in software unit test; integration, regression, and system testing.</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Planning a test project, design test cases and data, conduct testing operations, manage software problems and defects, generate a testing report.</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Expose the advanced software testing topics, such as object-oriented software testing methods, and component-based software testing issues, challenges, and solutions.</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Gain software testing experience by applying software testing jobs and methods to practice-oriented software testing projects.</p>
		</div>
		<div class="col-md-6">
			<h1 style="color:black">&nbsp;</h1>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Understand software test automation problems and solutions.</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Learn how to write software testing documents, and communicate with engineers in various forms.</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Gain the techniques and skills on how to use modern software testing tools to support software testing projects.</p>
			<p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;Selenium tool on Java programming</p>
            <p><i class="fa fa-check fa-lg" style="color:#033435"></i>&nbsp;&nbsp;A blend of MsSQL</p>
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
			<p style="font-size: 24px">Get the Software Testing Course now at only Rs. 1799</p>
			<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
			  Buy Now
			</button>

			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Enroll for Software Testing Course</h4>
			      </div>
			      <div class="modal-body">
			        <form action="#" id="payment_form">
    <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
	<input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />
    <input type="text" id="key" name="key" placeholder="Merchant Key" value="H4vy5Eez" hidden="" />
	<input type="text" id="salt" name="salt" placeholder="Merchant Salt" value="98VYR9A7yH" hidden="" />
	<input type="text" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "NW_TXN_" . rand(10000,99999999)?>" hidden/>
	<input type="text" id="amount" name="amount" placeholder="Amount" value="1799" hidden="" />
    <input type="text" id="pinfo" name="pinfo" placeholder="Product Info" value="Software Testing Course" hidden="" />
    
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
		          <ul><li style="margin-left:10px;font-size:17px">Manual testing </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li style="font-size:16px">Introduction of the Course</li>
							<li style="font-size:16px">Software Development Life Cycle [SDLC]</li>
							<li style="font-size:16px">White box testing / Unit testing</li>
							<li style="font-size:16px">Black box testing</li>
							<li style="font-size:16px">Non-Functional Testing</li>
							<li style="font-size:16px">Test Plan</li>
							<li style="font-size:16px">Test Case</li>
							<li style="font-size:16px">Test Data</li>
							<li style="font-size:16px">Software Test life cycle [STLC]</li>
							<li style="font-size:16px">Defect Life Cycle</li>
							<li style="font-size:16px">Interview Questions</li>
		        </ol>
		      </div>
		    </div>
		  </div>
		
			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
		          <ul><li style="margin-left:10px;font-size:17px">Core Java programming </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
							<li style="font-size:16px">Introduction of Java</li>
							<li style="font-size:16px">OOP Concept</li>
							<li style="font-size:16px">Data types, Variables and Arrays</li>
							<li style="font-size:16px">Operators and Expressions</li>
							<li style="font-size:16px">Control Flow Statements</li>
							<li style="font-size:16px">Important Keywords</li>
							<li style="font-size:16px">Classes and Objects</li>
							<li style="font-size:16px">Constructor in Java</li>
							<li style="font-size:16px">Inheritance in Java</li>
							<li style="font-size:16px">Packages</li>
							<li style="font-size:16px">Exception Handling</li>
							<li style="font-size:16px">Input/Output Streams</li>
							<li style="font-size:16px">Collection Framework</li>
							<li style="font-size:16px">Inheritance and Abstract Classes</li>
							<li style="font-size:16px">Multithreading</li>
							<li style="font-size:16px">File Handling in Java</li>
							<li style="font-size:16px">Strings in Java</li>
							<li style="font-size:16px">Reflection</li>
							<li style="font-size:16px">Annotations in Java</li>
							<li style="font-size:16px">Useful and/or Advanced Features</li>
							<li style="font-size:16px">Applets, AWT and Swing in Java</li>
							<li style="font-size:16px">JDBC</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo21" aria-expanded="false" aria-controls="collapseTwo21">
		          <ul><li style="margin-left:10px;font-size:17px">Selenium </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo21" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
							<li style="font-size:16px">Web Element</li>
							<li style="font-size:16px">Locators</li>
							<li style="font-size:16px">Synchronization</li>
							<li style="font-size:16px">Few Sample Codes</li>
							<li style="font-size:16px">Handling Listbox</li>
							<li style="font-size:16px">POM Concept</li>
							<li style="font-size:16px">TestNG</li>
							<li style="font-size:16px">Page Object Model</li>
							<li style="font-size:16px">Framework</li>
							<li style="font-size:16px">Jenkins</li>
							<li style="font-size:16px">Architecture of Framework</li>
							<li style="font-size:16px">Automation Framework Design Details</li>
							<li style="font-size:16px">Handling Popups</li>
							<li style="font-size:16px">List of Exceptions</li>
							<li style="font-size:16px">Interview Questions</li>
		        </ol>
		      </div>
		    </div>
		  </div>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo22" aria-expanded="false" aria-controls="collapseTwo22">
		          <ul><li style="margin-left:10px;font-size:17px">MsSQL </li></ul>
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo22" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
							<li style="font-size:16px">Introduction to Databases & SQL</li>
							<li style="font-size:16px">Microsoft SQL Server & Management Studio Setup</li>
							<li style="font-size:16px">Selecting & Filtering Data 1</li>
							<li style="font-size:16px">Selecting & Filtering Data 2</li>
							<li style="font-size:16px">Inserting, Updating & Deleting Data</li>
							<li style="font-size:16px">Combining & Joining Multiple Tables</li>
							<li style="font-size:16px">Other SQL Concepts</li>
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
<!--
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
<br><br>-->
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
