<?php
include 'header.php';
$msg = '';
if(isset($_POST['notification_id'])){
    $nid = $_POST['notification_id'];
    $heading = $_POST['heading'];
    $description = urlencode($_POST['mytextarea']);
    $course_name = $_POST['cname'];
    $sql = "UPDATE `notification` SET `heading` = '$heading', `description` = '$description' WHERE `ID` LIKE '$nid'";
    if(mysqli_query($con, $sql))
        $msg = "Notification Updated";
    else
        $msg = "Error: Can't Update Notification";
}else if(isset($_GET['nid'])){
    $nid = $_GET['nid'];
    $sql = "SELECT * FROM `notification` WHERE `ID` LIKE '$nid'";
    if($result = mysqli_query($con, $sql)){
        $row = mysqli_fetch_row($result);
        $course_id = $row[1];
            $sql2 = "SELECT `course_name` FROM `courses` WHERE `ID` LIKE '$course_id'";
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_row($result2);
            $course_name = $row2[0];
        $heading = $row[2];
        $description = $row[3];
    }
}else{
    exit();
}
?>
<script src='https://cdn.tiny.cloud/1/3tzpbjw74019dbzb796ya0ng7dwcmxd9qy1ybeu74ylh7mjl/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
  <script>
  tinymce.init({
    selector: '#mytextarea',
    height: 500,
	  plugins: [
	    'advlist autolink lists link image charmap print preview anchor',
	    'searchreplace visualblocks code fullscreen',
	    'insertdatetime media table contextmenu paste code'
	  ],
	  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	  content_css: [
	    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
	    '//www.tinymce.com/css/codepen.min.css'
	  ]
  });
  </script>
<div id="page-wrapper">
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>Add Notification</h4>
                </div>
                <div class="form-body">
                    <form class="form-horizontal" method="post">
                       <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Select Course</label> 
                          <div class="col-sm-9"> 
                            <?php echo $course_name; ?>
                            </div>
                       </div>
                       <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Topic Heading</label> 
                            <div class="col-sm-9"> 
                                <input type="text" class="form-control" id="inputEmail3" name="heading" value="<?php echo $heading; ?>" placeholder="Introduction"> 
                            </div>
                       </div>
                       <input type="hidden" name="notification_id" value="<?php echo $nid; ?>">
                       <input type="hidden" name="cname" value="<?php echo $course_name; ?>">
                       <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Description</label> 
                            <div class="col-sm-9"> 
                                <textarea id="mytextarea" name="mytextarea" rows="20"><?php echo urldecode($description); ?></textarea>
                            </div>
                       </div>

                       <div class="form-group">
                        <div class="col-sm-3"></div>
                            <div class="col-sm-9"> <label id="customMessage"></label> </div>
                        </div>
                       <div class="col-sm-offset-2"><?php echo $msg; ?></div>
                       <div class="col-sm-offset-2"> <button type="submit" class="btn btn-default">Update</button> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <p>&copy; 2021 LMS - Netzwerk Academy</a></p>		
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

<script src='js/SidebarNav.min.js' type='text/javascript'></script>
<script>
  $('.sidebar-menu').SidebarNav()
</script>
<script src="js/bootstrap.js"> </script>
</body>
</html>