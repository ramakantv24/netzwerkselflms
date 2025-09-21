<?php
    include 'header.php';
	
	$msg = '';
	
	if(!empty($_GET['delete_id'])){
		
		$user_id = $_GET['delete_id'];
		
		$start_date  = date('Y-m-d');
		
		#$userSQL = "DELETE FROM users WHERE ID='".$user_id."'";
		$userSQL = "UPDATE `users` SET `user_status`='D',`update_date`='".$start_date."' WHERE ID='".$user_id."'";
		mysqli_query($con, $userSQL);
		
		/* $courseUserSQL = "DELETE FROM course_user WHERE user_id='".$user_id."'";
		mysqli_query($con, $courseUserSQL);
		
		$courseHistorySQL = "DELETE FROM course_history WHERE uid='".$user_id."'";
		mysqli_query($con, $courseHistorySQL);
		$msg = '<span class="badge badge-success" style="font-size:16px">Users Deleted</span>'; */
	}
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>All Users</h4>
                </div>
                <div class="form-body">
				    <div class="col-sm-offset-2"><?php echo $msg; ?></div><br/>
					
					<!-- <div class="row">
					   <div class="col-md-6"></div>
					   <div class="col-md-6">
					        <form method="GET" action="https://netzwerkself.com/lms/admin/users.php">
							    <div class="row">
								   <?php if(!empty($_GET['search'])) { ?>
									  <div class="col-md-9"><input type="text" name="search" class="form-control" value="<?php echo $_GET['search']; ?>" placeholder="Search email.." /> </div>
								   <?php }else{ ?>
									  <div class="col-md-9"><input type="text" name="search" class="form-control"  placeholder="Search email.."/> </div>
								   <?php } ?>
									<div class="col-md-3"><button type="submit" class="btn btn-secondary" name="submit">Search</button>
									</div>
							    </div>  
						    </form>
					   </div>
					</div> -->
					
					<div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Mobile</th>
                              <th>Courses</th> 
                              <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							    if(!empty($_GET['search'])) {
									$sql = "SELECT * FROM `users` where email='".$_GET['search']."' and `user_status` = 'C' ORDER BY `users`.`ID` DESC";
								}else{									
                                   $sql = "SELECT * FROM `users` where `user_status` = 'C' ORDER BY `users`.`ID` DESC";
								}
                                if($result = mysqli_query($con, $sql)){
                                    $i = 1;
                                    while ($row = mysqli_fetch_row($result)) {
                                        $u_id = $row[0];
                                        $sql2 = "SELECT `course_id` FROM `course_user` WHERE `user_id` LIKE '$u_id'";
                                        $course_array = array();
                                        if($result2 = mysqli_query($con, $sql2)){
                                            while($row2 = mysqli_fetch_row($result2)){
                                                array_push($course_array, $row2[0]);
                                            }
                                        }
                                        
                                        $course_name_array = array();
                                        for($j=0;$j<sizeof($course_array);$j++){
                                            $sql3 = "SELECT `course_name` FROM `courses` WHERE `ID` LIKE '$course_array[$j]'";
                                            if($result3 = mysqli_query($con, $sql3)){
                                                while($row3 = mysqli_fetch_row($result3)){
                                                    array_push($course_name_array, $row3[0]);
                                                }
                                            }
                                        }

                                        echo '<tr>
                                              <th scope="row">'.$i.'</th>
                                              <td>'.$row[8].'</td>
                                              <td>'.$row[1].'</td>
                                              <td>'.$row[2].'</td>
                                              <td>'.json_encode($course_name_array).'</td>
                                              <td>
											    <a href="editUserCourse.php?id='.$u_id.'"><button type = "button" class = "btn btn-info">Edit</button></a>
											     <a href="users.php?delete_id='.$u_id.'" onclick="return deleteValidate();">
												     <button type="button" class="btn btn-danger">Delete</button>
												   </a>
												 </td>
                                            </tr>';
                                        $i++;
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    </div>
					<script>
					   function deleteValidate(){
						   var confirmDel = confirm('Do you want delete it?');
						   if(confirmDel==false){
							   return false;
						   }
					   }
					</script>
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

<script>
$(document).ready(function() {
    $('#datatable').dataTable({
        responsive: true
    });
} );
</script>
</body>
</html>