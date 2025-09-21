<?php
ob_start();
session_start();
include 'admin/dbConn.php';
$msg = '';
if(isset($_POST['h']) AND $_POST['pass1'] AND $_POST['pass2']){
 $hash = $_POST['h'];
 $pass1= $_POST['pass1'];
 $pass2= $_POST['pass2'];
 if($pass1==$pass2){
	 $password = md5(md5($pass1));
	 $sql = "UPDATE `users` SET `password` = '$password' WHERE `hash` LIKE '$hash'";
	 if(mysqli_query($con, $sql)){
		 $sql = "UPDATE `users` SET `hash` = '123' WHERE `password` LIKE '$password'";
		 mysqli_query($con, $sql);
		 $msg = "Password change successfully. Goto <a href='login.php'>Login </a>";
	 }
 }else{
	 $msg = "Password aren't same";
 }
}else if(isset($_GET['h'])){
	$hash = $_GET['h'];
	$sql = "SELECT * FROM `users` WHERE `hash` LIKE '$hash'";
	if($result = mysqli_query($con, $sql)){
		$count = mysqli_num_rows($result);
		if($count!=0){
			while ($row = mysqli_fetch_row($result)) {
				
			}
		}else{
            exit();
        }
	}
}else{
	exit();
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Set New Password : LMS</title>
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
<body class="">
<div class="main-content">
		<div id="page-wrapper">
			<div class="main-page login-page " style="margin-top:-60px;">
				<center><img src="https://netzwerkacademy.com/wp-content/uploads/2020/01/Netzwerk-Academy-Logo-min.jpg" width="90px" style="margin-bottom:30px"></center>
				<h2 class="title1">Set New Password</h2>
				<div class="widget-shadow">
					<div class="login-body">
						<form action="#" method="post">
							<input type="password" class="user" name="pass1" placeholder="Enter New Password" required="">
							<input type="password" class="user" name="pass2" placeholder="Re-Enter New Password" required="">
							<input type="hidden" class="user" name="h" value="<?php echo $hash; ?>">
							<?php echo $msg; ?>
							<input type="submit" name="Reset Password" value="Reset Password">
						</form>
					</div>
				</div>
				
			</div>
		</div>
		<div class="footer">
		   <p>&copy; 2021 LMS - Netzwerk Academy</p></div>
	</div>
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
   <script src="js/bootstrap.js"> </script>
</body>
</html>