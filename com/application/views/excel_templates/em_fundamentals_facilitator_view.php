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
$objPHPExcel->getActiveSheet()->setTitle('EMF - Snapshot');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(16);


$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Global Id');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Mandatory Completion (%)');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'First Accessed');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Last Accessed');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Profile Complete');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Purpose');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Mandatory Lessons Required');
$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Mandatory Lessons Completed');
$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Non Mandatory Lessons Completed');



$Line = 2;
foreach ($all_learners as $key => $learner) {
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, $learner["first_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $learner["last_name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, $learner["email"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, $learner["global_id"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$Line, $learner["stats"]["mandatory_completion_perc"]);


	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$Line, $learner["activity_date"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$Line, $learner["last_accessed"]);

	if(sizeof($learner["profile_info"]) > 0){
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$Line, "Yes");
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$Line, $learner["profile_info"][0]["profile_value"]);
    }else{
       	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$Line, "No");
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$Line, "");
    }


    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$Line, $learner["stats"]["total_mandatory"]);
    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$Line, $learner["stats"]["completed_mandatory_lessons"]);
    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$Line, $learner["stats"]["non_mand_completed"]);

	$Line++;

}

$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($style_green_header);


//**********************************************************************************************************************
// SHEET 2 MODULE WISE COMPLETIONS
//**********************************************************************************************************************
$objPHPExcel->createSheet(1);
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle('Mandatory Lessons');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);

$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Mandatory Completion (%)');

$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Profile Complete');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Purpose');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Mandatory Module Title');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Mandatory Page Title');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Complete');

$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($style_green_header);

$Line = 2;
foreach ($all_learners as $key => $learner) {



	if($learner["stats"]["total_mandatory"] > 0){
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$Line, $learner["first_name"]);
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$Line, $learner["last_name"]);
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$Line, $learner["email"]);
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$Line, $learner["stats"]["mandatory_completion_perc"]);

		if(sizeof($learner["profile_info"]) > 0){
	        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$Line, "Yes");
	        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$Line, $learner["profile_info"][0]["profile_value"]);
	    }else{
	       	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$Line, "No");
	        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$Line, "");
	    }

	    $merge_cell_count = $learner["stats"]["total_mandatory"] - 1;
	    $objPHPExcel->getActiveSheet()->mergeCells('A'.$Line.':A'.($Line + $merge_cell_count));
	    $objPHPExcel->getActiveSheet()->mergeCells('B'.$Line.':B'.($Line + $merge_cell_count));
	    $objPHPExcel->getActiveSheet()->mergeCells('C'.$Line.':C'.($Line + $merge_cell_count));
	    $objPHPExcel->getActiveSheet()->mergeCells('D'.$Line.':D'.($Line + $merge_cell_count));
	    $objPHPExcel->getActiveSheet()->mergeCells('E'.$Line.':E'.($Line + $merge_cell_count));
	    $objPHPExcel->getActiveSheet()->mergeCells('F'.$Line.':F'.($Line + $merge_cell_count));

	    $mandatory_pages_data = $learner["stats"]["mandatory_pages_data"];

    	foreach ($mandatory_pages_data as $key_2 => $page) {
    		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$Line, $page["module_title"]);
    		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$Line, $page["page_title"]);
    		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$Line, $page["is_complete"]);

    		$Line++;
    	}

	    $Line++;
	} // Has mandatory pages assigned check
} //End of foreach


$objPHPExcel->getActiveSheet()->getStyle('A1:I'.$Line)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:I'.$Line)->applyFromArray($bordered_cells);


//Set The Active Sheet to 0 - The Client Details Page
$objPHPExcel->setActiveSheetIndex(0);



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$file_name = "EMF_Facilitator_Report_".date("Y-m-d");

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