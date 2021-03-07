<?php
require_once 'Sites.php';

class Careerlink_site extends Sites {

    public $results = 0;
    public $patterns = array();
    public $url_categories = 'http://www.careerlink.vn';

    public function getUrlCategory($uri) {
        return $this->url_categories . $uri;
    }

    public function generateUrlSearch($url, $params = array('page' => 1)) {
        $page = $params['page'];
        return $url . "?page=$page";
    }

    public function getPagesPagination($total) {
        $total = preg_replace('/,/', '', $total);
        $pages = ceil($total / 30);
        return (int) $pages;
    }
    
    public function getUrlsListOfWorks($content) {
        $urls = parent::getUrlsListOfWorks($content);
        if (!empty($urls)) {
            $max = count($urls);
            for ($i = 0; $i < $max; $i++) {
                $urls[$i] = $this->url_categories.$urls[$i];
            }
        }
        return $urls;
    }
    public function parseWork($content) {
        $works = array();
        //Check allowed location
        $location = $this->parseLocations($content);
        
        if ($this->is_allowed_location($location)) {
            $work = array(
                'title' => $this->escape_string($this->getValFromParrerns($content, $this->patterns['works-title'])),
                'description' =>  $this->escape_string($this->getValFromParrerns($content, $this->patterns['works-description'])),
                'requirements' => $this->escape_string($this->getValFromParrerns($content, $this->patterns['works-requirements'])),
                'location' =>  $location,
                'created' =>  $this->getExpired($this->getValFromParrerns($content, $this->patterns['works-created'])),
                'start' =>  $this->getExpired($this->getValFromParrerns($content, $this->patterns['works-created'])),
                'end' =>  $this->getExpired($this->getValFromParrerns($content, $this->patterns['works-end'])),
                'company_name' =>  $this->getValFromParrerns($content, $this->patterns['company-name']),
                'company_description' =>  $this->escape_string($this->getValFromParrerns($content, $this->patterns['company-description'])),
                'company_website' =>  $this->getValFromParrerns($content, $this->patterns['company-website']),
                'company_email' =>  $this->getValFromParrerns($content, $this->patterns['company-email']),
                'company_address' =>  $this->getValFromParrerns($content, $this->patterns['company-address']),
                    'category_id' => KEY_WORK
            );
            global $uti;
            $work['slug'] = $uti->create_slug($work['title']);
            $work['created'] = empty($work['created'])?date ("Y-m-d H:i:s", time()):date ("Y-m-d H:i:s", $work['created']);
            $work['start'] = empty($work['start'])?date ("Y-m-d H:i:s", time()):date ("Y-m-d H:i:s", $work['start']);
            if (!empty($work['end'])) {
                $work['end'] = date('Y:m:d H:i:s', $work['end']);
            }
        }
        if (empty($work['title'])) return NULL;
        return $work;
    }
    public function escape_string($string) {
        
        $string = html_entity_decode($string);
        
        return trim($string);
    }
}