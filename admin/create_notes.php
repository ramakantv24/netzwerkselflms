<?php
    include 'header.php';
    $msg = '';
    if(isset($_POST['name'])){
		
        $name          = $_POST['name'];
        $courseID      = implode(',',$_POST['course_id']);
        $createDate    = date('Y-m-d H:i:s');
		
        $sqlMode = "INSERT INTO notes SET name='".$name."',course_id='".$courseID."',created_at='".$createDate."'";
		
		$response = mysqli_query($con,$sqlMode);
		
        if(isset($response)){
            $msg = '<span class="badge badge-success" style="font-size:16px">Notes Added</span><Br><Br>';
        }
    }
	
	$courseSQL     = "SELECT * FROM courses";
	$resourse      = mysqli_query($con,$courseSQL); 
	
?>
<div id="page-wrapper"> 
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>Create Notes</h4>
                </div>
                <div class="form-body">
				    <div class="col-sm-offset-2"><?php echo $msg; ?></div>
                    <form class="form-horizontal" method="post">
					   <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label> 
                            <div class="col-sm-9"> 
                                <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Name.." required> 
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