<?php
include 'header.php';
$msg = '';
if(isset($_POST['selector1'])){
  $course_id = $_POST['selector1'];
  $chapter_name = $_POST['cname'];
  $ip = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');
    if(isset($_POST['sub'])=='sub'){
      //child topic add
      $parent_id = $_POST['selector2'];
      $sql = "INSERT INTO `chapters` (`course_id`, `chapter_name`, `is_parent`, `added_by`, `ip`) VALUES ('$course_id','$chapter_name','$parent_id','$uid','$ip')";
      if(mysqli_query($con, $sql)){
        $msg = 'Sub Topic Added Successfully';
      }
    }else{
      $sub = 0; 
      $sql = "INSERT INTO `chapters` (`course_id`, `chapter_name`, `is_parent`, `added_by`, `ip`) VALUES ('$course_id','$chapter_name','$sub','$uid','$ip')";
      echo $sql;  
      if(mysqli_query($con, $sql)){
        $msg = 'Chapter Added Successfully';
      }
    }
}
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>Add New Chapter</h4>
                </div>
                <div class="form-body">
                    <form class="form-horizontal" method="post">
                       <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Course Name</label> 
                          <div class="col-sm-9"> 
                            <select name="selector1" id="selector1" class="form-control1">
                              <?php
                                $sql = "SELECT * FROM `courses` WHERE `status` LIKE '1'";
                                echo '<option value="nance"><------Select-------></option>';
                                if($result = mysqli_query($con, $sql)){
                                    while ($row = mysqli_fetch_row($result)) {
                                      echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                                    }
                                }
                              ?>
                            </select>
                            </div>
                       </div>
                       <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Chapter Name</label> 
                            <div class="col-sm-9"> 
                                <input type="text" class="form-control" id="inputEmail3" name="cname" placeholder="Introduction"> 
                            </div>
                       </div>
                       <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-9">
                          <label> <input type="checkbox" id="sub" name="sub" value="sub"> Is Sub Topic ? </label>
                        </div>
                       </div>
                       <div class="form-group" style="display: none" id="subtopic">
                          <label for="inputEmail3" class="col-sm-2 control-label">Select Parent Topic</label> 
                          <div class="col-sm-9"> 
                            <select name="selector2" id="selector2" name="selector2" class="form-control1">
                              <?php
                                $sql = "SELECT * FROM `courses` WHERE `status` LIKE '1'";
                                echo '<option value="nance2"><------Select-------></option>';
                                if($result = mysqli_query($con, $sql)){
                                    while ($row = mysqli_fetch_row($result)) {
                                      echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                                    }
                                }
                              ?>
                            </select>
                            </div>
                       </div>
                       <div class="form-group">
                        <div class="col-sm-3"></div>
                            <div class="col-sm-9"> <label id="customMessage"></label> </div>
                        </div>
                       <div class="col-sm-offset-2"><?php echo $msg; ?></div>
                       <div class="col-sm-offset-2"> <button type="submit" class="btn btn-default">Add</button> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  document.getElementById('sub').onclick = function(){
    if(document.getElementById('selector1').value=='nance'){
      alert('Please select course name');
      document.getElementById('sub').checked=false;
    }else{
      if(document.getElementById('sub').checked==true){
        console.log('yes');
        document.getElementById('customMessage').innerHTML = 'Please wait loading chapters name';
        document.getElementById('subtopic').style.display = 'block';
        $.ajax({
          url: 'api/getParent.php?id='+document.getElementById('selector1').value,
          dataType: 'json',
          success: function(data){  
            document.getElementById('customMessage').innerHTML = '';
            document.getElementById('selector2').innerHTML = data.values;
          },
          error: function (err) {
            //console.error('Error: ', err);
          }
        });
      }else{
        console.log('no');
        document.getElementById('subtopic').style.display = 'none';
        document.getElementById('customMessage').innerHTML = '';
      }
    }
  }
</script>
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

<script src='js/SidebarNav.min.js' type='text/javascript'></script>
<script>
  $('.sidebar-menu').SidebarNav()
</script>
<script src="js/bootstrap.js"> </script>
</body>
</html>