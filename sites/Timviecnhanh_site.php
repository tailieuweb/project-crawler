<?php

require_once 'Sites.php';

class Timviecnhanh_site extends Sites {
    public $results = 0;
    public $patterns = array();/* array(
        'categories' => array(
            'list' => array(
                0=>'/Việc làm theo ngành nghề[\s\S]*?<article.*?>([\s\S]*?)<\/article>/',
            ),
            'item' => array(
                0=>'/<li>[\s\S]*?<a.*?href="(.*?)".*?>([\s\S]*?)<\/a>/',
            ),
        ),
        'works' => array(
            'total' => array(
                0 => '/Việc làm ngành[\s\S]*?<span class="count">\((.*?)\)<\/span>/'
            ),
            'list' => array(
                0 => '/<div class="box-content">[\s\S]*?Việc làm ngành[\s\S]*?<article.*?>[\s\S]*?<tbody>([\s\S]*?)<\/tbody>/'
            ),
            'item' => array(
                0 => '/<a href="(.*?)" class="item".*?>/'
            ),
            'title'  =>  array(
                0 => '/<h1 class="title font-roboto text-primary">([\s\S]*?)<\/h1>/'
            ),
            'description'   => array(
                0 => '/<b>Mô tả<\/b>[\s\S]*?<td width.*?>([\s\S]*?)<\/td>/',
                1 => '/<b>Mô tả<\/b>[\s\S]*?<p>([\s\S]*?)<\/p>/'
                ),
            'requirements' => array(
                0 => '/<b>Yêu cầu<\/b>[\s\S]*?<td width.*?>([\s\S]*?)<\/td>/',
                1 => '/<b>Yêu cầu<\/b>[\s\S]*?<p>([\s\S]*?)<\/p>/'
                ),
            'other' => array(
                
                ),
            'location' => array(
                0 => array(
                        'list' => '/<b>- Tỉnh\/Thành phố:<\/b>([\s\S]*?)<\/li>/',
                        'item' => '/<a.*?>(.*?)<\/a>/'
                    )
                ),
            'created' => array(
                0 => '/Cập nhật(.*?) \|/',
                ),
            'end' => array(
                0 => '/<b>Hạn nộp<\/b>[\s\S]*?<td width.*?>([\s\S]*?)<\/td>/',
                1 => '/<b>Hạn nộp<\/b>[\s\S]*?<b class="text-danger">([\s\S]*?)<\/b>/',
                ),
            ),
        'company' => array(
            'name' => array(
                0 => '/<h3.*?>([\s\S]*?)<\/h3>[\s\S]*?<span>Địa chỉ/'
            ), 
            'description' => array(
                0 => '/<b>Khái quát<\/b>[\s\S]*?<td width.*?>([\s\S]*?)<\/td>/',
                1 => '/<b>Khái quát<\/b>[\s\S]*?<p>([\s\S]*?)<\/p>/'
            ), 
            'address' => array(
                0 => '/<span>Địa chỉ:(.*?)<\/span>/'
            ), 
            'website' => array(
                0 => '/<th>Website<\/th>[\s\S]*?<td>([\s\S]*?)<\/td>/',
                1 => '/<b>Website:<\/b>[\s\S]*?(.*?)<\/p>/'
            ), 
            'email' => array(
                0 => '/<b>Email<\/b>[\s\S]*?<td width.*?>([\s\S]*?)<\/td>/',
                1 => '/<b>Email<\/b>[\s\S]*?<p>(.*?)<\/p>/',
            ), 
        )
    );*/
    public $url_categories = '';

    public function getUrlCategories() {
        return $this->url_categories;
    }

    public function getUrlCategory($uri) {
        return $this->url_categories . $uri;
    }

    public function generateUrlSearch($url, $params = array('page' => 1)) {
        $page = $params['page'];
        return $url."?page=$page";
    }

    public function getPagesPagination($total) {
        return ceil($total/15);
    }
    
    public function parseWork($content) {
        $work = array();
        //Check allowed location
        $location = $this->parseLocations($content);
        if ($this->is_allowed_location($location)) {
            $work = array(
                'title' =>  $this->getValFromParrerns($content, $this->patterns['works-title']),
                'description' =>  $this->getValFromParrerns($content, $this->patterns['works-description']),
                'requirements' => $this->getValFromParrerns($content, $this->patterns['works-requirements']),
                'location' =>  $location,
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
    
    /**
     * Remove html tag
     * Remove ( )
     * Remove trim
     * @param type $string
     */
    public function escape_string($string) {
        //Remove html tag
        $string = preg_replace('/<.*?>/', '', $string);
        $string = preg_replace('/\(.*?\)/', '', $string);
        return trim($string);
    }
}
