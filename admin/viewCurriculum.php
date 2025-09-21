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
    	$sql = "SELECT * FROM `chapters` WHERE `course_id` LIKE '$cid' AND `is_parent` LIKE '0' ORDER BY `orderStructure`";
    }else{
    	$sql = "SELECT * FROM `chapters` WHERE `course_id` LIKE '$cid' AND `is_parent` LIKE '0'";
    }
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class="panel-group tool-tips widget-shadow" id="accordion" role="tablist" aria-multiselectable="true">
           <h4 class="title2"> Curriculum: <a href="rearrangeChapter.php?id=<?php echo $cid; ?>" target="_rearrange">(ReArrange Chapters)</a></h4>
           <?php
            if($result = mysqli_query($con, $sql)){
              while ($row = mysqli_fetch_row($result)) {

                $chapterID = $row[0];
                $random = mt_rand(0000000,9999999);
                echo '<div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingFive">
                 <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$random.'" aria-expanded="false" aria-controls="'.$random.'">
                    '.$row[2].' [ <a href="deleteChapters.php?id='.$row[0].'&n='.$row[2].'" target="_mew" style="text-decoration:underline;color:red">Delete</a> ]
                    </a>
                 </h4>
              </div>
              <div id="'.$random.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                 <div class="panel-body">';
                 echo '<table class="table">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Course Name</th>
                              <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>';
                    $sql2 = "SELECT * FROM `chapters` WHERE `is_parent` LIKE '$chapterID'";
                    if($result2 = mysqli_query($con, $sql2)){
                      $ik = 1;
                      while ($row2 = mysqli_fetch_row($result2)) {
                        echo '<tr>
                                <th scope="row">'.$ik.'</th>
                                <td>'.$row2[2].'</td>
                                <td>
                                  <a href="editChapter.php?id='.$row2[0].'" target="_editC"><button type = "button" class = "btn btn-info">Edit Chapter</button></a>
                                  <a href="deleteC.php?id='.$row2[0].'&n='.$row2[2].'" target="_deleteCS"><button type="button" class="btn btn-danger">Delete</button></a>
                                </td>
                              </tr>';
                        $ik++;
                      }
                    }
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