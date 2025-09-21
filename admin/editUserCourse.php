<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/SMTP.php';
    if(empty($_GET['id'])){
		echo 'Some thing went wrong..';exit;
	}
    include 'header.php';
    $msg = '';
	
	
    if(isset($_POST['course_id'])){
		
		$user_id    = $_POST['user_id'];
		$course_id  = $_POST['course_id'];

		#DELETE OLD COURSES
		$sqlDEL = "DELETE FROM course_user WHERE user_id='".$user_id."'";
		mysqli_query($con,$sqlDEL);
		
		#ADD NEW COURSE TO USERS
		foreach($course_id as $courseID){
		  $sql = "INSERT INTO course_user SET user_id='".$user_id."',course_id='".$courseID."'"; 
		  mysqli_query($con,$sql);
		}
		
		$timestamp  = date('Y-m-d H:i:s');
		
		//Update user
		$sql2 = "UPDATE `users` SET `user_status`='".$_POST['user_status']."' WHERE `ID`='".$user_id."'";
		mysqli_query($con,$sql2);
		$msg = '<span class="badge badge-success" style="font-size:16px">Course and User Status Updated</span><Br><Br>';
		
		$userSQL        = "SELECT * FROM users WHERE ID='".$_GET['id']."'";
		$userSQLRes     = mysqli_query($con,$userSQL); 
		$userRow        = mysqli_fetch_assoc($userSQLRes);
		
		if(($userRow['subscription_time'] == '') && ($userRow['start_date'] == '') && ($userRow['expire_date'] == '') && ($userRow['user_status'] == 'C')){
			
			$start_date  = date('Y-m-d');
			if($_POST['subscription_time'] =='6_month'){
				$monthArr = explode('_',$_POST['subscription_time']);
				$month = $monthArr[0];
			}elseif($_POST['subscription_time'] =='1_year'){
				$monthArr = explode('_',$_POST['subscription_time']);
				$month = $monthArr[0] * 12;
			}elseif($_POST['subscription_time'] =='all'){				
				$month = 240;
			}
			
			$expire_date = date('Y-m-d', strtotime("+$month months", strtotime($start_date)));
			
			if($_POST['subscription_time'] =='7_days'){
			    $expire_date = date('Y-m-d', strtotime('+7 days'));
			}
			
			$sql23 = "UPDATE `users` SET `subscription_time`='".$_POST['subscription_time']."',`start_date`='".$start_date."',`expire_date`='".$expire_date."' WHERE `ID`='".$user_id."'";
			mysqli_query($con,$sql23);
			
		}elseif(isset($_POST['subscription_time']) && ($userRow['subscription_time'] != '') && ($userRow['subscription_time'] != $_POST['subscription_time'])){
			
			$start_date  = date('Y-m-d');
			if($_POST['subscription_time'] =='6_month'){
				$monthArr = explode('_',$_POST['subscription_time']);
				$month = $monthArr[0];
			}elseif($_POST['subscription_time'] =='1_year'){
				$monthArr = explode('_',$_POST['subscription_time']);
				$month = $monthArr[0] * 12;
			}elseif($_POST['subscription_time'] =='all'){				
				$month = 240;
			}
			
			$expire_date = date('Y-m-d', strtotime("+$month months", strtotime($start_date)));
			
			if($_POST['subscription_time'] =='7_days'){
			    $expire_date = date('Y-m-d', strtotime('+7 days'));
			}
			
			$sql23 = "UPDATE `users` SET `subscription_time`='".$_POST['subscription_time']."',`start_date`='".$start_date."',`expire_date`='".$expire_date."' WHERE `ID`='".$user_id."'";
			mysqli_query($con,$sql23);
			
		}
				 
		if(!empty($userRow['email'])){			

			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Mailer = "smtp";
			$mail->SMTPDebug = false;
			//$mail->SMTPDebug  = 1;  
			$mail->SMTPAuth   = TRUE;
			$mail->SMTPSecure = "tls";
			$mail->Port       = 587;
			$mail->Host       = "netzwerkself.com";
			$mail->Username   = "info@netzwerkself.com";
			$mail->Password   = "PQCRD*APHp}}";
			
			$to      = $userRow['email'];
			//$to      = "ramakantv24@gmail.com";
			$subject = 'Profile Activated successfully';
			$message = '<p>Hi</p>';
			$message .= '<p>Your profile has been activated, and you can start learning the course Use the below link to log in to your profile</p>';
			$message .= '<p>Happy learning </p>';
			$message .= '<p>https://netzwerkself.com/lms/login.php </p>';
			$message .= '<p>Use the same id and password that you created after payment  </p>';
			$message .= '<p>Join the below telegram channel to get job posting and tips.  </p>';
			$message .= '<p>https://t.me/+DU37-hCEaL43MTE1  </p>';
			$message .= '<p>For any queries, email us at </p>';
			$message .= '<p>admin@netzwerkacademy.com  </p>';
			//$message .= '<p>Or WhatsApp us on  </p>';
			//$message .= '<p>+919789750652  </p>';
			$message .= '<p>Regards  </p>';
			$message .= '<p>Netzwerk Academy  </p>';
			
			$mail->IsHTML(true);
			$mail->AddAddress($to, "recipient-name");
			$mail->SetFrom("Admin@netzwerkacademy.com", "Netzwerkself");
			$mail->AddReplyTo("Admin@netzwerkacademy.com", "Netzwerkself");
			$mail->AddCC("Admin@netzwerkacademy.com", "Netzwerkself");
			$mail->Subject = $subject;
			$content = $message;

			$mail->MsgHTML($content); 
			$mail->Send();
			
		}	
    } 
	
	$courseSQL            = "SELECT * FROM courses WHERE status='1'";
	$courseSQLRes         = mysqli_query($con,$courseSQL); 
	
	
	$courseUserSQL        = "SELECT * FROM course_user WHERE user_id='".$_GET['id']."'";
	$courseUserSQLRes     = mysqli_query($con,$courseUserSQL);
	$courseDataUserArray  = array();
	while($courseUSerRow = mysqli_fetch_array($courseUserSQLRes)) { 
	   $courseDataUserArray[] = $courseUSerRow['course_id'];
	}
	
	$userSQL        = "SELECT * FROM users WHERE ID='".$_GET['id']."'";
	$userSQLRes     = mysqli_query($con,$userSQL); 
	$userRow        = mysqli_fetch_assoc($userSQLRes);
