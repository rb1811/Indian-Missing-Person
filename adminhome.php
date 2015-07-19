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
	
	<!-- <script>
		function startTime() {
			var today=new Date();
			var dd = today.getDate();
			var mm = today.getMonth();
			var yy = today.getYear();
			var h=today.getHours();
			var m=today.getMinutes();
			var s=today.getSeconds();
			h = checkTime(h);
			m = checkTime(m);
			s = checkTime(s);
			document.getElementById('clock').innerHTML = today;
			var t = setTimeout(function(){startTime()},500);
		}

		function checkTime(i) {
			if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
			return i;
		}
		</script> -->
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
							<li class = "active">
								<a href = ""><i class="fa fa-home fa-2x"></i><span>Home</span><span class="sr-only">(current)</span></a>
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
							<li>
								<a href="adminsearch.php"><i class="fa fa-search fa-2x"></i><span>Search</span></a>
							</li>
							
			  </ul>
			</div>
			
					
			<div id="page-wrapper" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<h1 class="page-header">Admin Home Page</h1>
				<div id="chart2" style=" width: 100%; height: auto; margin: 0 auto float: left;"></div><br/>
				<div id="chart1" style=" width: 100%; height: 600px; margin: 0 auto float: right;"></div><br/>
				<div class = "row">
				<div class = "col-sm-6"><div id="chart3" style=" width: 100%; margin: 0 auto"></div></div>
				<div class = "col-sm-6"><div id="chart4" style=" width: 100%; margin: 0 auto"></div></div>
				</div>
			</div>	
		</div>
		</div>		
		<!-- Placed at end of file for faster loading -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		<!-- Highcharts -->
		<script src="js/highcharts.js"></script>
		<script src="js/exporting.js"></script>
		
		<?php
		//Total region wise	
			$mystring = exec('python statsmpstatecount.py', $output);
			$contents = file_get_contents('statistics.json');
			$contents = utf8_encode($contents);
			$results = json_decode($contents,true);
		//State-wise gender
			$mystring = exec('python statsmpstatessex.py', $output);
			$contents = file_get_contents('statsstatesexoutput.json');
			$contents = utf8_encode($contents);
			$results2 = json_decode($contents,true);
		//Total India Gender-wise
			$mystring = exec('python statisticsindiasex.py', $output);
			$contents = file_get_contents('statsindiasexoutput.json');
			$contents = utf8_encode($contents);
			$results3 = json_decode($contents,true);
		//India Age Range
			$mystring = exec('python statisticsage.py', $output);
			$contents = file_get_contents('statisticsage.json');
			$contents = utf8_encode($contents);
			$results4 = json_decode($contents,true);
			//echo $results4['0-20']; */
		//Date-wise missing cases
			$mystring = exec('python statsindiayear.py', $output);
			$contents = file_get_contents('statsindiayear.json');
			$contents = utf8_encode($contents);
			$results5 = json_decode($contents,true);
			$n = sizeof($results5);
			//echo $results5[0][1]; 
		?>
		
		<script>

		$(function () {
			$('#chart1').highcharts({
				title: {
					text: 'Gender-wise Missing Cases'
				},
				xAxis: {
					categories: ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu and Kashmir',
					'Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Orissa','Punjab','Rajasthan','Sikkim',
					'Tamil Nadu','Telangana','Tripura','Uttar Pradesh','Uttarakhand','West Bengal']
				},
				labels: {
					items: [{
						html: 'Total missing cases',
						style: {
							left: '575px',
							top: '18px',
							color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
						}
					}]
				},
				series: [{
					type: 'column',
					name: 'Male',
					data: [<?php for($i=0;$i<28;$i++) echo $results2[$i][1].","; echo $results2[28][1]; ?>]
				}, {
					type: 'column',
					name: 'Other',
					data: [<?php for($i=0;$i<29;$i++) echo 0 ; ?>]
				}, {
					type: 'column',
					name: 'Female',
					data: [<?php for($i=0;$i<28;$i++) echo $results2[$i][2].","; echo $results2[28][2]; ?>]
				}, {
					type: 'pie',
					name: 'Total missing cases',
					data: [{
						name: 'Male',
						y: <?php echo $results3["Male"] ?>,
						color: Highcharts.getOptions().colors[0] // Male's color
					}, {
						name: 'Other',
						y: <?php echo $results3["other"] ?>,
						color: Highcharts.getOptions().colors[1] // Other's color
					}, {
						name: 'Female',
						y: <?php echo $results3["female"] ?>,
						color: Highcharts.getOptions().colors[2] // Female's color
					}],
					center: [750, 60],
					size: 150,
					showInLegend: false,
					dataLabels: {
						enabled: false
					}
				}]
			});
		});
		
		$(function () {
			$('#chart2').highcharts({
				chart: {
					type: 'scatter',
					zoomType: 'xy'
				},
				title: {
					text: 'Year versus Month of missing cases'
				},
				subtitle: {
					text: 'India, 2015'
				},
				xAxis: {
					title: {
						enabled: true,
						text: 'Month'
					},
					startOnTick: true,
					endOnTick: true,
					showLastLabel: true
				},
				yAxis: {
					title: {
						text: 'Year'
					}
				},
				legend: {
					layout: 'vertical',
					align: 'left',
					verticalAlign: 'top',
					x: 100,
					y: 70,
					floating: true,
					backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
					borderWidth: 1
				},
				plotOptions: {
					scatter: {
						marker: {
							radius: 10,
							states: {
								hover: {
									enabled: true,
									lineColor: 'rgb(100,100,100)'
								}
							}
						},
						states: {
							hover: {
								marker: {
									enabled: false
								}
							}
						},
						tooltip: {
							headerFormat: '<b>{series.name}</b><br>',
							pointFormat: '{point.x}, {point.y}'
						}
					}
				},
				series: [{
					name: 'Missing Persons',
					color: 'rgba(223, 83, 83, .5)',
					data: [<?php for($i=0;$i<$n-1;$i++){ $temp = explode('/', $results5[$i][1]); $year = $temp[2]; $month = $temp[0]; 
							echo "[".$month.",".$year."],"; } $temp = explode('/', $results5[$n-1][1]); $year = $temp[2]; $month = $temp[0]; 
							echo "[".$month.",".$year."]"; ?>  ]

				}]
			});
		}); 

		
		$(function () {

			// Radialize the colors
			Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
				return {
					radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
					stops: [
						[0, color],
						[1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
					]
				};
			});

			// Build the chart
			$('#chart3').highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'Age range of missing people in India, 2015'
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							},
							connectorColor: 'silver'
						}
					}
				},
				series: [{
					type: 'pie',
					name: 'Age Range',
					data: [
						['0-20', <?php echo $results4['0-20']; ?>],
						['21-40', <?php echo $results4['21-40']; ?>],
						['41-60', <?php echo $results4['41-60']; ?>],
						['60 above', <?php echo $results4['60 above']; ?>],
					]
				}]
			});
		});
				
				
		$(function () {
			$('#chart4').highcharts({
				chart: {
					type: 'bar'
				},
				title: {
					text: 'Missing People by State'
				},
				subtitle: {
					text: 'India, 2015'
				},
				xAxis: {
					categories: ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu and Kashmir',
					'Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Orissa','Punjab','Rajasthan','Sikkim',
					'Tamil Nadu','Telangana','Tripura','Uttar Pradesh','Uttarakhand','West Bengal'],
					title: {
						text: null
					}
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Number of Missing Cases',
						align: 'high'
					},
					labels: {
						overflow: 'justify'
					}
				},
				tooltip: {
					valueSuffix: ' millions'
				},
				plotOptions: {
					bar: {
						dataLabels: {
							enabled: true
						}
					}
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'top',
					x: -40,
					y: 100,
					floating: true,
					borderWidth: 1,
					backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
					shadow: true
				},
				credits: {
					enabled: false
				},
				series: [{
					name: 'Missing People',
					data: [<?php echo $results["Andhra Pradesh"]?>,<?php echo $results["Arunachal Pradesh"]?>, <?php echo $results["Assam"]?>, <?php echo $results["Bihar"]?>, <?php echo $results["Chhattisgarh"]?>, 
					<?php echo $results["Goa"]?>, <?php echo $results["Gujarat"]?>, <?php echo $results["Haryana"]?>, <?php echo $results["Himachal Pradesh"]?>, 
					<?php echo $results["Jammu and Kashmir"]?>, <?php echo $results["Jharkhand"]?>, <?php echo $results["Karnataka"]?>, <?php echo $results["Kerala"]?>,
					<?php echo $results["Madhya Pradesh"]?>, <?php echo $results["Maharashtra"]?>, <?php echo $results["Manipur"]?>, <?php echo $results["Meghalaya"]?>,
					<?php echo $results["Mizoram"]?>, <?php echo $results["Nagaland"]?>, <?php echo $results["Orissa"]?>,  <?php echo $results["Punjab"]?>, <?php echo $results["Rajasthan"]?>,
					<?php echo $results["Sikkim"]?>, <?php echo $results["Tamil Nadu"]?>, <?php echo $results["Telangana"]?>, <?php echo $results["Tripura"]?>, <?php echo $results["Uttar Pradesh"]?>,
					<?php echo $results["Uttarakhand"]?>, <?php echo $results["West Bengal"]?>]
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
								
