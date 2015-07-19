<?php

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
	
	<!-- Image slide effect -->
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	
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
							<li>
								<a href = "userhome.php"><i class="fa fa-home fa-2x"></i><span>Home</span></a>
							</li>
							<li>
								<a href="userindiamap.php"><i class="fa fa-map-marker fa-2x"></i><span>View Map</span></a>
							</li>
							<li>
								<a href="userreports.php"><i class="fa fa-users fa-2x"></i><span>Reports</span></a>
							</li>
							<li class = "active">
								<a href=""><i class="fa  fa-bar-chart-o fa-2x"></i><span>Analytics</span></a>
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
		
			<div id="page-wrapper" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<ul class="grid cs-style-3">
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/andhra.gif" alt="img01">
							<figcaption>
								<h3>Andhra Pradesh</h3>
								<span>Missing reports in Andhra Pradesh. </span>
								<a href="userexamplestate.php?state=andhra">Take a look</a>   
							</figcaption>
						</figure>
					</li>
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/himachal.gif" alt="img01">
							<figcaption>
								<h3>Himachal Pradesh</h3>
								<span>Missing reports in Himachal Pradesh. </span>
								<a href="userexamplestate.php?state=himachal">Take a look</a>   
							</figcaption>
						</figure>
					</li>
					

					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/assam.gif" alt="img01">
							<figcaption>
								<h3>Assam</h3>
								<span>Missing cases in Assam. </span>
								<a href="userexamplestate.php?state=assam">Take a look</a>
							</figcaption>
						</figure>		
					</li>
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/bihar.gif" alt="img01">
							<figcaption>
								<h3>Bihar</h3>
								<span>Missing cases in Bihar. </span>
								<a href="userexamplestate.php?state=bihar">Take a look</a>
							</figcaption>
						</figure>		
					</li>
					
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/arunachal.gif" alt="img01">
							<figcaption>
								<h3>Arunachal Pradesh</h3>
								<span>Missing cases in Arunachal Pradesh. </span>
								<a href="userexamplestate.php?state=arunachal">Take a look</a>
							</figcaption>
						</figure>
					</li>

					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/gujarat.gif" alt="img01">
							<figcaption>
								<h3>Gujarat</h3>
								<span>Missing cases in Gujarat. </span>
								<a href="userexamplestate.php?state=gujarat">Take a look</a>
							</figcaption>
						</figure>		
					</li>
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/punjab.jpg" alt="img01">
							<figcaption>
								<h3>Punjab</h3>
								<span>Missing reports in Punjab. </span>
								<a href="userexamplestate.php?state=punjab">Take a look</a>   
							</figcaption>
						</figure>
					</li>
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/jammukashmir.gif" alt="img01">
							<figcaption>
								<h3>Jammu and Kashmir</h3>
								<span>Missing cases in J&amp;K. </span>
								<a href="userexamplestate.php?state=jammu">Take a look</a>
							</figcaption>
						</figure>
					</li>
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/jharkhand.gif" alt="img01">
							<figcaption>
								<h3>Jharkhand</h3>
								<span>Missing cases in Jharkhand. </span>
								<a href="userexamplestate.php?state=jharkhand">Take a look</a>
							</figcaption>
						</figure>		
					</li>
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/madhya.gif" alt="img01">
							<figcaption>
								<h3>Madhya Pradesh</h3>
								<span>Missing cases in Madhya Pradesh. </span>
								<a href="userexamplestate.php?state=madhya">Take a look</a>
							</figcaption>
						</figure>
					</li>
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/manipur.gif" alt="img01">
							<figcaption>
								<h3>Manipur</h3>
								<span>Missing cases in Manipur. </span>
								<a href="userexamplestate.php?state=manipur">Take a look</a>
							</figcaption>
						</figure>		
					</li>
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/nagaland.gif" alt="img01">
							<figcaption>
								<h3>Nagaland</h3>
								<span>Missing cases in Nagaland. </span>
								<a href="userexamplestate.php?state=nagaland">Take a look</a>
							</figcaption>
						</figure>		
					</li>
				
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/meghalaya.gif" alt="img01">
							<figcaption>
								<h3>Meghalaya</h3>
								<span>Missing reports in Meghalaya. </span>
								<a href="userexamplestate.php?state=meghalaya">Take a look</a>   
							</figcaption>
						</figure>
					</li>
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/orissa.gif" alt="img01">
							<figcaption>
								<h3>Orissa</h3>
								<span>Missing cases in Orissa. </span>
								<a href="userexamplestate.php?state=orissa">Take a look</a>
							</figcaption>
						</figure>		
					</li>
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/rajasthan.gif" alt="img01">
							<figcaption>
								<h3>Rajasthan</h3>
								<span>Missing cases in Rajasthan. </span>
								<a href="userexamplestate.php?state=rajasthan">Take a look</a>
							</figcaption>
						</figure>
					</li>
					
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/tripura.gif" alt="img01">
							<figcaption>
								<h3>Tripura</h3>
								<span>Missing reports in Tripua. </span>
								<a href="userexamplestate.php?state=tripura">Take a look</a>   
							</figcaption>
						</figure>
					</li>
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/Uttarakhand.gif" alt="img01">
							<figcaption>
								<h3>Uttarakhand</h3>
								<span>Missing cases in Uttarakhand. </span>
								<a href="userexamplestate.php?state=uttarakhand">Take a look</a>
							</figcaption>
						</figure>
					</li>
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/uttarpradesh.gif" alt="img01">
							<figcaption>
								<h3>Uttar Pradesh</h3>
								<span>Missing cases in Uttar Pradesh. </span>
								<a href="userexamplestate.php?state=up">Take a look</a>
							</figcaption>
						</figure>		
					</li>
					
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/westbengal.gif" alt="img01">
							<figcaption>
								<h3>West Bengal</h3>
								<span>Missing cases in West Bengal. </span>
								<a href="userexamplestate.php?state=wb">Take a look</a>
							</figcaption>
						</figure>		
					</li>
					
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/Sikkim.gif" alt="img01">
							<figcaption>
								<h3>Sikkim</h3>
								<span>Missing cases in Sikkim. </span>
								<a href="userexamplestate.php?state=sikkim">Take a look</a>
							</figcaption>
						</figure>		
					</li>
					
					
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/goa.gif" alt="img01">
							<figcaption>
								<h3>Goa</h3>
								<span>Missing cases in Goa. </span>
								<a href="userexamplestate.php?state=goa">Take a look</a>
							</figcaption>
						</figure>
					</li>
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/haryana.gif" alt="img01">
							<figcaption>
								<h3>Haryana</h3>
								<span>Missing cases in Haryana. </span>
								<a href="userexamplestate.php?state=haryana">Take a look</a>
							</figcaption>
						</figure>		
					</li>
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/karnataka.gif" alt="img01">
							<figcaption>
								<h3>Karnataka</h3>
								<span>Missing cases in Karnataka. </span>
								<a href="userexamplestate.php?state=karnataka">Take a look</a>
							</figcaption>
						</figure>		
					</li>
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/mizoram.gif" alt="img01">
							<figcaption>
								<h3>Mizoram</h3>
								<span>Missing cases in Mizoram. </span>
								<a href="userexamplestate.php?state=mizoram">Take a look</a>
							</figcaption>
						</figure>
					</li>
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/kerala.gif" alt="img01">
							<figcaption>
								<h3>Kerala</h3>
								<span>Missing reports in Kerala. </span>
								<a href="userexamplestate.php?state=kerala">Take a look</a>   
							</figcaption>
						</figure>
					</li>
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/Chhattisgarh.gif" alt="img01">
							<figcaption>
								<h3>Chhattisgarh</h3>
								<span>Missing reports in Chhattisgarh. </span>
								<a href="userexamplestate.php?state=ch">Take a look</a>   
							</figcaption>
						</figure>
					</li>
					
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/tamilnadu.gif" alt="img01">
							<figcaption>
								<h3>Tamil Nadu</h3>
								<span>Missing cases in Tamil Nadu. </span>
								<a href="userexamplestate.php?state=tn">Take a look</a>
							</figcaption>
						</figure>		
					</li>
					
					<li>
						<figure>
							<img class = "img-responsive" src="statesmap/maharashtra.gif" alt="img01">
							<figcaption>
								<h3>Maharashtra</h3>
								<span>Missing cases in Maharashtra. </span>
								<a href="userexamplestate.php?state=maharashtra">Take a look</a>
							</figcaption>
						</figure>		
					</li>
					
				</ul>
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
	 <!-- Image Rollovers -->
	<script src="js/toucheffects.js"></script>         
	<script src="js/modernizr.custom.js"></script>

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
				header("location: userstatistics.php");
			}
		}
	} //end of checkLoggedIn else 
?>
