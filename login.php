<?php
ob_start();
session_start();
$msg = '';
if(isset($_POST['email'])){

	include 'admin/dbConn.php';
	#$sql = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))";
	#mysqli_query($con, $sql);
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = md5(md5($password));
	
	$sql22 = "SELECT * FROM `users` WHERE `email` LIKE '$email' AND `password` LIKE '$password'";
	$user22SQLRes     = mysqli_query($con,$sql22); 
	$user22Row        = mysqli_fetch_assoc($user22SQLRes);
	
	if($user22Row['user_status'] == 'P'){
		header("Location: login.php?ex=out");
	}
	
	$currentDate  = date('Y-m-d');
	if(isset($user22Row['expire_date']) && ($currentDate > $user22Row['expire_date'])){
		header("Location: login.php?ex=expire");
	}
	
	$sql = "SELECT * FROM `users` WHERE `email` LIKE '$email' AND `password` LIKE '$password' AND `user_status` = 'C'";
	if($result = mysqli_query($con, $sql)){
		$count = mysqli_num_rows($result);
		if($count!=0){
			while ($row = mysqli_fetch_row($result)) {
				$hash = md5($email.$password.mt_rand(00000000,9999999));
				$ID = $row[0];
				$sql = "UPDATE `users` SET `hash` = '$hash' WHERE `ID` LIKE '$ID'";
				if(mysqli_query($con, $sql)){
					$_SESSION['token'] = $hash;
					$_SESSION['id'] = $ID;
					$_SESSION['logged_in'] = 1;
					$_SESSION['uname'] = $row[8];
					header("Location: index.php");
				}
			}
		}else{
			header("Location: login.php?ex=in");
		}
	}
	exit();
}

if(isset($_GET['ex'])){
	if($_GET['ex']=='in'){
		$msg = '<br>Invalid Credentials. Try again<br><br>';
	}
	if($_GET['ex']=='out'){
		$msg = '<br>Your Account not Approve by admin<br><br>';
	}
	if($_GET['ex']=='expire'){
		$msg = '<br>Your Account Has been expired!<br><br>';
	}
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Login Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Yinka Enoch Adedokun">
<meta name="apple-mobile-web-app-title" content="CodePen">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
				    <!-- <img src="https://www.netzwerkself.com/lms_logo.png" style="height:350px;"/> -->
				    <img src="images/newlogo1.png" style="height:300px;"/>
				</h2></span>
				<h4 class="company_title"></h4>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 login_form">
				<div class="container-fluid">
					<div class="row">
						<h2>User Login</h2>
					</div>
					<div class="row">
						<form  action="login.php" method="post" class="form-group">
							<div class="row">
								<input type="email" name="email" id="username" class="form__input" placeholder="Enter Your Email" required>
								<?php echo $msg; ?>
							</div>
							<div class="row">
								<input type="password" name="password" id="password" class="form__input" placeholder="Password" required>
							</div>
							<!--<div class="row">
								<input type="checkbox" name="remember_me" id="remember_me" class="">
								<label for="remember_me">Remember Me!</label>
							</div>-->
							<div class="row">
								<p><a href="https://www.netzwerkself.com/lms/forgot-password.php">Forgot password?</a> &nbsp; | &nbsp; <a target="_blank" href="https://api.whatsapp.com/send?phone=919789750652&text=Hi%20team%20Netzwerk,%20I%20am%20trying%20to%20login%20to%20LMS%20portal,%20I%20am%20facing%20issue">Issue in login</a></p>
							</div>
							<div class="row">
								<input type="submit" name="submit" value="Submit" class="btn">
							</div>
						</form>
					</div>
					<!--<div class="row">
						<p><a href="https://netzwerkself.com/lms/forgot-password.php">Forgot password?</a></p>
					</div>-->
				</div>
			</div>
		</div>
	</div>
</body>
</html>