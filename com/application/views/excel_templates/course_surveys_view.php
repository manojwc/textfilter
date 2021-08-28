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
$objPHPExcel->getActiveSheet()->setTitle('Feedback Stats');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(45);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);


$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($style_green_header);
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Module Title');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Total Responses');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Excellent (%)');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Good (%)');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Satisfactory (%)');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Poor (%)');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Very Poor (%)');


$Line = 2;
foreach($all_surveys as $main_key => $survey){
	//if($main_key < 3){
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, $survey["module_title"]);
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $survey["stats"]["total_responses"]);

		$col_char = "C";
		foreach ($survey["stats"]["components"] as $key => $comp){
			if($comp["question"]["question_type"] == "single_select"){
				foreach ($comp["responses"] as $key => $option){
					if($survey["stats"]["total_responses"] > 0){
						$option_percentage = (($option["count"]/$survey["stats"]["total_responses"])*100);
					}else{
						$option_percentage = 0;
					}

					$integerVal = intval($option_percentage);
					$rounded_option_percentage = ($option_percentage - $integerVal < 0.5) ? floor($option_percentage) : ceil($option_percentage);

					$objPHPExcel->getActiveSheet()->SetCellValue($col_char.''.$Line, $rounded_option_percentage."%");
					$col_char++;
				}
			}
		}

		$Line++;
	//} // End  of limiting key loop

	//$objPHPExcel->getActiveSheet()->getStyle('C2:'.($col_char).''.$Line)->applyFromArray($percentage_format);
}



//**********************************************************************************************************************
// SHEET 2 Surveys -  Detailed Results
//**********************************************************************************************************************
$objPHPExcel->createSheet(1);
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle('Detailed Results');

//$objPHPExcel->getActiveSheet()->mergeCells('A1:A3');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);

$Line = 1;
foreach ($all_surveys as $key => $survey){
	//if($key < 3){
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $survey["module_title"]);
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$Line.':D'.$Line);
	$objPHPExcel->getActiveSheet()->getStyle('B'.$Line.':D'.$Line)->applyFromArray($section_title_row);
	$Line++;

	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, "Total Responses");
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, $survey["stats"]["total_responses"]);
	$objPHPExcel->getActiveSheet()->mergeCells('C'.$Line.':D'.$Line);
	$objPHPExcel->getActiveSheet()->getStyle('B'.$Line.':D'.$Line)->applyFromArray($style_h2_default);
	$Line = $Line + 2;

	foreach ($survey["stats"]["components"] as $key_2 => $comp){

		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $comp["question"]["question_text"]);
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$Line.':D'.$Line);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$Line.':D'.$Line)->applyFromArray($style_h2_default);
		$Line++;

		// QUESTION TYPE = Single Select
		if($comp["question"]["question_type"] == "single_select"){
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, "Option");
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, "Count");
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, "Percentage");
			$objPHPExcel->getActiveSheet()->getStyle('B'.$Line.':D'.$Line)->applyFromArray($grey_table_header);
			$Line++;

			foreach ($comp["responses"] as $key => $option){
				if($survey["stats"]["total_responses"] > 0){
					$option_percentage = (($option["count"]/$survey["stats"]["total_responses"])*100);
				}else{
					$option_percentage = 0;
				}

				$integerVal = intval($option_percentage);
				$rounded_option_percentage = ($option_percentage - $integerVal < 0.5) ? floor($option_percentage) : ceil($option_percentage);

				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $option["option_text"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, $option["count"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, $rounded_option_percentage."%");
				$objPHPExcel->getActiveSheet()->getStyle('B'.$Line.':D'.$Line)->applyFromArray($style_small_text);
				$Line++;

			}

		}

		// QUESTION TYPE = Text Entry
		else if($comp["question"]["question_type"] == "text_entry"){
			foreach ($comp["responses"] as $key => $learner_response){
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $learner_response["response_date"]);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$Line)->applyFromArray($small_dull_text);

				$combined_response = explode("$#$", $learner_response["response"]);
				$display_responses = "";
				//echo '<ul>';
				foreach ($combined_response as $key => $single_response) {
					if($single_response != ""){
						$display_responses .= $single_response;
					}
				}
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, $display_responses);
				$objPHPExcel->getActiveSheet()->mergeCells('C'.$Line.':D'.$Line);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$Line.':D'.$Line)->applyFromArray($style_small_text);

				$Line++;
			}
		}


	}
	$Line = $Line + 2;

	//} // End  of limiting key loop

	$objPHPExcel->getActiveSheet()->getStyle('B1:D'.$Line)->getAlignment()->setWrapText(true);

}



//Set The Active Sheet to 0 - TheFeedback Stats Tab
$objPHPExcel->setActiveSheetIndex(0);



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$file_name = date("Y-m-d")."_".$course_title_abbr."_All_Eval_Feedbacks";

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