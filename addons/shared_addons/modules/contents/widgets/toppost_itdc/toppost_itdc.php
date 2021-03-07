<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Show a list of images.
 *
 * @author        ptnhuan
 */
class Widget_Toppost_itdc extends Widgets {

    public $author = 'ptnhuan';
    public $website = 'http://tdcsolutions.biz/';
    public $version = '1.0.0';
    public $title = array(
        'en' => 'Top post iTDC',
    );
    public $description = array(
        'en' => 'Show a list of hot top post',
    );

    public function run() {
        $this->load->model('contents/job_m');
        $this->load->model('contents/pages_news_m');
        $params['limit']=5;
        $params['offset']=0;
        $works = $this->job_m->get_live($params);
        $news = $this->pages_news_m->get_live_list($params);
        return array('works' => $works,'news' => $news);
    }

}
