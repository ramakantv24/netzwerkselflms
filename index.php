<?php include 'header.php'; ?>
<style type="text/css">
	@media (max-width: 480px){
		.header-left {
    		width: 0 !important;
    		float: left !important;
		}
		.header-right {
    		width: 90% !important;
    		float: right !important;
		}

		.cbp-spmenu-push div#page-wrapper {
			padding-top: 90px !important;
		}
	}
</style>
<?php
$divyam = array();
$sql = "SELECT * FROM `course_user` WHERE `user_id` LIKE '$uid' GROUP BY `course_id`";
$cid = array();
$custom_de = '<table class="table table-responsive table-bordered table-striped">
            <tr>
            <th>Sr.</th>
            <th>Course Name</th>
            <th>Progress</th>
            </tr>';
if($result=mysqli_query($con, $sql)){
    $countCourse = mysqli_num_rows($result);
    while ($row = mysqli_fetch_row($result)) {
        array_push($cid, $row[2]);
    }
}

//Total Chapters
$total = 0;
for ($i=0; $i < count($cid); $i++) { 
    $sql = "SELECT count(*) FROM `chapters` WHERE `course_id` LIKE '$cid[$i]'";
    if($result = mysqli_query($con, $sql)){
        while ($row = mysqli_fetch_row($result)) {
            $total = $total + $row[0];
            //echo 'tota '.$total;
            $total2 = 0;
            
                $sql2 = "SELECT count(*) FROM `chapters` WHERE `course_id` LIKE '$cid[$i]' AND `is_parent` NOT LIKE '0'";
                if($result2 = mysqli_query($con, $sql2)){
                    while ($row2 = mysqli_fetch_row($result2)) {
                        //$total2 = $total2 + $row2[0];
                        //$total = $total - $total2;
                        $total = $row2[0];
                        array_push($divyam, $total);
                    }
                }
            
        }
    }
}



$pending = 0;
for ($i=0; $i < count($cid); $i++) { 
    $sql = "SELECT `history` FROM `course_history` WHERE `cid` LIKE '$cid[$i]' AND `uid` LIKE '$uid'";
    if($result = mysqli_query($con, $sql)){
        while ($row = mysqli_fetch_row($result)) {
            $pending = $pending + count(json_decode($row[0], TRUE));
            
        }
    }
}

$a = 1;
for ($i=0; $i < count($cid); $i++) { 
    $sql = "SELECT `course_name` FROM `courses` WHERE `ID` LIKE '$cid[$i]'";
    if($result=mysqli_query($con, $sql)){ 
        while ($row = mysqli_fetch_row($result)) {
            
            $sql1 = "SELECT `history` FROM `course_history` WHERE `cid` LIKE '$cid[$i]' AND `uid` LIKE '$uid'";
            $pending = 0;
            if($result1 = mysqli_query($con, $sql1)){
                while ($row1 = mysqli_fetch_row($result1)) {
                    $pending = $pending + count(json_decode($row1[0], TRUE));
                }
            }
    
            $percentage = ($pending/$divyam[$i])*100;
            /*echo 'divyam';
            echo $pending."<br>";
            echo $total."<br>";*/
            $color = 'blue';
            $j = $i;
            $j++;


            if($percentage>100)
                $percentage = 100;

            if($percentage==100)
                $color = 'green';

            $custom_de .= '<tr>
            <td>'.$a.'</td>
            <td><a href="my-courses.php">'.$row[0].'</a></td>
            <td><div class="progress progress-striped active"><div class="bar '.$color.'" style="width:'.$percentage.'%;"></div></div>'.round($percentage).'% Completed</td>
            </tr>';
            $a++;
        }
    }
}
$custom_de .= '</table>';

// Notification Panel
$notification = '';
$query = "SELECT * FROM `notification` WHERE "; 
if($countCourse>1){
    $query .= "`cid` LIKE '$cid[0]' ";
    for ($i=1; $i < count($cid); $i++) { 
        $query .= "OR '$cid[$i]'";
    }
    $query .= " ORDER BY `ID` DESC";
}else{
    $query .= "`cid` LIKE '$cid[0]' AND `status` LIKE '1' ORDER BY `ID` DESC";
}

$notification = '<table class="table table-responsive table-bordered table-striped">
    <tr>
    <th>Sr.</th>
    <th>Course Name</th>
    <th>Heading</th>
    <th>Manage</th>
    </tr>';
