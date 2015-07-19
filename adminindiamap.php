<?php 
ob_start(); 
session_start(); 

require_once ("functions.php"); 

if (checkLoggedin()) {
		//Get Contents
		$mystring = exec('python contactreport.py', $output);
		$contents = file_get_contents('contactreportoutput.json');
		$contents = utf8_encode($contents);
		$results = json_decode($contents, true);

		for ($i=0;$i<sizeof($results);$i++){

		$uid[$i] = $results[$i]["uid"];
		$name[$i] = $results[$i]["name"];
		//$age[$i] = $results[$i]["age"];
		//$gender[$i] = $results[$i]["gender"];
		//$DoM[$i] = $results[$i]["DoM"];
		$city[$i] = $results[$i]["city"];
		$state[$i] = $results[$i]["state"];
			
		//cUrl
		$address = urlencode("".$city[$i].",".$state[$i].",India");
		$url = "https://maps.googleapis.com/maps/api/geocode/json?address==$address&sensor=false&region=India&key=AIzaSyCUAV1KucbshAZwtVG021ypvHMYfxQoxGA";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response);
		$lat[] = $response_a->results[0]->geometry->location->lat;
		$long[] = $response_a->results[0]->geometry->location->lng;
		}
		$n = sizeof($city);

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
		area {
				display: inline-block;
				margin: auto;
				position: relative;
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
								<a href = "adminhome.php"><i class="fa fa-home fa-2x"></i><span>Home</span><span class="sr-only">(current)</span></a>
							</li>
							<li  class = "active">
								<a href=""><i class="fa fa-map-marker fa-2x"></i><span>View Map</span></a>
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
				<img src="india.jpg" id = "india" alt="India-Map" usemap="#indiamap">
				<map name="indiamap" class = "India">
					<area shape="poly" id="jk" coords="184,31,199,16,224,8,258,5,274,15,289,29,304,44,319,53,346,45,366,42,386,50,389,65,377,83,371,90,357,100,353,110,358,121,364,127,367,140,360,146,355,150,294,112,282,116,272,121,269,130,267,141,256,150,242,144,225,131,211,124" href="#jk" alt = "34.1490875,76.8259652" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="himachalpradesh" coords="261,150,268,142,275,129,286,118,304,119,314,124,328,128,334,133,339,140,341,149,339,157,344,165,347,173,337,177,327,181,320,191,315,201" href="#himachalpradesh" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="punjab" coords="217,207,230,194,232,173,253,157,269,150,277,167,290,173,293,191,293,204,281,208,274,222,260,223" href="#punjab" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="uttarakhand" coords="335,227,327,228,322,219,324,211,320,200,327,181,340,180,349,187,359,188,364,196,374,199,383,208,395,212,405,225,395,236,393,244,389,257,374,257" href="#uttarakhand" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="haryana" coords="253,229,268,224,277,221,280,211,288,211,297,202,306,199,317,207,309,218,301,234,302,256,310,273,311,280,295,279,270,275,258,255,237,238,232,223,234,215" href="#haryana" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="raj1" coords="245,376,232,385,230,397,230,420,199,421,190,401,182,391,160,382,132,376,113,366,96,347,96,327,84,307,100,291,129,290,154,280,173,264,186,254,193,232,206,223,228,215,240,239,257,252,267,272,275,287,297,280,308,291,311,303,312,318,328,327" href="#rajasthan" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="raj2" coords="247,379,259,385,269,402,283,402,293,394,297,378,290,367,285,363" href="#rajasthan" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="uttarpradesh" coords="313,304,312,277,303,248,313,213,337,227,351,244,370,256,388,270,404,282,427,299,454,307,488,315,510,325,501,330,499,356,490,367,484,380,483,394,354,349,366,369,382,367" href="#uttarpradesh" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="gujarat" coords="138,380,163,385,185,400,193,419,205,429,217,446,207,454,202,477,196,496,184,511,167,498,148,490,127,509,94,508,68,484,57,465,45,418,56,399" href="#gujarat" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="madhya" coords="217,449,224,432,233,413,253,410,285,403,304,376,335,360,333,386,346,401,354,400,369,373,394,374,408,380,445,384,464,402,454,417,442,433,434,447,419,463,409,476,400,493,302,482,278,495,243,490,211,468" href="#madhyapradesh" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="bihar" coords="518,354,509,349,501,334,510,326,533,331,546,336,559,338,577,342,591,344,609,342,610,350,608,362,599,367,587,377,576,388,556,389,547,392,523,398,511,397,499,395,485,389,483,372" href="#bihar" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="jharkhand" coords="503,434,493,420,484,405,505,395,530,399,549,391,560,389,572,395,584,390,592,374,607,370,614,380,609,394,595,408,565,423,563,439,581,450,581,462,554,468,518,460" href="#jharkhand" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="cg" coords="457,509,439,533,446,559,442,577,431,591,411,595,401,585,401,562,398,539,400,523,402,496,411,477,424,460,441,442,452,421,469,413,484,413,496,420,504,433,510,444" href="#cg" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="maharashtra" coords="199,508,212,489,247,491,272,503,304,491,334,493,377,490,398,501,398,516,397,529,328,533,319,548,310,564,301,582,282,599,270,615,247,615,215,634,202,641,199,667,174,662,166,602,160,538" href="#maharashtra" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="goa" coords="178,672,193,672,200,679,198,687,196,694,190,695" href="#goa" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="tamilnadu" coords="313,777,328,777,340,770,350,762,371,761,380,756,376,780,383,782,387,771,384,764,382,756,375,790,362,807,367,816,371,837,366,848,371,853,356,855,342,871,342,881,334,892,348,869,320,903,304,923,295,929,286,920,291,864,291,842,287,848,285,849,279,847,281,836,278,829,274,822,265,809,292,792,292,796,289,800,281,800,294,794,317,769" href="#tamilnadu" alt = "Tamilnadu, India" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="karnataka" coords="189,699,203,694,207,688,202,677,202,675,214,660,210,655,205,648,208,643,215,648,220,643,230,642,245,635,252,618,261,625,268,620,282,615,293,606,292,602,301,598,297,620,293,647,288,657,295,658,290,670,289,684,287,697,281,702,278,709,280,714,286,726,298,738,304,738,317,738,325,748,327,761,332,757,321,767,306,768,301,779,300,785,300,791,302,796,295,800,283,800,270,802,258,796,249,789,244,789,228,773,213,765" href="#karnataka" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="kerala" coords="216,771,228,781,233,788,249,799,258,803,257,812,265,823,275,834,277,849,279,856,286,856,288,866,283,875,291,886,290,880,284,892,287,900,285,914,275,917" href="#kerala" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="andhra" coords="325,771,337,766,337,759,348,761,354,756,361,750,370,755,377,748,384,742,380,731,385,725,381,711,382,695,387,686,394,680,404,676,410,680,416,672,418,663,427,662,433,664,444,659,450,654,450,647,455,639,468,631,480,623,493,607,511,594,526,577,526,570,520,570,505,578,495,577,492,570,478,581,463,595,456,595,457,592,445,607,443,604,433,617,421,627,412,629,402,635,397,635,397,642,392,643,384,637,374,648,359,650,346,662,340,668,329,670,324,666,315,670,306,674,298,674,292,673,292,681,295,695,288,703,282,700,283,712,290,726,313,746,310,739,319,751,332,751,310,732,331,753,315,727,325,759,327,756,313,739,317,744" href="#andhra" rel="popover" data-toggle="modal" data-target="#GSCCModal"> 
					<area shape="poly" id="telangana" coords="298,667,316,670,330,663,338,664,351,657,352,646,373,643,378,644,382,635,394,638,398,639,395,631,407,631,421,624,431,615,433,611,415,612,414,601,404,597,403,588,397,583,385,577,381,571,379,567,383,558,376,549,367,549,361,546,356,547,349,548,347,542,341,539,335,538,330,538,323,553,315,553,309,578,302,581,294,653" href="#telangana" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="westbengal1" coords="582,416,598,413,608,402,623,403,633,411,630,419,634,432,637,442,641,450,643,467,643,472,624,473,618,479,605,477,593,467,584,449,576,439,566,435,560,428" href="#westbengal" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="westbengal2" coords="628,337,618,330,612,317,614,306,632,306,634,320,643,326,651,329,661,331,659,338,656,345,650,347" href="#westbengal" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="sikkim" coords="614,301,621,304,626,304,628,302,631,297,631,289,626,287,620,285,616,288,612,288,610,294,610,300" href="#sikkim" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="meghalaya" coords="664,352,669,354,673,351,672,345,685,341,692,341,699,342,701,343,708,345,714,345,721,340,732,336,734,336,734,343,752,346,753,357,745,363,730,371,724,374,705,374,688,373,674,371,667,369,663,367,671,373,678,374,666,367" href="#meghalaya" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="assam1" coords="670,348,671,332,669,324,662,328,658,343,662,350,670,353" href="#assam" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="assam2" coords="673,343,678,323,693,325,705,325,720,323,726,322,731,309,748,307,764,305,781,302,789,288,794,281,817,273,821,268,831,266,835,272,836,276,832,283,815,295,802,305,789,315,784,328,776,332" href="#assam" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="assam3" coords="736,332,767,332,790,321,787,326,757,341,739,344,752,348,772,344,772,339,775,338,736,335,738,337,740,341,731,344,746,339,749,338,760,338,753,339,747,341,750,333,744,333" href="#assam" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="assam4" coords="751,346,771,342,768,357,743,366,737,376,745,387,757,379,765,371,768,363" href="#assam" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="arunachal1" coords="727,306,719,301,714,295,728,292,742,285,757,265,771,257,779,249,791,239,790,237,799,240,814,236,821,231,831,224,836,233,836,239,839,242,842,241,845,246,839,250,827,254,814,266,804,271,797,276,786,285,779,295,763,301" href="#arunachalpradesh" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="arunachal2" coords="816,268,819,258,832,253,838,252,841,256,834,263,848,258,858,257,861,256" href="#arunachalpradesh" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="arunachal3" coords="835,266,854,259,867,258,868,264,868,274,862,280,836,280,863,295,840,281" href="#arunachalpradesh" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="arunachal4" coords="837,282,858,280,867,294,847,294,827,302,824,310,818,301,815,297,818,290,829,284" href="#arunachalpradesh" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="nagaland" coords="818,296,808,305,798,315,792,321,787,330,776,340,772,345,774,352,789,341,804,340,811,344,817,337,824,314" href="#nagaland" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="manipur" coords="772,354,780,349,787,345,804,343,807,348,804,360,806,369,801,396,794,403,770,393,765,384,764,371,771,359" href="#manipur" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="mizoram" coords="743,393,749,388,762,381,767,391,777,393,783,397,792,403,782,407,770,404,771,412,771,428,769,442,767,449,771,460,764,471,755,467,749,466,742,444,739,431,739,419" href="#mizoram" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="tripura" coords="740,390,734,395,721,402,710,407,708,420,708,431,716,441,720,444,727,444,733,426,740,410,746,406" href="#tripura" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					<area shape="poly" id="orissa" coords="574,541,560,550,536,564,521,567,494,568,475,580,463,591,446,603,426,606,439,583,451,568,448,555,462,541,458,530,457,521,452,514,461,502,475,499,484,495,484,487,493,472,497,464,507,461,523,461,542,474,549,470,562,471,570,464,568,462,582,466,589,474,598,478" href="#orissa" rel="popover" data-toggle="modal" data-target="#GSCCModal">
					
				</map>
			</div>
		</div>
	</div>	

	<div id="GSCCModal" class="modal fade" tabindex="-1"role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	 <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
			<h4 class="modal-title" id="myModalLabel">State Map</h4>
		  </div>
		  <div class="modal-body">
		   <div id="googleMap" style="width:500px;height:380px;"></div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<a href = "adminstatistics.php"><button type="button" class="btn btn-primary">View Full Statistics</button></a>
		  </div>
		</div>
	  </div>
	</div>

	<!-- Placed at end of file for faster loading -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<!-- Google Maps API -->
	<script src="js/gmapsapi.js"></script>
	<script src="js/rwdImageMaps.js"></script>
	<script>
	/* $(document).ready(function(e) {
		$('img[usemap]').rwdImageMaps();
	}); */
	
		function initialize(lat,lon)
		{
		//City-wise Missing Person Details
	var cities = [<?php for($i=0;$i<$n-1;$i++) { echo "['".$city[$i]."',".$lat[$i].",".$long[$i]."],"; } echo "['".$city[$n-1]."',".$lat[$n-1].",".$long[$n-1]."]"; ?>];
	var details = [<?php for($i=0;$i<$n-1;$i++) { echo "[".$uid[$i].",'".$name[$i]."'],"; } echo "[".$uid[$n-1].",'".$name[$n-1]."']"; ?>];

		var myLatLng = new google.maps.LatLng(lat,lon);
		var mapOpt = {
		  center: myLatLng,
		  zoom:6,
		  mapTypeId:google.maps.MapTypeId.ROADMAP
		  };
		var map=new google.maps.Map(document.getElementById("googleMap"),mapOpt);
		var infowindow = new google.maps.InfoWindow({
				maxwidth: 50
		  });
		  var marker,i;
				for (i = 0; i < cities.length; i++) {
				//Create new marker for each city
				  marker = new google.maps.Marker({
					position: new google.maps.LatLng(cities[i][1], cities[i][2]),
					map: map
				  });
				//onclick event of marker
					  google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {
						  infowindow.setContent('<div><b>Unique ID: </b>'+details[i][0]+'</br><b>Name: </b>'+details[i][1]+'</br><b>City: </b>'+cities[i][0]+'</div>');
						  infowindow.open(map, marker);
						  //Toggle Bounce
							if (marker.getAnimation() != null) {
								marker.setAnimation(null);
							  } else {
								marker.setAnimation(google.maps.Animation.BOUNCE);
							  }
						}
					  })(marker, i));  
				  }

		$('#GSCCModal').on('shown.bs.modal',
			  function(){
				google.maps.event.trigger(map,'resize');
				map.setCenter(myLatLng);
			 });
		}
		//Initialise the state map
		$('#andhra').click( function(){ google.maps.event.addDomListener(document.getElementById('andhra'), 'click', initialize(15.9128998,79.7399875)); });
		$('#arunachal1').click( function(){ google.maps.event.addDomListener(document.getElementById('arunachal1'), 'click', initialize(28.2179994,94.7277528)); });
		$('#arunachal2').click( function(){ google.maps.event.addDomListener(document.getElementById('arunachal2'), 'click', initialize(28.2179994,94.7277528)); });
		$('#arunachal3').click( function(){ google.maps.event.addDomListener(document.getElementById('arunachal3'), 'click', initialize(28.2179994,94.7277528)); });
		$('#arunachal4').click( function(){ google.maps.event.addDomListener(document.getElementById('arunachal4'), 'click', initialize(28.2179994,94.7277528)); });
		$('#assam1').click( function(){ google.maps.event.addDomListener(document.getElementById('assam1'), 'click', initialize(26.2006043,92.9375739)); });
		$('#assam2').click( function(){ google.maps.event.addDomListener(document.getElementById('assam2'), 'click', initialize(26.2006043,92.9375739)); });
		$('#assam3').click( function(){ google.maps.event.addDomListener(document.getElementById('assam3'), 'click', initialize(26.2006043,92.9375739)); });
		$('#assam4').click( function(){ google.maps.event.addDomListener(document.getElementById('assam4'), 'click', initialize(26.2006043,92.9375739)); });
		$('#bihar').click( function(){ google.maps.event.addDomListener(document.getElementById('bihar'), 'click', initialize(25.0960742,85.31311939999999)); });
		$('#cg').click( function(){ google.maps.event.addDomListener(document.getElementById('cg'), 'click', initialize(21.2786567, 81.86614419999999)); });
		$('#goa').click( function(){ google.maps.event.addDomListener(document.getElementById('goa'), 'click', initialize(15.2993265,74.12399599999999)); });
		$('#gujarat').click( function(){ google.maps.event.addDomListener(document.getElementById('gujarat'), 'click', initialize(22.258652, 71.1923805)); });
		$('#haryana').click( function(){ google.maps.event.addDomListener(document.getElementById('haryana'), 'click', initialize(29.0587757, 76.085601)); });
		$('#himachalpradesh').click( function(){ google.maps.event.addDomListener(document.getElementById('himachalpradesh'), 'click', initialize(31.1048294, 77.17339009999999)); });
		$('#jk').click( function(){ google.maps.event.addDomListener(document.getElementById('jk'), 'click', initialize(34.1490875,76.8259652)); });
		$('#jharkhand').click( function(){ google.maps.event.addDomListener(document.getElementById('jharkhand'), 'click', initialize(23.6101808, 85.2799354)); });
		$('#karnataka').click( function(){ google.maps.event.addDomListener(document.getElementById('karnataka'), 'click', initialize(15.3172775, 75.7138884)); });
		$('#kerala').click( function(){ google.maps.event.addDomListener(document.getElementById('kerala'), 'click', initialize(10.8505159, 76.2710833)); });
		$('#madhya').click( function(){ google.maps.event.addDomListener(document.getElementById('madhya'), 'click', initialize(22.9734229, 78.6568942)); });
		$('#maharashtra').click( function(){ google.maps.event.addDomListener(document.getElementById('maharashtra'), 'click', initialize(19.7514798, 75.7138884)); });
		$('#manipur').click( function(){ google.maps.event.addDomListener(document.getElementById('manipur'), 'click', initialize(24.6637173, 93.90626879999999)); });
		$('#meghalaya').click( function(){ google.maps.event.addDomListener(document.getElementById('meghalaya'), 'click', initialize(25.4670308, 91.36621599999999)); });
		$('#mizoram').click( function(){ google.maps.event.addDomListener(document.getElementById('mizoram'), 'click', initialize(23.164543, 92.9375739)); });
		$('#nagaland').click( function(){ google.maps.event.addDomListener(document.getElementById('nagaland'), 'click', initialize(26.1584354, 94.5624426)); });
		$('#orissa').click( function(){ google.maps.event.addEventListener(document.getElementById('orissa'), 'click', initialize(20.9516658, 85.09852359999999)); });
		$('#punjab').click( function(){ google.maps.event.addEventListener(document.getElementById('punjab'), 'click', initialize(31.1471305, 75.34121789999999)); });
		$('#raj1').click( function(){ google.maps.event.addEventListener(document.getElementById('raj1'), 'click', initialize(27.0238036, 74.21793260000001)); });
		$('#raj2').click( function(){ google.maps.event.addEventListener(document.getElementById('raj2'), 'click', initialize(27.0238036, 74.21793260000001)); });
		$('#sikkim').click( function(){ google.maps.event.addEventListener(document.getElementById('sikkim'), 'click', initialize(27.5329718, 88.5122178)); });
		$('#tamilnadu').click( function(){ google.maps.event.addEventListener(document.getElementById('tamilnadu'), 'click', initialize(11.1271225, 78.6568942)); });
		$('#telangana').click( function(){ google.maps.event.addEventListener(document.getElementById('telangana'), 'click', initialize(18.1124372, 79.01929969999999)); });
		$('#tripura').click( function(){ google.maps.event.addEventListener(document.getElementById('tripura'), 'click', initialize(23.9408482, 91.9881527)); });
		$('#uttarpradesh').click( function(){ google.maps.event.addEventListener(document.getElementById('uttarpradesh'), 'click', initialize(27.5705886, 80.0981869)); });
		$('#uttarakhand').click( function(){ google.maps.event.addEventListener(document.getElementById('uttarakhand'), 'click', initialize(30.066753, 79.01929969999999)); });
		$('#westbengal1').click( function(){ google.maps.event.addEventListener(document.getElementById('westbengal1'), 'click', initialize(22.9867569, 87.85497549999999)); });
		$('#westbengal2').click( function(){ google.maps.event.addEventListener(document.getElementById('westbengal2'), 'click', initialize(22.9867569, 87.85497549999999)); });

		//Popovers
		$('#andhra').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Amravathi", title:"Andhra Pradesh"});
		$('#arunachal1').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Itanagar", title:"Arunachal Pradesh"});
		$('#arunachal2').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Itanagar", title:"Arunachal Pradesh"});
		$('#arunachal3').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Itanagar", title:"Arunachal Pradesh"});
		$('#arunachal4').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Itanagar", title:"Arunachal Pradesh"});
		$('#assam1').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Dispur", title:"Assam"});
		$('#assam2').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Dispur", title:"Assam"});
		$('#assam3').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Dispur", title:"Assam"});
		$('#assam4').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Dispur", title:"Assam"});
		$('#bihar').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Patna", title:"Bihar"});
		$('#cg').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Raipur", title:"Chhattisgarh"});
		$('#goa').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Panaji", title:"Goa"});
		$('#gujarat').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Gandhinagar", title:"Gujarat"});
		$('#haryana').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Chandigarh", title:"Haryana"});
		$('#himachalpradesh').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Shimla", title:"Himachal Pradesh"});
		$('#jk').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Srinagar", title:"Jammu and Kashmir"});
		$('#jharkhand').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Ranchi", title:"Jharkhand"});
		$('#karnataka').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Bengaluru", title:"Karnataka"});
		$('#kerala').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Thiruvananthapuram", title:"Kerala"});
		$('#madhya').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Bhopal", title:"Madhya Pradesh"});
		$('#maharashtra').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Mumbai", title:"Maharashtra"});
		$('#manipur').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Imphal", title:"Manipur"});
		$('#meghalaya').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Shillong", title:"Meghalaya"});
		$('#mizoram').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Aizawal", title:"Mizoram"});
		$('#nagaland').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Kohima", title:"Nagaland"});
		$('#orissa').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Bhubaneshwar", title:"Orissa"});
		$('#punjab').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Chandigarh", title:"Punjab"});
		$('#raj1').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Jaipur", title:"Rajasthan"});
		$('#raj2').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Jaipur", title:"Rajasthan"});
		$('#sikkim').popover({trigger:"hover", placement: "right", position: "relative", content:"Capital: Gangtok", title:"Sikkim"});
		$('#tamilnadu').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Chennai", title:"Tamilnadu"});
		$('#telangana').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Hyderabad", title:"Telangana"});
		$('#tripura').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Agartala", title:"Tripura"});
		$('#uttarpradesh').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Lucknow", title:"Uttar Pradesh"});
		$('#uttarakhand').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Dehradun", title:"Uttarakhand"});
		$('#westbengal1').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Kolkata", title:"West Bengal"});
		$('#westbengal2').popover({trigger: "hover", placement: "right", position: "relative", content:"Capital: Kolkata", title:"West Bengal"});
	

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
