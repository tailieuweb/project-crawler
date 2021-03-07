<?php

ini_set('max_execution_time', 0);
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

require_once '../model/works_model.php';

require_once '../model/all_categories_model.php';
require_once './log.php';
$log = new Log();
$md_works_model = new Works_Model();
$md_all_categories_model = new All_Categories_Model();

//Get list of actived categories
$categories = $md_all_categories_model->get_category_for_crawling();

//Crawl works
foreach ($categories as $category) {
    //Get info for log
    $category['start'] = date('Y-m-d H:i:s');
    $category['new_works']=0;
    
    $md_all_categories_model->update($category['id'], array('status_crawler' => 1));

    require_once '../sites/' . $category['class'] . '.php';
    $obj = new $category['class']($category['id_site']);

    //List of works
    $url_works_by_category = $obj->generateUrlSearch($category['c_url']);
    $content_works_by_category = $obj->getPageContent($url_works_by_category);

    //Get total resutls
    $total = array();
    if (empty($category['results'])) {
        $total = $obj->getValFromParrerns($content_works_by_category, $obj->patterns['works-total']);
        $obj->format_total($total);
    } else {
        $total = $category['results'];
    }
    /**
     * Watching
     */
    
    /**
     * Watching
     */
    if (!empty($total)) {

        //Get pagination page
        $pages = $obj->getPagesPagination($total);
        for ($i = 1; $i <= $pages; $i++) {
            //Crawl list of works by category
            $params = array(
                'page' => $i
            );

            $url_works_by_category = $obj->generateUrlSearch($category['c_url'], $params);
            $content_works_by_category = $obj->getPageContent($url_works_by_category, $params);
            
            //Get list of works url
            $urls_list_of_works = $obj->getUrlsListOfWorks($content_works_by_category);
            
            //Get list of created date
            $list_of_created_date = $obj->getListOfCreatedDate($content_works_by_category);
            if (!empty($urls_list_of_works)) {
                /**
                 * Insert url to database
                 */
                $data = array(
                    'id_work_categories' => $category['id_categories'],
                    'id_site' => $category['id_site'],
                    'urls' => $urls_list_of_works,
                    'created' => $list_of_created_date,
                    'status' => 'draft',
                    'author_id' => 1,
                    'status_crawler' => 0,
                    'category_id' => $obj->job_type,
                    'category_of_site'=>$category['id'],
                    'category_name'=>$category['c_name'],
                );
                
                $category['new_works']+=$md_works_model->insertUrls($data);
            } else
                break;
        }
        //Write log
        $category['total']=$total;
        $category['end']=date('Y-m-d H:i:s');
        $log->write_crawl_work_log($category);
    }
    //Update status
}