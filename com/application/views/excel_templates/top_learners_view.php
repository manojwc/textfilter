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
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);




$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($row_header_style);
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Overall Score');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Assets Viewed');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Videos Fully Watched');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Pages Visited');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Pages Marked Complete');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Page Completion %');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Reactions Given');
if($course_props["has_pre_assessment"] || $course_props["has_post_assessment"]){
	$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Pre-assessment');
	$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Post-assessment');
	$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Passed');
}



$Line = 2;
foreach($top_learners as $learner){
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, $learner["first_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $learner["last_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, $learner["email"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, $learner["learner_score"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$Line, $learner["comps_viewed"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$Line, $learner["comps_completed"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$Line, $learner["pages_visited"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$Line, $learner["pages_completed"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('I'.$Line, round((($learner["pages_completed"]/$course_props["total_pages"])*100) , 2));
	$objPHPExcel->getActiveSheet()->SetCellValue('J'.$Line, $learner["reactions_given"]);
	if($course_props["has_pre_assessment"] || $course_props["has_post_assessment"]){
		$pre_assess_score = $learner["pre_assess_score"];
		$post_assess_score = $learner["post_assess_score"];

		if($course_props["pre_assess"]["is_scored"]){
			$pre_assess_passed = (($learner["pre_assess_score"] >= $course_props["pre_assess"]["required_score"]) && ($learner["pre_assess_score"] != "NA")) ? true : false;
			$post_assess_passed = (($learner["post_assess_score"] >= $course_props["post_assess"]["required_score"]) && ($learner["post_assess_score"] != "NA")) ? true : false;
			$passed = ($pre_assess_passed || $post_assess_passed) ? "YES" : "NO" ;
		}else{
			$passed = "NA";
			$pre_assess_score = ($pre_assess_score == '0') ? "Attempted" : "NA";
		}

		$objPHPExcel->getActiveSheet()->SetCellValue('K'.$Line, $pre_assess_score);
		$objPHPExcel->getActiveSheet()->SetCellValue('L'.$Line, $learner["post_assess_score"]);
		$objPHPExcel->getActiveSheet()->SetCellValue('M'.$Line, $passed);
	}



	$Line++;

}

$objPHPExcel->getActiveSheet()->setTitle('MOOC Top Learners - '. substr($course_details["title"], 0, 10));


//Set The Active Sheet to 0 - The Client Details Page
$objPHPExcel->setActiveSheetIndex(0);



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$file_name = "MOOC_Learner_Report_".$course_details["hash"]."_".date("Y-m-d");

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