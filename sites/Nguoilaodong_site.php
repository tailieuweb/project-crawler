<?php
require_once 'Sites.php';
class Nguoilaodong_site extends Sites{
    public $results = 0;
    public $patterns = array();/*array(
        'categories' => array(
            'list'  => array(
                0=>'/<div class=[\"\']widget widget\-pro[\"\']>[\s\S]*?<div class=[\"\']widget-body[\"\']>([\s\S]*?)<\/div>/',
                ),
            'item'  =>  array(
                0=>'/<li><a href=[\'\"](.*?)[\'\"]>(.*?)<\/a>/',
                ),
        ),
        'works' => array(
            'total' => array(
                0 => '/<div class="pagination pagination-right">[\s\S]*?<div.*?>[\s\S]*?\/(.*?)<\/div>/'
            ),
            'list'  => array(
                0 => '/<table class=[\'\"]table table-hover[\'\"]([\s\S]*?)<\/table>/',
            ),
            'item'  => array(
                0 => '/<tr.*?>[\s\S]*?<td>[\s\S]*?<td.*?>[\s\S]*?<a.*?href=[\'\"](.*?)[\'\"]/'
            ),                
            'created' => array(
                0 =>'/<tr >[\s\S]*?(\d{2}-\d{2}-\d{4})[\s\S]*?<\/tr>/',
            ),
            'title' => array(
                0 => '/<strong>VỊ TR&Iacute; TUYỂN:<\/strong>([\s\S]*?)<\/tr>/',
                1 => '/<span style="font-size:14px"><strong>(.*?)<\/strong>/',
                2 => '/<div class=[\'\"]page-header[\'\"]>[\s\S]*?<h3>([\s\S]*?)<\/h3>/'
                ),
            'description' => array(
                0 => '/<u><strong>M&Ocirc; TẢ C&Ocirc;NG VIỆC:&nbsp;<\/strong><\/u>([\s\S]*?)<strong>/',
                1 => '/<span style=[\'\"]font-family:times new roman,times,serif[\'\"]>M&Ocirc; TẢ C&Ocirc;NG VIỆC<\/span>([\s\S]*?)<p>/',
                2 => '/<h5><span>Mô tả công việc<\/span><\/h5>[\s\S]*?<table.*?>([\s\S]*?)<\/table>/',
                3 => '/<strong>M&Ocirc; TẢ C&Ocirc;NG VIỆC<\/strong>([\s\S]*?)<strong>/'   ,//regex conflict! 3 => '/M&Ocirc; TẢ C&Ocirc;NG VIỆC[\s\S]*?<\/strong>([\s\S]*?)<span.*? >/',
                4 => '/M&ocirc; tả c&ocirc;ng việc:<\/strong>([\s\S]*?)<\/li>/',
                5 => '/<strong>M&ocirc; tả.*?<\/strong>([\s\S]*?)<strong.*?>/',                
                6 => '/<strong>1\.M&ocirc; tả c&ocirc;ng việc.*?<\/strong>([\s\S]*?)<\/p>/',
                7 => '/1\..*?M&ocirc; tả([\s\S]*?)<strong>/',
                8 => '/<span style="color:#000000">M&ocirc; tả c&ocirc;ng việc:<\/span>[\s\S]*?<\/div>([\s\S]*?)<\/div>/',
                9 => '/<strong>Mô tả công việc:<\/strong>([\s\S]*?)<\/p>/',
                10 => '/<strong>M&ocirc; tả c&ocirc;ng việc<\/strong>[\s\S]*?<\/td>([\s\S]*?)<\/td>/',
                ),
            'requirements' => array(
                0 =>'/<span style="color:#000000">Y&ecirc;u cầu kh&aacute;c:<\/span>[s\S]*?<\/div>([\s\S]*?)<\/div>/',
                1 => '/<td><strong>Kỹ năng yêu cầu<\/strong><\/td>[\s\S]*?<td>([\s\S]*?)<\/td>/',
                2 => '/<p style=[\'\"]text-align:justify[\'\"]><strong>Y&ecirc;u cầu<\/strong><\/p>[\s\S]*?<td>([\s\S]*?)<\/td>/',
                3 => '/<strong>.*?Điều kiện<\/strong>([\s\S]*?)<strong>/',
                4 => '/<strong>Y&ecirc;u cầu:<\/strong>([\s\S]*?)<strong>/',
                5 => '/<p><strong>Y&Ecirc;U CẦU CHUNG<\/strong><\/p>[\s\S]*?<div class=[\'\"]JobRequirements[\'\"].*?>([\s\S]*?)<\/table>/',
                6 => '/<strong><u>Y&Ecirc;U CẦU ỨNG VI&Ecirc;N:&nbsp;<\/u><\/strong>([\s\S]*?)<strong>/',
                7 => '/<strong>Y&ecirc;u cầu kh&aacute;c<\/strong>([\s\S]*?)<\/tr>/',
                8 => '/<strong>Y&ecirc;u cầu&nbsp;&nbsp;<\/strong>([\s\S]*?)<strong>/',
                9 => '/<strong>Y&ecirc;u cầu<\/strong>[\s\S]*?<td.*?>([\s\S]*?)<\/td>/',
                10 => '/<strong>Y&Ecirc;U CẦU KH&Aacute;C[\s\S]*?([\s\S]*?)<strong>/',
                11 => '/<p>Y&ecirc;u cầu:([\s\S]*?)<\/p>/',
                12 => '/<strong>M&Ocirc; TẢ C&Ocirc;NG VIỆC<\/strong>([\s\S]*?)<strong>/',
                13 => '/<strong>Y&ecirc;u cầu([\s\S]*?)<strong>/',
                14 => '/Y&ecirc;u cầu<\/strong>([\s\S]*?)<\/ul>/',
                15 => '/Y&ecirc;u cầu hồ sơ<\/strong>([\s\S]*?)<strong>/'
                ),
            'other' => array(
            ),
            'locations'  => array(
                0 => array(
                    'list' => array(
                        0 => '/<td><strong>Nơi làm việc<\/strong><\/td>[\s\S]*?<td>(.*?)<\/td>/',
                        1 => '/<i>Địa điểm làm việc:.*?<strong>(.*?)<\/strong>/',
                    ), 
                    'item' => ''
                    )
                ),
            'expired' => array(
                0 => '/<strong>Hạn nộp hồ sơ.*?<\/strong>[\s\S]*?<td>([\s\S]*?)<\/td>/',
                1 => '/<strong>HẠN NỘP HỒ SƠ:<\/strong>([\s\S]*?)<\/p>/',
                3 => '/Hạn nộp hồ sơ:(.*?)<br/',
                // regex conflict return ":" for some arcticle 4 => '/<strong>Hạn nộp hồ sơ(.*?)<\/strong>/',
                5 => '/<strong>Thời hạn nộp hồ sơ:<\/strong>([\s\S]*?)<\/li>/',
                6 => '/<li>Hạn nộp hồ sơ(.*?)<\/li>/',
                7 => '/<strong>Thời gian gửi hồ sơ.*?<\/strong>[\s\S]*?<span.*?>(.*?)<\/span>/',
                8 => '/<em>Thời gian gửi hồ sơ.*?<\/em>[\s\S]*?<span.*?>(.*?)<\/span>/',
                9 => '/<em>*Hạn nộp hồ sơ:<\/em>[\s\S]*?<span.*?>(.*?)<\/span>/',
                10 => '/Hạn nộp hồ sơ:<\/span>[\s\S]*?([\s\S]*?)<\/tr>/',
                11 => '/Hạn nộp hồ sơ[\s\S]*?<\/span>(.*?)<\/span>/',
                12 => '/<p style=[\'\"]text-align:justify[\'\"]><strong>Hạn nộp<\/strong><\/p>[\s\S]*?<td>([\s\S]*?)<\/td>/',
                13 => '/<strong>Hạn nộp Hồ sơ<\/strong>([\s\S]*?)<\/tr>/',
                14 => '/Hạn nộp&nbsp;&nbsp; &nbsp;([\s\S]*?)<\/span>/',
                15 => '/<strong>Hạn nộp<\/strong>([\s\S]*?)<\/tr>/',
                16 => '/<strong>Hạn nộp hồ sơ[\s\S]*?<\/td>([\s\S]*?)<\/tr>/',
            )
        ),
        'company' => array(
            'name'  => array(
                0 => '/<tr>[\s\S]*?<strong>Tên công ty<\/strong><\/td>[\s\S]*?<td>(.*?)<\/td>/',
                1 => '/<i>Đơn vị \/ Ứng viên:<\/i>[\s\S]*?(.*?)<\/strong>/',
                ),
            'description' => array(
                0 => '/<td valign=[\'\"]top[\'\"]>([\s\S]*?)<\/td>/',
                1 => '/<div class="CompanyName".*?>[\s\S]*?([\s\S]*?)<\/tr>/',
                2 => '/<p style="text-align:justify"><strong>Kh&aacute;i qu&aacute;t<\/strong><\/p>([\s\S]*?)<\/tr>/',
                3 => '/<strong>Giới thiệu<\/strong>[\s\S]*?<td.*>[\s\S]*?([\s\S]*?)<\/tr>/',
                4 => '/<strong>TH&Ocirc;NG TIN C&Ocirc;NG TY[\s\S]*?([\s\S]*?)<strong>/',
                ),
            'website' => array(
                0 => '/<strong>Thông tin liên hệ:<\/strong>[\s\S]*?www.([\s\S]*?)<\/td>/',
                1 => '/<p style=[\'\"]text-align:justify[\'\"]>Website:(.*?)<\/p>/',
                2 => '/<strong>Website<\/strong>[\s\S]*?<td.*?>([\s\S]*?)<\/tr>/',
                3 => '/<p>Website:([\s\S]*?)<\/p>/',
                
            ),
            'email' => array(
                0 => '/<tr>[\s\S]*?<strong>Email<\/strong><\/td>[\s\S]*?<td>(.*?)<\/td>/'
                ),
            'address' => array(
                0 => '/<td><strong>Địa chỉ công ty<\/strong><\/td>([\s\S]*?)<\/td>/',
                1 => '/<p style=[\'\"]text-align:justify[\'\"]>Địa chỉ<\/p>[\s\S]*?<\/td>([\s\S]*?)<\/td>/',
                2 => '/<td><strong>Địa chỉ công ty<\/strong><\/td>([\s\S]*?)<\/td>/',///<i>Thông tin liên hệ:<\/i>[\s\S]*?Địa chỉ:([\s\S]*?)<\/td>/
                3 => '/<strong>Địa chỉ<\/strong>([\s\S]*?)<\/tr>/',
                4 => '/<strong>Địa chỉ<\/strong>([\s\S]*?)<\/tr>/',
                5 => '/<br \/>[\s\S]*?Địa chỉ:([\s\S]*?)<\/span>/',
                6 => '/<p>Địa chỉ:([\s\S]*?)<\/p>/',
                )
        )
    );*/
    public $url_categories = 'http://vieclam.nld.com.vn/';
    public function getUrlCategory($uri) {
        return $this->url_categories.$uri;
    }
    public $url_list_works = NULL;
    public function generateUrlSearch($url, $params = array()) {
        if (empty($this->url_list_works)) {            
            $var = array('url_response' => TRUE);
            $this->getPageContent($url, $var);
            $this->url_list_works = $var['url_response'];
        }
        if (!empty($params)) {
            return $this->url_list_works.'&p='.$params['page'];
        }
        return $this->url_list_works;
    }

