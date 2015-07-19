<?php 
ob_start(); 
session_start(); 

require_once ("functions.php"); 

if (checkLoggedin()) {

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
    <link href="css/dashboard.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- Datepicker jquery -->
	<script src="js/bootstrap-datepicker.js" type="text/javascript"></script>
	
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
			  <a class="navbar-brand" href="#">Wish You Were Here <span id="clock"></span></a>
			</div>
			
			<div id="navbar" class="navbar-collapse collapse">
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="?logout=1" name = "logout"><i class="glyphicon glyphicon-user"></i>Sign Out</a></li>	
				<li><a href="#"><i class="glyphicon glyphicon-cog"></i>Settings</a></li>	
			  </ul>
			  <form class="navbar-form navbar-right" method="POST" action = "adminsearch.php">
				<input type="text" class="form-control" placeholder="Search..." name = "search_value"/>
				<input type = "hidden" class = "form-control"  name="search_key" value="name"/>
			  </form>
			</div>
		  </div>
		</nav>

		<div class="container-fluid">
		  <div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
			  <ul class="nav nav-sidebar">
							<li>
								<a href = "adminhome.php"><i class="fa fa-home fa-2x"></i><span>Home</span><span class="sr-only">(current)</span></a>
							</li>
							<li>
								<a href = "adminindiamap.php"><i class="fa fa-map-marker fa-2x"></i><span>View Map</span></a>
							</li>
							<li >
								<a href = "adddetails.php"><i class="fa fa-pencil-square-o fa-2x"></i><span>Add Details</span></a>
							</li>
							<li class = "active">
								<a href=""><i class="fa fa-pencil fa-2x"></i><span>Update Details</span></a>
							</li>
							<li>
								<a href = "adminreports.php"><i class="fa fa-users fa-2x"></i><span>Reports</span></a>
							</li>
							<li>
								<a href = "adminstatistics.php"><i class="fa  fa-bar-chart-o fa-2x"></i><span>Analytics</span></a></li>
							<li>
							<a href="excelwrite.php"><i class = "fa fa-database fa-2x"></i><span>Export</span></a>
							</li>
							<li>
								<a href="adminsearch.php"><i class="fa fa-search fa-2x"></i><span>Search</span></a>
							</li>
							
			  </ul>
			</div>
								
			<div id="page-wrapper" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			
			<div class="jumbotron">
				<h1 align="center">Update Missing Person Status</h1>
				<h4 align="center"><small>(Please verify before updating any missing person's case)</small></h4>
			</div>
			
			<form role = "form" name="update_status" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
				<div class="form-group">
					<label for="uid">Unique Id:</label>
					<input type="number" class="form-control" id="uid" placeholder="Missing Person's Unique ID" name="update_found[uid]" max="99999999" min="10000000" pattern="^([0-9]+)$"  maxlength="8" required/>
				</div>
				<div class="form-group">
  				<label for="date">Found Date:</label>
                		<input id="DoF" placeholder = "MM/DD/YYYY" name="update_found[dof]" type="date" class="form-control" required/>  
				</div>
				<br/>
				<button type="submit" class="btn btn-success" name = "found_btn" id = "updatebtn">
					<i class="glyphicon glyphicon-ok"></i> Report as Found </button>
				</form>
			<?php
				if(isset($_POST['found_btn'])){
					//Encode json
					$jsondata = json_encode($_POST['update_found']);
					$writeJson = file_put_contents('founduid.json', $jsondata);
					exec('python mpfound.py', $output);
					//Update Database
					//if(exec('python mpfound.py', $output)){
						echo "<br/><pre> Thankyou! A found report for case number ".$_POST['update_found']['uid']." has been registered. </pre>" ;
					//}
				}
			?>
			</div>
		</div>
	</div>
	
<!-- Placed at end of file for faster loading -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

	<script>
		//date < Today
		function dateChecker(inputDate){
			var ddmmyyyy = inputDate.split("/");
			var month = ddmmyyyy[0];
			var date = ddmmyyyy[1];
			var year = ddmmyyyy[2];
			var myDate = new Date(year, month - 1, date);
			var today = new Date();http://localhost/WishYouWereHere/adminupdate.php
			if(myDate>today){
				alert("Invalid date.");
				document.getElementById("DoM").focus();
			}
		}
	</script>
	
</body>
</html>
<?php  
	error_reporting(E_ERROR | E_PARSE); 
	if($_REQUEST['logout']==1){
		clearsessionscookies(); 
		header("location: userhome.php"); 
		break;
	}
		} //end of CheckLoggedIn if
	else	 
		echo "<h1>You are not logged in - <a href = \"userhome.php\">login</a></h1></h1>"; 
?>
