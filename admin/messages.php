<?php include 'header.php'; ?>
<style type="text/css">
.msg_container_base{
  background: #e5e5e5;
  margin: 0;
  padding: 0 10px 10px;
  max-height:40vh;
  overflow-x:hidden;
}
.top-bar {
  background: #666;
  color: white;
  padding: 10px;
  position: relative;
  overflow: hidden;
}
.msg_receive{
    padding-left:0;
    margin-left:0;
}
.msg_sent{
    padding-bottom:20px !important;
    margin-right:0;
}
.messages {
  background: white;
  padding: 10px;
  border-radius: 2px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  max-width:100%;
}
.messages > p {
    font-size: 13px;
    margin: 0 0 0.2rem 0;
  }
.messages > time {
    font-size: 11px;
    color: #ccc;
}
.msg_container {
    padding: 10px;
    overflow: hidden;
    display: flex;
}
.avatar {
    position: relative;
}
.base_receive > .avatar:after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border: 5px solid #FFF;
    border-left-color: rgba(0, 0, 0, 0);
    border-bottom-color: rgba(0, 0, 0, 0);
}

.base_sent {
  justify-content: flex-end;
  align-items: flex-end;
}
.base_sent > .avatar:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 0;
    border: 5px solid white;
    border-right-color: transparent;
    border-top-color: transparent;
    box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
}

.msg_sent > time{
    float: right;
}

.msg_container_base::-webkit-scrollbar-track{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar{
    width: 12px;
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar-thumb{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

.btn-group.dropup{
    position:fixed;
    left:0px;
    bottom:0;
}
</style>
		<div id="page-wrapper">
			<div class="main-page compose">
				<h2 class="title1">Compose Mail Page</h2>
				<div class="col-md-4 compose-left">
					<div class="folder widget-shadow">
						<ul>
							<li class="head">Message</li>
							<?php
								$sql = "SELECT `uname`,`ID` FROM `users` WHERE `ID` IN (SELECT `uid` FROM `chat` GROUP BY `uid` ORDER BY `ID` DESC)";
								if($result = mysqli_query($con, $sql)){
									while ($row = mysqli_fetch_row($result)) {
										$uid = $row[1];
										$sql2 = "SELECT `ID` FROM `chat` WHERE `ID` LIKE '$uid' AND `view` LIKE '0' AND `admin` LIKE '0'";
										$count = 0; $sh='';
										if($results = mysqli_query($con, $sql2)){
											$count = mysqli_num_rows($results);
										}
										if($count!=0){
											$sh = '<span>'.$count.'</span>';
										}
										echo '<li onclick="getMessage('.$row[1].')"><a href="#">'.$row[0].' '.$sh.'</a></li>';
									}
								}
							?>
						</ul>
					</div>
				</div>
				<div class="col-md-8 compose-right widget-shadow">
					<div class="panel-default">
						<div class="panel-heading">
							Send Message
						</div>
						<div class="panel-body">
							<div class="panel panel-primary" style="border:0px">
				                <div class="panel-heading top-bar">
				                    <div class="col-md-8 col-xs-8">
				                        <h3 class="panel-title">Chatbox</h3>
				                    </div>
				                </div>


				                <div class="panel-body msg_container_base">
				                    
				                	<!--all message here-->
				                    <chat_log id="chat" name="chat"></chat_log>
				                </div>

				                <!--CHAT USER BOX-->
				                <div class="panel-footer">
				                    <div class="input-group" id="myForm">
				                        <input id="btn-input" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." style="height: 38px">
				                        <span class="input-group-btn">
				                        <button class="btn btn-primary" id="submit" type="submit">Send</button>
				                        </span>
				                    </form>
				                    </div>
				                </div>
            				</div>
        				</div>
        				<div class="panel-body">
							<div class="panel panel-primary" style="border:0px">
				                <div class="panel-heading top-bar">
				                    <div class="col-md-8 col-xs-8">
				                        <h3 class="panel-title">User Details</h3>
				                    </div>
				                </div>
				                <div class="panel-body msg_container_base">
				                    <div class="table-responsive bs-example widget-shadow">
									   <table class="table table-bordered">
									      <thead>
									         <tr>
									            <th>Name</th>
									            <th>Email</th>
									            <th>Mobile</th>
									            <th>Enrolled Course</th>
									         </tr>
									      </thead>
									      <tbody id="tableData">
									         
									      </tbody>
									   </table>
									</div>
				                </div>
            				</div>
        				</div>
					</div>
				</div>


						</div>
					</div>
				</div>
				<div class="clearfix"> </div>	
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
<script type="text/javascript">
	var ke;
	 window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        
    function sendData(data2) {
    	$.ajax({
	        url: 'api/log.php?msg='+data2+'&uid='+window.ke,
	        success: function(data){
	       		//$('chat_log').append('<div class="row msg_container base_receive"><div class="col-md-10 col-xs-10"><div class="messages msg_receive"><p>'+data+'</p></div></div></div>');   
	        },
	        error: function (err) {
	            //console.error('Error: ', err);
          	}
        });
	}

	$("#submit").click(function() {
	    var data = $("#btn-input").val();
	        //console.log(data);
	        $('chat_log').append('<div class="row msg_container base_sent"><div class="col-md-10 col-xs-10"><div class="messages msg_receive"><p>'+data+'</p></div></div></div>');
	        clearInput();
	        sendData(data);
	        $(".msg_container_base").stop().animate({ scrollTop: $(".msg_container_base")[0].scrollHeight}, 1000);
	});

	function clearInput() {
	    $("#myForm :input").each(function() {
	        $(this).val(''); //hide form values
	    });
	}

	$("#myForm").submit(function() {
	    return false; //to prevent redirection to save.php
	});

	window.onload = function() {
		$(".msg_container_base").stop().animate({ scrollTop: $(".msg_container_base")[0].scrollHeight}, 1000);	
	}

	function getMessage(key){
		window.ke = key;
		$.ajax({
	        url: 'api/getMessage.php?id='+key,
	        success: function(data){
	        	$('#chat').empty();
	       		$('chat_log').append(data);
	       		$(".msg_container_base").stop().animate({ scrollTop: $(".msg_container_base")[0].scrollHeight}, 1000);	
	       		getUser(key);
	        },
	        error: function (err) {
	            //console.error('Error: ', err);
	          }
        });
	}

	function getUser(key){
		$.ajax({
	        url: 'api/getUser.php?id='+key,
	        success: function(data){
	       		document.getElementById('tableData').innerHTML = data;
	        },
	        error: function (err) {
	            //console.error('Error: ', err);
	          }
        });
	}
</script>
<script src="js/bootstrap.js"> </script>
</body>
</html>