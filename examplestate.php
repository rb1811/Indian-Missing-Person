<?php
ob_start(); 
session_start(); 

require_once ("functions.php"); 

if (checkLoggedin()) {
	error_reporting(E_ERROR | E_PARSE); 
	$states = array("Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", 
	"Jharkhand","Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Orissa", "Punjab", "Rajasthan", "Sikkim", 
	"Tamilnadu", "Telangana","Tripura","Uttar Pradesh", "Uttarkhand", "West Bengal");
	
	if($_REQUEST['state']=="andhra"){ $scode = 0; $state = $states[$scode]; }
	else if($_REQUEST['state']=="arunachal"){ $scode = 1; $state = $states[$scode]; }
	else if($_REQUEST['state']=="assam"){ $scode = 2; $state = $states[$scode]; }
	else if($_REQUEST['state']=="bihar"){ $scode = 3; $state = $states[$scode]; }
	else if($_REQUEST['state']=="ch"){ $scode = 4; $state = $states[$scode]; }
	else if($_REQUEST['state']=="goa"){ $scode = 5; $state = $states[$scode]; }
	else if($_REQUEST['state']=="gujarat"){ $scode = 6; $state = $states[$scode]; }
	else if($_REQUEST['state']=="haryana"){ $scode = 7; $state = $states[$scode]; }
	else if($_REQUEST['state']=="himachal"){ $scode = 8; $state = $states[$scode]; }
	else if($_REQUEST['state']=="jammu"){ $scode = 9; $state = $states[$scode]; }
	else if($_REQUEST['state']=="jharkhand"){ $scode = 10; $state = $states[$scode]; }
	else if($_REQUEST['state']=="karnataka"){ $scode = 11; $state = $states[$scode]; }
	else if($_REQUEST['state']=="kerala"){ $scode = 12; $state = $states[$scode]; }
	else if($_REQUEST['state']=="madhya"){ $scode = 13; $state = $states[$scode]; }
	else if($_REQUEST['state']=="maharashtra"){ $scode = 14; $state = $states[$scode]; }
	else if($_REQUEST['state']=="manipur"){ $scode = 15; $state = $states[$scode]; }
	else if($_REQUEST['state']=="meghalaya"){ $scode = 16; $state = $states[$scode]; }
	else if($_REQUEST['state']=="mizoram"){ $scode = 17; $state = $states[$scode]; }
	else if($_REQUEST['state']=="nagaland"){ $scode = 18; $state = $states[$scode]; }
	else if($_REQUEST['state']=="orissa"){ $scode = 19; $state = $states[$scode]; }
	else if($_REQUEST['state']=="punjab"){ $scode = 20; $state = $states[$scode]; }
	else if($_REQUEST['state']=="rajasthan"){ $scode = 21; $state = $states[$scode]; }
	else if($_REQUEST['state']=="sikkim"){ $scode = 22; $state = $states[$scode]; }
	else if($_REQUEST['state']=="tn"){ $scode = 23; $state = $states[$scode]; }
	else if($_REQUEST['state']=="telangana"){ $scode = 24; $state = $states[$scode]; }
	else if($_REQUEST['state']=="tripura"){ $scode = 25; $state = $states[$scode]; }
	else if($_REQUEST['state']=="up"){ $scode = 26; $state = $states[$scode]; }
	else if($_REQUEST['state']=="uttarakhand"){ $scode = 27; $state = $states[$scode]; }
	else if($_REQUEST['state']=="wb"){ $scode = 28; $state = $states[$scode]; }
	
	else{
		$state = "Invalid state or unauthorised access.";
	}

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
	
	<!-- Image slide effect
	<link rel="stylesheet" type="text/css" href="css/component.css" />  -->

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
				<li><a a href="?logout=1" name = "logout"><i class="glyphicon glyphicon-user"></i>Sign Out</a></li>	
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
							<li>
								<a href="adddetails.php"><i class="fa fa-pencil-square-o fa-2x"></i><span>Add Details</span></a>
							</li>
							<li>
								<a href="adminupdate.php"><i class="fa fa-pencil fa-2x"></i><span>Update Details</span></a>
							</li>
							<li>
								<a href="adminreports.php"><i class="fa fa-users fa-2x"></i><span>Reports</span></a>
							</li>
							<li class = "active">
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
				<h1 align = "center" class = "page-header" style = "margin-top: 10px; margin-bottom: 20px;">&nbsp; <?php echo $state; ?> </h1>
				<div class = "row">
				<div class = "col-sm-4"><div id="chart1" style="margin: 0 auto float: left;"></div></div>
				<div class = "col-sm-4"><div id="chart2" style="margin: 0 auto float: right;"></div></div>
				<div class = "col-sm-4"><div id="chart3" style="margin: 0 auto float: right;"></div></div>
				</div><br/>
				<div class = "row">
				<div class = "col-sm-12"><div id="chart4" style="margin: 0 auto float: right;"></div></div>
				</div>
				<!-- <pre class="code brush:js" style = "width:300px; float: left;">x-axis: Cities <br> y-axis: Number of people missing </pre> -->
			</div>
		</div>
	</div>
			
	<!-- Placed at end of file for faster loading -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<!-- Highcharts -->
	<script src="js/highcharts.js"></script>
	<script src="js/highcharts-3d.js"></script>
	<script src="js/exporting.js"></script>
						
	<?php
	
		$mystring = exec('python statsmpstatessex.py', $output);
		$contents = file_get_contents('statsstatesexoutput.json');
		$contents = utf8_encode($contents);
		$results = json_decode($contents,true);
		//var_dump($results);
		//echo "Male:".$results[9][1]."<br/>Female".$results[9][2];
		
		$mystring = exec('python statesmpage.py', $output);
		$contents = file_get_contents('statsageoutput.json');
		$contents = utf8_encode($contents);
		$results3 = json_decode($contents,true);
		//var_dump($results3);

		$mystring = exec('python statstatescities.py', $output);
		$contents = file_get_contents('statescitiesoutput.json');
		$contents = utf8_encode($contents);
		$results4 = json_decode($contents,true);
		//var_dump($results4);
		
		$city = array();
		$count = array();
		
		for ($i=0;$i<sizeof($results4[$scode][$state]);$i++){
			$city[$i] = $results4[$scode][$state][$i];
			$count[$i] = 1;
			//echo $city[$i]."\n";
		}
		
		$n = sizeof($city);
		for ($i=0;$i<$n;$i++){
			for($j=$i;$j<$n;$j++){
				if($city[$i]==$city[$j]){
						$count[$i]++;
						$count[$j]--;
					}
			}
			//if($count[$i]!=0)
				//echo "\n".$city[$i]." ".$count[$i];
		}
	?>
	
	<script type="text/javascript">
	$(function () {
		$('#chart1').highcharts({
			chart: {
				type: 'column'
			},
			title: {
				text: 'Cases filed since 2000'
			},
			subtitle: {
				text: <?php echo "'".$state."'"; ?>
			},
			xAxis: {
				type: 'category',
				labels: {
					rotation: -45,
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Number of Missing People'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'Missing people since 2000: <b>{point.y:.1f}</b>'
			},
			series: [{
				name: 'Missing People',
				data: [
					['2004' , 0],
					['2008', 0],
					['2012', 0],
					['2015', 0]
				],
				dataLabels: {
					enabled: true,
					rotation: -90,
					color: '#FFFFFF',
					align: 'right',
					format: '{point.y:.1f}', // one decimal
					y: 10, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			}]
		});
	});
	
	$(function () {
			$('#chart2').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Total missing persons, grouped by gender'
				},
				xAxis: {
					categories: ['Male','Female']
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Number of missing persons'
					}
				},
				tooltip: {
					pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
					shared: true
				},
				plotOptions: {
					column: {
						stacking: 'percent'
					}
				},
				series: [{
					name: 'Male',
					data: [<?php echo $results[$scode][1]?>] //JK state code: 9, Male code: 1
				},{
					name: 'Female',
					data: [<?php echo $results[$scode][2]?>]  //JK state code: 9, Female code: 2
				}]
			});
		});
		
		$(function () {
			$('#chart3').highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: 0,
					plotShadow: false
				},
				title: {
					text: 'Age<br>Range',
					align: 'center',
					verticalAlign: 'middle',
					y: 50
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						dataLabels: {
							enabled: true,
							distance: -50,
							style: {
								fontWeight: 'bold',
								color: 'white',
								textShadow: '0px 1px 2px black'
							}
						},
						startAngle: -90,
						endAngle: 90,
						center: ['50%', '75%']
					}
				},
				series: [{
					type: 'pie',
					name: 'Age Range',
					innerSize: '50%',
					data: [
						['0-20', <?php echo ($results3[$scode][$state]['0-20']/($results3[$scode][$state]['0-20']+$results3[$scode][$state]['21-40']+$results3[$scode][$state]['41-60']+$results3[$scode][$state]['60 above']))*100; ?>],
						['21-40', <?php echo ($results3[$scode][$state]['21-40']/($results3[$scode][$state]['0-20']+$results3[$scode][$state]['21-40']+$results3[$scode][$state]['41-60']+$results3[$scode][$state]['60 above']))*100; ?>],
						['41-60', <?php echo ($results3[$scode][$state]['41-60']/($results3[$scode][$state]['0-20']+$results3[$scode][$state]['21-40']+$results3[$scode][$state]['41-60']+$results3[$scode][$state]['60 above']))*100; ?>],
						['Above 60', <?php echo ($results3[$scode][$state]['60 above']/($results3[$scode][$state]['0-20']+$results3[$scode][$state]['21-40']+$results3[$scode][$state]['41-60']+$results3[$scode][$state]['60 above']))*100; ?>]
						
					]
				}]
			});
		});
		
		$(function () {
			$('#chart4').highcharts({
				chart: {
					type: 'column',
					margin: 75,
					options3d: {
						enabled: true,
						alpha: 10,
						beta: 25,
						depth: 70
					}
				},
				title: {
					text: 'Number of Missing People'
				},
				subtitle: {
					text: <?php echo "'".$state.",2015'"; ?>
				},
				plotOptions: {
					column: {
						depth: 25
					}
				},
				xAxis: {
					categories: [<?php echo "'".$city[0]."'"; for($i=1;$i<$n;$i++){ if($count[$i]!=0) echo ",'".$city[$i]."'"; } ?>]
				},
				yAxis: {
					title: {
						text: 'Missing cases'
					}
				},
				series: [{
					name: 'Missing people',
					data: [<?php echo $count[0]; for ($i=1;$i<$n;$i++){ if($count[$i]!=0) echo ",".$count[$i]; } ?>],
					color: 'maroon'
				}]
			});
		});
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
