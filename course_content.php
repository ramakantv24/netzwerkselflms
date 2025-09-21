<?php
    include 'header.php';
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
								
                                foreach($getFilesList as $fileName) {
										
                                        echo '<tr>
                                              <th scope="row">'.$result['course_name'].'</th>';
											 if(!empty($fileName)) {
                                               echo '<td><a href="https://netzwerkself.com/lms/admin/pdf/'.$fileName.'" target="_blank">'.$fileName.'</a></td>';
											 }else{
												 echo '<td>No file</td>';
											 }
                                            echo '</tr>';
                                        $i++;
                                    }
                            ?>
                        </tbody>
                    </table>
					<a href="https://netzwerkself.com/lms/my-courses.php"><button type="button" class="btn btn-info">Back</button></a>
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