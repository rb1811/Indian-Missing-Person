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
    
	<style>
		.jumbotron {
			color: #ffffff;
			background-color: #1bb0a7;
		}
	</style>	
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
								<a href="adminhome.php"><i class="fa fa-home fa-2x"></i><span>Home</span><span class="sr-only">(current)</span></a>
							</li>
							<li>
								<a href="adminindiamap.php"><i class="fa fa-map-marker fa-2x"></i><span>View Map</span></a>
							</li>
							<li>
								<a href="adddetails.php"><i class="fa fa-pencil-square-o fa-2x"></i><span>Add Details</span></a>
							</li>
							<li>
								<a href="adminupdate.php"><i class="fa fa-pencil fa-2x"></i><span>Update Details</span></a>
							</li>
							<li>
								<a href="adminreports.php"><i class="fa fa-users fa-2x"></i><span>Reports</span></a>
							</li>
							<li>
								<a href="adminstatistics.php"><i class="fa  fa-bar-chart-o fa-2x"></i><span>Analytics</span></a>
							</li>
							<li>
							<a href="excelwrite.php"><i class = "fa fa-database fa-2x"></i><span>Export</span></a>
							</li>
							<li  class = "active">
								<a href=""><i class="fa fa-search fa-2x"></i><span>Search</span></a>
							</li>			
			  </ul>
			</div>
					
			<div id="page-wrapper" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<div class="container-fluid">
			<div class="jumbotron"><h1>Search</h1><h4><small>(Please choose a key and enter appropriate value to search)</small></h4>
			<form role = "form" name="search_form" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			
			<div class="form-group">
				<label for="key">Select Key: *</label>
				<select class="form-control" id="searchkey" name="search_key" required>
					<option value="" selected disabled hidden>---</option>
					<option value="uid">Unique ID</option>
					<option value="name">Name</option>
				<!--	<option value="age">Age</option>
					<option value="DoM">Date of Missing</option>
					<option value="city">City</option> -->
					<option value="state">State</option>
				<!--	<option value="cname">Contact Person Name</option>
					<option value="ccity">Contact Person City</option>
					<option value="cstate">Contact Person State</option> -->
					<option value="cphone">Contact Person Phone Number</option> 
				</select>
				</div>
				
				<div class="form-group">
					<label for="value">Enter Value: *</label>
					<input type = "text" class = "form-control" name = "search_value" id = "searchvalue" required/>
				</div>
				<button type="submit" class="btn btn-success" name = "search_btn" id = "searchbtn">
					<i class="glyphicon glyphicon-search"></i> Search
				</button>
			</form>
			</div>
			<?php 
			if (!empty($_POST)):
								//Encode json
								$_POST["search_value"] = str_replace(array("\r\n", "\r", "\n"), " ", $_POST["search_value"]);
								$query = array($_POST["search_key"] => $_POST["search_value"]);
								$arr = json_encode($query);

			$flag = 0;
			if($_POST['search_key']=="uid"){
				//Dump json file for search
				$writeJson = file_put_contents('searchuid.json', $arr);
				$mystring = exec('python searchmpuid.py', $output);
				
				//Fetch Missing Person Details
				$contents = file_get_contents('searchuidoutput.json');
				$contents = utf8_encode($contents);
				$results = json_decode($contents,true);
				$flag = 1;
				}
			else if($_POST['search_key']=="name"){
				$writeJson = file_put_contents('searchname.json', $arr);
				$mystring = exec('python searchmpname.py', $output);
				
				//Fetch Missing Person Details
				$contents = file_get_contents('searchnameoutput.json');
				$contents = utf8_encode($contents);
				$results = json_decode($contents,true);
				$flag = 1;
			}
			else if($_POST['search_key']=="state"){
				$writeJson = file_put_contents('searchstate.json', $arr);
				$mystring = exec('python searchmpstate.py', $output);
				
				//Fetch Missing Person Details
				$contents = file_get_contents('searchstateoutput.json');
				$contents = utf8_encode($contents);
				$results = json_decode($contents,true);
				$flag = 1;
			}
			
			if($flag==1){
			?>
			<ul class = "list-group">
			<li class="list-group-item list-group-item-danger"><h3>Missing Person Details<span class="badge"><?php echo sizeof($results);?></span></h3>		
			<div class="table-responsive">
			<table class="table table-bordered table-hover table-condensed" id= "mp_result">
				<thead>
				  <tr class = "info">
					<th>Unique ID</th>
					<th>Full Name</th>
					<th>Age</th>
					<th>Occupation</th>
					<th>Gender</th>
					<th>Height(cm)</th>
					<th>Built</th>
					<th>Complexion</th>
					<th>Dress</th>
					<th>Date of Missing</th>
					<th>Address</th>
					<th>City</th>
					<th>State</th>
				  </tr>
				</thead>
				<tbody>
				<?php 
				
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

					//echo "Missing Person ".($i+1)." Details - <br/>Name:".$name."<br/> Age:".$age."<br/> Unique ID:".$uid."<br/><br/>";
				?>
				  <tr>
					<td><?php echo $uid?></td>
					<td><?php echo $name?></td>
					<td><?php echo $age?></td>
					<td><?php echo $occupation?></td>
					<td><?php echo $gender?></td>
					<td><?php echo $height?></td>
					<td><?php echo $built?></td>
					<td><?php echo $complexion?></td>
					<td><?php echo $dress?></td>
					<td><?php echo $DoM?></td>
					<td><?php echo $address?></td>
					<td><?php echo $city?></td>
					<td><?php echo $state?></td>
				  </tr>
				  <?php } //end of for loop 
						} //end of if ?>
				</tbody>
			</table>
			</div>
			</li>
			
