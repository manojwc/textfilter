<?php

ini_set("memory_limit","1024M");
ini_set('max_execution_time', 600);
/** Error reporting */

error_reporting(E_ALL);
//application\views\excel_templates\
include_once("excel_config.php");


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("DAL");
$objPHPExcel->getProperties()->setLastModifiedBy("DAL");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("");
$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
$objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);



//**********************************************************************************************************************
// SHEET 1 SNAPSHOT
//**********************************************************************************************************************


//**********************************************************************************************************************
// SHEET 2 MODULE WISE COMPLETIONS
//**********************************************************************************************************************
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Module Access');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
//$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);

$objPHPExcel->getActiveSheet()->mergeCells('A1:A3');
$objPHPExcel->getActiveSheet()->mergeCells('B1:B3');
$objPHPExcel->getActiveSheet()->mergeCells('C1:C3');
$objPHPExcel->getActiveSheet()->mergeCells('D1:D3');
$objPHPExcel->getActiveSheet()->mergeCells('E1:E3');
//$objPHPExcel->getActiveSheet()->mergeCells('F1:F3');

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
//$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Global Id');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Course First Accessed');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Course Last Accessed');



$column_num = "F";
$module_start_column = "F";
$topic_column = "F";

$mod_columns = array("First Access", "Last Access", "Pages Visited");

foreach ($module_data as $key => $module) {
	$module_end_column = increment_by($module_start_column, 3);
	$objPHPExcel->getActiveSheet()->mergeCells($module_start_column.'1:'.$module_end_column.'1');
	$objPHPExcel->getActiveSheet()->SetCellValue($module_start_column.'1', $module["title"]);

	$objPHPExcel->getActiveSheet()->mergeCells($module_start_column.'2:'.$module_end_column.'2');
	$objPHPExcel->getActiveSheet()->SetCellValue($module_start_column.'2', "Pages - " .sizeof($module["pages"]));

	$module_start_column = $module_end_column;
	$module_start_column++;

	foreach ($mod_columns as $key => $mod_column_title) {
		$objPHPExcel->getActiveSheet()->SetCellValue($topic_column.'3', $mod_column_title);
		$objPHPExcel->getActiveSheet()->getColumnDimension($topic_column)->setWidth(15);
		$topic_column++;
	}
}

$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($style_green_header);
$objPHPExcel->getActiveSheet()->getStyle('F1:'.$module_start_column.'1')->applyFromArray($style_subheader_1);
$objPHPExcel->getActiveSheet()->getStyle('F2:'.$module_start_column.'2')->applyFromArray($style_subheader_2);
$objPHPExcel->getActiveSheet()->getStyle('F3:'.$topic_column.'3')->applyFromArray($style_subheader_4);


$Line = 4;
foreach ($all_learners as $key => $learner) {
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, $learner["first_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $learner["last_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, $learner["email"]);
	//$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, $learner["global_id"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, $learner["activity_date"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$Line, $learner["last_accessed"]);


	$column_num = "F";

	foreach ($learner["all_mod_stats"] as $key => $mod_stat) {
		$objPHPExcel->getActiveSheet()->SetCellValue($column_num.$Line, $mod_stat["first_visit"]);
		$column_num++;

		$objPHPExcel->getActiveSheet()->SetCellValue($column_num.$Line, $mod_stat["last_visit"]);
		$column_num++;

		$objPHPExcel->getActiveSheet()->SetCellValue($column_num.$Line, $mod_stat["pages_visited"]);
		$column_num++;
    }

    $Line++;
}

$objPHPExcel->getActiveSheet()->getStyle('A1:'.$column_num.''.$Line)->getAlignment()->setWrapText(true);

$objPHPExcel->setActiveSheetIndex(0);

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$file_name = $course_id."_MOOC_Modules_Access - ".date("Y-m-d");

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