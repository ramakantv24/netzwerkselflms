<?php
    include 'header.php';
    if(isset($_GET['id'])){
      $nid = $_GET['id'];
    }else{
      die('Notification is not selected. Close window and try again');
    }
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class="panel-group tool-tips widget-shadow" id="accordion" role="tablist" aria-multiselectable="true">
           <?php
              $sql = "SELECT * FROM `notification` WHERE `ID` LIKE '$nid'";
              if($result = mysqli_query($con, $sql)){
                $row = mysqli_fetch_row($result);
                $heading = $row[2];
                $description = $row[3];
              }
           ?>
           <h4 class="title2"> <?php echo $heading; ?> </h4>
           <hr>
           <p>
            <?php echo urldecode($description); ?>
           </p>
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