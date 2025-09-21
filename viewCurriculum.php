<?php
    include 'header.php';
    if(isset($_GET['id'])){
      $cid = $_GET['id'];

      

      if($cid!=17){
	      $sql = "SELECT * FROM `course_user` WHERE `course_id` LIKE '$cid' AND `user_id` LIKE '$uid'";
	      if($result=mysqli_query($con, $sql)){
	        $count = mysqli_num_rows($result);
	        if($count==0){
	          //exit
	          die();
	        }
	      }
	  }

    }else{
      die('Course is not selected. Close window and try again');
    }

    $sql23 = "SELECT `history` FROM `course_history` WHERE `cid` LIKE '$cid' AND `uid` LIKE '$uid'";
    if($res = mysqli_query($con, $sql23)){
      while ($row32 = mysqli_fetch_row($res)) {
        $history = $row32[0];
      }
    } 
    $arr = json_decode($history, TRUE);
  
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class="panel-group tool-tips widget-shadow" id="accordion" role="tablist" aria-multiselectable="true">
           <h4 class="title2"> Curriculum: </h4>
           <?php
            //$sql = "SELECT * FROM `chapters` WHERE `course_id` LIKE '$cid' AND `is_parent` LIKE '0'";
           $sql = "SELECT * FROM `chapters` WHERE `course_id` = '$cid' AND `is_parent` = '0'";
           
		    $result1 = mysqli_query($con, $sql);
		    $row1 = mysqli_fetch_row($result1);
		    if($row1[8]!=0){
		    	$sql = "SELECT * FROM `chapters` WHERE `course_id` = '$cid' AND `is_parent` = '0' ORDER BY `orderStructure`";
		    }else{
		    	$sql = "SELECT * FROM `chapters` WHERE `course_id` = '$cid' AND `is_parent` = '0'";
		    }

        
        
            if($result = mysqli_query($con, $sql)){
              while ($row = mysqli_fetch_row($result)) {
                $chapterID = $row[0];
                $chapter_name = $row[2];
                $random = mt_rand(0000000,9999999);

                echo '<div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingFive">
                 <h4 class="panel-title">
                 <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$random.'" aria-expanded="false" aria-controls="'.$random.'">'. $chapter_name .'</a>
                 </h4>
              </div>
              <div id="'.$random.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                 <div class="panel-body">';

                 echo '<table class="table">
                          <thead>
                              <tr>
                                <th>#</th>
                                <th>Course Name</th>
                                <th>Progress</th>
                              </tr>
                          </thead>
                          <tbody>';
                          $sql2 = "SELECT * FROM `chapters` WHERE `is_parent` = '$chapterID'";
                          if($result2 = mysqli_query($con, $sql2)){
                            $ik = 1;
                            while ($row2 = mysqli_fetch_row($result2)) {


                              $msg = '';
                              echo '<tr>
                              <th scope="row">'.$ik.'</th>
                              <td><a href="viewChapter.php?id='.$row[1].'&cid='.$row2[0].'&pid='.$chapterID.'" style="text-decoration:underline" target="_viewChapter">'.$row2[2].'</a></td>
                              <td>'.$msg.'</td>
                            </tr>';
                              $ik++;
                            }
                          }


                /* echo '<table class="table">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Course Name</th>
                              <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>'; */
                   /* $sql2 = "SELECT * FROM `chapters` WHERE `is_parent` = '$chapterID'";
                   
                    if($result2 = mysqli_query($con, $sql2)){
                      $ik = 1;
                      while ($row2 = mysqli_fetch_row($result2)) {
                        $msg = "Pending";
                        for ($i=0; $i < count($arr); $i++) { 
                          if($arr[$i]['cid']==$row2[0]){
                            $msg = 'Completed';
                          }
                        }
                        echo '<tr>
                                <th scope="row">'.$ik.'</th>
                                <td><a href="viewChapter.php?id='.$row[1].'&cid='.$row2[0].'&pid='.$chapterID.'" style="text-decoration:underline" target="_viewChapter">'.$row2[2].'</a></td>
                                <td>'.$msg.'</td>
                              </tr>';
                        $ik++;
                      }
                    } */
                 echo '</tbody>
                    </table></div>
              </div>
           </div>'; 
              }
            }
           ?>

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