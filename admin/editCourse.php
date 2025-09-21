<?php
    include 'header.php';
    $msg = '';
	
    if(isset($_POST['cname'])){
        $cname = $_POST['cname'];
	
		if(!empty($_FILES['pdfFile']['name'][0])){
			
				$total    = count($_FILES['pdfFile']['name']);
				$fileName = array();
				 
			    for( $i=0 ; $i < $total ; $i++ ) {
					
					$tmpFilePath   = $_FILES['pdfFile']['tmp_name'][$i];
					$fileName[]    = $_FILES["pdfFile"]["name"][$i];
					$uploaddir     = '/var/www/netzwerkself/lms/admin/pdf/';
					$uploadfile    = $uploaddir . basename($_FILES['pdfFile']['name'][$i]);
					
					move_uploaded_file($tmpFilePath, $uploadfile);
				}
				$getFinalDataArray = array ();
				if(!empty($_POST['update_id'])){
				    $courseInfoSQL        = "SELECT * FROM courses WHERE id='".$_POST['update_id']."'";
	                $courseInfoSQLRes     = mysqli_query($con,$courseInfoSQL); 
	                $courseInfoRow        = mysqli_fetch_assoc($courseInfoSQLRes);
                    if(!empty($courseInfoRow['image'])){				   
				        $getOldFiles          = explode(',',$courseInfoRow['image']);
				        $getFinalDataArray    = array_merge($getOldFiles,$fileName);
				    }else{
						$getFinalDataArray    = $fileName;
					}
				}
				//echo "<pre>"; print_r($getFinalDataArray);exit;
				if(!empty($getFinalDataArray[0])) {
				    $fileNames = implode(',',$getFinalDataArray);
				}else{
					$fileNames = '';
				}
				
				$sql = "UPDATE courses SET course_name='$cname', `image`='".$fileNames."' WHERE ID='".$_POST['update_id']."'";
				
				if($result = mysqli_query($con, $sql)){
					$msg = '<span class="badge badge-success" style="font-size:16px">Course Updated</span><Br><Br>';
				}
			
	 	}else{
			
			$sql = "UPDATE courses SET course_name='$cname' WHERE ID='".$_POST['update_id']."'"; 
			
			if($result = mysqli_query($con, $sql)){
				$msg = '<span class="badge badge-success" style="font-size:16px">Course Updated</span><Br><Br>';
			}
		}
    }
	
	if(!empty($_GET['id'])){
		
	  $courseSQL        = "SELECT * FROM courses WHERE id='".$_GET['id']."'";
	  $courseSQLRes     = mysqli_query($con,$courseSQL); 
	  $courseRow        = mysqli_fetch_assoc($courseSQLRes); 

	}else{
		echo 'Something went wrong?.';exit;
	}
?>
<div id="page-wrapper"> 
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>Update Course</h4>
                </div>
                <div class="form-body">
				   <div class="col-sm-offset-2"><?php echo $msg; ?></div>
                    <form class="form-horizontal" method="post" enctype='multipart/form-data'>
					    <input type="hidden" class="form-control" id="inputEmail3" name="update_id" placeholder="Advance Data Science" value="<?php echo $courseRow['ID'];?>" required>
                       <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Course Name</label> 
                            <div class="col-sm-9"> 
                                <input type="text" class="form-control" id="inputEmail3" name="cname" placeholder="Advance Data Science" value="<?php echo $courseRow['course_name'];?>"> 
                            </div>
                       </div>
					   <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Upload Pdf file</label> 
                            <div class="col-sm-9"> 
                                <input type="file" class="form-control" id="inputEmail3" name="pdfFile[]" multiple> 
                            </div>
                       </div>
                       
                       <div class="col-sm-offset-2"> <button type="submit" class="btn btn-default">Add</button> </div>
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