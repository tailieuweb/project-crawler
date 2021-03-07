<?php

ini_set('max_execution_time', 0);
set_time_limit(0);

require_once '../model/sites.php';
require_once '../model/all_categories_model.php';
require_once './log.php';

$log = new Log();

//Get list of sites
$msites = new Sites_model();
$md_all_categories_model = new All_Categories_Model();
$sites = $msites->get_sites();
foreach ($sites as $site) {
    if ($site['status'] == IS_ACTIVE) {

        //Create site class        
        require_once '../sites/' . $site['class'] . '.php';
        
        $site['start'] = date('Y-m-d H:i:s');
        $obj = new $site['class']($site['id']);
        //Create crawl categories
        $content_categories = $obj->getPageContent($site['url_categories']);
        $categories = array();

        //Get the list of items
        $items = array();
        if (!empty($obj->patterns['categories-list'])) {

            $list = $obj->getValFromParrerns($content_categories, $obj->patterns['categories-list'], FALSE);
            if (!empty($list)) {
                foreach ($obj->patterns['categories-item'] as $pattern) {
                    $items = $obj->parsePageContent($list, $pattern);
                    if (!empty($items[1][0]) && $items[2][0])
                        break;
                }
            }
        } else {
            foreach ($obj->patterns['categories-item'] as $pattern) {
                $items = $obj->parsePageContent($content_categories, $pattern);
                if (!empty($items[1][0]) && $items[2][0])
                    break;
            }
        }
        //Insert into database
        if (!empty($items[1])) {
            foreach ($items[1] as $index => $url) {
                $categories[] = array(
                    'url' => $obj->getUrlCategory($url),
                    'name' => $obj->escape_string($items[2][$index]),
                    'id_site' => $site['id'],
                    'results' => $obj->results,
                );
            }

            $site['new_cate']=$md_all_categories_model->insertFromArray($categories);
            

            //Write log
            $site['end']=date('Y-m-d H:i:s');
            $log->crawl_categories($categories, $site);
        }
    }
}