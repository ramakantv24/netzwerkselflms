<?php
    include 'header.php';
    $msg = '';
    if(isset($_POST['email'])){
		
		
        $user_name  = $_POST['uname'];
        $email      = $_POST['email'];
        $role      = $_POST['role'];
        $password   = md5(md5($_POST['password']));        
       
        $hash       = md5($email.$password.mt_rand(00000000,9999999));
		
       $sqlMode = "INSERT INTO admin SET uname='".$user_name."',email='".$email."',password='".$password."',role='".$role."',hash='".$hash."'";
		
		$response = mysqli_query($con,$sqlMode);
		$user_id  = $con->insert_id;		
		
        if(isset($user_id)){
            $msg = '<span class="badge badge-success" style="font-size:16px">Users Added</span><Br><Br>';
        }
    }
	
?>
<div id="page-wrapper"> 
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>Add Trainer</h4>
                </div>
                <div class="form-body">
                    <form class="form-horizontal" method="post">
					   <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label> 
                            <div class="col-sm-9"> 
                                <input type="text" class="form-control" id="inputEmail3" name="uname" placeholder="Name.." required> 
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
                            <label for="inputEmail3" class="col-sm-2 control-label">Role</label> 
                            <div class="col-sm-9">
                               <select name="role" id="role" class="form-control" required>
								
							       <option value="admin">Admin</option>
							       <option value="user">Trainer</option>
								
							   </select>							
                            </div>
                       </div>
					   
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