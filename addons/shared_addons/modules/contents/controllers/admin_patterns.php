<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_patterns extends Admin_Controller {

    protected $section = 'patterns';
    
    /** @var array The validation rules */
    protected $validation_rules = array(
            'pattern_name' => array(
                    'field' => 'pattern_name',
                    'label' => 'lang:global:title',
                    'rules' => 'trim|htmlspecialchars|required|max_length[200]'
            ),
            'machine_name' => array(
                    'field' => 'machine_name',
                    'label' => 'lang:global:title',
                    'rules' => 'trim|htmlspecialchars|required|max_length[200]'
            ),
        );
    public function __construct() {
        parent::__construct();
        //Load model
        $this->load->model('allias_patterns_m');
        $this->load->model('work_statistic_m');
        $this->load->library(array('keywords/keywords', 'form_validation'));
        //Load language
        $this->lang->load(array('contents'));
        $this->template->append_js('module::admin.js')
                ->append_js('admin/filter.js')
                ->append_css('module::admin.css');
    }

    public function index() {
        $select_site = $this->work_statistic_m->convert_to_select(array('status' => 1));
        $params = array('id_site'=>key($select_site));
        //Get sites to select
        if ($this->input->post('id_site')) {
            $params['id_site'] = $this->input->post('id_site');
        }
        if ($this->input->post('btnAction')) {
            if ($this->input->post('id_site')) {
                $params['id_site'] = $this->input->post('id_site');
                $this->allias_patterns_m->delete_by_idsite($params);
                
                $data_save = $_REQUEST;
                
                if (isset($data_save['id_site'])) {
                    unset($data_save['id_site']);
                }
                if (isset($data_save['csrf_hash_name'])) {
                    unset($data_save['csrf_hash_name']);
                }
                if (isset($data_save['btnAction'])) {
                    unset($data_save['btnAction']);
                }
                
                foreach ($data_save as $pattern_name => $item) {
                    
                    $value_pattern = array(
                        'id_site' => $params['id_site'],
                        'id_pattern' => $item[0],
                    );
                    unset($item[0]);
                    foreach ($item as $i => $key) {
                        $value_pattern['value_pattern'] = $key['value_pattern'];
                        $value_pattern['status'] = !empty($key['status'])?$key['status']:0;
                        $this->allias_patterns_m->insert_value_pattern($value_pattern);
                    }
                }
            }
        }
        
        $value_patterns = $this->allias_patterns_m->get_live_patterns($params);
        
        $this->input->is_ajax_request() and $this->template->set_layout(false);
        $this->template
                ->title($this->module_details['name'])
                ->set('select_site', $select_site)
                ->set('params',  $params)
                ->set('value_patterns', $value_patterns);
        $this->input->is_ajax_request()
           ? $this->template->build('admin/tables/patterns')
           : $this->template->build('admin/patterns/index');
    }
    
    public function create() {

        $id_pattern = -1;
        $is_exist = false;
        
        // Set our validation rules
        $this->form_validation->set_rules($this->validation_rules);
        $select_pattern_name = $this->allias_patterns_m->get_allias_patterns();
        $works_site_patterns = $this->allias_patterns_m->get_live_patterns();
        
        if ($this->form_validation->run()) {
            $pattern = array(
                'pattern_name' => $this->input->post('pattern_name'),
                'machine_name' => $this->input->post('machine_name'),
            );
            foreach ($select_pattern_name as $key => $item) {
                if (strcmp($pattern['machine_name'],$item['machine_name']) == 0) {
                    $id_pattern = $item['id'];
                    break;
                }
            }
            if ($id_pattern < 0) {
                $id_pattern = $this->allias_patterns_m->insert($pattern);
            }
            $site_pattern = array(
                'id_site' => $this->input->post('id_site'),
                'id_pattern' => $id_pattern,
            );
            
            foreach ($works_site_patterns as $key => $item) {
                if ($site_pattern['id_site'] == $item['id_site'] && $site_pattern['id_pattern'] == $item['id_pattern']) {
                    $is_exist = true;
                    break;
                }
            }
            if (!$is_exist) {
                $this->allias_patterns_m->insert_site_pattern($site_pattern);
                $this->session->set_flashdata('success_insert');
            } else
            {
                $success = $this->session->set_flashdata('notice', 'Machine name is exist');
            }
        } 
        else
            $success = $this->session->set_flashdata('notice', 'Add error');
        
        $select_site = $this->work_statistic_m->convert_to_select(array('status' => 1));
        $this->template
                ->title($this->module_details['name'])
                ->set('select_site', $select_site)
                ->set('success', $success)
                ->set('select_patterns', $select_pattern_name);
        $this->template
                ->title($this->module_details['name'])
                ->build('admin/patterns/create');
    }
    public function edit($id=0) {
        $id_site = $this->uri->segment(6)?$this->uri->segment(6):1;
        $id = $this->uri->segment(5)?$this->uri->segment(5):$id;
        $allias_pattern = $this->allias_patterns_m->get($id);
        if (!empty($allias_pattern)) {
            if ($this->input->post('pattern_name') && $this->input->post('machine_name')) {
                $this->form_validation->set_rules($this->validation_rules);
                if ($this->form_validation->run()) {
                    $value = array(
                        'pattern_name' => $this->input->post('pattern_name'),
                        'machine_name' => $this->input->post('machine_name'),
                    );
                    $this->allias_patterns_m->update($allias_pattern->id, $value);
                    redirect('admin/contents/patterns');
                    $this->session->set_flashdata('success', 'Updated');
                }
            }
        } else {
            $this->session->set_flashdata('notice', 'Not found');
        }
        $select_site = $this->work_statistic_m->convert_to_select(array('status' => 1));
        $select_pattern_name = $this->allias_patterns_m->get_allias_patterns();
        $this->template
                ->title($this->module_details['name'])
                ->set('allias_pattern', $allias_pattern)
                ->set('id_site', $id_site)
                ->set('select_site', $select_site)
                ->set('select_patterns', $select_pattern_name)
                ->build('admin/patterns/create');
    }
    
    public function delete($id = 0) {
        $id = (int)$this->uri->segment(5);
        $allias_pattern = $this->allias_patterns_m->get($id);
        if (!empty($allias_pattern)) {
            if ($allias_pattern->id) {
                $this->allias_patterns_m->delete($id);
                $this->allias_patterns_m->delete_site_pattern_by_idpattern($id);
                $this->session->set_flashdata('success', 'Deleted');
                
            } else {
                    $this->session->set_flashdata('notice', "Cann't deleted");
            }
        } else {
            $this->session->set_flashdata('notice', 'Not found');
        }
        redirect('admin/contents/patterns');
    }
}