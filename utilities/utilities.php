<?php

require_once '../libararies/php-excel/php-excel.class.php';

class utilities {

    public function fixWorksCode(&$data) {
        $MAX_SIZE = count($data);
        for ($index = 1; $index < $MAX_SIZE; $index++) {
            //UTF8
            for ($i = DATABASE_WORKS_FIELD_STRING_FROM; $i < DATABASE_WORKS_FIELD_STRING_TO; $i++) {
                $data[$index][$i] = html_entity_decode($data[$index][$i]);
            }
            //Date
            $data[$index][3] = date('d-m-Y', $data[$index][3]);
        }
    }
    public function arrayPHPtoArrayExcel($data) {
        $excel = array();
        //Get keys
       $excel[] = array_keys($data[0]);
        //Get data
       foreach ($data as $work) {
           $excel[] = array_values($work);
//           break;
       }
       $this->fixWorksCode($excel);
       return $excel;
    }

    /**
     * 
     * @param type $data
     * @param type $filename
     * @param type $dom_info
     */
    public function exportExcell($data) {
        // create a simple 2-dimensional array
//        $data = array(
//            array('a','b'),
//            array('cộng hòa','xã hội chủ nghĩa việt nam')
//        );
        // generate file (constructor parameters are optional)
        $xls = new Excel_XML('UTF-8', false, 'My Test Sheet');
        $xls->addArray($data);
        $xls->generateXML('my-test');
        exit();
    }

}

?>
