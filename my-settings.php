<?php
    include 'header.php';
    $sql = "SELECT `email`,`password` FROM `users` WHERE `ID` LIKE '$uid'";
    if($result = mysqli_query($con, $sql)){
      $row = mysqli_fetch_row($result);
      $email = $row[0];
      $password = $row[1];
    }

    $msg = '';
    if(isset($_POST['c']) AND isset($_POST['n']) AND isset($_POST['rn'])){
        $c = $_POST['c'];
        $n = $_POST['n'];
        $rn = $_POST['rn'];
        $msg = $n.$rn;
        $c = md5(md5($c));
        if($c==$password){
            if($n==$rn){
                $new_password = md5(md5($n));
                $sql = "UPDATE `users` SET `password` = '$new_password' WHERE `ID` LIKE '$uid'";
                if(mysqli_query($con, $sql))
                    $msg = "Password changed successfully";
            }else
                 $msg = "Password are not same";
        }else
            $msg = "Invalid Old Password";
    }
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class=" form-grids row form-grids-right" style="background-image: ">
                <div class="form-body" style="background-color:#d9d9d9">
                    <?php
                      echo "<p>Registered Email Address - ".$email."</p>";
                    ?>
                </div>
                <div style="padding:10px">
                    <h3>Change Password</h3>
                    <hr>
                    <div class="col-md-4">
                        <form method="post" action="">
                        <input type="password" class="form-control" name="c" placeholder="Current Password"><br>
                        <input type="password" class="form-control" name="n" placeholder="New Password"><br>
                        <input type="password" class="form-control" name="rn" placeholder="Re-Enter New Password"><br>
                        <button class="btn btn-success" type="submit"> Update </button>
                        <br><?php echo $msg; ?>
                        </form>
                    </div>
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
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src='js/SidebarNav.min.js' type='text/javascript'></script>
<script>
  $('.sidebar-menu').SidebarNav()
</script>
<script src="js/bootstrap.js"> </script>
</body>
</html>