    public function getPagesPagination($total) {
        $total = trim($total);
        $pages = ceil($total/15);
        return (int)$pages;
    }
   public function parseWork($content) {
        $works = array();
        //Check allowed location
        $location = $this->parseLocations($content);
     
        if ($this->is_allowed_location($location)) {
            $work = array(
                'title' =>  $this->getValFromParrerns($content, $this->patterns['works-title']),
                'description' =>  $this->escape_string($this->getValFromParrerns($content, $this->patterns['works-description'])),
                'requirements' => $this->escape_string($this->getValFromParrerns($content, $this->patterns['works-requirements'])),
                'other' => $this->getValFromParrerns($content, $this->patterns['works-other']),
                'location' =>  trim($location),
                'created' =>  0,//Created date already gotten in crawl_works $this->getExpired($this->getValFromParrerns($content, $this->patterns['works']['created'])),
                'end' =>  $this->getExpired($this->getValFromParrerns($content, $this->patterns['works-expired'])),
                'company_name' =>  $this->getValFromParrerns($content, $this->patterns['company-name']),
                'company_description' =>  trim($this->getValFromParrerns($content, $this->patterns['company-description'])),
                'company_website' =>  $this->getValFromParrerns($content, $this->patterns['company-website']),
                'company_email' =>  $this->getValFromParrerns($content, $this->patterns['company-email']),
                'company_address' =>  $this->getValFromParrerns($content, $this->patterns['company-address']),
                'type' => KEY_WORK,
            );
            $work['created'] = empty($work['created'])?date ("Y-m-d H:i:s", time()):date ("Y-m-d H:i:s", $work['created']);
            if (!empty($work['end'])) {
                $work['end'] = date('Y:m:d H:i:s', $work['end']);
            }
        }
        if (empty($work['title'])) return NULL;
        return $work;
    }
    public function getUrlsListOfWorks($content) {
        foreach ($this->patterns['works-list'] as $parten){
            $content_list_of_works = $this->parsePageContent($content, $parten);
            if(!empty($content_list_of_works)) break;
        }
        
        if (empty($content_list_of_works))            return NULL;
        //Url
        
        foreach ( $this->patterns['works-item'] as $item){
            $urls = $this->parsePageContent($content_list_of_works[1][0],$item);
            if(!empty($urls)) break;
        }
        
        if (empty($urls))            return NULL;
        $max = count($urls[1]);
        for ($i = 0; $i < $max; $i++) {
            $urls[1][$i] = $this->url_categories.$urls[1][$i];
        }
        //Posted
        $posted = $this->parsePageContent($content_list_of_works[1][0], $this->patterns['works-posted']);
        if (!empty($posted[1])) {
            $max = count($posted[1]);
            $this->posted = array();
            for ($i = 0; $i < $max; $i++) {
               $this->posted[]  = $this->getExpired($posted[1][$i]);
            }
        }
        return $urls[1];
    }
    public function parseLocations($content){
        $locations = array();
        foreach ($this->patterns['works-locations-list'] as $location) {
            $content_list_locations = trim($this->getValFromParrerns($content, $location));
            if (!empty($content_list_locations)) {
                $locations = explode(',', $content_list_locations);
                return $locations;
            }
        }
        return $locations;
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
