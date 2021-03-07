<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
//require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';

require_once 'customize-01simple-download-xlsx.php';

class Excel_Temp_First extends Excel{
    function __construct() {
        parent::__construct();
    }
}
    $objPHPExcel_demo = new Excel_Temp_First();
    $objPHPExcel_demo1 = new Excel_Temp_First();
   
//    $array = array(0 => array( 'id' => '1',
//                               'title' => 'demo1',
//                               'decription' => 'mô tả 1',
//        
//                       ),
//                  1 => array( 'id' => '2',
//                               'title' => 'demo2',
//                               'decription' => 'mô tả 1',
//        
//                       ),
//                  2 => array( 'id' => '3',
//                               'title' => 'demo3',
//                               'decription' => 'mô tả 3',
//        
//                       ),
//             );
    $array = array(0 => array( '#' => '1',
                               'Title' => 'Tuyển Dụng Lập Trình Viên',
                               'Decription' => 'Tuyen dung lap trinh vienTuyen dung lap trinh vienTuyen dung lap trinh vienTuyen dung lap trinh vienTuyen dung lap trinh vienTuyen dung lap trinh vien',
                               'Requirements' => 'Tuyen dung lap trinh vienTuyen dung lap trinh vienTuyen dung lap trinh vienTuyen dung lap trinh vienTuyen dung lap trinh vienTuyen dung lap trinh vien',
                               'Expired' => '2015/10/25',
                               'Company Name' => 'Cong ty abc',
                               'Company Website' => 'abc.com/asd',
        
                       ),
                  1 => array(  '#' => '2',
                               'name' => '',
                               'decription' => '',
                               'Requirements' => '',
                               'Expired' => '',
                               'Company Name' => '',
                               'Company Website' => '',
                       ),
                  2 => array( '#' => '3',
                               'name' => '',
                               'decription' => '',
                               'Requirements' => '',
                               'Expired' => '',
                               'Company Name' => '',
                               'Company Website' => '',
        
                       ),
                  3 => array( '#' => '4',
                               'name' => '',
                               'decription' => '',
                               'Requirements' => '',
                               'Expired' => '',
                               'Company Name' => '',
                               'Company Website' => '',  
        
                       ),
             );
    $array_info = array(
        'creator' => 'demo',
        'lasmodifiedby' => 'demo',
        'title' => 'demo',
        'subject' => 'demo',
        'description' => 'demo',
        'keywords' => 'demo',
        'category' => 'demo',
    );
    $filename = '01demo';
    //set properties excel
    $objPHPExcel_demo->set_Properties_Excel($array_info);
    //customize template excel
    //$objPHPExcel_demo->push_Data_Excel($array);//temp default
    $objPHPExcel_demo->push_Data_temp_2_Excel($array);
    //export download file excel
    $objPHPExcel_demo->export_to_Excel_Download($filename);


