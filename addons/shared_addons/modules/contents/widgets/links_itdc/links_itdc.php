<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Show a list of images.
 *
 * @author        ptnhuan
 */
class Widget_Links_itdc extends Widgets {

    public $author = 'ptnhuan';
    public $website = 'http://tdcsolutions.biz/';
    public $version = '1.0.0';
    public $title = array(
        'en' => 'Links',
    );
    public $description = array(
        'en' => 'Show a list of links',
    );

    public function run() {
        $this->load->model('contents/pages_links_m');
        $links = $this->pages_links_m->get_live('Liên kết', 3);
        return array('links' => $links);
    }
}
