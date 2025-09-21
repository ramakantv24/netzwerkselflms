<?php
    include 'header.php';
    $msg = '';
    if(isset($_POST['mytextarea'])){
      $chapter = urlencode($_POST['mytextarea']);
      $cid     = $_POST['cid'];
      $sql     = "UPDATE `chapters` SET `data` = '$chapter' WHERE `ID` LIKE '$cid'";
      if(mysqli_query($con, $sql)){
        $msg = '<span class="badge badge-success" style="font-size:16px">Chapter Added</span>';
      }
    }
    
    if(isset($_GET['id'])){
      $cid = $_GET['id'];
      $sql = "SELECT `chapter_name`,`data` FROM `chapters` WHERE `ID` LIKE '$cid'";
      if($result=mysqli_query($con, $sql)){
        while($row=mysqli_fetch_row($result)){
          $chapter_name = $row[0];
          $data = $row[1];
        }
      }
    }else{
      die('Course is not selected. Close window and try again');
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
        <div class="panel-group tool-tips widget-shadow" id="accordion" role="tablist" aria-multiselectable="true">
           <?php echo $msg; ?>
           <h4 class="title2"> Edit Chapter: <b><?php echo $chapter_name; ?></b></h4>
           <form method="post">
             <input type="text" name="cid" value="<?php echo $cid; ?>" hidden>
             <textarea id="mytextarea" name="mytextarea" rows="20"><?php echo urldecode($data); ?></textarea>
             <br><button class="btn btn-success" type="submit">Save Chapter</button>
           </form>
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