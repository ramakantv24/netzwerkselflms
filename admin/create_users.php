<?php
    include 'header.php';
    $msg = '';
    if(isset($_POST['email'])){
		
        $user_name  = $_POST['user_name'];
        $email      = $_POST['email'];
        $password   = md5(md5($_POST['password']));
        $mobile_no  = $_POST['mobile_no'];
        $courseIDS  = $_POST['course_id'];
        $my_ip      = $_SERVER['REMOTE_HOST'];
        $timestamp  = date('Y-m-d H:i:s');
        $payuID     = $_POST['payuID'];
        $internatID = $_POST['internatID'];
        $hash       = md5($email.$password.mt_rand(00000000,9999999));
		
        $sqlMode = "INSERT INTO users SET uname='".$user_name."',email='".$email."',password='".$password."',mobile='".$mobile_no."',status='1',ip='".$my_ip."',timestamp='".$timestamp."',hash='".$hash."',payuID='".$payuID."',internatID='".$internatID."'";
		
		$response = mysqli_query($con,$sqlMode);
		$user_id  = $con->insert_id;
		
		if(isset($user_id)){
		    foreach($courseIDS as $course_id){
			  $sqlCourseToUser = "INSERT INTO course_user SET user_id='".$user_id."',course_id='".$course_id."'";
			  $response = mysqli_query($con,$sqlCourseToUser);
			}
			
			
			$to      = $email;
            $subject = 'Account created successfully';
            $message = 'Your account has been created successfully.';
            $headers = 'From: netzwerkself@gmail.com'       . "\r\n" .
                         'Reply-To: netzwerkself@gmail.com' . "\r\n" .
                         'X-Mailer: PHP/' . phpversion();
        
            mail($to, $subject, $message, $headers);
			
		}
        if(isset($user_id)){
            $msg = '<span class="badge badge-success" style="font-size:16px">Users Added</span><Br><Br>';
        }
    }
	
	$courseSQL     = "SELECT * FROM `courses` WHERE `status` LIKE '1'";
	$resourse      = mysqli_query($con,$courseSQL);
	
?>
<div id="page-wrapper"> 
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>Create Users</h4>
                </div>
                <div class="form-body">
                    <form class="form-horizontal" method="post">
					   <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label> 
                            <div class="col-sm-9"> 
                                <input type="text" class="form-control" id="inputEmail3" name="user_name" placeholder="Name.." required> 
                            </div>
                       </div>
                       <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label> 
                            <div class="col-sm-9"> 
                                <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email.." required> 
                            </div>
                       </div>
					   <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Password</label> 
                            <div class="col-sm-9"> 
                                <input type="password" class="form-control" id="inputEmail3" name="password" placeholder="Password.." required> 
                            </div>
                       </div>
					   <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mobile</label> 
                            <div class="col-sm-9"> 
                                <input type="number" class="form-control" id="inputEmail3" name="mobile_no" placeholder="Mobile.." required> 
                            </div>
                       </div>
					   <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Course</label> 
                            <div class="col-sm-9">
                               <select name="course_id[]" id="courseID" multiple class="form-control" required>
								<?php while($courseRow = mysqli_fetch_array($resourse)) { ?>
							       <option value="<?php echo $courseRow['ID'];?>"><?php echo $courseRow['course_name'];?></option>
								<?php } ?>
							   </select>							
                            </div>
                       </div>
					   <!--<div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Payu ID</label> 
                            <div class="col-sm-9"> 
                                <input type="text" class="form-control" id="inputEmail3" name="payuID" placeholder="Payu ID.." required> 
                            </div>
                       </div>
					   <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Internet ID</label> 
                            <div class="col-sm-9"> 
                                <input type="text" class="form-control" id="inputEmail3" name="internatID" placeholder="Internet ID.." required> 
                            </div>
                       </div>-->
                       <div class="col-sm-offset-2"><?php echo $msg; ?></div>
                       <div class="col-sm-offset-2"> <button type="submit" class="btn btn-default">Submit</button> </div>
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