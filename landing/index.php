<?php
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
	//Request hash
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';	
	if(strcasecmp($contentType, 'application/json') == 0){
		//$data->key = 'H4vy5Eez';
		//$data->salt = '98VYR9A7yH';
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
	return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'ads-response2.php';
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
							<li> <a href="index.html">Home</a> </li>
							<li class="current"> <a href="about-us.html">Data Science </a></li>
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
					<iframe class="elementor-video-iframe" allowfullscreen="" title="vimeo Video Player" src="https://player.vimeo.com/video/505565532?color&amp;autopause=0&amp;loop=0&amp;muted=0&amp;title=0&amp;portrait=0&amp;byline=0#t=" style="width:100%;height:400px;border:0px !important"></iframe>
				</div>
				<div class="col-md-6">
					<h1 style="color:black">THE FULL SUITE<br>DATA SCIENCE COURSE</h1>
					<table class="table table-responsive table-bordered">
						<tbody>
						<tr>
						<th>Duration :</th>
						<td>5 Months</td>
						</tr>
						<tr>
						<th>Mode :</th>
						<td>Online Live Classes</td>
						</tr>
						<tr>
						<th>Placement :</th>
						<td>Assistance &amp; Guarantee</td>
						</tr>
						<tr>
						<th>Language :</th>
						<td>English</td>
						</tr>
						<tr>
						<th>EMI :</th>
						<td>Available</td>
						</tr>
						</tbody>
						</table>
				</div>
			</div>
		</div>
		<div class="row">
				<div class="col-md-8">
					<h1 style="color:black">About Course</h1>
					<p>Designed by Netzwerk Academy,THE FULL SUITE DATA SCIENCE COURSE is the go to option for anyone with keen interest in this field, it covers wide array of topics from python, machine learning, mathematics to statistics and muchmore.</p>
					<p>It is a beginer friendly course that is suitable for learnersenalysts and for even job seekers. This course is a strategic blend of perfect theories, real life examples, and module wise interview questions that makes it a complete toolbox to become a data scientist.</p>
					<p>The demand of a data scientist is increasing everyday in every field, the goal is to transform data into information, and information into insight,which is possiblle with this</p>
					<p>FULL SUITE DATA SCIENCE COURSE.</p>
				</div>
				<div class="col-md-4">
					<br><br><br>
					<img src="https://netzwerkacademy.com/wp-content/uploads/2020/05/advancedatascience-min.png"><br><br>
				</div>
		</div>
</div>
<br><br>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1 style="color:black">COURSE HIGHLIGHTS</h1>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;The course provides the entire toolbox you need to become a data scientist</p>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;Start coding in Python and learn how to use it for stastical analysis.</p>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;Understand the mathematics behind the Machine Learning.</p>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;Ten Machine Learning algorithms from scratch with several examples</p>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;and projects explained and for self-practice.</p>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;Improve Machine Learning algorithms by studying underfitting,overfitting, training, validation and model selection.</p>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;Access to GitHub for getting all the codes and new resources to work on and stay updated everyday.</p>
		</div>
		<div class="col-md-6">
			<h1 style="color:black">&nbsp;</h1>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;Regular updates on modules to meet changing industry requirements.</p>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;You will be able to create Machine Learning algorithms in Python, using Numpy, stats models and scikit-learn.</p>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;Get best in practice for resume preparation for high probability of getting shortlisted.</p>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;Ten Machine Learning algorithms from scratch with several examples</p>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;Learn how to hunt the lobs through employment portals with proven methods.</p>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;Optimize your employment portal profile page to attract interviewers.</p>
			<p><i class="fa fa-check fa-lg" style="color:#EFC444"></i>&nbsp;&nbsp;Dedicated support team for solving your technical and fundamental queries.</p>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<h1 style="color: #fff">WHAT WE OFFER</h1>
		<div class="col-md-4">
			<center>
				<img src="https://netzwerkacademy.com/wp-content/uploads/2020/05/advancedatascience-min.png" width="200px">
				<p>Email Support for clearing doubts</p>
			</center>
		</div>
		<div class="col-md-4">
			<center>
				<img src="https://netzwerkacademy.com/wp-content/uploads/2020/05/advancedatascience-min.png" width="200px">
				<p>Explainatory Content</p>
			</center>
		</div>
		<div class="col-md-4">
			<center>
				<img src="https://netzwerkacademy.com/wp-content/uploads/2020/05/advancedatascience-min.png" width="200px">
				<p>Textual and Graphical Representations</p>
			</center>
		</div>
		<div class="col-md-4">
			<center>
				<img src="https://netzwerkacademy.com/wp-content/uploads/2020/05/advancedatascience-min.png" width="200px">
				<p>Easy to use Portal</p>
			</center>
		</div>
		<div class="col-md-4">
			<center>
				<img src="https://netzwerkacademy.com/wp-content/uploads/2020/05/advancedatascience-min.png" width="200px">
				<p>Access on Mobile</p>
			</center>
		</div>
		<div class="col-md-4">
			<center>
				<img src="https://netzwerkacademy.com/wp-content/uploads/2020/05/advancedatascience-min.png" width="200px">
				<p>Self Paced Learning</p>
			</center>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<h1 style="color: #fff">GET THIS OFFER</h1>
		<center>
			<p style="font-size: 24px">Get the Full Suit Data Science Course now at only Rs. 2499/-</p>
			<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
			  Buy Now
			</button>

			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Enroll for Advance Data Science</h4>
			      </div>
			      <div class="modal-body">
			        <form action="#" id="payment_form">
    <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
	<input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />
    <input type="text" id="key" name="key" placeholder="Merchant Key" value="H4vy5Eez" hidden="" />
	<input type="text" id="salt" name="salt" placeholder="Merchant Salt" value="98VYR9A7yH" hidden="" />
	<input type="text" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "NW_TXN_" . rand(10000,99999999)?>" hidden/>
	<input type="text" id="amount" name="amount" placeholder="Amount" value="2499" hidden="" />
    <input type="text" id="pinfo" name="pinfo" placeholder="Product Info" value="Advance Data Science" hidden="" />
    
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
		<h1 style="color: #fff">SYLLABUS</h1>
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingOne">
		      <h4 class="panel-title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		          Mathematics
		        </a>
		      </h4>
		    </div>
		    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li>Statistics</li>
					<li>Probability</li>
					<li>Linear Algebra</li>
					<li>Calculus</li>
		        </ol>
		      </div>
		    </div>
		  </div>
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          Python
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li>Basics</li>
		        	<li>Control Flow and Iterations</li>
		        	<li>In-built Data Structures</li>
		        	<li>Functions</li>
		        	<li>Exception handling</li>
		        	<li>File handling</li>
		        	<li>Classes in Python</li>
		        	<li>Numpy</li>
		        	<li>Matplotlib</li>
		        	<li>Pandas</li>
		        </ol>
		      </div>
		    </div>
		  </div>
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingThree">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
		          Machine Learning
		        </a>
		      </h4>
		    </div>
		    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
		      <div class="panel-body" style="color:black">
		        <ol type="1">
		        	<li>Introduction</li>
					<li>Types of data and extraction</li>
					<li>Raw & Processed data</li>
					<li>ED Analysis</li>
					<li>Types of Machine learning :-</li>
						<ol type="1">
						<li>Supervised</li>
							<ol type="1">
							<li>Regression</li>
							<li>Classification</li>
							</ol>
						<li>Unsupervised</li>
							<ol type="1">
							<li>Clustering</li>
							</ol>
						<li>Linear Regression</li>
						<li>Cost Function and Optimization(Gradient Descent)</li>
						<li>Logistic Regression</li>
						<li>KNN</li>
						<li>Decision Trees</li>
						<li>Model Selection</li>
							<ol type="1">
							<li>Over Fitting & Under Fitting</li>
							<li>Regularization: Ridge and Lasso</li>
							<li>Feature Engineering</li>
							<li>Cross Validation</li>
							<li>Normalization & Standardization</li>
							<li>Hyper Parameter Tuning</li>
							<li>Accuracy Metrics ( Confusion matrix, F1 score, ..)</li>
							</ol>
						</ol>
					<li>Support Vector Machine (SVM)</li>
					<li>Gradient Boosting</li>
					<li>Extreme Gradient Boosting & XG boost</li>
		        </ol>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<h1 style="color:black">WHAT OUR STUDENTS HAVE TO SAY</h1>
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
			<h1 style="color:black">Support</h1>
				<p style="line-height: 10px">Ph No. <a href="telno:9945549645">9945549645</a></p>
				<p style="line-height: 10px">Email: <a href="mailto:info@netzwerkacademy.com">info@netzwerkacademy.com</a></p>
				<p style="line-height: 10px">Address</p>
		</div>
		<div class="col-md-6">
			<h1 style="color:black">FAQs</h1>
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
