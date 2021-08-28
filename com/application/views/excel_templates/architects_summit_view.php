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
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);




$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($row_header_style);
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'First Accessed');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Last Accessed');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', $report_type.' Videos Viewed');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', $report_type.' Videos Fully Watched');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', $report_type.' Pages Marked Complete');


$Line = 2;
foreach($all_learners as $learner){
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, $learner["first_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $learner["last_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, $learner["email"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, $learner["activity_date"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$Line, $learner["last_accessed"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$Line, sizeof($learner["viewed_comps"]));
	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$Line, sizeof($learner["completed_comps"]));
	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$Line, sizeof($learner["completed_pages"]));


	$Line++;

}

$objPHPExcel->getActiveSheet()->setTitle('Architects Summit - '.$report_type);


//Set The Active Sheet to 0 - The Client Details Page
$objPHPExcel->setActiveSheetIndex(0);



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$file_name = "MOOC_Arch_Summit_".$report_type."_".date("Y-m-d");

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