<?php
    include 'header.php';
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>All Course</h4>
                </div>
                <div class="form-body">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Course Name</th>
                              <th>Added By</th>
                              <th>Added On</th>
                              <th>Chapters</th>
                              <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM `courses` WHERE `status` LIKE '1'";
                                if($result = mysqli_query($con, $sql)){
                                    $i = 1;
                                    while ($row = mysqli_fetch_row($result)) {
                                        echo '<tr>
                                              <th scope="row">'.$i.'</th>
                                              <td>'.$row[1].'</td>
                                              <td>'.$row[2].'</td>
                                              <td>'.$row[3].'</td>
                                              <td>
                                                <a href="viewCurriculum.php?id='.$row[0].'" target="_chapter"><button type = "button" class = "btn btn-success">View Curriculum</button></a>
                                              </td>
                                              <td>
                                              <a href="editCourse.php?id='.$row[0].'&n='.$row[1].'"><button type = "button" class = "btn btn-info">Edit</button></a>
                                                <a href="deleteCS.php?id='.$row[0].'&n='.$row[1].'" target="_deleteCS"><button type="button" class="btn btn-danger">Delete</button></a>
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