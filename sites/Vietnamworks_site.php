<?php
require_once 'Sites.php';
class Vietnamworks_site extends Sites{
    public $results = 0;
    public $patterns = array();/*array(
        'categories' => array(
            'list'  => array(
                0 => '/<div class="list-simple col-md-6">([\s\S]*?)<div class="list-simple col-md-3">/',
            ),
            'item'  => array(
                0 =>  '/<li><a href=[\'\"](.*?)[\'\"].*?>(.*?)<\/a>/',
            )
        ),
        'works' => array(
            'total' =>  array(
                0 => '/<span class="orange"><strong>(\d*)?<\/strong>/',
             ),
            'list'  => NULL,
            'item'  => array(
                0 => '/<a href=[\'\"](.*?)[\'\"].*?class="job-title text-clip text-lg"/'
            ),
            'title' => array(
                0 => '/<div class=[\'\"]job-header-info[\'\"]>([\s\S]*?)<\/h1>/',
            ),
            'description' => array(
                0 => '/<div id=[\'\"]job-description[\'\"].*?[\'\"]>([\s\S]*?)<\/div>/',
                //note: not use 1 => '/<div.*?itemprop="description">([\s\S]*?)<\/div>/'
            ),
            'requirements' => array(
                0 => '/<div id=[\'\"]job-requirement[\'\"].*?[\'\"]>([\s\S]*?)<\/div>/',
              
            ),
            'location' => array(
                0 => array(
                        'list' => array(
                            0 => '/<p class=[\'\"]work-location[\'\"]>[\s\S]*?<a.*?\'>(.*?)<\/p>/',
                            ),
                        'item' => ''
                    ),
            ),
            'created' => array(
                0 => '/<span>Đăng tuyển:[\s\S]*?([\d{2}\/d{2}\/d{4}]*?)<\/span>/',
            ),
            'expired' => array(
               // Can not get data in this page!!!
            )
        ),
        'company' => array(
            'name' => array(
                0 => '/<span class=[\'\"]company-name text-lg block[\'\"]>([\s\S]*?)<\/span>/',
                // note: not use 1 => '/<div class="tit_company">(.*?)<\/div>/',
                ),
            'description' => array(
                0 => '/<span id=[\'\"]companyprofile[\'\"]>([\s\S]*?)<\/span>/',
                // note: note use 1 => '/<div class="desc_company content_fck">([\s\S]*?)<\/div>/',
                ),
            'website' => array(
                0 => array(
                    0 => '/<span id=[\'\"]companyprofile[\'\"]>[\s\S]*?Website:([\s\S]*?)<\/span>/',
                )
                ),
            'email' => array(),
            'address' => array(
                0 => '/<span class=[\'\"]company-address block[\'\"]>([\s\S]*?)<\/span>/'
                ),
            'ref' => array(
                0 => null,
            )
        )
    );*/
    public $url_categories = 'http://vietnamworks.com';
    public function getUrlCategory($uri) {
        return $uri;
    }
    public function generateUrlSearch($url, $params = array('page' => 1)) {
        $page = $params['page'];
        return $url."/trang-$page";
    }
    public function getPagesPagination($total) {
        $pages = ceil($total/50);
        return (int)$pages;
    }
    
     public function parseLocations($content){
        $locations = array();
        foreach ($this->patterns['works-location-list'] as $location) {
            $content_list_locations = html_entity_decode(trim($this->getValFromParrerns($content, $location)));
            if (!empty($content_list_locations)) {
                $locations = explode(',', $content_list_locations);
                return $locations;
            }
        }
        return $locations;
    }
  
    public function parseWork($content) {
        $work = array();
        //Check allowed location
        $location = $this->parseLocations($content); 
       
        if ($this->is_allowed_location($location)) {
            $work = array(
                'title' =>  $this->getValFromParrerns($content, $this->patterns['works-title']),
                'description' =>  $this->getValFromParrerns($content, $this->patterns['works-description']),
                'requirements' => trim($this->getValFromParrerns($content, $this->patterns['works-requirements'])),
                'location' =>  $location,
                'created' =>  0,//Created date already gotten in crawl_works.php
                'end' =>  $this->getExpired($this->getValFromParrerns($content, $this->patterns['works-expired'])),
                'company_name' => $this->escape_string($this->getValFromParrerns($content, $this->patterns['company-name'])),
                'company_description' =>  $this->getValFromParrerns($content, $this->patterns['company-description']),
                'company_website' =>  $this->getValFromParrerns($content, $this->patterns['company-website']),
                'company_email' =>  $this->getValFromParrerns($content, $this->patterns['company-email']),
                'company_address' =>  $this->getValFromParrerns($content, $this->patterns['company-address']),
                'category_id' => KEY_WORK
            );
            global $uti;
            $work['slug'] = $uti->create_slug($work['title']);
            $work['created'] = empty($work['created'])?date ("Y-m-d H:i:s", time()):date ("Y-m-d H:i:s", $work['created']);
            if (!empty($work['end'])) {
                $work['end'] = date('Y:m:d H:i:s', $work['end']);
            }
            if (empty($work['company_name'])) {
                $this->findCompanyInfo($content, $work);
            }
        }
        if (empty($work['title'])) return NULL;
        return $work;
    }
    public function findCompanyInfo($content, &$work) {
        $url = $this->getValFromParrerns($content, $this->patterns['company-ref']);
        if (!empty($url)) {
            $content_company_info = $this->getPageContent($url);
            $work['company_name'] = $this->getValFromParrerns($content_company_info, $this->patterns['company-name']);
            $work['company_description'] = $this->getValFromParrerns($content_company_info, $this->patterns['company-description']);
        }
    }
    /**
     * 
     * @param type $content
     * @param type $patterns
     * @return type list
     */
    public function getListOfCreatedDate($content, $patterns=NULL){
        //List of created date
        (empty($patterns))? $patterns=$this->patterns['works-created']:$patterns;
        return parent::getListOfCreatedDate($content, $patterns);
    }
        
}