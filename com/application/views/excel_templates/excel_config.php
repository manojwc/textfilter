<?php

/** Include path **/
ini_set('include_path', ini_get('include_path').';assets/plugins/PHPExcel_1.8.0_doc/Classes');

/** PHPExcel */
include 'PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'PHPExcel/Writer/Excel2007.php';


//Styles

$style_green_header = array(
							'font' => array( 'bold' => true,  'size' => 11,),
							'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER, ),
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
$style_subheader_1 = array(
							'font' => array( 'bold' => true,  'size' => 10,),
							'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER, ),
							'borders' => array(
									'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), ),
									),
							'fill' => array(
								'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
								'rotation' => 90,
								'startcolor' => array( 'argb' => '92D9EF', ),
								'endcolor' => array( 'argb' => '92D9EF', ),
							),
						);
$style_subheader_2 = array(
							'font' => array( 'bold' => true, 'size' => 9,),
							'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER, ),
							'borders' => array(
									'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), ),
									),
							'fill' => array(
								'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
								'rotation' => 90,
								'startcolor' => array( 'argb' => 'C8EAF5', ),
								'endcolor' => array( 'argb' => 'C8EAF5', ),
							),
						);
$style_subheader_3 = array(
							'font' => array( 'bold' => false, 'size' => 8,),
							'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER, ),
							'borders' => array(
									'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), ),
									),
							'fill' => array(
								'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
								'rotation' => 90,
								'startcolor' => array( 'argb' => 'DDE1E2', ),
								'endcolor' => array( 'argb' => 'DDE1E2', ),
							),
						);

$style_subheader_4 = array(
							'font' => array( 'bold' => false, 'size' => 9,),
							'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER, ),
							'borders' => array(
									'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), ),
									),
							'fill' => array(
								'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
								'rotation' => 90,
								'startcolor' => array( 'argb' => 'DDE1E2', ),
								'endcolor' => array( 'argb' => 'DDE1E2', ),
							),
						);

$section_title_row = array(
							'font' => array( 'bold' => true,  'size' => 16,),
							'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER, ),
							'borders' => array(
									'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), ),
									),
							'fill' => array(
								'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
								'rotation' => 90,
								'startcolor' => array( 'argb' => '92D9EF', ),
								'endcolor' => array( 'argb' => '92D9EF', ),
							),
						);
$style_h2_default = array(
							'font' => array( 'bold' => true,  'size' => 14,),
							'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, ),
							'borders' => array(
									'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), ),
									)
						);
$grey_table_header = array(
							'font' => array( 'bold' => true, 'size' => 11,),
							'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER, ),
							'borders' => array(
									'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), ),
									),
							'fill' => array(
								'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
								'rotation' => 90,
								'startcolor' => array( 'argb' => 'DDE1E2', ),
								'endcolor' => array( 'argb' => 'DDE1E2', ),
							),
						);
$style_small_text = array(
							'font' => array( 'bold' => false,  'size' => 11,),
							'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, ),
							'borders' => array(
									'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), ),
									)
						);

$small_dull_text = array(
							'font' => array( 'bold' => false,  'size' => 9, 'color' => array('rgb' => '666666'),),
							'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, ),
							'borders' => array(
									'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '88888888'), ),
									)
						);

$percentage_format = array(
							'code' => PHPExcel_Style_NumberFormat::FORMAT_NUMBER
						);

$light_green_bg = array(

							'fill' => array(
								'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
								'rotation' => 90,
								'startcolor' => array( 'argb' => 'D9F5DE', ),
								'endcolor' => array( 'argb' => 'D9F5DE', ),
							),
						);
$bordered_cells = array(
							'borders' => array(
									'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '88888888'), ),
									)
						);

function increment_by($char, $length){
	for($i =0; $i < ($length-1); $i++){
		$char++;
	}
	return $char;
}

?>