<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_locations extends Admin_Controller {

    protected $section = 'locations';

    /** @var array The validation rules */
    protected $validation_rules = array(
        'name' => array(
            'field' => 'name',
            'label' => 'lang:global:title',
            'rules' => 'trim|htmlspecialchars|required|max_length[200]'
        ),
    );
    
    public function __construct() {
        parent::__construct();
        //Load language
        $this->lang->load(array('contents'));
        
        //Load model
        $this->load->model('work_locations_m');
//        $this->load->library(array('keywords/keywords', 'form_validation'));
//        //Load language
//        $this->lang->load(array('contents'));
        $this->template->append_js('module::admin.js')
                ->append_css('module::admin.css')
                ->append_css('module::portBox.css')
                ->append_js('module::admin_logs.js');
    }

    public function index() {
        
        if ($this->input->post('location')) {
            $this->work_locations_m->update_status($this->input->post('location'));
        }
        $pagination = create_pagination('admin/contents/locations', count($this->work_locations_m->get_works_locations()));
        $params = array_merge($params, $pagination);
        $work_locations = $this->work_locations_m->get_works_locations($params);
        $this->input->is_ajax_request() and $this->template->set_layout(false);
        $this->template
                ->title('Locations')
                ->set('work_locations', $work_locations)
                ->set('pagination', $pagination)
                ->build('admin/locations/index');
    }
    
    public function create() {
        // Set our validation rules
        $this->form_validation->set_rules($this->validation_rules);
        if ($this->form_validation->run()) {
            $locations = array(
                'name' => $this->input->post('name'),
                'id_alias' => $this->input->post('id_alias'),
                'status' => 0
            );
            $this->work_locations_m->insert($locations);
            
        } 
        $select_locations = $this->work_locations_m->convert_to_select();

        $this->template
                ->title($this->module_details['name'])
                ->set('select_locations', $select_locations)
                ->build('admin/locations/create');
    }
    
    public function edit($id=0) {
        $id = $this->uri->segment(5)?$this->uri->segment(5):$id;
        $location = $this->work_locations_m->get($id);
        if (!empty($location)) {
            if ($this->input->post('name')) {
                $this->form_validation->set_rules($this->validation_rules);
                if ($this->form_validation->run()) {
                    $value = array(
                        'name' => $this->input->post('name'),
                        'id_alias' => $this->input->post('id_alias'),
                    );
                    $this->work_locations_m->update($location->id, $value);
                    redirect('admin/contents/locations');
                    $this->session->set_flashdata('success', 'Updated');
                }
            }
        } else {
            $this->session->set_flashdata('notice', 'Not found');
        }
        $location = $this->work_locations_m->get($id);
        $select_location = $this->work_locations_m->convert_to_select();
        $this->template
                ->title($this->module_details['name'])
                ->set('location', $location)
                ->set('select_locations', $select_location)
                ->build('admin/locations/edit');
    }
    
    public function delete($id = 0) {
        $id = (int)$this->uri->segment(5);
        $location = $this->work_locations_m->get($id);
        if (!empty($location)) {
            if ($location->id_alias) {
                $this->work_locations_m->delete($id);
                $this->session->set_flashdata('success', 'Deleted');
            } else {
                $parent = array(
                    0 => array('id' => $id)
                );
                $this->work_locations_m->get_sub_works_locations($parent);
                if (empty($parent[0]['child'])) {
                    $this->work_locations_m->delete($id);
                    $this->session->set_flashdata('success', 'Deleted');
                } else {
                    $this->session->set_flashdata('notice', "{$location->name} has child. Cant delete");
                }
            }
        } else {
            $this->session->set_flashdata('notice', 'Not found');
        }
        redirect('admin/contents/locations');
    }
}
