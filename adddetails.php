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
	
	<!-- Datepicker jquery 
	<script src="js/bootstrap-datepicker.js" type="text/javascript"></script> -->
	
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
			   <applet code="clock.class" width="150" height="50"> </applet>			
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
								<a href="adminindiamap.php"><i class="fa fa-map-marker fa-2x"></i><span>View Map</span></a>
							</li>
							<li class = "active">
								<a href = ""><i class="fa fa-pencil-square-o fa-2x"></i><span>Add Details</span></a>
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
							<li>
								<a href="adminsearch.php"><i class="fa fa-search fa-2x"></i><span>Search</span></a>
							</li>
							
			  </ul>
			</div>
								
			<div id="page-wrapper" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	
			<div class="jumbotron">
				<h1 align="center">Report A Missing Person</h1>
				<h4 align="center"><small>(Please fill in the following form with exact details)</small></h4>
			</div>
		
			<h2>Missing Person Details</h2>
			<form role="form" action="jsondump.php" method="post" name="f1" enctype="multipart/form-data">
				
				<div class="form-group">
				<input type = "hidden" class = "form-control" name = "person[uid]" id = "id1"/>
				</div>				
				<div class="form-group">
					<label for="image">Upload photo: (MAX File Size: 200kb) </label>
					<input id="profile" type="file" class="file" name="file" required />
				</div>
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" class="form-control" id="name" placeholder="Enter name" name="person[name]" onchange = 'letterChecker(document.getElementById("name").value,"name")' pattern="[A-Za-z\s]+{3}" >
				</div>
				<div class="form-group">
					<label for="age">Age:</label>
					<input type="number" class="form-control" id="age" placeholder="Enter age" name="person[age]" max="100" min="1" pattern="^([0-9]+)$"  maxlength="3"  >
				</div>
				<div class="form-group">
					<label for="occupation">Occupation:</label>
					<input type="text" class="form-control" id="occupation" placeholder="Enter Occupation" name="person[occupation]" onblur = 'letterChecker(document.getElementById("occupation"),"occupation")' pattern="[A-Za-z\s]+">
				</div>
				
				<div class="form-group">
				<label for="gender"> Gender: </label>
					<div class="radio">
						<label><input type="radio" id="male" name="person[gender]" value="Male">Male</label>
						<label><input type="radio" id="female" name="person[gender]" value="Female">Female</label>
						<label><input type="radio" id="other" name="person[gender]" value="Other">Other</label>
					</div>
				</div>
					
				<div class="form-group">
				<label for="height">Height:</label>
				<input type="number" class="form-control" id="height" placeholder="Enter height(in cms)" name="person[height]" onfocus = 'radioChecker()'  max="300" min="0" pattern="^([0-9]+)$" >
				</div>
				<div class="form-group">
				<label for="built">Built:</label>
				<input type="text" class="form-control" id="built" placeholder="Enter Built" name="person[built]" onblur = 'specialChecker(document.getElementById("built").value, "built")' >
				</div>
				<div class="form-group">
				<label for="complexion">Complexion:</label>
				<input type="text" class="form-control" id="complexion" placeholder="Complexion" name="person[complexion]" onblur = 'letterChecker(document.getElementById("complexion").value, "complexion")' pattern="[A-Za-z\s]+" >
				</div>
				<div class="form-group">
				<label for="dress">Dress:</label>
				<input type="text" class="form-control" id="phone" placeholder="Enter dress last seen in" name="person[dress]" onblur = 'specialChecker(document.getElementById("dress").value, "dress")' >
				</div>
				
				
				<div class="form-group">
  				<label for="date">Date Of Missing:</label>
                		<input id="DoM" placeholder = "MM/DD/YYYY" name="person[DoM]" type="date" class="form-control" required/>  
				</div>

				
				<br>
				<div class="form-group">
				<label for="address">Address:</label>
				<textarea class="form-control" rows="5" id="address" name="person[address]" onblur = 'specialChecker(document.getElementById("address").value, "address")' ></textarea>
				</div>
				
				<div class="form-group">
				<label for="city">City:</label>
				<input type="text" class="form-control" id="city" placeholder="Enter City" name="person[city]" onblur = 'letterChecker(document.getElementById("city").value, "city")' pattern="[A-Za-z\s]+" >
				</div>
				
				<div class="form-group">
				<label for="state">State:</label>
				<select class="form-control" id="state" name="person[state]" >
					<option value="none">Select State</option>
					<option value="Andhra Pradesh">Andhra Pradesh</option>
					<option value="Arunachal Pradesh">Arunachal Pradesh</option>
					<option value="Assam">Assam</option>
					<option value="Bihar">Bihar</option>
					<option value="Chhattisgarh">Chhattisgarh</option>
					<option value="Goa">Goa</option>
					<option value="Gujarat">Gujarat</option>
					<option value="Haryana">Haryana</option>
					<option value="Himachal Pradesh">Himachal Pradesh</option>
					<option value="Jammu and Kashmir">Jammu and Kashmir</option>
					<option value="Jharkhand">Jharkhand</option>
					<option value="Karnataka">Karnataka</option>
					<option value="Kerala">Kerala</option>
					<option value="Madhya Pradesh">Madhya Pradesh</option>
					<option value="Maharashtra">Maharashtra</option>
					<option value="Manipur">Manipur</option>
					<option value="Meghalaya">Meghalaya</option>
					<option value="Mizoram">Mizoram</option>
					<option value="Nagaland">Nagaland</option>
					<option value="Orissa">Orissa</option>
					<option value="Punjab">Punjab</option>
					<option value="Rajasthan">Rajasthan</option>
					<option value="Sikkim">Sikkim</option>
					<option value="Tamil Nadu">Tamil Nadu</option>
					<option value="Telangana">Telangana</option>
					<option value="Tripura">Tripura</option>
					<option value="Uttar Pradesh">Uttar Pradesh</option>
					<option value="Uttarakhand">Uttarakhand</option>
					<option value="West Bengal">West Bengal</option>
				</select>
				</div>

				<h3>Contact Person Details</h3>
				
				<div class="form-group">
				<input type="hidden" class="form-control" id="id2" name="contact[uid]"/>
				</div>
				<div class="form-group">
				<label for="cname">Contact Person Name:</label>
				<input type="text" class="form-control" id="cname" placeholder="Enter Contact Person Name" name="contact[name]" onfocus = 'stateChecker("state")' onchange = 'letterChecker(document.getElementById("cname").value,"cname")' pattern="[A-Za-z\s]+{3}" >
				</div>
				<div class="form-group">
				<label for="caddress">Contact Person Address:</label>
				<textarea class="form-control" rows="5" id="caddress" name="contact[address]" onblur = 'specialChecker(document.getElementById("caddress").value, "caddress")' ></textarea>
				</div>
				<div class="form-group">
				<label for="ccity">City:</label>
				<input type="text" class="form-control" id="ccity" placeholder="Enter City" name="contact[city]" onblur = 'letterChecker(document.getElementById("ccity").value, "ccity")' pattern="[A-Za-z\s]+{3}">
				</div>
				
				<div class="form-group">
				<label for="state">State:</label>
				<select class="form-control" id="cstate" name="contact[state]" >
					<option value="none">Select State</option>
					<option value="Andhra Pradesh">Andhra Pradesh</option>
					<option value="Arunachal Pradesh">Arunachal Pradesh</option>
					<option value="Assam">Assam</option>
					<option value="Bihar">Bihar</option>
					<option value="Chhattisgarh">Chhattisgarh</option>
					<option value="Goa">Goa</option>
					<option value="Gujarat">Gujarat</option>
					<option value="Haryana">Haryana</option>
					<option value="Himachal Pradesh">Himachal Pradesh</option>
					<option value="Jammu and Kashmir">Jammu and Kashmir</option>
					<option value="Jharkhand">Jharkhand</option>
					<option value="Karnataka">Karnataka</option>
					<option value="Kerala">Kerala</option>
					<option value="Madhya Pradesh">Madhya Pradesh</option>
					<option value="Maharashtra">Maharashtra</option>
					<option value="Manipur">Manipur</option>
					<option value="Meghalaya">Meghalaya</option>
					<option value="Mizoram">Mizoram</option>
					<option value="Nagaland">Nagaland</option>
					<option value="Orissa">Orissa</option>
					<option value="Punjab">Punjab</option>
					<option value="Rajasthan">Rajasthan</option>
					<option value="Sikkim">Sikkim</option>
					<option value="Tamil Nadu">Tamil Nadu</option>
					<option value="Telangana">Telangana</option>
					<option value="Tripura">Tripura</option>
					<option value="Uttar Pradesh">Uttar Pradesh</option>
					<option value="Uttarakhand">Uttarakhand</option>
					<option value="West Bengal">West Bengal</option>
				</select>
				</div>
				
				<div class="form-group">
				<label for="cphone">Contact Person Phone No:</label>
				<input type="number" class="form-control" id="cphone" placeholder="Enter Contact Phone No" name="contact[phone]" onfocus = 'stateChecker("cstate")'  pattern="^([0-9]+)$"  max="9999999999" min="0000000000" >
				</div>
				<input type="submit" class="btn btn-info" value="Confirm Details" name="submit">
			</form>
			</div>
		</div>
	</div>

	<!-- Placed at end of file for faster loading -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script>

			//unique key generator	
			function generate(length)
			{
				var arr = [];
				var n;
	
				for(var i=0; i<length; i++)
				{
					do
						n = Math.floor(Math.random()*2129+1327);
						
						while(arr.indexOf(n) !== -1)       
							arr[i] = n;
				}
				return arr;
			}

			x = "";
			var b = generate(2);

			for(var i=0; i<b.length; i++)
			{
				x+=b[i]+"";
			}

			document.getElementById("id1").value = x + "";
			document.getElementById("id2").value = x + "";
		
		//letters only
		function letterChecker(inputText,idName){
		var txtformat = /^[A-Za-z\s+]+$/;  
			if(!inputText.match(txtformat))   { 
				alert("You have entered an invalid "+idName+"!");  
				document.getElementById(idName).focus();   
			}  
		}
		
		//age
		function ageChecker(age1){
		var numbers = /^[0-9]+$/;  
		if(!age1.match(numbers)||(age1<1)||(age1>100)) {
			alert("Please enter correct age.");
			document.getElementById("age").focus();
			}
		}
		
		//height
		function heightChecker(height1){
		var numbers = /^[0-9]+$/;  
		if(!height1.match(numbers)||(height1<1)||(height1>300)) {
			alert("Please enter correct height.");
			document.getElementById("height").focus();
			}
		}
		
		//radio
		function radioChecker(){
			if((document.getElementById("male").checked==false)&&(document.getElementById("female").checked==false)&&(document.getElementById("other").checked==false)){
				alert("Please select a gender!");
				document.getElementById("other").focus();
			}
		}
		
		//date < Today
		function dateChecker(inputDate){
		var ddmmyyyy = inputDate.split("/");
		var month = ddmmyyyy[0];
        var date = ddmmyyyy[1];
        var year = ddmmyyyy[2];
		var myDate = new Date(year, month - 1, date);
		var today = new Date();
		if(myDate>today){
			alert("Invalid date.");
			document.getElementById("DoM").focus();
		}
		}
		
		//numbers only
		function numberChecker(inputText,idName){
		var numbers = /^[0-9]+$/;
		if(!inputText.match(numbers)){
			alert("You have entered an invalid "+idName+"!");
			document.getElementById(idName).focus();
		}
		}
		
		//no special characters
		function specialChecker(inputText,idName){
		var special = /^[A-Za-z0-9\-\\\/\&#\'\"(){}.,:;\s+]+$/;
		if(!inputText.match(special)){
			alert("You have entered an invalid "+idName+"!");
			document.getElementById(idName).focus();
		}
		}
		
		//state checker
		function stateChecker(idName){
		 if ((idName=="state")&&(document.getElementById("state").value == "none"))  
			{
				alert("Please select a state of the missing person.");        
				document.getElementById("state").focus();  
			}   
		else if ((idName=="cstate")&&(document.getElementById("cstate").value == "none"))
			{
				alert("Please select a state of the contact person.");        
				document.getElementById("cstate").focus(); 
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
