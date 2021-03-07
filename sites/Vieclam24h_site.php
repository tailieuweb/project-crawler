<?php
require_once 'Sites.php';
class Vieclam24h_site extends Sites {
    public $results = 0;
    public $patterns = array();/* array(
        'categories' => array(
            'list'  => array(
                0=>'/<div class=[\'\"]padB10[\'\"]>([\s\S]*?)<div class=[\'\"]aRight marB10[\'\"]>/',
            ),
            'item'  =>  array(
                0=>'/<a href=[\'\"](.*?)[\'\"].*?>(.*?)\(/',
            ),
        ),
        'works' =>  array(
            'total' =>  array(
                0 => '/page=(\d*)[\'\"] >Cu&#7889;i/'
            ),
            'list'  =>  NULL,
            'item'  =>  array(
                0 =>  '/<a href=[\'\"](.*?)[\'\"].*?onmouseover/',
            ),
            'title'  =>  array(
                0 => '/<h2>(.*?)<\/h2>/'
                ),
            'description'   =>  array(
                0 => '/Mô tả công việc[\s\S]*?<td.*?>([\s\S]*?)<\/td>/'
                ),
            'requirements'  =>  array(
                0 => '/Yêu cầu khác[\s\S]*?<td.*?>([\s\S]*?)<\/td>/'
                ),
            'locations'  =>  array(
                0 => array(
                        'list' => array(
                            0 => '/Địa điểm làm việc[\s\S]*?<td.*?>([\s\S]*?)<\/td>/',
                            ),
                        'item' => ''
                    )
                ),
            'created' => array(
                0 => '/Ngày làm mới.*?<b>(.*?)<\/b>/',
                ),
            'end' => array(
                0 => '/<b class=[\'\"]redTxt[\'\"]>(.*?)<\/b>/'
                )
        ),
        'company' => array(
            'name' => array(
                0 => '/Tên công ty[\s\S]*?<td.*?>([\s\S]*?)<\/td>/'
            ),
            'description' => array(
                0 => '/Giới thiệu[\s\S]*?<td.*?>([\s\S]*?)<\/td>/'
            ),
            'address' => array(
                0 => '/Địa chỉ liên hệ<\/b>[\s\S]*?<td.*?>([\s\S]*?)<\/td>/',
                1 => '/Địa chỉ liên hệ[\s\S]*?<td.*?>([\s\S]*?)<\/td>/'
            ),
            'website' => array(
                0 => '/Website[\s\S]*?<td.*?>([\s\S]*?)<\/td>/'
            ),
            'email' => array(
                0 => '/Email liên hệ<\/b>[\s\S]*?<td .*?>([\s\S]*?)<\/td>/',
                1 => '/Email liên hệ[\s\S]*?<td.*?>([\s\S]*?)<\/td>/'
            )
        )
    );*/
    public $url_categories = 'http://hcm.vieclam.24h.com.vn';
    public function getUrlCategory($uri) {
        return $this->url_categories.$uri;
    }
    public function generateUrlSearch($url, $params = array('page' => 1)) {
        $page = $params['page'];
        return $url."?number_items=20&page=$page";
    }
    public function getPagesPagination($total) {
        return (int)$total;
    }
    public function getUrlsListOfWorks($content) {
        $urls = parent::getUrlsListOfWorks($content);
        //TODO: check urls
        if (!empty($urls)) {
            $max = count($urls);
            for($i = 0; $i < $max; $i++) {
                $urls[$i] = $this->url_categories.$urls[$i];
            }
        }
        return $urls;
    }
  
    public function parseWork($content) {
        $work = array();
        //Check allowed location
        $locations = $this->parseLocations($content);
        if ($this->is_allowed_location($locations)) {

            $work = array(
                'title' =>  $this->getValFromParrerns($content, $this->patterns['works-title']),
                'description' =>  $this->getValFromParrerns($content, $this->patterns['works-description']),
                'requirements' => $this->getValFromParrerns($content, $this->patterns['works-requirements']),
                'location' =>  $locations,
                'created' =>  $this->getExpired($this->getValFromParrerns($content, $this->patterns['works-created'])),
                'end' =>  $this->getExpired($this->getValFromParrerns($content, $this->patterns['works-end'])),
                'company_name' =>  $this->getValFromParrerns($content, $this->patterns['company-name']),
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
        }
        if (empty($work['title'])) return NULL;
        return $work;
    }
    public function parseLocations($content){
        $locations = array();
        foreach ($this->patterns['works-locations-list'] as $location) {
           // $temp = array(1);
            $content_list_locations = trim($this->getValFromParrerns($content, $location));
           // $content_list_locations = trim($this->parsePageContent($content, $location['list'], $temp, TRUE));
            if (!empty($content_list_locations)) {
                $locations = explode(',', $content_list_locations);
                return $locations;
            }
        }
        return $locations;
    }
}