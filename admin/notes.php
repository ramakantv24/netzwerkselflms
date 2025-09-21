<?php
    include 'header.php';
    
	$msg = '';
	if(isset($_GET['id'])){
        $sqlMode  = "DELETE FROM notes WHERE id='".$_GET['id']."'";
		mysqli_query($con,$sqlMode);
		$msg = '<span class="badge badge-success" style="font-size:16px">Notes Deleted</span>';
    }
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
			   
                <div class="form-title">
                    <h4>All Notes</h4>
                </div>
                <div class="form-body">
				    <div class="col-sm-offset-2"><?php echo $msg; ?></div><br/>
				    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Title</th>
                              <th>Courses</th>
                              <th>Created At</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM `notes`";
                                if($result = mysqli_query($con, $sql)){
                                    $i = 1;
                                    while ($row = mysqli_fetch_row($result)) {
                                        
										$course_array       = array();
                                        $course_array1      = explode(',',$row[2]);
                                        $course_name_array  = array();
										
                                        for($j=0;$j<sizeof($course_array1);$j++){
											
                                            $sql3 = "SELECT `course_name` FROM `courses` WHERE ID ='".$course_array1[$j]."'";
                                            $result3 = mysqli_query($con, $sql3);
											$row3    = mysqli_fetch_assoc($result3);
                                            $course_name_array[] = $row3['course_name'];
                                        }

                                        echo '<tr>
                                              <th scope="row">'.$i.'</th>
                                              <td>'.$row[1].'</td>
                                              <td>'.json_encode($course_name_array).'</td>
                                              <td>'.date('d-m-Y',strtotime($row[4])).'</td>
                                              <td>
											       <a href="edit_notes.php?id='.$row[0].'"><button type="button" class="btn btn-info">Edit</button></a>
												   
                                                   <a href="notes.php?id='.$row[0].'" onclick="return deleteValidate();">
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
						  var delStatus = confirm('Do you want to delete ?.');
						
						  if(delStatus==false){
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