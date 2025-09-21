<?php
  include 'header.php';
  if(isset($_GET['cid']) AND isset($_GET['id'])){
      $cid = $_GET['id'];
      $id  = $_GET['cid'];
      if($cid!=17){
	      $sql = "SELECT * FROM `course_user` WHERE `course_id` LIKE '$cid' AND `user_id` LIKE '$uid'";
	      if($result=mysqli_query($con, $sql)){
	        $count = mysqli_num_rows($result);
	        if($count==0)
	          die();
	  }

        $sql = "SELECT `course_name` FROM `courses` WHERE `ID` LIKE '$cid'";
        if($result = mysqli_query($con, $sql)){
          while ($roww = mysqli_fetch_row($result) ) {
            $cname = $roww[0];
            $roww[0];
          }
        }
      }
      $parent_id = $_GET['pid'];
      $next_button = '';
      $previous_button = '';

      $sql = "SELECT `ID`,`chapter_name` FROM `chapters` Where ID < '$id' AND `is_parent` LIKE '$parent_id' ORDER BY ID DESC LIMIT 1";
      if($result = mysqli_query($con, $sql)){
      	$count = mysqli_num_rows($result);
      	if($count==1){
      		$row = mysqli_fetch_row($result);
      		$previous_button_id = $row[0];
      		$previous_name = $row[1];
      		$previous_button = "<a href='viewChapter.php?id=".$cid."&cid=".$previous_button_id."&pid=".$parent_id."'><button class='btn btn-success'>Previous Chapter</button></a>";
      	}
      }

      $sql = "SELECT `ID`,`chapter_name` FROM `chapters` Where ID > '$id' AND `is_parent` LIKE '$parent_id' LIMIT 1";
      if($result = mysqli_query($con, $sql)){
      	$count = mysqli_num_rows($result);
      	if($count==1){
      		$row = mysqli_fetch_row($result);
      		$next_button_id = $row[0];
      		$next_name = $row[1];
      		$next_button = "<a href='viewChapter.php?id=".$cid."&cid=".$next_button_id."&pid=".$parent_id."'><button class='btn btn-success'>Next Chapter</button></a>";
      	}
      }
	  //SELECT * FROM chapters Where ID > '4' AND `is_parent` LIKE '1' LIMIT 1
    }else{
      die('Course is not selected. Close window and try again');
    }

    //Check if viewed exist
    $sql = "SELECT `history` FROM `course_history` WHERE `cid` LIKE '$cid' AND `uid` LIKE '$uid'";
    //echo $sql;
    if($result = mysqli_query($con, $sql)){
      $count = mysqli_num_rows($result);
      if($count == 0){
          $data = '[{"cid":"'.$id.'","date":"'.date("d-m-Y").'"}]';
          $sql = "INSERT into `course_history`(`cid`,`uid`,`history`) VALUES('$cid','$uid','$data')";
          echo $sql;
          if(mysqli_query($con, $sql)){
            //echo "<script>alert('Data written');</script>";
          }
      }else{
          while ($row = mysqli_fetch_row($result)) {
            $arr = $row[0];
            $arr = json_decode($arr, TRUE);
            $exist = 0;
            for ($i=0; $i < count($arr); $i++) { 
              if($arr[$i]['cid']==$id){
                $exist = 1;
              }
            }
                
            if($exist==0){
              $arr[] = ['cid' => $id, 'date' => date("d-m-Y")];
              $json = json_encode($arr);
              $sql = "UPDATE `course_history` SET `history` = '$json' WHERE `cid` LIKE '$cid' AND `uid` LIKE '$uid'";
              if(mysqli_query($con, $sql)){
                //success
              }else{
                echo "<script>alert('Data could not be written on Database');</script>";
              }
            }
          }
          //end else
      }
    }
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class="panel-group tool-tips widget-shadow" id="accordion" role="tablist" aria-multiselectable="true" style="height: 800px">
           <?php
            $sql = "SELECT `data`,`chapter_name`,`is_parent` FROM `chapters` WHERE `ID` LIKE '$id'";
            if($result = mysqli_query($con, $sql)){
              while ($row = mysqli_fetch_row($result)) {
                //select parent name
                $s = "SELECT `chapter_name` FROM `chapters` WHERE `ID` LIKE '$row[2]'";
                if($resul = mysqli_query($con, $s)){
                  while ($rows = mysqli_fetch_row($resul)) {
                    $topic = $rows[0];
                  }
                }

                echo '<ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="viewCurriculum.php?id='.$cid.'">'.$cname.'</a></li>
            <li class="active">'.$topic.'</li>
          </ol>';
          echo '<h2 class="title2">'.$row[1].'</h4>';
                echo urldecode($row[0]);
              }
            }
           ?>

           <hr>
           <div class="col-md-12 row">
           		<div class="col-md-6" align="" style="margin-bottom: 30px">
           			<?php echo $previous_name; ?><br>
           			<?php echo $previous_button; ?>
           		</div>
           		<div class="col-md-6" align="">
           			<?php echo $next_name; ?><br>
           			<?php echo $next_button; ?>
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
<script>
document.querySelector("#accordion > p > iframe").style.width="640px";
document.querySelector("#accordion > p > iframe").style.height="360px";
</script>
<script src="js/bootstrap.js"> </script>
</body>
</html>