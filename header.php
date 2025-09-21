<?php
session_start();
include 'admin/dbConn.php';
if(isset($_SESSION['logged_in'])){
  $stat = $_SESSION['logged_in'];
  $hash = $_SESSION['token'];
  $uname = $_SESSION['uname'];
  $uid   = $_SESSION['id'];
  if($stat==1){
    $sql = "SELECT * FROM `users` WHERE `hash` LIKE '$hash'";
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
<link href="css/style.css?v=0.0.2" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<script type="text/javascript">
  if (location.protocol !== 'https:') {
    location.replace(`https:${location.href.substring(location.protocol.length)}`);
}
</script>
<script src="js/Chart.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<style>
#chartdiv {
  width: 100%;
  height: 295px;
}
.float{
  position:fixed;
  width:60px;
  height:60px;
  bottom:40px;
  right:40px;
  background-color:#25d366;
  color:#FFF;
  border-radius:50px;
  text-align:center;
  font-size:30px;
  box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
  margin-top:16px;
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
        <!-- <a href="https://api.whatsapp.com/send?phone=919789750652&text=" class="float" target="_blank">
          <i class="fa fa-whatsapp my-float"></i>
          <p class="my-float" style="font-size:14px;color:black">Support</p>
        </a> -->
	<div class="main-content">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<aside class="sidebar-left" style="height: 100vh">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            
            <h1><a class="navbar-brand" href="index.php"><img src="images/newlogo1.png" style="width: 55px;" ></a><br><br><br></h1>
            <ul class="sidebar-menu">
              <li class="treeview" >
                <a href="index.php" style="font-size: 18px !important;">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
              </li>
              <li class="treeview">
                <a href="messages.php"  style="font-size: 18px !important;">
                <i class="fa fa-comment"></i> <span>Messages</span>
                </a>
              </li>
              <li class="treeview">
                <a href="my-courses.php" style="font-size: 18px !important;">
                <i class="fa fa-tasks"></i> <span>My Courses</span>
                </a>
              </li>
              <li class="treeview">
                <a href="my-settings.php" style="font-size: 18px !important;">
                <i class="fa fa-cog"></i> <span>Settings</span>
                </a>
              </li>
              <li class="treeview">
                <a href="logout.php" style="font-size: 18px !important;">
                 <span>Logout</span>
                </a>
              </li>
            </ul>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
          </div>
          <!-- /.navbar-collapse -->
      </nav>
    </aside>
	</div>
		<!--left-fixed -navigation-->
		
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<div class="profile_details_left"><!--notifications of menu start -->
					
					<div class="clearfix"> </div>
				</div>
				<!--notification menu end -->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
				
				
				
				
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<div class="user-name" style="margin-top:20px">
										<p>Welcome, &nbsp;<?php echo $uname; ?></p>
									</div>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="settings.php"><i class="fa fa-cog"></i> Settings</a> </li> 
								<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140530882-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-140530882-1');
</script>
		<!-- //header-ends -->