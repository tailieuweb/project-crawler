<?php
set_time_limit(0);
define('KEY_WORK', 5);
define('KEY_INTERNSHIP', 6);

date_default_timezone_set("Asia/Bangkok");
require_once '../config/config.php';
require_once '../libararies/uti.php';

require_once '../pages/RE.php';

require_once '../model/patterns_model.php';
require_once '../model/locations.php';


abstract class Sites {
    private $_proxy = array(
        'status' => 'OFF',
        'value' => '192.168.100.1:8080'
    );
    public $job_type = 5;
    public $id_site = 0;
    public $name = NULL;
    public $class = NULL;
    public $keywords = array();
    public $locations = array();
    public $categories = array();
    public $content = NULL;
    public $url_site = NULL;
    public $url_search = NULL;
    public $url_detail = NULL;
    public $matches = array();
    public $patterns = array(
        'pagination' => NULL,
        'url_detail' => NULL,
        'posted_date' => NULL,
        'content' => NULL,
        'total' => NULL,
        'company' => array(
            'name' => NULL,
            'address' => NULL,
            'profile' => NULL
        ),
        'job_detail' => array(
        )
    );
    public $posted = 0;
    public $allowed_locations = NULL; 
    
    public $pagination = array(
        'total' => 0,
        'per_pages' => 10,
        'start' => 1,
        'end' => 0
    );

    public function __construct($id_site=NULL) {
        //get location from database
        $obj_location = new Locations_model();
        $this->allowed_locations = array_map('strtolower',$obj_location->get_locations());
        
        //get pattern from database
        $obj_pattern = new Patterns_model();
        $this->id_site = $id_site;
        $this->patterns = $obj_pattern->get_patterns_site($this->id_site);
        
    }

    public function setPatterns() {
        
    }

    public function getPatterns() {
        
    }

    /**
     *
     * @param type $url
     * @param type $keyword
     * @param type $location
     * @param type $category
     * @param type $page
     */
    public function generateUrlSearch($url, $params = array()) {
        
    }

    /**
     * Url Search
     * @param type $url
     * @return type
     */
    public function setUrlSearch($url) {
        $this->url_search = $url;
        return $url;
    }

    public function getUrlSearch() {
        return $this->url_search;
    }

    /**
     * Url Detail
     * @param type $url
     * @return type
     */
    public function setUrlDetail($url) {
        $this->url_detail = $url;
        return $url;
    }

    public function getUrlDetail() {
        return $this->url_detail;
    }

    public function setPagination($total) {
        if (!empty($total)) {
            $this->pagination['total'] = $total;
            $this->pagination['end'] = (int) ceil($total / $this->pagination['per_pages']);
        }
    }

