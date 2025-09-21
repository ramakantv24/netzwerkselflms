<?php
    include 'header.php';
    $msg = '';
	
    if(isset($_POST['cname'])){
        
        $cname = $_POST['cname'];
		
			$total    = count($_FILES['pdfFile']['name']);
			$fileName = array();
			
			for( $i=0 ; $i < $total ; $i++ ) {
				
				$tmpFilePath   = $_FILES['pdfFile']['tmp_name'][$i];
				$fileName[]    = $_FILES["pdfFile"]["name"][$i];
				$uploaddir     = '/var/www/netzwerkself/lms/admin/pdf/';
				$uploadfile    = $uploaddir . basename($_FILES['pdfFile']['name'][$i]);
				move_uploaded_file($tmpFilePath, $uploadfile);
			}
			if(!empty($fileName[0])) {
		       $fileNames = implode(',',$fileName);
			}else{
				$fileNames = '';
			}
			
			$ip = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');
			
			$sql = "INSERT INTO `courses`(`course_name`, `added_by`, `ip`,`image`) VALUES ('$cname','$uid','$ip','$fileNames')";
			
			if($result = mysqli_query($con, $sql)){
				$msg = '<span class="badge badge-success" style="font-size:16px">Course Added</span><Br><Br>';
			}
			 
			//$msg = '<span class="badge badge-danger" style="font-size:16px">Your file size is large. please upload maximum 600 kb</span><Br><Br>';
    }
?>
<div id="page-wrapper"> 
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>Add New Course</h4>
                </div>
                <div class="form-body">
				   <div class="col-sm-offset-2"><?php echo $msg; ?></div>
                    <form class="form-horizontal" method="post" enctype='multipart/form-data'>
                       <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Course Name</label> 
                            <div class="col-sm-9"> 
                                <input type="text" class="form-control" id="inputEmail3" name="cname" placeholder="Advance Data Science"> 
                            </div>
                       </div>
					   <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Upload Pdf file</label> 
                            <div class="col-sm-9"> 
                                <input type="file" class="form-control" id="inputEmail3" name="pdfFile[]" multiple required> 
                            </div>
                       </div>
                       
                       <div class="col-sm-offset-2"> <button type="submit" class="btn btn-default">Add</button> </div>
                    </form>
                </div>
            </div>
        </div> 

        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>All Course</h4>
                </div>
                <div class="form-body">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Course Name</th>
                              <th>Course Content</th>
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
											/*  if(!empty($row[7])) {
                                               echo '<td><a href="https://netzwerkself.com/lms/admin/pdf/'.$row[7].'" target="_blank">Go To PDF</a></td>';
											 }else{
												 echo '<td>No Any Pdf</td>';
											 } */
											
											echo '<td><a href="https://netzwerkself.com/lms/admin/course_content.php?course_id='.$row[0].'">Get Course Content</a></td>';
                                            echo'  <td>'.$row[2].'</td>
                                              <td>'.$row[3].'</td>  
                                              <td>
                                                <a href="editCourse.php?id='.$row[0].'&n='.$row[1].'"><button type = "button" class = "btn btn-info">Edit</button></a>
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