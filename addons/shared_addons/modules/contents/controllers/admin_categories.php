<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_categories extends Admin_Controller {

    protected $section = 'categories';

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
        //Load model
        $this->load->model('work_categories_m');
        $this->load->model('all_categories_m');
        $this->load->library(array('keywords/keywords', 'form_validation'));
        //Load language
        $this->lang->load(array('contents'));
        $this->template->append_js('module::admin.js')
                ->append_css('module::admin.css')
                ->append_js('admin/filter.js');
        
    }

    public function index() {
        $params = array();
        if ($this->input->post('id_category')) {
            $this->work_categories_m->like('id', $this->input->post('id_category'));
            $params['id_category'] = $this->input->post('id_category');
        }
        if ($this->input->post('categories')) {
            $this->work_categories_m->update_status($this->input->post('categories'));
            $this->all_categories_m->update_status($this->input->post('categories'));
        }
        $total_rows = count($this->work_categories_m->get_parent_categories($params));
        $pagination = create_pagination('admin/contents/categories', $total_rows);
        $params = array_merge($params, $pagination);
        $categories = $this->work_categories_m->get_parent_categories($params);
        $select_categories = $this->work_categories_m->convert_to_select();
        $this->input->is_ajax_request() and $this->template->set_layout(false);
        $this->template
                ->title($this->module_details['name'])
                ->set('pagination', $pagination)
                ->set('categories', $categories)
                ->set('select_categories', $select_categories);
        $this->input->is_ajax_request()
           ? $this->template->build('admin/tables/categories')
           : $this->template->build('admin/categories/index');
    }
    public function edit($id=0) {
        $id = $this->uri->segment(5)?$this->uri->segment(5):$id;
        $category = $this->work_categories_m->get($id);
        if (!empty($category)) {
            if ($this->input->post('name')) {
                $this->form_validation->set_rules($this->validation_rules);
                if ($this->form_validation->run()) {
                    $value = array(
                        'name' => $this->input->post('name'),
                        'path' => $this->input->post('parent_category'),
                    );
                    $this->work_categories_m->update($category->id, $value);
                    $this->session->set_flashdata('success', 'Updated');
                }
            }
        } else {
            $this->session->set_flashdata('notice', 'Not found');
        }
        $category = $this->work_categories_m->get($id);
        $select_categories = $this->work_categories_m->convert_to_select();
        $this->template
                ->title($this->module_details['name'])
                ->set('category', $category)
                ->set('select_categories', $select_categories)
                ->build('admin/categories/edit');
    }
    public function create() {
        // Set our validation rules
        $this->form_validation->set_rules($this->validation_rules);
        if ($this->form_validation->run()) {
            $category = array(
                'name' => $this->input->post('name'),
                'path' => $this->input->post('parent_category'),
                'status' => 0
            );
            $this->work_categories_m->insert($category);
        } 
        $select_categories = $this->work_categories_m->convert_to_select();
        $this->template
                ->title($this->module_details['name'])
                ->set('select_categories', $select_categories)
                ->build('admin/categories/create');
    }
    public function delete($id = 0) {
        $id = (int)$this->uri->segment(5);
        $category = $this->work_categories_m->get($id);
        if (!empty($category)) {
            if ($category->path) {
                $this->work_categories_m->delete($id);
                $this->session->set_flashdata('success', 'Deleted');
            } else {
                $parent = array(
                    0 => array('id' => $id)
                );
                $this->work_categories_m->get_sub_categories($parent);
                if (empty($parent[0]['child'])) {
                    $this->work_categories_m->delete($id);
                    $this->session->set_flashdata('success', 'Deleted');
                } else {
                    $this->session->set_flashdata('notice', "{$category->name} has child. Cant delete");
                }
            }
        } else {
            $this->session->set_flashdata('notice', 'Not found');
        }
        redirect('admin/contents/categories');
    }
}