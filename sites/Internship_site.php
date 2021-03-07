<?php
require_once 'Sites.php';
class Internship_site extends Sites{
    public $results = 1;
    public $job_type = 6;
    public $patterns = array();/*array(
        'categories' => array(
            'list'  => array(),
            'item'    =>  array(
                0=>'/<a href=[\'\"](.*?)[\'\"]>([\s\S]*?)\(/',
            ),
        ),
        'works' => array(
            'total' =>  NULL,
            'list'  =>  NULL,
            'item'  =>  array(
              0 =>   '/<tr class=[\'\"]tpj_row.*?>[\s\S]*?<td>[\s\S]*?<td.*?>[\s\S]*?<td.*?>[\s\S]*?<td>[\s\S]*?<a href=[\'\"](.*?)[\'\"]/',
            ),
            'title'  =>  array(
                0 => '/<h1 class=[\'\"]job_title[\'\"]>(.*?)<\/h1>/'
                ),
            'description'   =>  array(
                0 => '/<h4>THÔNG TIN CHI TIẾT<\/h4>([\s\S]*?)<h4>THÔNG TIN CÔNG TY<\/h4>/'
                ),
            'requirements'  =>  array(
                0 => NULL,
            ),
            'location'  =>  array(
                0 => '/Nơi làm việc[\s\S]*?<td.*?>([\s\S]*?)<\/td>/'
            ),
            'created' => array(
                0 => '/<tr class=[\'\"]tpj_row.*?>[\s\S]*?<td>[\s\S]*?<td.*?>([\s\S]*?)<\/td>/'
            ),
            'end' => array(
                0 => '/Ngày hết hạn<\/td>[\s\S]*?<td.*?>([\s\S]*?)<\/td>/'
            )
        ),
        'company' => array(
            'name' => array(
                0 => '/company_name[\s\S]*?<a.*?>(.*?)<\/a>/'
            ),
            'description' => array(
            ),
            'address' => array(
                0 => '/Nơi làm việc[\s\S]*?<td.*?>([\s\S]*?)<\/td>/'
            ),
            'website' => array(
            ),
            'email' => array(
            ),
        )
    );*/
    public $url_categories = 'http://www.internship.edu.vn';
    public function getUrlCategory($uri) {
        return $this->url_categories.$uri;
    }
    public function generateUrlSearch($url, $params = array('page' => 1)) {
        $page = $params['page'];
        $params = array(
            'limit' =>  100,
            'limitstart' => 0
        );
        return $url."?limit=0";//"?page=$page";
    }
    public function getPagesPagination($total) {
        return (int)$total;
    }
    public function getUrlsListOfWorks($content) {

        $urls = parent::getUrlsListOfWorks($content);
        //
        if (empty($urls))            return NULL;
        $max = count($urls);
        for ($i = 0; $i < $max; $i++) {
            $urls[$i] = $this->url_categories.$urls[$i];
        }
        //Posted
        $this->posted = $this->getValsFromParrerns($content, $this->patterns['works-posted']);
        if (!empty($this->posted)) {
            foreach ($this->posted as $index => $posted) {
                $this->posted[$index] = $this->getExpired(trim($posted));
            }
        }
        return $urls;
    }
   
    public function parseWork($content) {
        $work = array();
        $location = $this->parseLocations($content);
        if ($this->is_allowed_location($location)) {
            $work = array(
                'title' =>  $this->getValFromParrerns($content, $this->patterns['works-title']),
                'description' =>  $this->getValFromParrerns($content, $this->patterns['works-description']),
                'requirements' => $this->getValFromParrerns($content, $this->patterns['works-requirements']),
                'location' =>  $location,
                'created' =>  0,//Created date already gotten in crawl_works $this->getExpired($this->getValFromParrerns($content, $this->patterns['works']['created'])),
                'end' =>  $this->getExpired($this->getValFromParrerns($content, $this->patterns['works-end'])),
                'company_name' =>  $this->getValFromParrerns($content, $this->patterns['company-name']),
                'company_description' =>  $this->getValFromParrerns($content, $this->patterns['company-description']),
                'company_website' =>  $this->getValFromParrerns($content, $this->patterns['company-website']),
                'company_email' =>  $this->getValFromParrerns($content, $this->patterns['company-email']),
                'company_address' =>  $this->getValFromParrerns($content, $this->patterns['company-address']),
                'category_id' => KEY_INTERNSHIP
            );
            if (empty($work['title'])) return NULL;
            global $uti;
            $work['slug'] = $uti->create_slug($work['title']);
            //remove slashes if you want to assign current time when created time is NULL $work['created'] = empty($work['created'])?date ("Y-m-d H:i:s", time()):date ("Y-m-d H:i:s", $work['created']);
            if (!empty($work['end'])) {
                $work['end'] = date('Y:m:d H:i:s', $work['end']);
            }
        }
        return $work;
    }
    public function parseLocations($content){
        $location = '';
        $address = $this->getValFromParrerns($content, $this->patterns['works-location']);
        if (!empty($address)) {
            $arr = explode(',', $address);
            $location = trim(end($arr));
        }
        return $location;
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