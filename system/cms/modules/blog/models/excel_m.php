<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') or exit('No direct script access allowed');

//date_default_timezone_set('Europe/London');

/** Include PHPExcel */

//require_once dirname(__FILE__) . '/../../libraries/ExportExcel/PHPExcel.php';

class Excel_m extends MY_Model{
   public $objPHPExcel = NULL;
   public $style_type = array();
   protected $table = '';


   public function __construct() {
       $this->load->library('PHPExcel');
       $this->objPHPExcel = new PHPExcel();
   }
   
   /**
     * setting Properties of Excel 
     *
     * @param  array $pProperties object array include 
    * infomation properties of excel ( creator, lasmodifiedby, title, subject, description, keywords, category)
     * @return PHPDocument_properties
     */
   public function set_Properties_Excel($pProperties = NULL){
       if (!empty($pProperties)) {
            $this->objPHPExcel->getProperties()
                    ->setCreator($pProperties['creator'])
                    ->setLastModifiedBy($pProperties['lasmodifiedby'])
                    ->setTitle($pProperties['title'])
                    ->setSubject($pProperties['subject'])
                    ->setDescription($pProperties['description'])
                    ->setKeywords($pProperties['keywords'])
                    ->setCategory($pProperties['category']);
        }
        return NULL;
   }
   /**
     * Insert Data To Excel 
     *
     * @param  array $data_array 
     * @param  int  $rowstart value of row start.
     * @return object PHPExcel
     */
   public function push_Data_Excel($data_array = NULL, $name_category = null, $rowstart = 1, $customize = 0) {
        $baseRow = $rowstart;
        $objPHPExcel = $this->objPHPExcel;
       
        $objPHPExcel->setActiveSheetIndex(0);
        //$worksheet = $objPHPExcel->getActiveSheet();
       
        $objPHPExcel->getActiveSheet()->setCellValue('B1',"Dữ Liệu Nghành: " . $name_category);
        //$objPHPExcel->getActiveSheet()->setCellValue('B2')->fromArray(array_keys($data_array[0]));
        
        //set title of table 
        $objPHPExcel->getActiveSheet()->fromArray(array_keys($data_array[0]),null,'B2');
//        $columnID = 'B';
//        foreach (array_keys($data_array[0]) as $data_rows) {
//            $objPHPExcel->getActiveSheet()->setCellValue($columnID++ .'2', $data_rows);
//        }
        $rowID = 3;
        foreach ($data_array as $data_rows) {
            $columnID = 'B';
            foreach ($data_rows as $columnValue) {
                $objPHPExcel->getActiveSheet()->setCellValue($columnID . $rowID, $columnValue);
                $columnID++;
            }
            $rowID++;
        }
        //set Font and Size 
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(True)
                ->setSize(20);
        
        
        //set mercells
        $objPHPExcel->getActiveSheet()->mergeCells('B1:H1');
        
        
        //set background color 
         $objPHPExcel->getActiveSheet()->getStyle('B2:H2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
         $objPHPExcel->getActiveSheet()->getStyle('B2:H2')->getFill()->getStartColor()->setARGB('538DD5');
         $objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
         $objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->setARGB('0F243E');
        
         //set height of row
         $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(80);
         $objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(30);
         
         //set width of col
         $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
         $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
         $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
         $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
         $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
         $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
         
         //set color text
         $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));
         $objPHPExcel->getActiveSheet()->getStyle('F2')->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));
         $objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));
         $objPHPExcel->getActiveSheet()->getStyle('C2')->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));
         $objPHPExcel->getActiveSheet()->getStyle('D2')->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));
         $objPHPExcel->getActiveSheet()->getStyle('E2')->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));
         $objPHPExcel->getActiveSheet()->getStyle('G2')->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));
         $objPHPExcel->getActiveSheet()->getStyle('H2')->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));
         
         //set alignment 
         $objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('C2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('D2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('E2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('F2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('G2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $objPHPExcel->getActiveSheet()->getStyle('H2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
         //set wrap text 
//         $objPHPExcel->getActiveSheet()->getStyle('E3:E' . $rowID)->getAlignment()->setWrapText(true);
         $objPHPExcel->getActiveSheet()->getStyle('D3:H' . $rowID)->getAlignment()->setWrapText(true);
         
         //set col text-center
          $objPHPExcel->getActiveSheet()->getStyle('B3:B' . $rowID)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle('B3:B' . $rowID)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle('C3:C' . $rowID)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle('C3:C' . $rowID)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
          $objPHPExcel->getActiveSheet()->getStyle('F3:F' . $rowID)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle('F3:F' . $rowID)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle('G3:G' . $rowID)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle('G3:G' . $rowID)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
          $objPHPExcel->getActiveSheet()->getStyle('H3:H' . $rowID)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle('H3:H' . $rowID)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
          
         
          //Format d-y-m col F
          $objPHPExcel->getActiveSheet()->getStyle('F3:F' . $rowID)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
          
         //set color background sheet
          $objPHPExcel->getDefaultStyle()->applyFromArray(array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('argb' => '000000'),
                ),
          ));
        $objPHPExcel->getActiveSheet()->setTitle(date('d-m-Y'));
        $objPHPExcel->setActiveSheetIndex(0);
        return $this->objPHPExcel = $objPHPExcel;
    }

    /**
     * Export Data From $objPHPExcel
     *
     * @param  string $filename direction save file example demo.xlsx or /folder/filename.xlsx
     * @return 
     */
   public function export_to_Excel_Download($filename = __FILE__ ){
      
       // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$filename.'.xlsx');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
}
/*
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');

// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
*/
