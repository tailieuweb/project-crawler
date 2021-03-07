<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_recruitments extends Admin_Controller {

    protected $section = 'recruitments';
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
        $this->load->model('work_recruitments_m');
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
            $this->work_recruitments_m->like('name', $this->input->post('keyword'));
            $params['keyword'] = $this->input->post('keyword');
        }
        $total_rows = $this->work_recruitments_m->count_by(array());
        $pagination = create_pagination('admin/contents/recruitments', $total_rows);
        $params = array_merge($params, $pagination);
        $all_recruitments = $this->work_recruitments_m->get_live($params);
        $this->template
                ->title($this->module_details['name'])
                ->set('all_recruitments', $all_recruitments)
                ->set('pagination', $pagination)
                ->build('admin/recruitments/index')
        ;
    }

    public function delete($id = 0) {
        // Delete one
        $ids = ($id) ? array($id) : array($this->uri->segment(5));
        // Go through the array of slugs to delete
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $this->work_recruitments_m->delete($id);
                $this->session->set_flashdata('success', "Deteled");
            }
        }
        redirect('admin/contents/recruitments');
    }

    public function edit($id = 0) {
        $id = $this->uri->segment(5) ? $this->uri->segment(5) : $id;
        $recruitments = $this->work_recruitments_m->get($id);
        if (!empty($recruitments)) {
            if ($this->input->post('name')) {
                $this->form_validation->set_rules($this->validation_rules);
                if ($this->form_validation->run()) {
                    $value = array(
                        'name' => $this->input->post('name'),
                        'description' => $this->input->post('description'),
                        'id_categories' => $this->input->post('id_categories'),
                        'work_name'=>$this->input->post('work_name'),
                        'work_description'=>$this->input->post('work_description'),
                        'work_count'=>$this->input->post('work_count'),
                        'work_end'=>$this->input->post('work_end'),
                        'requirements'=>$this->input->post('requirements'),
                        'status' => $this->input->post('status'),
                    );
                    $this->work_recruitments_m->update($recruitments->id, $value);
                    $this->session->set_flashdata('success', "Updated");
                } else {
                    $this->session->set_flashdata('notice', 'Not found');
                }
            }
        }
        $recruitments = $this->work_recruitments_m->get($id);
        $this->template
                ->title($this->module_details['name'])
                ->set('recruitments', $recruitments)
                ->append_metadata($this->load->view('fragments/wysiwyg', array(), true))
                ->append_js('jquery/jquery.tagsinput.js')
                ->append_js('module::contact_form.js')
                ->append_css('module::blog.css')
                ->append_css('jquery/jquery.tagsinput.css')
                ->build('admin/recruitments/edit');
    }

    public function create() {
        // Set our validation rules
        $this->form_validation->set_rules($this->validation_rules);
        if ($this->form_validation->run()) {
            $recruitments = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'id_categories' => $this->input->post('id_categories'),
                'status' => 0
            );
            $this->work_recruitments_m->insert($recruitments);
        }
        $this->load->driver('Streams');
        $this->template
                ->title($this->module_details['name'])
                ->append_metadata($this->load->view('fragments/wysiwyg', array(), true))
                ->append_js('jquery/jquery.tagsinput.js')
                ->append_js('module::contact_form.js')
                ->append_css('module::blog.css')
                ->append_css('jquery/jquery.tagsinput.css')
                ->build('admin/recruitments/create');
    }

}
