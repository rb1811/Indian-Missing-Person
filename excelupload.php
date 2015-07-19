<?php

/* Program to copy entire excel sheet contents into a temp database on the server.
 * No validation checks, blind data copy.
* File Format: PMS_PODT for PO Details ; PMS_ITEM for Item details
* Error flags: Y=Yet to be checked,E=Error,P=Processed.
*
* NOTE: EXCEL FILES MUST BE ALREADY EXISTING IN UPLOAD DIRECTORY.
*
* Limitation: Only one set of PMS_PODT and PMS_ITEM should exist in upload directory. Also, no spaces in filename.
*/

ini_set("display_errors",1);
require 'excel_reader2.php';

$personFile = "";
$contactFile = "";

//Check if upload directory is empty
$flag = 0;

if (count(glob("C:/wamp/www/WishYouWereHere/upload/*")) != 0 ) {			//if not empty, match required filenames
	$dir = new DirectoryIterator('C:/wamp/www/WishYouWereHere/upload/');
	foreach ($dir as $fileinfo) {
		$filename = $fileinfo->getFilename();

		if(preg_match('#^(person)#', $filename)) {	//[\s*]+(\.(xls))
			$personFile = $filename;
			echo "Person: ".$personFile."<br>";
			$flag =1;
		}

		else if(preg_match('#^(contact)#', $filename)) {
			$contactFile = $filename;
			echo "Contact: ".$contactFile."<br>";
			$flag =1;
		}
	}	//if necessary files are not found
	if ($flag==0) {echo "ERROR! Required file(s) not found!";}
}
else 	{echo "ERROR! Upload Directory is empty!";}


//if files have been successfully detected, then update database
if (($personFile != "")&&($contactFile != "")) {

	//Missing Person Details JSON File

	$data = new Spreadsheet_Excel_Reader($personFile);

	echo "Total Sheets in ".$personFile." = ".count($data->sheets)."<br /><br />";

	//$html="<table border='1'>";
	for($i=0;$i<count($data->sheets);$i++) // Loop to get all sheets in a file.
	{
		if(count($data->sheets[$i]['cells'])>0) // checking sheet not empty
		{
			$writeJson = file_put_contents('person.json', "[");
			$totalnoofrows = count($data->sheets[$i]['cells']);
			echo "Sheet $i:<br />Total rows in sheet $i = ".count($data->sheets[$i]['cells'])."<br />";
			for($j=2;$j<=count($data->sheets[$i]['cells']);$j++) // loop used to get each row of the sheet
			{
				/*	$html.="<tr>";
					for($k=1;$k<=count($data->sheets[$i]['cells'][$j]);$k++) // This loop is created to get data in a table format.
				{
				$html.="<td>";
				$html.=$data->sheets[$i]['cells'][$j-1][$k];
				$html.="</td>";
				}
				*/
				//Missing Person Details
				$name = $data->sheets[$i]['cells'][$j][1];
				$age = $data->sheets[$i]['cells'][$j][2];
				$occupation =$data->sheets[$i]['cells'][$j][3];	
				$gender = $data->sheets[$i]['cells'][$j][4];	
				$height = $data->sheets[$i]['cells'][$j][5];
				$built = $data->sheets[$i]['cells'][$j][6];
				$complexion = $data->sheets[$i]['cells'][$j][7];
				$dress = $data->sheets[$i]['cells'][$j][8];
				$DoM = $data->sheets[$i]['cells'][$j][9];
				$address = $data->sheets[$i]['cells'][$j][10];
				$city = $data->sheets[$i]['cells'][$j][11];
				$state = $data->sheets[$i]['cells'][$j][12]; 	
				$uid = $data->sheets[$i]['cells'][$j][13]; 
				
				//id is generated uniquely
				$query = array('uid' => $uid, 'name' => $name, 'age' => $age, 'occupation' => $occupation, 'gender' => $gender, 'height' => $height, 'built' => $built, 'complexion' => $complexion, 'dress' => $dress, 'DoM' => $DoM, 'address' => $address, 'city' => $city, 'state' => $state);
				$arr = str_replace(array("\r\n", "\r", "\n"), " ", $query);
				$jsondata = json_encode($arr);
				echo "<br/>".$jsondata;
				$writeJson = file_put_contents('person.json', $jsondata.",", FILE_APPEND);
			}
		}

	}
				$writeJson = file_put_contents('person.json', "]", FILE_APPEND);
	//$html.="</table>";
	//echo $html;
	echo "<br />Missing Person Details updated successfully.<br/>";

	
	//Contact Person Details JSON File

	$data = new Spreadsheet_Excel_Reader($contactFile);

	echo "<br/><br/>Total Sheets in ".$contactFile." = ".count($data->sheets)."<br /><br />";

	//$html="<table border='1'>";
	for($i=0;$i<count($data->sheets);$i++) // Loop to get all sheets in a file.
	{
		if(count($data->sheets[$i]['cells'])>0) // checking sheet not empty
		{
			$writeJson = file_put_contents('contact.json', "[");
			$totalnoofrows = count($data->sheets[$i]['cells']);
			echo "Sheet $i:<br />Total rows in sheet $i =  ".count($data->sheets[$i]['cells'])."<br />";
			for($j=2;$j<=count($data->sheets[$i]['cells']);$j++) // loop used to get each row of the sheet
			{
				/*	$html.="<tr>";
				for($k=1;$k<=count($data->sheets[$i]['cells'][$j]);$k++) // This loop is created to get data in a table format.
				{
				$html.="<td>";
				$html.=$data->sheets[$i]['cells'][$j-1][$k];
				$html.="</td>";
			}
				*/
				//Contact Person Details
				$cname = $data->sheets[$i]['cells'][$j][1];
				$caddress = $data->sheets[$i]['cells'][$j][2];
				$ccity =$data->sheets[$i]['cells'][$j][3];
				$cstate = $data->sheets[$i]['cells'][$j][4];
				$cphone = $data->sheets[$i]['cells'][$j][5];
				$cid =  $data->sheets[$i]['cells'][$j][6];

				//id is generated uniquely
				$arr = array('uid' => $cid, 'name' => $cname, 'address' => $caddress, 'city' => $ccity, 'state' => $cstate, 'phone' => $cphone);
				$query = str_replace(array("\r\n", "\r", "\n"), " ", $arr);
				$jsondata = json_encode($query);
				echo "<br/>".$jsondata;
				$writeJson = file_put_contents('contact.json', $jsondata."," , FILE_APPEND);
					//$html.="</tr>";
			}
		}

	}
				$writeJson = file_put_contents('contact.json', "]", FILE_APPEND);
//$html.="</table>";
//echo $html;
echo "<br />Contact Person Details Updated successfully.";

/*
//Once database has been updated on the server, delete the uploaded Excel files
if ((file_exists("upload/".$itemInputFileName))&&(file_exists("upload/".$poInputFileName))) {
unlink("upload/".$itemInputFileName);
unlink("upload/".$poInputFileName);
	echo "<br/><br/> Files ".$itemInputFileName." and ".$poInputFileName." have successfully been deleted from upload folder.<br>";
}
*/
}	else {echo "<br><br>Database not updated."; }
