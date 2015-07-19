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
			<applet code="clock.class" width="150" height="53"> </applet>
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
							<li>
								<a href="adminupdate.php"><i class="fa fa-pencil fa-2x"></i><span>Update Details</span></a>
							</li>
							<li class = "active">
								<a href = ""><i class="fa fa-users fa-2x"></i><span>Reports</span></a>
							</li>
							<li>
								<a href = "adminstatistics.php"><i class="fa  fa-bar-chart-o fa-2x"></i><span>Analytics</span></a>
							</li>
							<li>
							<a href="excelwrite.php"><i class = "fa fa-database fa-2x"></i><span>Export</span></a>
							</li>
							<li>
								<a href="adminsearch.php"><i class="fa fa-search fa-2x"></i><span>Search</span></a>
							</li>
							
			  </ul>
			</div>
								
			<div id="page-wrapper" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
						
				<ul>
				<div class="table-responsive">
		                <?php 
		                //Fetch JSON data
				$mystring = exec('python report.py', $output);
		                $contents = file_get_contents('reportsoutput.json');
		                $contents = utf8_encode($contents);
		                $results = json_decode($contents, true);
			                for ($i=0;$i<sizeof($results);$i++){
			                		
			                	$uid = $results[$i]["uid"];
			                	$name = $results[$i]["name"];
			                	$age = $results[$i]["age"];
			                	$occupation = $results[$i]["occupation"];
			                	$gender = $results[$i]["gender"];
			                	$height = $results[$i]["height"];
			                	$built = $results[$i]["built"];
			                	$complexion = $results[$i]["complexion"];
			                	$dress = $results[$i]["dress"];
			                	$DoM = $results[$i]["DoM"];
			                	$address = $results[$i]["address"];
			                	$city = $results[$i]["city"];
			                	$state = $results[$i]["state"]; 	
		                ?>
		          
		                    <li>
		                    	<i class="fa fa-fw fa-play state"></i>	
								<span class="hour"><?php echo $DoM?></span> <?php echo $name?> <br><br/>
								<div class = "data-infos">
								<table class="table table-condensed table-hover">
								<tbody>
								<tr>
								<td rowspan = "11" colspan = "3" style="padding:5px 0px 5px 0px; .img-responsive{width:100%;}">
									<img class="img-responsive img-rounded" src = "<?php echo "images/".$uid.".jpg"; ?>" alt = "<?php echo $uid?>"></img></td>	
									<td></td><td></td>	
								</tr>
								<tr>
									<th>Name: </th><td><?php echo $name?></td>
								</tr>
								<tr>
									<th>Age:</th><td><?php echo $age?></td>
								</tr>
								<tr>
									<th>Gender:</th><td><?php echo $gender?></td>
								</tr>
								<tr>
									<th>Occupation:</th><td><?php echo $occupation?></td>
								</tr>
								<tr>
									<th>Height:</th><td><?php echo $height?></td>
								</tr>
								<tr>
									<th>Built:</th><td><?php echo $built?></td>
								</tr>
								<tr>
									<th>Complexion:</th><td><?php echo $complexion?></td>
								</tr>
								<tr>
									<th>Address:</th><td><?php echo $address." , ".$city?></td>
								</tr>
								<tr>
									<th>State:</th><td><?php echo $state?></td>
								</tr>
								<tr><td colspan = "2">
									<a href = "<?php echo "pdfgenerate.php?uid=".$uid; ?>"><button type="button" class="btn btn-danger btn-block" name = "<?php echo "print".$uid?>" style = "float:right;">
									<i class="fa fa-file-pdf-o fa-2x"></i>Save as PDF</button></a></td>
								</tr>
								</tbody>
								</table> 
								</div>								
		                    </li>
		                    <?php } //end of for loop?>
		             </div>
		            </ul>
			</div>
		</div>
	</div>
	
<!-- Placed at end of file for faster loading -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

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