    /**
     *
     * @param type $url
     * @return type
     */
    public function getPageContent($url=null, &$var=NULL) {
            $ch = curl_init();
            $timeout = 5;
            $headers=array(
                'Accept'=>'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Encoding'=>'gzip, deflate',
                'Accept-Language'=>'vi-VN,vi;q=0.8,en-US;q=0.5,en;q=0.3',
                'Connection'=>'keep-alive',
                'DNT'=>1,
            );
            if ($var) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($var));
            }
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
            //Config as real browser
            curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0');
            
            if ($this->_proxy['status'] == 'ON') {
                curl_setopt($ch, CURLOPT_PROXY, $this->_proxy['value']);
            }
            
            //
            $content = curl_exec($ch);
            if (!empty($var)) {
                $var['url_response'] = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
            }
            curl_close($ch);
            $this->content = $content;
        
        return $content;
    }

    public function parsePageContent($content, $pattern, &$ret = array(2), $is_first_match = FALSE) {
        if (empty($pattern)) {
            return NULL;
        }
        if (empty($ret)) {
            $ret = array(1);
        }
        $results = NULL;
        preg_match_all($pattern, $content, $matches);
        if (!empty($matches[1])) {
            $results = $matches;
            if ($is_first_match) {
                $results = $results[1][0];
            }
        }
        return $results;
    }

    public function parseWorksList($matches) {
        $this->matches = $matches;
    }

    public function parseWorksDetail($urls) {
        
    }

    public function removeHtmlCode($content) {
        return preg_replace($this->patterns['remove_html'], '', $content);
    }

    public $url_categories = '';

    public function getUrlCategories() {
        return $this->url_categories;
    }
    public function getUrlCategory($uri) {
        return $uri;
    }
    public function getExpired($date) {
        if (empty($date)) return 0;
        $val = preg_replace('/\//', '-', $date);
        $val = preg_replace('/[a-zA-Z&;:]/', '', $val);
        $time = strtotime($val);
        if (empty($time)) return 0;
        return $time;
    }
    public function getValsFromParrerns($content, $patterns) {
        $vals = '';
        foreach ($patterns as $pattern) {
            $matches = $this->parsePageContent($content, $pattern);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $item) {
                    $vals[] = preg_replace('/<.*?>/', '', $item);
                }
                return $vals;
            }
        }
        return NULL;
    }
    public function getValFromParrerns($content, $patterns, $is_html = TRUE) {
        $val = '';    
        foreach ($patterns as $pattern) {
            $temp = array(1);
            $val = trim($this->parsePageContent($content, $pattern, $temp, TRUE));
            if (!empty($val)) {
                $val = $is_html?preg_replace('/<.*?>/', '', $val):$val;
                return $val;
            }
        }
        return NULL;
    }
    public function is_allowed_location(&$location) {
        $flag = NULL;
        if (is_array($location)) {
            $locations = array();
            foreach ($location as $item){
                $temp = in_array(strtolower(trim($item)), $this->allowed_locations);
                if ($temp) {
                    $locations[] = $item;
                }
            }
            if (!empty($locations)) {
                $location = implode(',',$locations);
                $flag = TRUE;
            }
        } else {
            $flag = in_array(strtolower(trim($location)), $this->allowed_locations);
        }
        return $flag;
    }
    
    /**
     * 
     * @param type $content
     * @return null
     */
    public function getUrlsListOfWorks($content) {
        
         //List of works
        $content_list_of_works = NULL;
        if (!empty($this->patterns['works-list'])) {
            foreach ($this->patterns['works-list'] as $re) {
                $content_list_of_works = $this->parsePageContent($content, $re);
                if (!empty($content_list_of_works[1])) break;
            }
            if (empty($content_list_of_works[1])) 
                return NULL;
            else 
                $content_list_of_works = $content_list_of_works[1][0];
        } else {
            $content_list_of_works = $content;
        }
        /**
         * List of works link detail
         */
        $urls = array();
        foreach ($this->patterns['works-item'] as $re) {
            $urls = $this->parsePageContent($content_list_of_works, $re);
            
        }
        if (!empty($urls[1])) 
            return $urls[1];
        else 
            return NULL;
            
    }
    public function parseLocations($content){
        $locations = array();
      
         foreach ($this->patterns['works-location-list'] as $list) {
            $temp = array(1);
            $content_list_locations = trim($this->parsePageContent($content, $list, $temp, TRUE));
            if (!empty($content_list_locations)) {
                foreach ($this->patterns['works-location-item'] as $item) {
                    $val = $this->parsePageContent($content_list_locations, $item);
                    if (!empty($val[1])) {
                        foreach ($val[1] as $item) {
                            $locations[] = trim($item);
                        }
                    }
                }
                return $locations;
            } else {
                $items = explode(',', $content_list_locations);
                if (count($items) >= 2) {
                    return trim($items[count($items) - 2]);
                }
                return $content_list_locations;
            }
        }
        return $locations;
        
    }
    public function is_valid_job($job) {
        if (empty($job['title'])) return FALSE;
        if (empty($job['description'])) return FALSE;
        return TRUE;
    }
    public function format_total(&$total) {
        if (is_array($total)) {
            if (!empty($total[1][0])) {
                $total[1][0] = preg_replace('/\,/', '', $total[1][0]);
                $total[1][0] = preg_replace('/ /', '', $total[1][0]);
                $total[1][0] = (int)$total[1][0];
            }
        } else {
            if (!empty($total)) {
                $total = preg_replace('/\,/', '', $total);
                $total = preg_replace('/ /', '', $total);
                $total = (int)$total;
            }
        }
    }
    /**
     * 
     * @param type $string
     * @return type :string
     * escape html string
     */
    public function escape_string($string) {
       //Decode html
        $string = html_entity_decode($string);
        
        return trim($string);
    }
    
    /**
     * Get list of created date and convert it to standard format
     * @param type $content
     * @return null
     */
    public function getListOfCreatedDate($content,$patterns=NULL){
        //List of created date
        $result = NULL;
        if (!empty($patterns)) {
            foreach ($patterns as $re) {
                //Get list of date
                $content_list_of_created = $this->parsePageContent($content, $re);
                
                if (!empty($content_list_of_created[1])) {   
                    //Format date and time
                    $result=  $this->convertListToStandardTime($content_list_of_created[1]);
                    break;
                }   
            }
        }
        return $result;
    }
    
    /**
     * convert list of date time to standard date time
     * @param type $list_of_date
     * @return type $array of converted date time, format "Year:month:date Hour:minute:second"
     */
    public function convertListToStandardTime($list_of_date){
        $result=array();
        foreach($list_of_date as $date){
            //convert date time and assign into array
			$time = $this->getExpired($date);
            $result[]= date('Y:m:d H:i:s',$time!=0 ? $time : time());
        }
        return $result;
    }
}

