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
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(16);



$objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($row_header_style);
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Global Id');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Mandatory Completion (%)');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'First Accessed');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Last Accessed');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Profile Complete');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Role');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'BU');
$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'GBL');
$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Sector');
$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Mandatory Pre-assessments');
$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Completed Pre-assessments');
$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Mandatory Lessons Required');
$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Mandatory Lessons Completed');
$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Non Mandatory Lessons Completed');




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
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$Line, "TRUE");
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
	            $objPHPExcel->getActiveSheet()->SetCellValue($column_num.$Line, $value_string);
	            $objPHPExcel->getActiveSheet()->getStyle($column_num.$Line)->getAlignment()->setWrapText(true);
        	}else{
        		$objPHPExcel->getActiveSheet()->SetCellValue($column_num.$Line, $profile["profile_value"]);
        	}

            $column_num++;
        }
    }else{
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$Line, "FALSE");
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$Line, "");
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$Line, "");
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$Line, "");
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$Line, "");
    }

    $objPHPExcel->getActiveSheet()->SetCellValue('M'.$Line, $learner["stats"]["mandatory_pre_assess"]);
    $objPHPExcel->getActiveSheet()->SetCellValue('N'.$Line, $learner["stats"]["completed_pre_assess"]);
    $objPHPExcel->getActiveSheet()->SetCellValue('O'.$Line, $learner["stats"]["total_mandatory"]);
    $objPHPExcel->getActiveSheet()->SetCellValue('P'.$Line, $learner["stats"]["completed_mandatory_lessons"]);
    $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$Line, $learner["stats"]["non_mand_completed"]);



	$Line++;

}

$objPHPExcel->getActiveSheet()->setTitle('UGTM Compliance - '. date("Y-m-d"));


//Set The Active Sheet to 0 - The Client Details Page
$objPHPExcel->setActiveSheetIndex(0);



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$file_name = "UGTM_Compliance_".date("Y-m-d");

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