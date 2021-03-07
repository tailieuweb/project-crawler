<?php
require_once 'Sites.php';
class Tempalte_site extends Sites{
    public $results = 0;
    public $patterns = array(
        'categories' => array(
            'list'  => array(
                0 => '',
            ),
            'item'  => array(
                0 =>  '',
            )
        ),
        'works' => array(
            'total' =>  array(
                0 => '',
                1 => ''
             ),
            'list'  => NULL,
            'item'  => array(
                0 => ''
            ),
            'title' => array(
                0 => '',
                1 => '',
                2 => '',
            ),
            'description' => array(
                0 => '',
                1 => ''
            ),
            'requirements' => array(
                0 => '',
                1 => '',
              
            ),
            'location' => array(
                0 => array(
                        'list' => '',
                        'item' => ''
                    ),
                1 => array(
                        'list' => '',
                        'item' => ''
                    ),
            ),
            'created' => array(
                0 => ''
            ),
            'expired' => array(
                0 => '',
                1 => '',
            )
        ),
        'company' => array(
            'name' => array(
                0 => '',
                1 => '',
                ),
            'description' => array(
                0 => '',
                1 => '',
                ),
            'website' => array(
                0 => null
                ),
            'email' => array(),
            'address' => array(
                0 => ''
                ),
            'ref' => array(
                0 => null,
            )
        )
    );
    public $url_categories = 'http://';
    public function getUrlCategory($uri) {
        return $uri;
    }
    public function generateUrlSearch($url, $params = array('page' => 1)) {
        $page = $params['page'];
        return $url."/limit/50/page/$page";
    }
    public function getPagesPagination($total) {
        $pages = ceil($total/50);
        return (int)$pages;
    }

  
    public function parseWork($content) {
        $work = array();
        //Check allowed location
        $location = $this->parseLocations($content); 
        if ($this->is_allowed_location($location)) {
            $work = array(
                'title' =>  $this->getValFromParrerns($content, $this->patterns['works']['title']),
                'description' =>  $this->getValFromParrerns($content, $this->patterns['works']['description']),
                'requirements' => $this->getValFromParrerns($content, $this->patterns['works']['requirements']),
                'location' =>  $location,
                'created' =>  $this->getExpired($this->getValFromParrerns($content, $this->patterns['works']['created'])),
                'end' =>  $this->getExpired($this->getValFromParrerns($content, $this->patterns['works']['expired'])),
                'company_name' =>  $this->getValFromParrerns($content, $this->patterns['company']['name']),
                'company_description' =>  $this->getValFromParrerns($content, $this->patterns['company']['description']),
                'company_website' =>  $this->getValFromParrerns($content, $this->patterns['company']['website']),
                'company_email' =>  $this->getValFromParrerns($content, $this->patterns['company']['email']),
                'company_address' =>  $this->getValFromParrerns($content, $this->patterns['company']['address']),
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
        $url = $this->getValFromParrerns($content, $this->patterns['company']['ref']);
        if (!empty($url)) {
            $content_company_info = $this->getPageContent($url);
            $work['company_name'] = $this->getValFromParrerns($content_company_info, $this->patterns['company']['name']);
            $work['company_description'] = $this->getValFromParrerns($content_company_info, $this->patterns['company']['description']);
        }
    }
}