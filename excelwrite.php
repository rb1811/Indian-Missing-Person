<?php
//Current Date
$pd = "".date("d-m-Y")."";

//Fetch JSON data
//$mystring = exec('python report.py', $output);
$contents = file_get_contents('person.json');
$contents = utf8_encode($contents);
$results = json_decode($contents, true);
//$mystring = exec('python contactreport.py', $output);
$contents = file_get_contents('contact.json');
$contents = utf8_encode($contents);
$results2 = json_decode($contents, true);

/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("svc")
							 ->setLastModifiedBy("svc")
							 ->setTitle("Daily Report - ".$pd."")
							 ->setSubject("Missing Persons Daily Report")
							 ->setDescription("Automatically generated daily report of Missing Persons, dated: ".$pd."")
							 ->setKeywords("missing persons contact details report ".$pd." ")
							 ->setCategory("Daily Report File");


// Add headings
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Unique ID')
            ->setCellValue('B1', 'Name')
            ->setCellValue('C1', 'Age')
            ->setCellValue('D1', 'Occupation')
            ->setCellValue('E1', 'Gender')
            ->setCellValue('F1', 'Height')
            ->setCellValue('G1', 'Built')
            ->setCellValue('H1', 'Complexion')
            ->setCellValue('I1', 'Dress')
            ->setCellValue('J1', 'Date of Missing')
            ->setCellValue('K1', 'Address')
            ->setCellValue('L1', 'City')
            ->setCellValue('M1', 'State')
            ->setCellValue('N1', 'Contact Person Name')
            ->setCellValue('O1', 'Contact Person Address')
            ->setCellValue('P1', 'Contact Person City')
            ->setCellValue('Q1', 'Contact Person State')
            ->setCellValue('R1', 'Contact Person Phone');

//Set Bold Headings
$objPHPExcel->getActiveSheet()->getStyle('A1:R1')->getFont()->setBold(true);

//Load  Missing Person Data
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
	
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.($i+2), "".$uid."")
				->setCellValue('B'.($i+2), "".$name."")
				->setCellValue('C'.($i+2), "".$age."")
				->setCellValue('D'.($i+2), "".$occupation."")
				->setCellValue('E'.($i+2), "".$gender."")
				->setCellValue('F'.($i+2), "".$height."")
				->setCellValue('G'.($i+2), "".$built."")
				->setCellValue('H'.($i+2), "".$complexion."")
				->setCellValue('I'.($i+2), "".$dress."")
				->setCellValue('J'.($i+2), "".$DoM."")
				->setCellValue('K'.($i+2), "".$address."")
				->setCellValue('L'.($i+2), "".$city."")
				->setCellValue('M'.($i+2), "".$state."");
}

//Load Contact Person Data
	for ($i=0;$i<sizeof($results2);$i++){

	$uid = $results2[$i]["uid"];
	$cName = $results2[$i]["name"];
	$cAddress = $results2[$i]["address"];
	$cCity = $results2[$i]["city"];
	$cState = $results2[$i]["state"];
	$cPhone = $results2[$i]["phone"];
	
	//echo "Contact Person ".($i+1)." Details - <br/>Name:".$cName."<br/> Unique ID:".$uid."<br/><br/>";
	
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('N'.($i+2), $cName)
				->setCellValue('O'.($i+2), $cAddress)
				->setCellValue('P'.($i+2), $cCity)
				->setCellValue('Q'.($i+2), $cState)
				->setCellValue('R'.($i+2), $cPhone);
}

// Set column widths
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(28);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(4);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(19);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(58);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(49);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(19);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(28);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(49);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(19);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);


// Set page orientation and size
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle(date("d-m-Y"));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="'.$pd.'-DailyReport.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
