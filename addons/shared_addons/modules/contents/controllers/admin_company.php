<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Admin_company extends Admin_Controller {

    protected $section = 'company';

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

        // Load all the required classes
        $this->load->model('work_companies_m');
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
            $this->work_companies_m->like('name', $this->input->post('keyword'));
            $params['keyword'] = $this->input->post('keyword');
        }
        $total_rows = $this->work_companies_m->count_by(array());
        $pagination = create_pagination('admin/contents/company', $total_rows);
        $params = array_merge($params, $pagination);
        $all_companies = $this->work_companies_m->get_live($params);
        $this->template
                ->title($this->module_details['name'])
                ->set('all_companies', $all_companies)
                ->set('pagination', $pagination)
                ->build('admin/company/index')
        ;
    }

    public function delete($id = 0) {
        // Delete one
        $ids = ($id) ? array($id) : array($this->uri->segment(5));
        // Go through the array of slugs to delete
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $this->work_companies_m->delete($id);
                $this->session->set_flashdata('success', "Deteled");
            }
        }
        redirect('admin/contents/company');
    }

    public function edit($id = 0) {
        $id = $this->uri->segment(5) ? $this->uri->segment(5) : $id;
        $company = $this->work_companies_m->get($id);
        if (!empty($company)) {
            if ($this->input->post('name')) {
                $this->form_validation->set_rules($this->validation_rules);
                if ($this->form_validation->run()) {
                    $value = array(
                        'name' => $this->input->post('name'),
                        'website' => $this->input->post('website'),
                        'email' => $this->input->post('email'),
                        'description' => $this->input->post('description'),
                        'address' => $this->input->post('address'),
                        'other' => $this->input->post('other'),
                        'status' => 0
                    );
                    $this->work_companies_m->update($company->id, $value);
                    $this->session->set_flashdata('success', "Updated");
                } else {
                    $this->session->set_flashdata('notice', 'Not found');
                }
            }
        }
        $company = $this->work_companies_m->get($id);
        $this->template
                ->title($this->module_details['name'])
                ->set('company', $company)
                ->append_metadata($this->load->view('fragments/wysiwyg', array(), true))
                ->append_js('jquery/jquery.tagsinput.js')
                ->append_js('module::contact_form.js')
                ->append_css('module::blog.css')
                ->append_css('jquery/jquery.tagsinput.css')
                ->build('admin/company/edit');
    }

    public function create() {
        // Set our validation rules
        $this->form_validation->set_rules($this->validation_rules);
        if ($this->form_validation->run()) {
            $company = array(
                'name' => $this->input->post('name'),
                'website' => $this->input->post('website'),
                'email' => $this->input->post('email'),
                'description' => $this->input->post('description'),
                'address' => $this->input->post('address'),
                'other' => $this->input->post('other'),
                'status' => 0
            );
            $this->work_companies_m->insert($company);
        }
        $this->load->driver('Streams');
        $this->template
                ->title($this->module_details['name'])
                ->append_metadata($this->load->view('fragments/wysiwyg', array(), true))
                ->append_js('jquery/jquery.tagsinput.js')
                ->append_js('module::contact_form.js')
                ->append_css('module::blog.css')
                ->append_css('jquery/jquery.tagsinput.css')
                ->build('admin/company/create');
    }

}
