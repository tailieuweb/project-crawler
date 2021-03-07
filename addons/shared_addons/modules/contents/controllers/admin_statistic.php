<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_statistic extends Admin_Controller {
    
    protected $section = 'statistic';
    
    private $tags = array(
        0 => 'Sites',
        1 => 'Categories',
    );

    public function __construct() {
        parent::__construct();
    $this->lang->load(array('contents'));
        // Load all the required classes
        $this->load->model('work_statistic_m');
        $this->load->library(array('keywords/keywords', 'form_validation'));
        // We'll set the partials and metadata here since they're used everywhere
        $this->template->append_js('module::admin.js')
                ->append_css('module::admin.css')
                ->append_css('module::style.css');
    }

    public function index() {
        $params = array();
        
        if ($this->input->post('statistic')) {
            $this->work_statistic_m->update_status($this->input->post('statistic'));
        }
        $all_sites = $this->work_statistic_m->get_live($params);
        $count_work = $this->work_statistic_m->count();
        $categories = $this->work_statistic_m->get_work_categories();
        $this->template
            ->title($this->module_details['name'])
            ->set('all_sites', $all_sites)
            ->set('tags', $this->tags)
            ->set('categories', $categories)
            ->set('count_work', $count_work)
            ->build('admin/statistic/index');
    }
    public function  manage_sites(){
        $params = array();
        if(($this->input->post('sites')))
        {
            $this->work_statistic_m->update_status($this->input->post('sites'));
        }
//        var_dump($this->db->last_query());
//        die();
        $all_sites = $this->work_statistic_m->get_live($params);
        $this->template
            ->title($this->module_details['name'])
            ->set('all_sites', $all_sites)
            ->build('admin/statistic/manage_sites');
    }
    public function  cron_tab(){
        $params = array();
        if(($this->input->post('sites')))
        {
            $this->work_statistic_m->update_status($this->input->post('sites'));
        }
//        var_dump($this->db->last_query());
//        die();
        $all_sites = $this->work_statistic_m->get_live($params);
        $this->template
            ->title($this->module_details['name'])
            ->set('all_sites', $all_sites)
            ->build('admin/statistic/cron_tab');
    }

}
