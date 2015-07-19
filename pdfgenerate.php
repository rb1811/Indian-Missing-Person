<?php
ini_set("memory_limit","128M");	
require('html2fpdf.php'); //fpdf.php, html2fpdf.php, gif.php, htmltoolkit.php, font(helvetica)
error_reporting(E_ERROR | E_PARSE); 

if (function_exists('date_default_timezone_set')) { 
	date_default_timezone_set('Asia/Mumbai'); 
}

if($_REQUEST['uid']){
	$uid = $_REQUEST['uid'];

	//Fetch JSON data
	$contents = file_get_contents('person.json');
	$contents = utf8_encode($contents);
	$results = json_decode($contents, true);
				
	//Generate PDF
	$pdf=new HTML2FPDF();		//Create blank PDF
	$pdf->AddPage();		//Add first page in PDF
			
	for ($i=0;$i<sizeof($results);$i++){
		if($results[$i]["uid"]==$uid){
			//Missing Person Details
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
			$status = "Missing";
			$curdate = "".date("Y-m-d") ."";		//Current Date
			$date_diff = abs(strtotime($curdate) - strtotime($DoM));
			$noofdays = floor($date_diff/(60*60*24));
			$lastaddress = "Hebbal, Bangalore, Karnataka";
			
			//Title
			$pdf->SetFont ("Times","B",20);			
			$pdf->Cell(190,17.5,"Missing Person Details",1,1, 'C');
			//$pdf->Cell(200,10,$curdate,20,1);
			//$pdf->Ln();
			
						
			//Missing Person Photo
			$upload = "images/".$uid.".jpg";
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			$pdf->SetXY($x, $y);
			$pdf->Image ($upload,$x+1,$y+1,48,48,'jpg');
			$x=$pdf->GetX();
			$y=$pdf->GetY()-49;
			$pdf->SetXY($x,$y);
			$pdf->Cell (50,50,"  ",1,0);
	
			//Missing Person Details
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(40,5,"Unique ID: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$uid,1,1,'C');
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			$pdf->SetXY($x+50, $y);
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(40,5,"Name: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$name,1,1,'C');
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			$pdf->SetXY($x+50, $y);
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(40,5,"Age: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$age,1,1,'C');
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			$pdf->SetXY($x+50, $y);
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(40,5,"Gender: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$gender,1,1,'C');
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			$pdf->SetXY($x+50, $y);
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(40,5,"Occupation: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$occupation,1,1,'C');
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			$pdf->SetXY($x+50, $y);
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(40,5,"Height: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$height,1,1,'C');
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			$pdf->SetXY($x+50, $y);
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(40,5,"Built: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$built,1,1,'C');
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			$pdf->SetXY($x+50, $y);
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(40,5,"Complexion: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$complexion,1,1,'C');
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			$pdf->SetXY($x+50, $y);
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(40,5,"Dress: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$dress,1,1,'C');
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			$pdf->SetXY($x+50, $y);
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(40,5,"Missing Since: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$DoM,1,1,'C');
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(90,10,"Address: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,10,$address,1,1,'C');			
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(90,5,"City: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$city,1,1,'C');
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(90,5,"State: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$state,1,1,'C');
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(45,5,"Status: ",1,0,'L');
			$pdf->SetFont ("Helvetica","B",8);
			$pdf->Cell(45,5,$status,1,0,'C');
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(50,5,"Days Elapsed:",1,0,'L');
			$pdf->SetFont ("Helvetica","B",8);
			$pdf->Cell(50,5,$noofdays,1,1,'C');
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(45,5,"Last spotted at location:",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(145,5,$lastaddress,1,1,'C');

			//Address and Google Maps
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			$image = "https://maps.googleapis.com/maps/api/staticmap?center=Hebbal,Bangalore,India&zoom=14&size=600x300&scale=2&markers=color:red%7Clabel:S%7CHebbal+Bangalore+India&format=jpg";
			$pdf->Image($image,$x+2.5,$y+2.5,150,75,'JPG');
			$x=$pdf->GetX();
			$y=$pdf->GetY()-77.5;
			$pdf->SetXY($x,$y);
			$pdf->Cell (190,80,"  ",1,0,'C');	
			$pdf->Ln();
		}
	}
	
				
	//Fetch Contact JSON
	$contents = file_get_contents('contact.json');
	$contents = utf8_encode($contents);
	$results = json_decode($contents, true);
	//Contact Person Details
	for ($i=0;$i<sizeof($results);$i++){
		if($results[$i]["uid"]==$uid){			
			$uid = $results[$i]["uid"];
			$cName = $results[$i]["name"];
			$cAddress = $results[$i]["address"];
			$cCity = $results[$i]["city"];
			$cState = $results[$i]["state"];
			$cPhone = $results[$i]["phone"];
			
			//Title
			$pdf->SetFont ("Times","B",14);
			$pdf->Ln(4);			
			$pdf->Cell(190,15,"Contact Person Details",1,1, 'L');
			
			//Contact Person Details
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(90,5,"Contact Person Name: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$cName,1,1,'C');
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(90,5,"Contact Person Phone: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$cPhone,1,1,'C');
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(90,10,"Contact Person Address: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,10,$cAddress,1,1,'C');			
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(90,5,"City: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$cCity,1,1,'C');
			$pdf->SetFont ("Arial","B",8);
			$pdf->Cell(90,5,"State: ",1,0,'L');
			$pdf->SetFont ("Helvetica","",8);
			$pdf->Cell(100,5,$cState,1,1,'C');
		}
	}
	$curdate = "".date("Y-m-d h:i:s") ."";
	$pdf->Ln(10);
	$pdf->Cell(190,5,$curdate,0,1,'R');	
	$pdf->Output($uid.".pdf", 'D');	 //Save file
	
/* Redirect output to a client’s web browser
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="'.$uid.'".pdf"');
readfile($uid.'.pdf'); */

}

else
	echo "<h1>Invalid access.</h1>\n";
