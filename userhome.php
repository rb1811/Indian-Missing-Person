<?php
//<applet code="clock.class" width="150" height="50"> </applet>
	ob_start();
	session_start();
	require_once ("functions.php"); 

	if (checkLoggedin()){
	error_reporting(E_ERROR | E_PARSE); 
		echo "<H1>You are already logged in - <a href = \"userhome.php?do=logout\">logout</a></h1>";
		if($_REQUEST['do']=="logout"){
			clearsessionscookies(); 
			header("location: userhome.php"); 
			break;
		}
	}
	else
	{
?>

<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Missing Persons">
    <meta name="author" content="svc">
	
	<title>Missing Person</title>
	<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Custom styles for this template -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/dashboard.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
    <link href="css/prism.css" rel="stylesheet"/>
    <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
	
	</head>
	<body>
		
		<nav class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			 <applet code="clock.class" width="150" height="53"> </applet>
			  <a class="navbar-brand" href="#">Wish You Were Here <span id="clock"></span></a>
			</div>
			
			<div id="navbar" class="navbar-collapse collapse">
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="" data-target="#signin" data-toggle="modal"><i class="glyphicon glyphicon-log-in"></i> Administrator</a></li>	
			  </ul>
			</div>
		  </div>
		</nav>

		<div class="container-fluid">
		  <div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
			  <ul class="nav nav-sidebar">
							<li class = "active">
								<a href = ""><i class="fa fa-home fa-2x"></i><span>Home</span></a>
							</li>
							<li>
								<a href="userindiamap.php"><i class="fa fa-map-marker fa-2x"></i><span>View Map</span></a>
							</li>
							<li>
								<a href="userreports.php"><i class="fa fa-users fa-2x"></i><span>Reports</span></a>
							</li>
							<li>
								<a href="userstatistics.php"><i class="fa  fa-bar-chart-o fa-2x"></i><span>Analytics</span></a>
							</li>
							<li>
							<a href="excelwrite.php"><i class = "fa fa-database fa-2x"></i><span>Export</span></a>
							</li>
							<li>
								<a href="usersearch.php"><i class="fa fa-search fa-2x"></i><span>Search</span><span class="sr-only">(current)</span></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-user fa-2x"></i><span> About Us</span></a>
							</li>
							
			  </ul>
			</div>
			
				<?php
					//Current Date
					$pd = "".date("d-m-Y")."";
					
					//Execute query to get latest missing persons
					$mystring = exec('python ticker.py', $output);
					
					//Fetch JSON data
					$contents = file_get_contents('tickeroutput.json');
					$contents = utf8_encode($contents);
					$results = json_decode($contents, true);
				?>
			
			<div id="page-wrapper" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<h1 class="page-header">Greetings!</h1>
				<div class="white">
					<div id="nt-example2-container">
		                <ul id="nt-example2">
		                <?php 
			                for ($i=0;$i<sizeof($results);$i++){
			                		
			                	$uid = $results[$i][0];
			                	$name = $results[$i][1];
			                	$age = $results[$i][4];
			                	//$occupation = $results[$i]["occupation"];
			                	$gender = $results[$i][3];
			                	$height = $results[$i][7];
			                	//$built = $results[$i]["built"];
			                	//$complexion = $results[$i]["complexion"];
			                	//$dress = $results[$i]["dress"];
			                	$DoM = $results[$i][2];
			                	$address = $results[$i][8];
			                	$city = $results[$i][5];
			                	$state = $results[$i][6]; 	
		                ?>
		                    <li>
		                    	<i class="fa fa-fw fa-play state"></i>
		                    	<?php echo $DoM?> <?php echo $name?> <br><br/>	
								<span class="hour"><img class="img-responsive img-rounded" src = "<?php echo "images/".$uid.".jpg"; ?>" alt = "<?php echo $uid?>"></img></span>
								<div class = "data-infos">	
								<div class="table-responsive">
								<table class="table table-condensed">
								<tbody>
								<tr>
									<th>Name:</th><td><?php echo $name?></td>
								</tr>
								<tr>
									<th>Age:</th><td><?php echo $age?></td>
								</tr>
								<tr>
									<th>Gender:</th><td><?php echo $gender?></td>
								</tr>
								<tr>
									<th>Date of Missing:</th><td><?php echo $DoM?></td>
								</tr>
								<tr>
									<th>Address:</th><td><?php echo $address?></td>
								</tr>
								<tr>
									<th>City:</th><td><?php echo $city?></td>
								</tr>
								<tr>
									<th>State:</th><td><?php echo $state?></td>
								</tr>
								</tbody>
								</table>
								</div>
								</div>								
		                    </li>
		                    <?php } //end of for loop?>
		                </ul>
						
		                <div id="nt-example2-infos-container">
			                <div id="nt-example2-infos-triangle"></div>
			                <div id="nt-example2-infos" class="row">
			                	<div class="col-xs-4 centered">
				                	<div class="infos-hour">
				                		<span style = "font-size: 50px; font-weight: 700; margin-right: 20px;"><?php echo date("h:ia");?></span>
				                	</div>
				                	<i class="fa fa-arrow-left" id="nt-example2-prev"></i>
				                	<i class="fa fa-arrow-right" id="nt-example2-next"></i>
			                	</div>
			                	<div class="col-xs-8">
			                		<div class="infos-text"><div style = "margin-top: 10%;"><h2>Latest Missing Persons<span class="badge"><?php echo sizeof($results);?></span></h2></div></div>
			                	</div>
			                </div>
		                </div>
					</div>	
				</div>	
			</div>
		</div>
		</div>
	
	<div id="signin" class="modal fade" style="margin-top:100px;" role="dialog" aria-labelledby="myModalLogin" aria-hidden="true" data-backdrop= "static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Administrator Login</h4>
				</div>	
				<form role="form" action = "<?php $_SERVER['PHP_SELF'];?>" method = "post" name="adminform">
				<div class="modal-body">
						<div class="form-group">
							<label for="user">Username:</label>
							<input type="text" class="form-control" id="username" name="adminusername"/>
						</div>
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" class="form-control" id="password" name="adminpassword"/>
						</div>
				</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-default" data-dismiss="modal" value="Cancel"/>
					<input type = "submit" class="btn btn-primary" value="Login" name = "adminlogin"/>
				</div>	
				</form>
			</div>
		</div>
	</div>
	
	<!-- Placed at end of file for faster loading -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.newsTicker.js"></script>

	<script>
	
	var nt_example2 = $('#nt-example2').newsTicker({
		row_height: 60,
		max_rows: 1,
		speed: 300,
		duration: 6000,
		prevButton: $('#nt-example2-prev'),
		nextButton: $('#nt-example2-next'),
		hasMoved: function() {
			$('#nt-example2-infos-container').fadeOut(200, function(){
				$('#nt-example2-infos .infos-hour').html($('#nt-example2 li:first span').html());
				$('#nt-example2-infos .infos-text').html($('#nt-example2 li:first div').html());
				$(this).fadeIn(400);
			});
		},
		pause: function() {
			$('#nt-example2 li i').removeClass('fa-play').addClass('fa-pause');
		},
		unpause: function() {
			$('#nt-example2 li i').removeClass('fa-pause').addClass('fa-play');
		}
	});
	$('#nt-example2-infos').hover(function() {
		nt_example2.newsTicker('pause');
	}, function() {
		nt_example2.newsTicker('unpause');
	});

	</script>

</body>
</html>

<?php 		

	/*$returnurl = urlencode(isset($_POST["returnurl"])?$_POST["returnurl"]:"");
		if($returnurl == "")
			$returnurl = urlencode(isset($_POST["returnurl"])?$_POST["returnurl"]:"");*/
		
		if(isset($_POST['adminlogin'])){
			$username = $_POST["adminusername"];
			$password = $_POST["adminpassword"];

			if(confirmuser($username,md5($password)))
			{ 
				createsessions($username,$password);
				header("Location: adminhome.php"); 
			} 
			else 
			{ 
				echo "Invalid login credentials.";
				clearsessionscookies();
				header("location: userhome.php");
			}
		}
	} //end of checkLoggedIn else 
?>
