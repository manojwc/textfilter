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
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Compliance Snapshot');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);

$snap_col_char = "F";

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Global Id');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Mandatory Completion (%)');

foreach ($release_config as $key => $release) {
	$objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.'1', $release["title"].' (%)');
	$objPHPExcel->getActiveSheet()->getColumnDimension($snap_col_char)->setWidth(15);
	$snap_col_char++;
}

$snapshot_columns = array(
							array("title" => "First Accessed", "width" => 12),
							array("title" => "Last Accessed", "width" => 12),
							array("title" => "Profile Complete", "width" => 12),
							array("title" => "Role", "width" => 25),
							array("title" => "BU", "width" => 25),
							array("title" => "GBL", "width" => 25),
							array("title" => "Sector", "width" => 40),
							array("title" => "Mandatory Pre-assessments", "width" => 15),
							array("title" => "Completed Pre-assessments", "width" => 15),
							array("title" => "Mandatory Lessons Required", "width" => 15),
							array("title" => "Mandatory Lessons Completed", "width" => 15),
							array("title" => "Non Mandatory Lessons Completed", "width" => 16),
						);

foreach ($snapshot_columns as $key => $column) {
	$objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.'1', $column["title"]);
	$objPHPExcel->getActiveSheet()->getColumnDimension($snap_col_char)->setWidth($column["width"]);
	$snap_col_char++;
}


$Line = 2;
foreach ($all_learners as $key => $learner) {
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, $learner["first_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $learner["last_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, $learner["email"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, $learner["global_id"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$Line, $learner["stats"]["mandatory_completion_perc"]);

	$snap_col_char = "F";
	foreach ($release_config as $key_release => $release) {
		$objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.''.$Line, $learner["release_stats"][$key_release]["percentage"]);
		$snap_col_char++;
	}


	$objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.''.$Line, $learner["activity_date"]);
	$snap_col_char++;
	$objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.''.$Line, $learner["last_accessed"]);
	$snap_col_char++;

	if(sizeof($learner["profile_info"]) > 0){
        $objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.''.$Line, "TRUE");
        $snap_col_char++;
        $column_num = 'I';
        foreach ($learner["profile_info"] as $key_2 => $profile) {
        	if(strrpos($profile["profile_value"], "$") !== FALSE){
        		$value_string = "";
        		$all_vals = explode("$", $profile["profile_value"]);
        		foreach ($all_vals as $key_3 => $val) {
        			$value_string .= ($key_3+1).". ";
        			$value_string .= $val;
        			$value_string .= "\n";
        		}
        		//$value_string = str_replace("$", "\n - ", $profile["profile_value"]);
        		$value_string = rtrim($value_string, "\n");
	            $objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.$Line, $value_string);
	            $objPHPExcel->getActiveSheet()->getStyle($snap_col_char.$Line)->getAlignment()->setWrapText(true);
        	}else{
        		$objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.$Line, $profile["profile_value"]);
        	}

            $snap_col_char++;
        }
    }else{
        $objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.$Line, "FALSE");
        $snap_col_char++;
        $objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.$Line, "");
        $snap_col_char++;
        $objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.$Line, "");
        $snap_col_char++;
        $objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.$Line, "");
        $snap_col_char++;
        $objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.$Line, "");
        $snap_col_char++;
    }

    $objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.$Line, $learner["stats"]["mandatory_pre_assess"]);
    $snap_col_char++;
    $objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.$Line, $learner["stats"]["completed_pre_assess"]);
    $snap_col_char++;
    $objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.$Line, $learner["stats"]["total_mandatory"]);
    $snap_col_char++;
    $objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.$Line, $learner["stats"]["completed_mandatory_lessons"]);
    $snap_col_char++;
    $objPHPExcel->getActiveSheet()->SetCellValue($snap_col_char.$Line, $learner["stats"]["non_mand_completed"]);

	$Line++;

}

$objPHPExcel->getActiveSheet()->getStyle('A1:'.$snap_col_char.'1')->applyFromArray($style_green_header);


//**********************************************************************************************************************
// SHEET 2 MODULE WISE COMPLETIONS
//**********************************************************************************************************************
$objPHPExcel->createSheet(1);
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle('Module Details');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);

$objPHPExcel->getActiveSheet()->mergeCells('A1:A3');
$objPHPExcel->getActiveSheet()->mergeCells('B1:B3');
$objPHPExcel->getActiveSheet()->mergeCells('C1:C3');
$objPHPExcel->getActiveSheet()->mergeCells('D1:D3');
$objPHPExcel->getActiveSheet()->mergeCells('E1:E3');
$objPHPExcel->getActiveSheet()->mergeCells('F1:F3');

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Global Id');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Profile Completed');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Mandatory Completion');



$column_num = "G";
$module_start_column = "G";
$topic_column = "G";

foreach ($this->rpt_ugtm_release_model->course as $key => $module) {
	$module_end_column = increment_by($module_start_column, (sizeof($module["topic_ids"])));
	$objPHPExcel->getActiveSheet()->mergeCells($module_start_column.'1:'.$module_end_column.'1');
	$objPHPExcel->getActiveSheet()->SetCellValue($module_start_column.'1', $module["title"]);
	$module_start_column = $module_end_column;
	$module_start_column++;

    foreach ($module["topics"] as $key => $topic) {
		//$objPHPExcel->getActiveSheet()->mergeCells($topic_column.'2:'.$topic_column.'2');
		$objPHPExcel->getActiveSheet()->SetCellValue($topic_column.'2', $topic["title"]);
		$objPHPExcel->getActiveSheet()->SetCellValue($topic_column.'3', $topic["release"]);
		$objPHPExcel->getActiveSheet()->getColumnDimension($topic_column)->setWidth(15);

		$topic_column++;
    }
}


$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($style_green_header);
$objPHPExcel->getActiveSheet()->getStyle('G1:'.$module_start_column.'1')->applyFromArray($style_subheader_1);
$objPHPExcel->getActiveSheet()->getStyle('G2:'.$topic_column.'2')->applyFromArray($style_subheader_2);
$objPHPExcel->getActiveSheet()->getStyle('G3:'.$topic_column.'3')->applyFromArray($style_subheader_3);


$Line = 4;
foreach ($all_learners as $key => $learner) {
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, $learner["first_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $learner["last_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, $learner["email"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, $learner["global_id"]);

	$profile_complete = (sizeof($learner["profile_info"]) > 0) ? "YES" : "NO";
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$Line, $profile_complete);

	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$Line, $learner["stats"]["mandatory_completion_perc"]);

	$column_num = "G";

	foreach ($this->rpt_ugtm_release_model->course as $key => $module) {
        foreach ($module["topics"] as $key => $topic) {
            $topic_stats = $learner["topic_completions"][$topic["topic_id"]];
            if($topic_stats["has_recos"]){
                $objPHPExcel->getActiveSheet()->SetCellValue($column_num.$Line, $topic_stats["reco_completion"]);
            }else{
                 $objPHPExcel->getActiveSheet()->SetCellValue($column_num.$Line, "-");
            }
            $column_num++;
        }
    }

    $Line++;
}

$objPHPExcel->getActiveSheet()->getStyle('A1:'.$column_num.''.$Line)->getAlignment()->setWrapText(true);


//Set The Active Sheet to 0 - The Client Details Page
$objPHPExcel->setActiveSheetIndex(0);



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$file_name = "UGTM_CONSOLIDATED_REPORTS_".date("Y-m-d");

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