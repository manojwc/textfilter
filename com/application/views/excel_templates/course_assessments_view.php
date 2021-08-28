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



//*******************************************************************************************************************************
// SHEET 1 All Surveys - Stats View
//*******************************************************************************************************************************

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Assessment Stats');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(45);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);


$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($style_green_header);
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Assessment Title');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Has Recommendations');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Required Score (%)');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Total Attempts');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Distinct Learners');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Started');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Passed');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Failed');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Pass Percentage (%)');

$Line = 2;
foreach($course_assessments as $main_key => $assessment){
	//if($main_key < 3){
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, $assessment["title"]);
		$reco_status = ($assessment["recommendation_level"] == "none") ? "No" : "Yes";
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $reco_status);
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, $assessment["required_score"]);
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, $assessment["total_attempts"]);
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$Line, $assessment["total_learners"]);
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$Line, $assessment["started"]);
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$Line, $assessment["passed"]);
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$Line, $assessment["failed"]);
		$pass_percentage = round(($assessment["passed"]/$assessment["total_attempts"])*100);
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$Line, $pass_percentage);

		$Line++;
	//} // End  of limiting key loop

	//$objPHPExcel->getActiveSheet()->getStyle('C2:'.($col_char).''.$Line)->applyFromArray($percentage_format);
		$objPHPExcel->getActiveSheet()->getStyle('A1:I'.$Line)->applyFromArray($bordered_cells);
}



//**********************************************************************************************************************
// SHEET 2 Surveys -  Detailed Results
//**********************************************************************************************************************
$objPHPExcel->createSheet(1);
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle('Questions Stats');

//$objPHPExcel->getActiveSheet()->mergeCells('A1:A3');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(45);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);

$Line = 1;
foreach($course_assessments as $main_key => $assessment){
	//if($key < 3){
	if($assessment["assess_type"] == "module_assessment" && sizeof($assessment["all_questions"]) > 0 ){
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, $assessment["title"]);
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$Line.':G'.$Line);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$Line.':G'.$Line)->applyFromArray($section_title_row);
		$Line++;

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, "Question");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, "Number of Times Answered");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, "Correctly Answered");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, "Correctly Answered (%)");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$Line, "Option Num");
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$Line, "Option Text");
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$Line, "Option Selected Count");
		$objPHPExcel->getActiveSheet()->getStyle('A'.$Line.':G'.$Line)->applyFromArray($grey_table_header);
		$Line++;

		$all_questions = $assessment["all_questions"];
		foreach ($assessment["all_questions"] as $key_1 => $question){
			$option_count = sizeof($question['options']);

			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, $question["question_text"]);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$Line.':A'.($Line + $option_count-1));

			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $question["total_attempts"]);
			$objPHPExcel->getActiveSheet()->mergeCells('B'.$Line.':B'.($Line + $option_count-1));

			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, $question["total_correct"]);
			$objPHPExcel->getActiveSheet()->mergeCells('C'.$Line.':C'.($Line + $option_count-1));

			$correct_q_percentage = round(($question["total_correct"]/$question["total_attempts"]) * 100);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, $correct_q_percentage);
			$objPHPExcel->getActiveSheet()->mergeCells('D'.$Line.':D'.($Line + $option_count-1));


			foreach ($question["options"] as $key_2 => $option){
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$Line, ($key_2 + 1));
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$Line, $option["option_text"]);
				if($option["is_correct"] == 1){
					$objPHPExcel->getActiveSheet()->getStyle('F'.$Line)->applyFromArray($light_green_bg);
				}
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$Line, $option["total_selects"]);

				$Line++;
			}

			$Line++;
		} // Questions Loop


		$Line = $Line + 2;

	//} // End  of limiting key loop

	} // module_assesment check loop

	//$objPHPExcel->getActiveSheet()->getStyle('B1:D'.$Line)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1:G'.$Line)->applyFromArray($bordered_cells);

}



//Set The Active Sheet to 0 - TheFeedback Stats Tab
$objPHPExcel->setActiveSheetIndex(0);



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$file_name = date("Y-m-d")."_".$course_title_abbr."_All_Assess_Stats";

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