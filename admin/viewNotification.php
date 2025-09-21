<?php
    include 'header.php';
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>View Notifications</h4>
                </div>
                <div class="form-body">
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Course Name</th>
                              <th>Heading</th>
                              <th>Added On</th>
                              <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM `notification` WHERE `status` LIKE '1'";
                                if($result = mysqli_query($con, $sql)){
                                    $i = 1;
                                    while ($row = mysqli_fetch_row($result)) {
                                        $course_id = $row[1];
                                        $sql2 = "SELECT `course_name` FROM `courses` WHERE `ID` LIKE '$course_id'";
                                        $result2 = mysqli_query($con, $sql2);
                                        $row2 = mysqli_fetch_row($result2);
                                        $course_name = $row2[0];
                                        echo '<tr>
                                              <th scope="row">'.$i.'</th>
                                              <td>'.$course_name.'</td>
                                              <td>'.$row[2].'</td>
                                              <td>'.$row[6].'</td>
                                              <td>
                                                <a href="editNotification.php?nid='.$row[0].'" target="_chapter"><button type = "button" class = "btn btn-success">Edit Notification</button></a>
                                                <a href="deleteNotification.php?id='.$row[0].'&n='.$row[2].'" target="_chapter"><button type = "button" class = "btn btn-danger">Delete Notification</button></a>
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