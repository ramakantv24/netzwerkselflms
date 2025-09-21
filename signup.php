<?php
session_start();
$msg = '';
if(isset($_POST['email'])){
	echo 'Please wait...';
	include 'admin/dbConn.php';
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = md5(md5($password));
	$sql = "SELECT * FROM `users` WHERE `email` LIKE '$email' AND `password` LIKE '$password'";
	echo $sql;
	if($result = mysqli_query($con, $sql)){
		$count = mysqli_num_rows($result);
		if($count==0)
			header("Location: login.php?ex=in");
		while ($row = mysqli_fetch_row($result)) {
			$hash = md5($email.$password.mt_rand(00000000,9999999));
			$ID = $row[0];
			$sql = "UPDATE `users` SET `hash` = '$hash' WHERE `ID` LIKE '$ID'";
			if(mysqli_query($con, $sql)){
				$_SESSION['token'] = $hash;
				$_SESSION['id'] = $ID;
				$_SESSION['logged_in'] = 1;
				$_SESSION['uname'] = $row[4];
				header("Location: index.php");
			}
		}
	}
	exit();
}

if(isset($_GET['ex'])){
	if($_GET['ex']=='in')
		$msg = '<br>Invalid Credentials. Try again<br><br>';
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Login : LMS</title>
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
</head> 
<body class="cbp-spmenu-push">
<div class="main-content">
		<div id="page-wrapper">
			<div class="main-page signup-page">
				<h2 class="title1">SignUp Here</h2>
				<div class="sign-up-row widget-shadow">
					<h5>Personal Information :</h5>
				<form action="#" method="post">
					<div class="sign-u">
								<input type="text" name="firstname" placeholder="First Name" required="">
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
								<input type="text" placeholder="Last Name" required="">
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
								<input type="email" placeholder="Email Address" required="">
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Gender* :</h4>
						</div>
						<div class="sign-up2">
							<label>
								<input type="radio" name="Gender" required="">
								Male
							</label>
							<label>
								<input type="radio" name="Gender" required="">
								Female
							</label>
						</div>
						<div class="clearfix"> </div>
					</div>
					<h6>Login Information :</h6>
					<div class="sign-u">
								<input type="password" placeholder="Password" required="">
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
								<input type="password" placeholder="Confirm Password" required="">
						</div>
						<div class="clearfix"> </div>
					<div class="sub_home">
							<input type="submit" value="Submit">
						<div class="clearfix"> </div>
					</div>
					<div class="registration">
						Already Registered.
						<a class="" href="login.html">
							Login
						</a>
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