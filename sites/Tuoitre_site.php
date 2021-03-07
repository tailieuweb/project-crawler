<?php
require_once 'Sites.php';
class Tuoitre_site extends Sites{
    public $results = 0;
    public $patterns = NULL; /*array(
        'categories' => array(
            'list'  => array(
                0 => '/<div class="block JobByCategory">([\s\S]*?)<div class="threecoln">/',
            ),
            'item'  => array(
                0 =>  '/<li><a href=[\'\"](.*?)[\'\"].*?>(.*?)<\/a>/',
            )
        ),
        'works' => array(
            'total' =>  array(
                0 => '/<div class=[\"\']ListSearchResume[\"\']>.*?<span>(.*?)<\/span>/',
                1 => '/<div class="count-job">.*?<span>(.*?)<\/span>.*?<\/div>/'
             ),
            'list'  => NULL,
            'item'  => array(
                0 => '/<dd class="brief.*?">[\s\S]*?<span class="jobtitle">[\s\S]*?<p><a.*?href="(.*?)".*?>/'
            ),
            'title' => array(
                0 => '/<p.*?itemprop="title">(.*?)<\/p>/',
                1 => '/<h2 itemprop="title">(.*?)<\/h2>/',
                2 => '/<h1 itemprop="title">(.*?)<\/h1>/',
                3 => '/<div class="TitleJoblarge".*?><h1>(.*?)<\/h1>/',
                4 =>'/<h1><a.*\">(.*?)<\/h1>/',
                5 =>'/<div class="title320" itemprop="title">[\s\S]?<h1>(.*?)<\/div>/'
            ),
            'description' => array(
                0 => '/<div style="font-family: Arial" itemprop="description">([\s\S]*?)<\/div>/',
                1 => '/<div.*?itemprop="description">([\s\S]*?)<\/div>/'
            ),
            'requirements' => array(
                0 => '/<div style="font-family: Arial" itemprop="experienceRequirements">([\s\S]*?)<\/div>/', 
                1 => '/<div.*?itemprop="experienceRequirements">([\s\S]*?)<\/div>/',
                2 => '/<p class=[\'\"]title_job_info[\'\"]>Yêu Cầu Công Việc[\s\S]*?<div.*?>([\s\S]*?)<\/div/',
              
            ),
            'location' => array(
                0 => array(
                        'list' => '/<p.*?itemprop="jobLocation">([\s\S]*?)<\/p>/',
                        'item' => '/<a.*?>(.*?)<\/a>/'
                    ),
                1 => array(
                        'list' => '/<b.*?itemprop="jobLocation">([\s\S]*?)<\/b>/',
                        'item' => '/<a.*?>(.*?)<\/a>/'
                    ),
            ),
            'created' => array(
                //0 => '/<div class="datepost">Ngày đăng:(.*?)<\/div>/',
                1=> '/<p class=[\'\"]dateposted[\'\"]>[\s\S]*?([\d{2}\/d{2}\/d{4}]*?)<\/p>/',
            ),
            'expired' => array(
                0 => '/<p class="col_left_76">Hết hạn nộp<\/p>([\s\S]*?)<\/p>/',
                1 => '/<span>Hết hạn nộp:.*?<\/span>([\s\S]*?)<\/p>/',
            )
        ),
        'company' => array(
            'name' => array(
                0 => '/<p class="title_comp".*?itemprop="name">(.*?)<\/p>/',
                1 => '/<div class="tit_company">(.*?)<\/div>/',
                2 => '/<p class="title_comp".*?>(.*?)\</p>/',
                3 => '/<div class=[\'\"]JobCompany[\'\"]>[\s\S]*?<h3>(.*?)<\/h3>/'
                ),
            'description' => array(
                1 => '/<div class="desc_company content_fck">([\s\S]*?)<\/div>/',   
                2 => '/<div class="content_intro">[\s\S]*?<p>.*?http[\s\S]*?<p>([\s\S]*?)<\/p>/',
                3 => '/<div class="content_intro">[\s\S]*?<p>.*?www[\s\S]*?<p>([\s\S]*?)<\/p>/',
                4 => '/<div class="content_intro">[\s\S]*?<p>([\s\S]*?)<\/p>/',
                5 => '/<div class="intro_company">[\s\S]*?<\/p>[\s\S]*?<\/p>([\s\S]*?)<\/p>/',
                ),
            'website' => array(
                0 =>'/<span class="MarginRight30">([\s\S]*?)<\/span>/', //note: regex conflict /<div class="content_intro">([\s\S]*?)<\/p>/
                1 =>'/<div class=[\'\"]content_intro[\'\"]>[\s\S]*?<p>http:\/\/([\s\S]*?)<\/p>/',
                2 =>'/<p class="title_comp"[\s\S]*?<\/p>[\s\S]*?<p>www.([\s\S]*?)<\/p>/',
                3 =>'/<div class="intro_company">[\s\S]*?\">http:\/\/(.*?)<\/p/',
                4 =>'/<div class="intro_company">[\s\S]*?<div class="content_intro">[\s\S]*?(.*?)<\/p>/',
                ),
            'email' => array(),
            'address' => array(
                0 => '/<label itemprop="addressLocality">(.*?)<\/label>/'
                ),
            'ref' => array(
                0 => null,
            )
        )
    );*/
    public $url_categories = 'http://vieclam.tuoitre.vn';
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
                'title' =>  $this->getValFromParrerns($content, $this->patterns['works-title']),
                'description' =>  $this->escape_string($this->getValFromParrerns($content, $this->patterns['works-description'])),
                'requirements' => $this->escape_string($this->getValFromParrerns($content, $this->patterns['works-requirements'])),
                'location' =>  $location,
                'created' =>  0,//$this->getExpired($this->getValFromParrerns($content, $this->patterns['works']['created'])),
                'end' =>  $this->getExpired($this->getValFromParrerns($content, $this->patterns['works-expired'])),
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