?>
<div id="page-wrapper"> 
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>Update User Course</h4>
                </div>
                <div class="form-body">
				   <div class="col-sm-offset-2"><?php echo $msg; ?></div>
                    <form class="form-horizontal" method="post" enctype='multipart/form-data'>
					    <input type="hidden" class="form-control" id="inputEmail3" name="user_id" placeholder="Advance Data Science" value="<?php echo $_GET['id'];?>" required>
                       <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Course Name</label>
                            <div class="col-sm-9"> 
							<select name="course_id[]" multiple class="form-control" required>
							   <option>-Select-</option>
							   <?php while($courseRow = mysqli_fetch_array($courseSQLRes)) { ?>
							      <?php if(in_array($courseRow['ID'],$courseDataUserArray)) { ?>
								     <option value="<?php echo $courseRow['ID'];?>" selected><?php echo $courseRow['course_name'];?></option>
								  <?php }else{?>
								     <option value="<?php echo $courseRow['ID'];?>"><?php echo $courseRow['course_name'];?></option>
							      <?php } ?>
							   <?php } ?>
							</select>
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">User Status</label>
                            <div class="col-sm-9"> 
							<select name="user_status" class="form-control" required>
							   <option>-Select-</option>
							   <option value="P" <?php if($userRow['user_status'] == 'P'){ echo 'Selected'; } ?>>Pending</option>
							   <option value="C" <?php if($userRow['user_status'] == 'C'){ echo 'Selected'; } ?> >Complete</option>
							</select>
                            </div>
                       </div>
					    <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Subscription Time</label>
                            <div class="col-sm-9"> 
							<select name="subscription_time" class="form-control" required>
							   <option>-Select-</option>
							   <option value="7_days" <?php if($userRow['subscription_time'] == '7_days'){ echo 'Selected'; } ?>>7 Days</option>
							   <option value="6_month" <?php if($userRow['subscription_time'] == '6_month'){ echo 'Selected'; } ?>>6 Month</option>
							   <option value="1_year" <?php if($userRow['subscription_time'] == '1_year'){ echo 'Selected'; } ?> >1 Year</option>
							   <option value="all" <?php if($userRow['subscription_time'] == 'all'){ echo 'Selected'; } ?> >Life Time</option>
							</select>
                            </div>
                        </div>
                       <div class="col-sm-offset-2"> <button type="submit" class="btn btn-default">Submit</button> </div>
                    </form>
                </div>
            </div>
        </div> 

        <!--<div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>All Course</h4>
                </div>
                <div class="form-body">
                    <table class="table">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Course Name</th>
                              <th>Course Pdf</th>
                              <th>Added By</th>
                              <th>Added On</th>
                              <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM `courses` WHERE `status` LIKE '1'";
                                if($result = mysqli_query($con, $sql)){
                                    $i = 1;
                                    while ($row = mysqli_fetch_row($result)) {
										
                                        echo '<tr>
                                              <th scope="row">'.$i.'</th>
                                              <td>'.$row[1].'</td>';
											 if(!empty($row[7])) {
                                               echo '<td><a href="https://netzwerkself.com/lms/admin/pdf/'.$row[7].'" target="_blank">Go To PDF</a></td>';
											 }else{
												 echo '<td>No Any Pdf</td>';
											 }
                                            echo'  <td>'.$row[2].'</td>
                                              <td>'.$row[3].'</td>
                                              <td>
                                                <button type = "button" class = "btn btn-info">Edit</button>
                                                <a href="deleteCS.php?id='.$row[0].'&n='.$row[1].'" target="_deleteCS"><button type="button" class="btn btn-danger">Delete</button></a>
                                            </td>
                                            </tr>';
                                        $i++;
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->
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