<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_crawler extends Admin_Controller {

    protected $section = 'crawler';

    /** @var array The validation rules */
    protected $rules_crawl_setting = array(
        'threads' => array(
            'field' => 'threads',
            'label' => 'Threads',
            'rules' => 'required|numeric'
        ),
        'sleep' => array(
            'field' => 'sleep',
            'label' => 'Sleep',
            'rules' => 'required|numeric'
        ),
    );
    //Define validations rules for crawl
    protected $rules_crawl_categories = array(
        'categories' => array(
            'field' => 'categories',
            'label' => 'Running Crawl Categories',
            'rules' => 'trim|required|max_length[200]'
        ),
    );
    //Define validations rules for crawl
    protected $rules_crawl_works = array(
        'works' => array(
            'field' => 'works',
            'label' => 'Running Crawl Works',
            'rules' => 'trim|required|max_length[200]'
        ),
    );
    //Define validations rules for crawl
    protected $rules_crawl_details = array(
        'details' => array(
            'field' => 'details',
            'label' => 'Running Crawl Details',
            'rules' => 'trim|required|max_length[200]'
        ),
    );
    //Define fields
    public $fields = array(
        'threads' => 'Threads',
        'sleep' => "Sleep",
    );
    //Define tabs
    protected $tags = array(
        'tab1' => 'Crawl Settings', 
        'tab2' => 'Running Crawler', 
    );
    //Define fields for running crawl
    protected $runs = array(
        'categories' => 'Running Crawl Categories', 
        'works' => 'Running Crawl Works', 
        'details' => 'Running Crawl Details', 
    );
    
    public function __construct() {
        parent::__construct();
        //Load language
        $this->lang->load(array('contents'));
        
        //Load model
        $this->load->model('work_crawler_m');
//        $this->load->library(array('keywords/keywords', 'form_validation'));
//        //Load language
//        $this->lang->load(array('contents'));
        $this->template->append_js('module::admin.js')
                ->append_css('module::admin.css')
                ->append_css('module::portBox.css');
    }

    public function index() {
        
        if ($this->input->post()) {
            $this->crawl_setting();
            $this->run_crawl();
        }
        
//        if ($this->input->post()) {
//            $this->rules_crawl();
//        }
        $setting = $this->work_crawler_m->get_value_fields();
        $this->input->is_ajax_request() and $this->template->set_layout(false);
        $this->template
                ->title('Crawler')
                ->set('tags', $this->tags)
                ->set('runs', $this->runs)
                ->set('fields', $this->fields)
                ->set('setting', $setting)
                ->build('admin/crawler/index');
    }
    
    public function crawl_setting() {
        
        if ($this->input->post('btnCrawlerSetting')) {
            $this->form_validation->set_rules($this->rules_crawl_setting);
            if ($this->form_validation->run()) {
                $crawler_setting = array(
                    'threads' => $this->input->post('threads'),
                    'sleep' => $this->input->post('sleep'),
                );
                $id = $this->input->post('id');
                $kq = $this->work_crawler_m->update($id, $crawler_setting);
                if ($kq) {
                    echo '<script> alert("Save success!"); </script>';
                } else {
                    echo '<script> alert("Save fail!"); </script>';
                }
            }
        }
    }
    
    public function run_crawl($type='') {
        if ($this->input->post('btn_crawl_categories')) {
            $this->form_validation->set_rules($this->rules_crawl_categories);
            if ($this->form_validation->run()) {
                
            } 
        } else if ($this->input->post('btn_crawl_works')) {
            $this->form_validation->set_rules($this->rules_crawl_works);
            if ($this->form_validation->run()) {
                
            } 
            
        } else if ($this->input->post('btn_crawl_details')) {
            $this->form_validation->set_rules($this->rules_crawl_details);
            if ($this->form_validation->run()) {
                
            } 
        }
        
    }
}
