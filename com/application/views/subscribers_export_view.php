<?php

ini_set("memory_limit","1024M");
ini_set('max_execution_time', 600); 
/** Error reporting */

error_reporting(E_ALL);

/** Include path **/
ini_set('include_path', ini_get('include_path').';assets/plugins/PHPExcel_1.8.0_doc/Classes');

/** PHPExcel */
include 'PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'PHPExcel/Writer/Excel2007.php';


//Styles

$green_bg_center = array( 
				'font' => array( 'bold' => true, 'size' => 18,), 
				'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, ), 				
				'borders' => array( 
						'outline' => array( 'style' => PHPExcel_Style_Border::BORDER_THICK, 'color' => array('argb' => '00000000'), ), 
						), 
				'fill' => array( 
					'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR, 
					'rotation' => 90, 
					'startcolor' => array( 'argb' => '92D050', ), 
					'endcolor' => array( 'argb' => '92D050', ), 
				),
			);

$row_header_style = array( 
				'font' => array( 'bold' => true, ), 
				'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, ), 				
				'borders' => array( 
						'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), ), 
						), 
				'fill' => array( 
					'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR, 
					'rotation' => 90, 
					'startcolor' => array( 'argb' => '92D050', ), 
					'endcolor' => array( 'argb' => '92D050', ), 
				),
			);


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("DAL");
$objPHPExcel->getProperties()->setLastModifiedBy("DAL");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("");
$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri'); 
$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
$objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);



//*******************************************************************************************************************************
// SHEET 1 Learners List
//*******************************************************************************************************************************

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);




$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($row_header_style);
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Subscribed Time (CET Hrs)');



$Line = 2;
foreach($all_subscribers as $subscriber){
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, $subscriber["first_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $subscriber["last_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, $subscriber["email"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, $subscriber["sub_date"]);
		

	$Line++;

}

$objPHPExcel->getActiveSheet()->setTitle('Subscribers - '. substr($course_details["title"], 0, 15));


//Set The Active Sheet to 0 - The Client Details Page
$objPHPExcel->setActiveSheetIndex(0);



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$file_name = "MOOC_Subscribers_".substr($course_details["title"], 0, 15)."_".date("Y-m-d G:i:s");

if($save_to_file){
	// ** TO SAVE the file to a predefined location **/
	$objWriter->save(REPORTS_FOLDER."/".$file_name.'.xlsx');
}else{
	// We'll be outputting an excel file. To provide download option to users
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	// Provide the filename
	header('Content-Disposition: attachment; filename="'.$file_name.'.xlsx"');

	$objWriter->save('php://output');
}


exit();