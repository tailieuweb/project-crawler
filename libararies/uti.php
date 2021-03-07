<?php
class Utilities {
    public function __construct() {
    }
    function unicode_str_filter($str) {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
    }
    public function create_slug($title, $rand = NULL) {
        if (empty($rand)) {
            $rand = rand(1, 1000);
        }
        $slug = strtolower($this->seo_string_to_url($title).'-'.$rand);
        return $slug;
    }
    public function seo_string_to_url($str) {
        $str = preg_replace('/\//', '-', $str);
        $str = preg_replace('/"/', '', $str);
        $str = preg_replace('/\'/', '', $str);
        $str = preg_replace('/”/', '', $str);
        $str = preg_replace('/“/', '', $str);
        $str = preg_replace('/\(/', '', $str);
        $str = preg_replace('/\)/', '', $str);
        $str = preg_replace('/&/', '', $str);
        $str = $this->unicode_str_filter($str);
        $str = urlencode($str);
        //TODO
        $str = preg_replace('/\+/', '-', $str);
        return $str;
    }
    
    public function get_id_from_uri($uri) {
        preg_match('/\-(\d+)$/', $uri, $mach);
        $id = isset($mach[1])?$mach[1]:NULL;
        return $id;
    }
    
    public function set_url_segment($array_segments) {
        $index = 0;
        $url_segment = '';
        foreach ($array_segments as $key => $val) {
            $index++;
            if ($index < count($array_segments))
                $url_segment.=$key . "/" . $val . '/';
            if ($index == count($array_segments))
                $url_segment.=$key;
        }
        return $url_segment;
    }
    
    public function get_full_date($timestamp, $is_full = TRUE) {
        $day_of_week = date('D', $timestamp);
        switch ($day_of_week) {
            case 'Mon':
                $day_of_week = 'Thứ hai';
                break;
            case 'Tue':
                $day_of_week = 'Thứ ba';
                break;
            case 'Wed':
                $day_of_week = 'Thứ tư';
                break;
            case 'Thu':
                $day_of_week = 'Thứ năm';
                break;
            case 'Fri':
                $day_of_week = 'Thứ sáu';
                break;
            case 'Sat':
                $day_of_week = 'Thứ bảy';
                break;
            default:
                $day_of_week = 'Chủ nhật';
                break;
        }
        if (!$is_full) {
            return date('d-m-Y', $timestamp);
        }
        return $day_of_week . ', ' . date('d-m-Y', $timestamp);
    }
    
    public function ext_substr($str, $l){
        if ($l > strlen($str)) {
            return $str;
        }
        $str = substr($str, 0, strpos($str, ' ', $l));
        return $str;
    }
    public function printdate($timestamp) {
        if (empty($timestamp)) return '...';
        return date('d/m/Y', $timestamp);
    }
}
$uti = new Utilities();