if($result_n = mysqli_query($con, $query)){
    $b = 1;
    while($row_n = mysqli_fetch_row($result_n)){
        $course_idd = $row_n[1];
            $sl = "SELECT `course_name` FROM `courses` WHERE `ID` LIKE '$course_idd'";
            $rr = mysqli_query($con, $sl);
            $rr = mysqli_fetch_row($rr);
        $notification .= '<tr>
            <td>'.$b.'</td>
            <td>'.$rr[0].'</td>
            <td>'.$row_n[2].'</td>
            <td><a href="viewNotification.php?id='.$row_n[0].'" target="_notification">View Message</a></td>
            </tr>';
        $b++;
    }
}
$notification .= "</table>";
?>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			<div class="col_3">
        	<!--<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-calendar icon-rounded"></i>
                    <div class="stats">
                      <h5><strong>23</strong></h5>
                      <span>Days Left</span>
                    </div>
                </div>
        	</div>-->
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-tasks user1 icon-rounded"></i>
                    <div class="stats">
                      <span>My Total Course</span>
                      <h5><strong><?php echo $countCourse; ?></strong></h5>
                    </div>
                </div>
        	</div>
        	<!--<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-book user2 icon-rounded"></i>
                    <div class="stats">
                      <span>Chapter Left</span>
                      <h5><strong><?php echo $pending ?>/<small style="font-weight: 800">   <?php echo $total; ?></small></strong></h5>
                    </div>
                </div>
        	</div>-->
        	<!--
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong>$450</strong></h5>
                      <span>Expenditure</span>
                    </div>
                </div>
        	 </div>
        	<div class="col-md-3 widget">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong>1450</strong></h5>
                      <span>Total Users</span>
                    </div>
                </div>
        	 </div>-->
        	<div class="clearfix"> </div>
		</div>
		
		<div class="row-one widgettable">
			<!--<div class="col-md-5 content-top-2 card">
				<div class="agileinfo-cdr">
					<div class="card-header">
                        <h3>Daily Chapters Progress</h3>
                    </div>
					
						<div id="Linegraph" style="width: 98%; height: 350px">
						</div>
						
				</div>
			</div>-->
            <div class="col-md-5 content-top-2 card" style="margin-left: 0px">
                <div class="agileinfo-cdr" style="padding: 20px 10px">
                    <div class="card-header">
                        <h3>My Course Progress</h3>
                        <hr>
                        <div class="col-md-12" style="padding: 0px;">
                            <div class="row" style="padding:0px;">
                                <?php echo $custom_de; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="margin-left: 10px">
            	<div class="col-md-12 content-top-2 card" style="">
	                <div class="agileinfo-cdr">
	                    <div class="card-header">
	                        <h3>Notifications</h3>
	                        <hr>
	                        <div class="col-md-12" style="padding: 0px;">
	                            <div class="row" style="padding:0px;">
	                                <?php echo $notification; ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-12 content-top-2 card">
	                <div class="agileinfo-cdr">
	                    <div class="card-header">
	                        <h3>How to Video</h3>
	                        <hr>
	                        <div class="col-md-12" style="padding: 0px;">
	                            <div class="row" style="padding:0px;">
	                                <!--<iframe src="https://player.vimeo.com/video/553676231" frameborder="0" allow="autoplay; fullscreen; picture-in-picture"  style="width:100%;height:400px;" title="Introduction tutorial1.mp4"></iframe>-->
									
									<!--<iframe src="https://vimeo.com/553676231/3d6b9b80e6" frameborder="0" allow="autoplay; fullscreen; picture-in-picture"  style="width:100%;height:400px;" title="Introduction tutorial1.mp4"></iframe>-->
									
									<!-- <iframe src="https://vimeo.com/719757735/bfa6d248fd" frameborder="0" allow="autoplay; fullscreen; picture-in-picture"  style="width:100%;height:400px;" title="Introduction tutorial1.mp4"></iframe> -->
									
									<iframe src="https://player.vimeo.com/video/719757735?h=bfa6d248fd&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" width="100%" height="400px" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen title="LMS"></iframe>
									
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
            </div>
            
			
			<div class="clearfix"> </div>
		</div>
				
	
	<!-- for amcharts js -->
			<script src="js/amcharts.js"></script>
			<script src="js/serial.js"></script>
			<script src="js/export.min.js"></script>
			<link rel="stylesheet" href="css/export.css" type="text/css" media="all" />
			<script src="js/light.js"></script>
	<!-- for amcharts js -->

    <script  src="js/index1.js"></script>					
			</div>
		</div>
	<!--footer-->
	<div class="footer">
	   <p>&copy; 2020 LMS - Netzwerk Academy</a></p>		
	</div>
    <!--//footer-->
	</div>
		
	<!-- new added graphs chart js-->
	
    <script src="js/Chart.bundle.js"></script>
    <script src="js/utils.js"></script>
	
	<script>
        var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var color = Chart.helpers.color;
        var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: 'Dataset 1',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ]
            }, {
                label: 'Dataset 2',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ]
            }]

        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Bar Chart'
                    }
                }
            });

        };

        document.getElementById('randomizeData').addEventListener('click', function() {
            var zero = Math.random() < 0.2 ? true : false;
            barChartData.datasets.forEach(function(dataset) {
                dataset.data = dataset.data.map(function() {
                    return zero ? 0.0 : randomScalingFactor();
                });

            });
            window.myBar.update();
        });

        var colorNames = Object.keys(window.chartColors);
        document.getElementById('addDataset').addEventListener('click', function() {
            var colorName = colorNames[barChartData.datasets.length % colorNames.length];;
            var dsColor = window.chartColors[colorName];
            var newDataset = {
                label: 'Dataset ' + barChartData.datasets.length,
                backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                borderColor: dsColor,
                borderWidth: 1,
                data: []
            };

            for (var index = 0; index < barChartData.labels.length; ++index) {
                newDataset.data.push(randomScalingFactor());
            }

            barChartData.datasets.push(newDataset);
            window.myBar.update();
        });

        document.getElementById('addData').addEventListener('click', function() {
            if (barChartData.datasets.length > 0) {
                var month = MONTHS[barChartData.labels.length % MONTHS.length];
                barChartData.labels.push(month);

                for (var index = 0; index < barChartData.datasets.length; ++index) {
                    //window.myBar.addData(randomScalingFactor(), index);
                    barChartData.datasets[index].data.push(randomScalingFactor());
                }

                window.myBar.update();
            }
        });

        document.getElementById('removeDataset').addEventListener('click', function() {
            barChartData.datasets.splice(0, 1);
            window.myBar.update();
        });

        document.getElementById('removeData').addEventListener('click', function() {
            barChartData.labels.splice(-1, 1); // remove the label first

            barChartData.datasets.forEach(function(dataset, datasetIndex) {
                dataset.data.pop();
            });

            window.myBar.update();
        });
    </script>
	<!-- new added graphs chart js-->
	
	<!-- Classie --><!-- for toggle left push menu script -->
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
	<!-- //Classie --><!-- //for toggle left push menu script -->
		
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->
	
	<!-- for index page weekly sales java script -->
	<script src="js/SimpleChart.js"></script>
    <script>
        var graphdata1 = {
            linecolor: "#CCA300",
            title: "Monday",
            values: [
            { X: "6:00", Y: 10.00 },
            { X: "7:00", Y: 20.00 },
            { X: "8:00", Y: 40.00 },
            { X: "9:00", Y: 34.00 },
            { X: "10:00", Y: 40.25 },
            { X: "11:00", Y: 28.56 },
            { X: "12:00", Y: 18.57 },
            { X: "13:00", Y: 34.00 },
            { X: "14:00", Y: 40.89 },
            { X: "15:00", Y: 12.57 },
            { X: "16:00", Y: 28.24 },
            { X: "17:00", Y: 18.00 },
            { X: "18:00", Y: 34.24 },
            { X: "19:00", Y: 40.58 },
            { X: "20:00", Y: 12.54 },
            { X: "21:00", Y: 28.00 },
            { X: "22:00", Y: 18.00 },
            { X: "23:00", Y: 34.89 },
            { X: "0:00", Y: 40.26 },
            { X: "1:00", Y: 28.89 },
            { X: "2:00", Y: 18.87 },
            { X: "3:00", Y: 34.00 },
            { X: "4:00", Y: 40.00 }
            ]
        };
        var graphdata2 = {
            linecolor: "#00CC66",
            title: "Tuesday",
            values: [
              { X: "6:00", Y: 100.00 },
            { X: "7:00", Y: 120.00 },
            { X: "8:00", Y: 140.00 },
            { X: "9:00", Y: 134.00 },
            { X: "10:00", Y: 140.25 },
            { X: "11:00", Y: 128.56 },
            { X: "12:00", Y: 118.57 },
            { X: "13:00", Y: 134.00 },
            { X: "14:00", Y: 140.89 },
            { X: "15:00", Y: 112.57 },
            { X: "16:00", Y: 128.24 },
            { X: "17:00", Y: 118.00 },
            { X: "18:00", Y: 134.24 },
            { X: "19:00", Y: 140.58 },
            { X: "20:00", Y: 112.54 },
            { X: "21:00", Y: 128.00 },
            { X: "22:00", Y: 118.00 },
            { X: "23:00", Y: 134.89 },
            { X: "0:00", Y: 140.26 },
            { X: "1:00", Y: 128.89 },
            { X: "2:00", Y: 118.87 },
            { X: "3:00", Y: 134.00 },
            { X: "4:00", Y: 180.00 }
            ]
        };
        var graphdata3 = {
            linecolor: "#FF99CC",
            title: "Wednesday",
            values: [
              { X: "6:00", Y: 230.00 },
            { X: "7:00", Y: 210.00 },
            { X: "8:00", Y: 214.00 },
            { X: "9:00", Y: 234.00 },
            { X: "10:00", Y: 247.25 },
            { X: "11:00", Y: 218.56 },
            { X: "12:00", Y: 268.57 },
            { X: "13:00", Y: 274.00 },
            { X: "14:00", Y: 280.89 },
            { X: "15:00", Y: 242.57 },
            { X: "16:00", Y: 298.24 },
            { X: "17:00", Y: 208.00 },
            { X: "18:00", Y: 214.24 },
            { X: "19:00", Y: 214.58 },
            { X: "20:00", Y: 211.54 },
            { X: "21:00", Y: 248.00 },
            { X: "22:00", Y: 258.00 },
            { X: "23:00", Y: 234.89 },
            { X: "0:00", Y: 210.26 },
            { X: "1:00", Y: 248.89 },
            { X: "2:00", Y: 238.87 },
            { X: "3:00", Y: 264.00 },
            { X: "4:00", Y: 270.00 }
            ]
        };
        var graphdata4 = {
            linecolor: "Random",
            title: "Thursday",
            values: [
              { X: "20-06", Y: 3 },
            { X: "21-06", Y: 0 },
            { X: "22-06", Y: 2 },
            { X: "23-06", Y: 1 },
            { X: "24-06", Y: 4 },
            { X: "25-06", Y: 8 },
            { X: "26-06", Y: 2 }
            ]
        };
        var Piedata = {
            linecolor: "Random",
            title: "Profit",
            values: [
              { X: "Monday", Y: 50.00 },
            { X: "Tuesday", Y: 110.98 },
            { X: "Wednesday", Y: 70.00 },
            { X: "Thursday", Y: 204.00 },
            { X: "Friday", Y: 80.25 },
            { X: "Saturday", Y: 38.56 },
            { X: "Sunday", Y: 98.57 }
            ]
        };
        $(function () {
            $("#Bargraph").SimpleChart({
                ChartType: "Bar",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: true,
                data: [graphdata4, graphdata3, graphdata2, graphdata1],
                legendsize: "140",
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $'
            });
            $("#sltchartype").on('change', function () {
                $("#Bargraph").SimpleChart('ChartType', $(this).val());
                $("#Bargraph").SimpleChart('reload', 'true');
            });
            $("#Hybridgraph").SimpleChart({
                ChartType: "Hybrid",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: true,
                data: [graphdata4],
                legendsize: "140",
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $'
            });
            $("#Linegraph").SimpleChart({
                ChartType: "Line",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: false,
                data: [graphdata4],
                legendsize: "140",
                legendposition: 'bottom',
                xaxislabel: 'Date',
                title: '',
                yaxislabel: 'No. of Chapter'
            });
            $("#Areagraph").SimpleChart({
                ChartType: "Area",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: true,
                data: [graphdata4, graphdata3, graphdata2, graphdata1],
                legendsize: "140",
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $'
            });
            $("#Scatterredgraph").SimpleChart({
                ChartType: "Scattered",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: true,
                data: [graphdata4, graphdata3, graphdata2, graphdata1],
                legendsize: "140",
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $'
            });
            $("#Piegraph").SimpleChart({
                ChartType: "Pie",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: true,
                showpielables: true,
                data: [Piedata],
                legendsize: "250",
                legendposition: 'right',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $'
            });

            $("#Stackedbargraph").SimpleChart({
                ChartType: "Stacked",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: true,
                data: [graphdata3, graphdata2, graphdata1],
                legendsize: "140",
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $'
            });

            $("#StackedHybridbargraph").SimpleChart({
                ChartType: "StackedHybrid",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: true,
                data: [graphdata3, graphdata2, graphdata1],
                legendsize: "140",
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $'
            });
        });

    </script>
	<!-- //for index page weekly sales java script -->
	
	
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->
	
</body>
</html>