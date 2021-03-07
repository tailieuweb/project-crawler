<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Show a list of images.
 *
 * @author        ptnhuan
 */
class Widget_Topnews_itdc extends Widgets {

    public $author = 'ptnhuan';
    public $website = 'http://tdcsolutions.biz/';
    public $version = '1.0.0';
    public $title = array(
        'en' => 'Topnews iTDC',
    );
    public $description = array(
        'en' => 'Show a list of hot news',
    );

    public function run() {
        $this->load->model('contents/pages_news_m');
        $news = $this->pages_news_m->get_live();
        return array('news' => $news);
    }

}
