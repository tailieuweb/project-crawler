<?php
require_once '../pages/VietnamWorks.php';
require_once '../pages/CareerLink.php';
require_once '../pages/Internship.php';
require_once '../model/db.php';
require_once '../model/works.php';
require_once '../model/keywords.php';
require_once '../model/keys_works.php';
//require_once '../model/log.php';
require_once '../model/show_log.php';
$md_keywords = new Keywords();
$md_works = new Works();
$keywords = $md_keywords->select();
$show_log = new show_log();
foreach ($crawling_sites as $site) {
    $result_crawl = array(
        'date' =>strtotime(date('d-m-Y')),
        'id_site' => $site['id'],
        'total' => NULL,
        'inserted' => NULL,
        'id_keywords' =>'',
        'id_works' =>array()
    );
    //Crawl from site
    if ($site['status'] && $site['is_site']) {
        $crawl = new $site['class'];
        foreach ($keywords as $index => $keyword) {
            $total_inserted = 0;
            $listId_insert = array();
            $params = array(
                'keyword' => $keyword,
                'page' => 1);
            //Generate Url search
            $crawl->generateUrlSearch($params);
            //Get page content
            $content = $crawl->getPageContent($crawl->url_search);
           
            $total = $crawl->parsePageContent($crawl->content, $crawl->patterns['total']);           
            if (isset($total[1][0])) {
                $total = (int) $total[1][0];
                $crawl->setPagination($total);
                for ($i = $crawl->pagination['start']; $i <= $crawl->pagination['end']; $i++) {
                    $params['page'] = $i;
                    $crawl->generateUrlSearch($params);
                   
                    // Get content of search result page
                    $content = $crawl->getPageContent($crawl->url_search);
                    /* matches = array(
                     *  0   =>  array(urls)
                     *  1   =>  array(date)
                     *)
                     */
                    $matches = array();

                    // Parse content to get 
                    //+ url detail
                    //+ posted date                                
                    $crawl->parsePageContent($crawl->content, $crawl->patterns['url_detail'], $matches);
                    $crawl->parsePageContent($crawl->content, $crawl->patterns['posted_date'], $matches);
                    /* works = array(
                     * 'name',
                     * 'description',
                     * 'experience_requirements',
                     * 'posted_date',
                     * 'company_name',
                     * 'company_address',
                     * 'company_profile',
                     * 'url',
                     * 'id_site'
                     * )
                     */
                    
                    $works = $crawl->parseWorksList($matches);
                    $crawl->parseWorksDetail($works);
                    
                    /**
                     * Insert to `works` table
                     */
                    $result_insert = $md_works->insertFromArray($works);
                    foreach ($result_insert as $item)
                        $listId_insert[] = $item;
                    $total_inserted+=count($result_insert);
                } // End pagination;  
            }// End total[1][0];
                $result_crawl['total']+=$total;
                $result_crawl['inserted']+=$total_inserted;
                $result_crawl['id_keywords'] .=$keyword['id'].',';
                if(!empty($listId_insert))
                    $result_crawl['id_works'][] =implode(',',$listId_insert);
        } // End keyword;
        $result_crawl['id_works'] = !empty($result_crawl['id_works']) ? implode(',', $result_crawl['id_works']) :NULL;
        $show_log->insert($result_crawl);
    }
    if ($site['status'] && !$site['is_site']) {
        $crawl = new $site['class'];
        foreach ($crawl->url_lists as $key => $page) {
            $total_inserted = 0;
            $listId_insert = array();
            $params = array(
                'limit' => 0,
                'limitstart' => 0
            );
            $content = $crawl->getPageContent($page['url'], $params);
            // Parse content to get 
            //+ url detail
            //+ posted date                                
            $matches = array();
            $crawl->parsePageContent($crawl->content, $crawl->patterns['url_detail'], $matches);
            $crawl->parsePageContent($crawl->content, $crawl->patterns['posted_date'], $matches);
            $works = array();
            /* works = array(
             * 'name',
             * 'description',
             * 'experience_requirements',
             * 'posted_date',
             * 'company_name',
             * 'company_address',
             * 'company_profile',
             * 'url'
             * )
             */
            $works = $crawl->parseWorksList($matches);
            $works = $crawl->parseWorksDetail($works);
            $crawl->getFromLocations($works); //TODO
            /**
             * Insert to `works` table
             */
            $result_insert = $md_works->insertFromArray($works);
                    foreach ($result_insert as $item)
                        $listId_insert[] = $item;
                            $total_inserted+=count($result_insert);       
            $result_crawl['total']+=count($works);
            $result_crawl['inserted']+=$total_inserted;
            if(!empty($listId_insert))
                    $result_crawl['id_works'][] =implode(',',$listId_insert);       
        }// End Keywords;
        $result_crawl['id_works'] = !empty($result_crawl['id_works']) ? implode(',', $result_crawl['id_works']) :NULL;
        $show_log->insert($result_crawl); 
    }
   // break;
}

