<?php

ini_set('max_execution_time', 0);
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
require_once '../model/works_model.php';
require_once './log.php';
$log = new Log();
//Log info
$log_info = array();
//
$md_works_model = new Works_Model();
$limit = 1;


$categories = $md_works_model->getCategoriesFromWork();

foreach ($categories as $category) {
    //Log detail
    $log_info['none_requirement']=0;
    $log_info['none_description']=0;
    $log_info['valid_works']=0;
    $log_info['total_works']=0;
    $log_info['start'] = date('Y-m-d H:i:s');
    //Get works for crawling detail
    $works = $md_works_model->getWorksForCrawling($limit, $category['id_site'], $category['category_of_site']);
    //log--Get work info
    $work_info=$works[0];
    
    while (!empty($works)) {
        foreach ($works as $work) {
            require_once '../sites/' . $work['class'] . '.php';
            $obj = new $work['class']($work['id_site']);
            $content = $obj->getPageContent($work['url']);
            /* Parse work */
            $info = $obj->parseWork($content);
            
            if ($obj->is_valid_job($info)) {
                $info['id'] = $work['id'];
                if ($work['created'] !== '0000-00-00 00:00:00') {
                    $info['created'] = $work['created'];
                    $info['start'] = $work['created'];
                }
                /* Update into database */
                $invalid_work=$md_works_model->updateWork($info);
                //log info
                $log_info['none_requirement']+=$invalid_work['none_requirement'];
                $log_info['none_description']+=$invalid_work['none_description'];
                $log_info['valid_works']++;
            } else {
                //Lock
                $md_works_model->lock($work['id']);
            }
            //log info
            $log_info['total_works']++;
        }
        $works = $md_works_model->getWorksForCrawling($limit, $category['id_site'], $category['category_of_site']);
    }
    //Save log
    $log_info['end'] = date('Y-m-d H:i:s'); 
    $log->write_crawl_work_detail_log($log_info, $work_info);
}



