<?php
    include 'header.php';
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class=" form-grids row form-grids-right" style="background-image: ">
                <div class="form-body">
				  <div class="row">
                    <?php
                      $sql2 = "SELECT `course_id`,`date` FROM `course_user` WHERE `user_id` LIKE '$uid' GROUP BY `course_id`";
                      
                      if($result2=mysqli_query($con, $sql2)){
                        while($row2 = mysqli_fetch_row($result2)){
							
							$sql22 = "SELECT * FROM `users` WHERE `ID` = '$uid'";
							$user22SQLRes     = mysqli_query($con,$sql22); 
							$user22Row        = mysqli_fetch_assoc($user22SQLRes);
							
							$subscription_time = $user22Row['subscription_time'];
							if($subscription_time == 'all'){
								
								$id = $row2[0];
								$createDate = new DateTime($row2[1]);
								$purchase_date = $createDate->format('d-M-Y');
								$ending_date = date("d-M-Y", strtotime(date("d-M-Y", strtotime($purchase_date)) . " + 20 year"));
								
							}elseif($subscription_time == '1_year'){
								
								$id = $row2[0];
								$createDate = new DateTime($row2[1]);
								$purchase_date = $createDate->format('d-M-Y');
								$ending_date = date("d-M-Y", strtotime(date("d-M-Y", strtotime($purchase_date)) . " + 1 year"));
								
							}elseif($subscription_time == '6_month'){
								
								$id = $row2[0];
								$createDate = new DateTime($row2[1]);
								$purchase_date = $createDate->format('d-M-Y');
								$ending_date = date("d-M-Y", strtotime(date("d-M-Y", strtotime($purchase_date)) . " + 6 months"));
								
							}else{
								$id = $row2[0];
								$createDate = new DateTime($row2[1]);
								$purchase_date = $createDate->format('d-M-Y');
								$ending_date = date("d-M-Y", strtotime(date("d-M-Y", strtotime($purchase_date)) . " + 1 year"));
							}
							
                          /* $id = $row2[0];
                          $createDate = new DateTime($row2[1]);
                          $purchase_date = $createDate->format('d-M-Y');
                          $ending_date = date("d-M-Y", strtotime(date("d-M-Y", strtotime($purchase_date)) . " + 1 year")); */

                          $sql = "SELECT * FROM `courses` WHERE `ID` LIKE '$id' AND `status` LIKE '1'";
                          if($result = mysqli_query($con, $sql)){
                              $i = 1;
                              while ($row = mysqli_fetch_row($result)) {
								  
                                  echo '<div class="col-md-4 chart-layer1-right" style="margin-bottom: 40px;"> 
                                        <div class="user-marorm">
										<!-- <div class="malorum-top" style="background-image: url('.$row[6].');">       
                                        </div> -->
                                        <div class="malorm-bottom" style="box-shadow: 0px 0px 5px -2px rgb(0 0 0 / 61%); border-radius: 5px;">
                                           <h2 style="text-align:center; margin-top:0px;">'.$row[1].'</h2>
                                          <!--<p style="text-align:center;">'.$row[8].'</p><br>-->';
										   
										  if(!empty($row[6])) {
										    echo '<p style="text-align:center;"><h4 style="text-align:center"><a href="https://netzwerkself.com/lms/course_content.php?course_id='.$row[0].'">Get course content</a></h4></p><br/>';
										  }
										  
                                        echo '<center>
                                            <a href="viewCurriculum.php?id='.$row[0].'">
                                                <button class="btn btn-success">View / Resume Course</button>
                                            </a>
                                          </center><br>
                                          <div style="padding:10px;background-color:#edededb0">
                                          <p style="text-align:left;font-size:14px">Purchased on: '.$purchase_date.'</p>
                                          <p style="text-align:left;font-size:14px">Expiry on: '.$ending_date.'</p>
                                          </div>
                                        </div>
                                         </div>
                                      </div>';
									  
                                  $i++;
                              }
                          }
                        }
                      }
                      $sql = "SELECT * FROM `courses` WHERE `ID` LIKE '17' AND `status` LIKE '1'";
                      if($result = mysqli_query($con, $sql)){
                              $i = 1;
                              while ($row = mysqli_fetch_row($result)) {
                                  echo '<div class="col-md-4 chart-layer1-right"  style="min-height:auto;"> 
                                        <div class="user-marorm">
										<!-- <div class="malorum-top" style="background-image: url('.$row[6].');">       
                                        </div> -->
                                        <div class="malorm-bottom">
                                           <h2  style="text-align:center; margin-top:0px;>'.$row[1].'</h2>
                                          <p style="text-align:center;">'.$row[7].'</p><br>
                                          <center>
                                            <a href="viewCurriculum.php?id='.$row[0].'">
                                                <button class="btn btn-success">View / Resume Course</button>
                                            </a> 
                                          </center><br>
                                          <div style="padding:10px;background-color:#edededb0"> 
                                          </div>
                                        </div>
                                         </div>
                                      </div>';
                                  $i++;
                              }
                          }
                    ?>
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
</body>
</html>