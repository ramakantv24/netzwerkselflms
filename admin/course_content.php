<?php
    include 'header.php';

	if(!empty($_GET['course_id']) && !empty($_GET['file_id'])){
		 
		 $fileSql          = "SELECT * FROM `courses` WHERE ID='".$_GET['course_id']."'";
		 $fileresponse     = mysqli_query($con, $fileSql);
		 $fileresult       = mysqli_fetch_assoc($fileresponse);
		 $filesArray       = explode(',',$fileresult['image']);
		 $fileID           = $_GET['file_id']-1;
		 
		 unset($filesArray[$fileID]);
		 
		 $updatefilesArray = implode(',',$filesArray);
		 
		 $fileSqlUpdate    = "UPDATE courses SET image = '".$updatefilesArray."' WHERE ID='".$_GET['course_id']."'";
		 mysqli_query($con, $fileSqlUpdate);
		 $course_id = $_GET['course_id'];
		 echo "<script>window.location.href='course_content.php?course_id=$course_id';</script>";exit;
	} 
	
?>
<div id="page-wrapper"> 
    <div class="main-page"> 
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>Course's Contents</h4>
                </div>
                <div class="form-body">
                    <table class="table">
                        <thead>
                            <tr>
                              <th>Course's Name</th>
                              <th>Course's Content</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql      = "SELECT * FROM `courses` WHERE ID='".$_GET['course_id']."'";
								$response = mysqli_query($con, $sql);
								$result   = mysqli_fetch_assoc($response);
								
								$getFilesList = explode(',',$result['image']);
							
                                foreach($getFilesList as $keys=>$fileName) {
										$fileID = $keys+1;
                                        echo '<tr>
                                              <th scope="row">'.$result['course_name'].'</th>';
											 if(!empty($fileName)) {
                                               echo '<td><a href="https://netzwerkself.com/lms/admin/pdf/'.$fileName.'" target="_blank">'.$fileName.'</a></td>';
											   echo '<td><a href="https://netzwerkself.com/lms/admin/course_content.php?course_id='.$_GET['course_id'].'&file_id='.$fileID.'" onclick="return DeleteValidate();"><button type="button" class="btn btn-danger">Delete</button></a></td>';
											 }else{
												 echo '<td>No file</td>';
											 }
                                            echo '</tr>';
                                        $i++;
                                    }
                            ?>
                        </tbody>
                    </table>
					<script>
					 function DeleteValidate(){
						 var conMsg = confirm("Do you want to delete?.");
						 if(conMsg==false){
							return false;
						 }
					}
					</script>
					<a href="https://netzwerkself.com/lms/admin/addCourse.php"><button type="button" class="btn btn-info">Back</button></a>
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