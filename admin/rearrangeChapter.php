<?php
    include 'header.php';
    if(isset($_GET['id'])){
      $cid = $_GET['id'];
    }else{
      die('Course is not selected. Close window and try again');
    }

    $sql = "SELECT * FROM `chapters` WHERE `course_id` LIKE '$cid' AND `is_parent` LIKE '0'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);
    if($row[8]!=0){
    	$sql = "SELECT `chapter_name`,`orderStructure`,`ID` FROM `chapters` WHERE `course_id` LIKE '$cid' AND `is_parent` LIKE '0' ORDER BY `orderStructure`";
    }else{
    	$sql = "SELECT `chapter_name`,`orderStructure`,`ID` FROM `chapters` WHERE `course_id` LIKE '$cid' AND `is_parent` LIKE '0'";
    }
    $valIndex = array();
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class="panel-group tool-tips widget-shadow" id="accordion" role="tablist" aria-multiselectable="true">
           <h4 class="title2"> Curriculum: </h4>
            <div class="table-container">
           		<div>
           			<table class="table table-responsive table-bordered">
           				<tr>
           					<th>Order Structure</th>
           					<th>Chapter Name</th>
           				</tr>
			           <?php
			            if($result = mysqli_query($con, $sql)){
			              while ($row = mysqli_fetch_row($result)) {
			              	echo '<tr>';
			              		echo '<td><input type="text" value="'.$row['1'].'" id="'.$row[2].'"></td>';
			              		echo '<td>'.$row['0'].'</td>';
			              		echo '<input type="text" value="'.$row['2'].'" id="div_'.$row[2].'" hidden>';
			              	echo '</tr>';
			              	array_push($valIndex, $row[2]);
			              }
			            }
			           ?>
		           </table>
		           <button onclick="updateBox()" class="btn btn-success">Update</button>
		           <p id="stats"></p>
	       		</div>
	   		</div>

        </div>
        </div>
    </div>
</div>
<div class="footer">
    <p>&copy; 2020 LMS - Netzwerk Academy</p>		
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
<script type="text/javascript">
	var texIndex = <?php echo json_encode($valIndex); ?>;
	function updateBox(){
		var id = <?php echo $cid; ?>;
		var update = 0;
		var value;
		for (var i = 0; i < texIndex.length; i++) {
			//console.log(texIndex[i]);
			og = document.getElementById('div_'+texIndex[i]).value;
			value = document.getElementById(texIndex[i]).value;
			$.ajax({
		      url: 'updateChapterOrder.php?i='+id+'&c='+value+'&ogValue='+og,
		      dataType: 'json',
		      success: function(data){  
		      if(data['success']==true){
		      	console.log('true');
		      	update = update + 1;
		      	document.getElementById('stats').innerHTML = 'Updating '+update+' / '+texIndex.length;
		      	if(update==texIndex.length){
		      		document.getElementById('stats').innerHTML = 'Update Completed. Please Refresh';
		      	}
		      }
		    },
		    error: function (err) {
		      //console.error('Error: ', err);
		    }
		    });
		}
	}
</script>
</body>
</html>