<?php
			$flag = 0;
			//Fetch Contact Person Details
			if($_POST['search_key']=="uid"){
				$writeJson = file_put_contents('searchcname.json', $arr);
				$mystring = exec('python searchmpcname.py', $output);
				//Fetch Missing Person Details
				$contents = file_get_contents('searchcnameoutput.json');
				$contents = utf8_encode($contents);
				$results = json_decode($contents, true);
				$flag = 1;
			}
			
			else if ($_POST['search_key']=="cphone"){
				$writeJson = file_put_contents('searchcphone.json', $arr);
				$mystring = exec('python searchcphone.py', $output);
				//Fetch Missing Person Details
				$contents = file_get_contents('searchcphoneoutput.json');
				$contents = utf8_encode($contents);
				$results = json_decode($contents, true);
				$flag = 1;
			}

			if($flag==1){

?>

			<li class="list-group-item list-group-item-success"><h3>Contact Person Details<span class="badge"><?php echo "1"?></span></h3>
			<div class="table-responsive">
			<table class="table table-bordered table-hover table-condensed" id= "cp_result">
				<thead>
				  <tr class = "info">
				  	<th>Unique ID</th>
					<th>Contact Person Name</th>
					<th>Address</th>
					<th>City</th>
					<th>State</th>
					<th>Phone</th>
				  </tr>
				</thead>
				<tbody>
				<?php
					for ($i=0;$i<sizeof($results);$i++){
					
					$uid = $results[$i]["uid"];
					$cName = $results[$i]["name"];
					$cAddress = $results[$i]["address"];
					$cCity = $results[$i]["city"];
					$cState = $results[$i]["state"];
					$cPhone = $results[$i]["phone"];
					
					//echo "Contact Person ".($i+1)." Details - <br/>Name:".$cName."<br/> Unique ID:".$uid."<br/><br/>"
				?>
				  <tr>
				  	<td><?php echo $uid?></td>
					<td><?php echo $cName ?></td>
					<td><?php echo $cAddress?></td>
					<td><?php echo $cCity?></td>
					<td><?php echo $cState?></td>
					<td><?php echo $cPhone?></td>
				  </tr>
				  <?php } //end of for loop
						}//end of if
						endif;?>
				</tbody>
			</table>
			</div>
			</li></ul>
			</div>
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
