<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Show a list of images.
 *
 * @author        ptnhuan
 */
class Widget_Partners_itdc extends Widgets {

    public $author = 'ptnhuan';
    public $website = 'http://tdcsolutions.biz/';
    public $version = '1.0.0';
    public $title = array(
        'en' => 'Partners',
    );
    public $description = array(
        'en' => 'Show a list of partners',
    );

    public function run() {
        $this->load->model('contents/pages_links_m');
        $partners = $this->pages_links_m->get_live('Đối tác', 6);
        return array('partners' => $partners);
    }
}
