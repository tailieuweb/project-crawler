<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_logs extends Admin_Controller {

    protected $section = 'logs';

    /** @var array The validation rules */
    protected $validation_rules = array(
        'name' => array(
            'field' => 'name',
            'label' => 'lang:global:title',
            'rules' => 'trim|htmlspecialchars|required|max_length[200]'
        ),
    );
    
    private $tags = array(
            0 => array(
                'name' => 'categories',
                'status' => '1',
            ),
            1 => array(
                'name' => 'works',
                'status' => '0',
            ),
            2 => array(
                'name' => 'details',
                'status' => '0',
            ),
        );

    public function __construct() {
        parent::__construct();
        //Load model
        $this->load->model('work_logs_m');
//        $this->load->library(array('keywords/keywords', 'form_validation'));
//        //Load language
//        $this->lang->load(array('contents'));
        $this->template->append_js('module::admin.js')
                ->append_css('module::admin.css')
                ->append_css('module::portBox.css')
                ->append_js('module::admin_logs.js');
    }

    public function index($crawl='categories') {
        $params = array('tags' => array());
        $paginations = array();
        $crawl = $this->uri->segment(4) ? $this->uri->segment(4) : $crawl;
        
        foreach ($this->tags as $key => $tag) {
            if ($tag['name'] == $crawl) {
                $tag['status'] = '1';
            }
            else {
                $tag['status'] = '0';
            }
            $params['tags'] = array_merge($params['tags'],array($tag));
        }
        $this->tags = $params['tags'];
        
        //Get count logs
        $total_category_logs = count($this->work_logs_m->get_works_category_logs());
        $total_work_logs = count($this->work_logs_m->get_works_logs());
        $total_detail_logs = count($this->work_logs_m->get_work_detail_logs());
        
        
        //Create pagination
        $paginations['categories'] = create_pagination('admin/contents/logs', $total_category_logs, 10);
        $params = array_merge($params, array('categories' => $paginations['categories']));
        $paginations['categories']['links'] = preg_replace('/\?/', '?#categories', $paginations['categories']['links']);
        
        
        $paginations['works'] = create_pagination('admin/contents/logs', $total_work_logs, 10);
        $params = array_merge($params, array('works' => $paginations['works']));
        $paginations['works']['links'] = preg_replace('/\?/', '?#works', $paginations['works']['links']);
        
        
        $paginations['details'] = create_pagination('admin/contents/logs', $total_detail_logs, 10);
        $params = array_merge($params, array('details' => $paginations['details']));
        $paginations['details']['links'] = preg_replace('/\?/', '?#details', $paginations['details']['links']);
        
        $category_logs = $this->work_logs_m->get_works_category_logs($params['categories']);
        $work_logs = $this->work_logs_m->get_works_logs($params['works']);
        $detail_logs = $this->work_logs_m->get_work_detail_logs($params['details']);
        
        //Get work all categories..group by id_site
        $work_all_categories = $this->work_logs_m->get_works_categories();
        
        //Get categories mapped
        $category_mapped = $this->work_logs_m->get_category_mapped();
        
        //Get works non requirements
        $work_non_requirement = $this->work_logs_m->get_works_non_requirement(array('type'=>'requirements'));
        
        //Get works non requirements
        $work_non_description = $this->work_logs_m->get_works_non_requirement(array('type'=>'description'));
        
        $this->input->is_ajax_request() and $this->template->set_layout(false);
        $this->template
                ->title('Logs')
                ->set('tags', $this->tags)
                ->set('categories', $category_logs)
                ->set('works', $work_logs)
                ->set('details', $detail_logs)
                ->set('category_mapped', $category_mapped)
                ->set('work_all_categories', $work_all_categories)
                ->set('work_non_requirement', $work_non_requirement)
                ->set('work_non_description', $work_non_description)
                ->set('paginations', $paginations)
                ->build('admin/logs/index');
    }

    //Crawl Categories
    public function truncate($tag = '') {
        $tag = $this->uri->segment(5) ? $this->uri->segment(5) : $tag;
        if (!empty($tag)) {
            if (strcmp($tag, 'categories') == 0) {
                $this->work_logs_m->truncate('default_work_category_logs');
            } else if (strcmp($tag, 'works') == 0) {
                $this->work_logs_m->truncate('default_work_logs');
            } else if (strcmp($tag, 'details') == 0) {
                $this->work_logs_m->truncate('default_work_detail_logs');
            }
            echo '<script> alert("Truncate sucess"); </script>';
        }else {
            echo '<script> alert("Truncate failed"); </script>';
        }
        
        redirect('admin/contents/logs');
            
    }

}
