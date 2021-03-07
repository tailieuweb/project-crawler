<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Show a list of images.
 *
 * @author        ptnhuan
 */
class Widget_Topworks_itdc extends Widgets {

    public $author = 'ptnhuan';
    public $website = 'http://tdcsolutions.biz/';
    public $version = '1.0.0';
    public $title = array(
        'en' => 'Top works iTDC',
    );
    public $description = array(
        'en' => 'Show a list of hot works',
    );

    public function run() {
        $this->load->model('contents/pages_works_m');
        $works = $this->pages_works_m->get_live();
        return array('works' => $works);
    }

}
