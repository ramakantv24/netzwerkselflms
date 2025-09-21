<?php
    include 'header.php';
    $msg = '';
    if(isset($_POST['update_id'])){
		
        $name          = $_POST['name'];
        $courseID      = implode(',',$_POST['course_id']);
        $createDate    = date('Y-m-d H:i:s');
		
        $sqlMode = "UPDATE notes SET name='".$name."',course_id='".$courseID."',created_at='".$createDate."' WHERE id='".$_POST['update_id']."'";
		mysqli_query($con,$sqlMode);
        $msg = '<span class="badge badge-success" style="font-size:16px">Notes Updated</span><Br><Br>';
    }
	
	$courseSQL     = "SELECT * FROM courses";
	$resourse      = mysqli_query($con,$courseSQL); 
	
	if(!empty($_GET['id'])){
		
	  $notesSQL     = "SELECT * FROM notes WHERE id='".$_GET['id']."'";
	  $notesRes     = mysqli_query($con,$notesSQL); 
	  $notesRow     = mysqli_fetch_assoc($notesRes); 
	  $courseIDArr  = explode(',',$notesRow['course_id']);
	}else{
		echo 'Something went wrong?.';exit;
	}
	
?>
<div id="page-wrapper"> 
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>Update Notes</h4>
                </div>
                <div class="form-body">
				    <div class="col-sm-offset-2"><?php echo $msg; ?></div>
                    <form class="form-horizontal" method="post">
					   <input type="hidden" name="update_id" value="<?php echo $_GET['id'];?>" required>
					   <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label> 
                            <div class="col-sm-9"> 
                                <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Name.." value="<?php echo $notesRow['name']; ?>" required> 
                            </div>
                       </div>
					   <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Course</label> 
                            <div class="col-sm-9">
                               <select name="course_id[]" id="courseID" multiple class="form-control" required>
								<?php while($courseRow = mysqli_fetch_array($resourse)) { ?>
								   <?php if(in_array($courseRow['ID'],$courseIDArr)) { ?>
								      <option value="<?php echo $courseRow['ID'];?>" selected><?php echo $courseRow['course_name'];?></option>
								   <?php }else{?>
							          <option value="<?php echo $courseRow['ID'];?>"><?php echo $courseRow['course_name'];?></option>
								   <?php } ?>
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