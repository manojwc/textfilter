<?php

ini_set("memory_limit","1024M");
ini_set('max_execution_time', 600);
/** Error reporting */

error_reporting(E_ALL);

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
$objPHPExcel->getDefaultStyle()->getFont()->setSize(11);
$objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);


//**********************************************************************************************************************
// SHEET 1 Poor Ratings
//**********************************************************************************************************************
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('UGTM Poor Ratings');

//$objPHPExcel->getActiveSheet()->mergeCells('A1:A3');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);


$Line = 1;
foreach($all_modules as $main_key => $module){
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, $module["module_title"]);
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$Line.':C'.$Line);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$Line.':C'.$Line)->applyFromArray($section_title_row);
	$Line++;

	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, "Number of Feedbacks (poor/very poor)");
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, sizeof($module["poor_raters"]));
	$objPHPExcel->getActiveSheet()->getStyle('A'.$Line.':C'.$Line)->applyFromArray($style_h2_default);	
	$Line++;

	//if($key < 3){
	if(sizeof($module["poor_raters"]) > 0 ){
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, "How would you rate this module's learning experience?");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, "What did you like most about this module?");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, "What suggestions do you have to improve the learning experience?");
		$objPHPExcel->getActiveSheet()->getStyle('A'.$Line.':C'.$Line)->applyFromArray($grey_table_header);
		$Line++;

		foreach ($module["poor_raters"] as $learner_key => $rater) {
			$col_char = "A";
			foreach ($rater as $key => $question) {

				if($question["question_id"] == 4){
					$response_text = ($question["response"] == 9) ? "Poor" : "Very Poor";
					$objPHPExcel->getActiveSheet()->SetCellValue($col_char.''.$Line, $response_text);
				}else{
					$objPHPExcel->getActiveSheet()->SetCellValue($col_char.''.$Line, $question["response"]);	
				}
				
				$col_char++;

				if( ($key == sizeof($rater) - 1) && $show_emails){
					$objPHPExcel->getActiveSheet()->SetCellValue($col_char.''.$Line, $question["email"]);	
				}
			}
			$Line++;
		}

	} // End of IF condition for low raters size
	
	$Line = $Line + 2;

} ///


$objPHPExcel->getActiveSheet()->getStyle('A1:C'.$Line)->applyFromArray($bordered_cells);



//Set The Active Sheet to 0 - TheFeedback Stats Tab
$objPHPExcel->setActiveSheetIndex(0);



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$file_name = date("Y-m-d")."_".$course_title_abbr."_Poor_Ratings";
$file_name = date("Y-m-d")."_UGTM_Poor_Ratings";

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