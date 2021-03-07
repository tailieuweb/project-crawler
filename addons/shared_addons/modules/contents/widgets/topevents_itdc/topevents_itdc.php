<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Show a list of images.
 *
 * @author        ptnhuan
 */
class Widget_Topevents_itdc extends Widgets {

    public $author = 'ptnhuan';
    public $website = 'http://tdcsolutions.biz/';
    public $version = '1.0.0';
    public $title = array(
        'en' => 'Topevents iTDC',
    );
    public $description = array(
        'en' => 'Show a list of images',
    );

    public function run() {
        $this->load->model('contents/pages_events_m');
        $events = $this->pages_events_m->get_live();
        return array('events' => $events);
    }

}
