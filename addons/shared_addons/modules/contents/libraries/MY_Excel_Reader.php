<?php

require_once ADDON_FOLDER.'shared_addons/modules/contents/third_party/PHPExcel_1.8.0/PHPExcel.php';
require_once ADDON_FOLDER.'shared_addons/modules/contents/third_party/PHPExcel_1.8.0/PHPExcel/IOFactory.php';


class MY_Excel_Reader extends PHPExcel {
    public function import($file) {
        //  Read your Excel workbook
        try {
            $inputFileType = PHPExcel_IOFactory::identify($file);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($file);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }
        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        //  Loop through each row of the worksheet in turn
        $data = array();
        for ($row = 1; $row <= $highestRow; $row++) {
            //  Read a row of data into an array
            $temp = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
            $data[] = $temp[0];
        }
        return $data;
    }

}
