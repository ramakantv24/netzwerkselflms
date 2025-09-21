<?php 
	include 'header.php';
	$id = $_SESSION['id'];
	$msg = '';
	if(isset($_POST['name']) AND isset($_POST['old'])){
		$name = $_POST['name'];
		$oldpass = $_POST['old'];
		$oldpass = md5(md5($oldpass));

		$sql = "SELECT `password` FROM `users` WHERE `ID` LIKE '$id' AND `password` LIKE '$oldpass'";
		if($result = mysqli_query($con, $sql)){
			$count = mysqli_num_rows($result);
			if($count!=1)
				$msg = '<div class="alert alert-danger" role="alert"><strong>Invalid</strong> Password or Password field is empty!</div>';
			else{
				if(isset($_POST['new']) AND isset($_POST['new1'])){
					$new = $_POST['new'];
					$new1 = $_POST['new1'];
					if($new==$new1){
						$new = md5(md5($new));
						$sql = "UPDATE `users` SET `uname`='$name',`password`='$new' WHERE `ID` LIKE '$id'";
						mysqli_query($con, $sql);
						$msg = '<div class="alert alert-success" role="alert"><strong>Password</strong> Updated!</div>';
					}else{
						$msg = '<div class="alert alert-warning" role="alert"><strong>New</strong> Password are not same!</div>';	
					}
				}else{
					$msg = '<div class="alert alert-warning" role="alert"><strong>New</strong> Password Required!</div>';
					if(isset($_POST['name'])){
						$name = $_POST['name'];
						$sql = "UPDATE `users` SET `uname`='$name' WHERE `ID` LIKE '$id'";
						mysqli_query($con, $sql);
						$msg = '<div class="alert alert-success" role="alert"><strong>Name</strong> Updated!</div>';
					}
				}
			}
		}

		/*$sql = "UPDATE `users` SET `uname`='$name' WHERE `ID` LIKE '$id'";
		mysqli_query($con, $sql);
		$msg = '<div class="alert alert-success" role="alert"><strong>Name</strong> Updated!</div>';*/
	}

	$sql = "SELECT `uname`,`email` FROM `users` WHERE `ID` LIKE '$id'";
	if($result=mysqli_query($con, $sql)){
		$count=mysqli_num_rows($result);
		if($count==1){
			$row = mysqli_fetch_row($result);
			$name = $row[0];
			$email = $row[1];
		}else
			exit();
	}else
		exit();
?>
		<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h2 class="title1">My Account</h2>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Settings</h4>
						</div>
						<div class="form-body">
							<?php echo $msg; ?>
							<form method="post">
							   	<div class="form-group" style="width: 300px"> 
							   		<label for="exampleInputEmail1">Email address</label> 
							   		<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?php echo $email; ?>" disabled=""> 
							   	</div>

							   	<div class="form-group" style="width: 300px"> 
							   		<label for="Name">Name</label> 
							   		<input type="text" class="form-control" id="Name" name="name" placeholder="Your Name" value="<?php echo $name; ?>"> 
							   	</div>

							   	<div class="form-group" style="width: 300px"> 
							   		<label for="Name1">Old Password</label> 
							   		<input type="password" class="form-control" id="Name1" name="old" placeholder="Old Password" > 
							   	</div>
							   	<div class="form-group" style="width: 300px"> 
							   		<label for="Name2">New Password</label> 
							   		<input type="password" class="form-control" id="Name2" name="new" placeholder="New Password" > 
							   	</div>
							   	<div class="form-group" style="width: 300px"> 
							   		<label for="Name2">Repeat Password</label> 
							   		<input type="password" class="form-control" id="Name3" name="new1" placeholder="Repeat New Password" > 
							   	</div>
							   
							   <button type="submit" class="btn btn-success">Update</button> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
    <p>&copy; 2020 LMS - Netzwerk Academy</a></p>		
</div>
</div>
<script src="js/utils.js"></script>
<script src="js/classie.js"></script>
<script>
 var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
 showLeftPush = document.getElementById( 'showLeftPush' ),
 body = document.body;
 showLeftPush.onclick = function() {
    classie.toggle( this, 'active' );
    classie.toggle( body, 'cbp-spmenu-push-toright' );
    classie.toggle( menuLeft, 'cbp-spmenu-open' );
    disableOther( 'showLeftPush' );
};
function disableOther( button ) {
    if( button !== 'showLeftPush' ) {
       classie.toggle( showLeftPush, 'disabled' );
   }
}
</script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src='js/SidebarNav.min.js' type='text/javascript'></script>
<script>
  $('.sidebar-menu').SidebarNav()
</script>
<script src="js/bootstrap.js"> </script>
</body>
</html>