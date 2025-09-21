<?php
    include 'header.php';
    
	$msg = '';
	if(isset($_GET['id'])){
        $sqlMode  = "DELETE FROM admin WHERE id='".$_GET['id']."'";
		mysqli_query($con,$sqlMode);
		$msg = '<span class="badge badge-success" style="font-size:16px">Notes Deleted</span>';
    }
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
			   
                <div class="form-title">
                    <h4>All Trainer</h4>
					<a href="add_trainer.php" style="float: right;margin-top: -27px;"><button type="button" class="btn btn-info">Add Trainer</button></a>
                </div>
                <div class="form-body">
				    <div class="col-sm-offset-2"><?php echo $msg; ?></div><br/>
                   <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Role</th>
                              <th>Email</th>                              
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM `admin`";
                                if($result = mysqli_query($con, $sql)){
                                    $i = 1;
                                    while ($row = mysqli_fetch_row($result)) {
                                        if($row[1] == 'user'){
											$role = 'Trainer';
										}else{
											$role = $row[1];
										}
										
                                        echo '<tr>
                                              <th scope="row">'.$i.'</th>
                                              <td>'.$row[5].'</td>
                                              <td>'.$role.'</td>
                                              <td>'.$row[2].'</td>
                                              <td>
											       <a href="edit_trainer.php?id='.$row[0].'"><button type="button" class="btn btn-info">Edit</button></a>
												   
                                                   <a href="trainer.php?id='.$row[0].'" onclick="return deleteValidate();">
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