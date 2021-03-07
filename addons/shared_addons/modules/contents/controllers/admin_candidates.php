<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_candidates extends Admin_Controller {

    protected $section = 'candidates';
    protected $validation_rules = array(
        'name' => array(
            'field' => 'name',
            'label' => 'lang:global:title',
            'rules' => 'trim|htmlspecialchars|required|max_length[200]'
        ),
    );

    public function __construct() {
        parent::__construct();

        // Load all the required classes
        $this->load->model('work_candidates_m');
        $this->load->library(array('keywords/keywords', 'form_validation'));
        //Load language
        $this->lang->load(array('contents'));

        // We'll set the partials and metadata here since they're used everywhere
        $this->template->append_js('module::admin.js')
                ->append_css('module::admin.css');
    }

    public function index() {
        $params = array(
        );
        if ($this->input->post('keyword')) {
            $this->work_candidates_m->like('name', $this->input->post('keyword'));
            $params['keyword'] = $this->input->post('keyword');
        }
        $total_rows = $this->work_candidates_m->count_by(array());
        $pagination = create_pagination('admin/contents/candidates', $total_rows);
        $params = array_merge($params, $pagination);
        $all_candidates = $this->work_candidates_m->get_live($params);
        $this->template
                ->title($this->module_details['name'])
                ->set('all_candidates', $all_candidates)
                ->set('pagination', $pagination)
                ->build('admin/candidates/index')
        ;
    }

    public function delete($id = 0) {
        // Delete one
        $ids = ($id) ? array($id) : array($this->uri->segment(5));
        // Go through the array of slugs to delete
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $this->work_candidates_m->delete($id);
                $this->session->set_flashdata('success', "Deteled");
            }
        }
        redirect('admin/contents/candidates');
    }

    public function edit($id = 0) {
        $this->load->model('work_categories_m');
        $id = $this->uri->segment(5) ? $this->uri->segment(5) : $id;
        $candidate = $this->work_candidates_m->get($id);
        if (!empty($candidate)) {
            if ($this->input->post('name')) {
                $this->form_validation->set_rules($this->validation_rules);
                if ($this->form_validation->run()) {
                    $value = array(
                        'name' => $this->input->post('name'),
                        'level' => $this->input->post('level'),
                        'id_category' => $this->input->post('id_category'),
                        'email'=>$this->input->post('email'),
                        'phone'=>$this->input->post('phone'),
                        'status' => $this->input->post('status'),
                        'description' => $this->input->post('description'),
                    );
                    $this->work_candidates_m->update($candidate->id, $value);
                    $this->session->set_flashdata('success', "Updated");
                } else {
                    $this->session->set_flashdata('notice', 'Not found');
                }
            }
        }
        $category = $this->work_categories_m->get_valkeys();
        $candidate = $this->work_candidates_m->get($id);
        $this->template
                ->title($this->module_details['name'])
                ->set('candidate', $candidate)
                ->set('category',$category)
                ->append_metadata($this->load->view('fragments/wysiwyg', array(), true))
                ->append_js('jquery/jquery.tagsinput.js')
                ->append_js('module::contact_form.js')
                ->append_css('module::blog.css')
                ->append_css('jquery/jquery.tagsinput.css')
                ->build('admin/candidates/edit');
    }

    public function create() {
        // Set our validation rules
        $this->form_validation->set_rules($this->validation_rules);
        if ($this->form_validation->run()) {
            $candidate = array(
                'name' => $this->input->post('name'),
                'level' => $this->input->post('level'),
                'id_category' => $this->input->post('id_category'),
                'status' => $this->input->post('status'),
                'description' => $this->input->post('description'),
                'status' => 0
            );
            $this->work_candidates_m->insert($candidate);
        }
        $this->load->driver('Streams');
        $this->template
                ->title($this->module_details['name'])
                ->append_metadata($this->load->view('fragments/wysiwyg', array(), true))
                ->append_js('jquery/jquery.tagsinput.js')
                ->append_js('module::contact_form.js')
                ->append_css('module::blog.css')
                ->append_css('jquery/jquery.tagsinput.css')
                ->build('admin/candidates/create');
    }

}
