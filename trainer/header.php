<?php
session_start();
include 'dbConn.php';
if(isset($_SESSION['logged_in'])){
  $stat = $_SESSION['logged_in'];
  $hash = $_SESSION['token'];
  $uname = $_SESSION['uname'];
  $uid   = $_SESSION['id'];
  if($stat==1){
    $sql = "SELECT * FROM `admin` WHERE `hash` LIKE '$hash'";
    if($result = mysqli_query($con, $sql)){
      $count = mysqli_num_rows($result);
      if($count==0){
        header("Location: login.php");
        exit();
      }
    }
  }else{
    header("Location: login.php");
    exit();
  }
}else{
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Dashboard - Netzwerk Acadmey</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
<script src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  if (location.protocol !== 'https:') {
    location.replace(`https:${location.href.substring(location.protocol.length)}`);
}
</script>
<script src="js/modernizr.custom.js"></script>
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<script src="js/Chart.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">
<script language="JavaScript" src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>

<style>
#chartdiv {
  width: 100%;
  height: 295px;
}
</style>
<script src="js/pie-chart.js" type="text/javascript"></script>
 <script type="text/javascript">

        $(document).ready(function () {
            $('#demo-pie-1').pieChart({
                barColor: '#2dde98',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-2').pieChart({
                barColor: '#8e43e7',
                trackColor: '#eee',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-3').pieChart({
                barColor: '#ffc168',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

           
        });

    </script>
					<link href="css/owl.carousel.css" rel="stylesheet">
					<script src="js/owl.carousel.js"></script>
						<script>
							$(document).ready(function() {
								$("#owl-demo").owlCarousel({
									items : 3,
									lazyLoad : true,
									autoPlay : true,
									pagination : true,
									nav:true,
								});
							});
						</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '693960844900187'); 
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=693960844900187&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

<script async src="https://www.googletagmanager.com/gtag/js?id=G-8WQ7QSEWVJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8WQ7QSEWVJ');
</script>

</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<aside class="sidebar-left">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <h1><a class="navbar-brand" href="index.php"><img src="images/newlogo1.png" style="width: 55px;" ></a><br><br><br></h1>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="treeview" style="background-color: #090e12">
                <a href="index.php" style="font-size: 18px !important;">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
              </li>
             
              <li class="treeview" style="background-color: #090e12">
                <a href="users.php" style="font-size: 18px !important;">
                <i class="fa fa-users"></i> <span>Users</span>
                </a>
              </li>
			  <li class="treeview" style="background-color: #090e12">
                <a href="pending_users.php" style="font-size: 18px !important;">
                <i class="fa fa-users"></i> <span>Pending Users</span>
                </a>
              </li>
              
              <li class="treeview" style="background-color: #090e12">
                <a href="deleting_users.php" style="font-size: 18px !important;">
                <i class="fa fa-users"></i> <span>Deleted Users</span>
                </a>
              </li>
              
			  <li class="treeview" style="background-color: #090e12">
                <a href="create_users.php" style="font-size: 18px !important;">
                <i class="fa fa-users"></i> <span>Create Users</span>
                </a>
              </li>
			  
              <li class="treeview" style="background-color: #090e12">
                <a href="logout.php" style="font-size: 18px !important;">
                <i class="fa fa-sign-out"></i> <span>Logout</span>
                </a>
              </li>
              
            </ul>
          </div>
      </nav>
    </aside>
	</div>
		<div class="sticky-header header-section ">
			<div class="header-left">
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<div class="profile_details_left">
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<div class="user-name">
										<p>User</p>
                    <p><?php echo $uname; ?>
									</div>
									<div class="clearfix"></div>	
								</div>	
							</a>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>