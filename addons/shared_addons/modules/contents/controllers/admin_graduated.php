<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_graduated extends Admin_Controller {

    protected $section = 'graduated';
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
        $this->load->model('work_graduated_m');
        $this->load->model('work_courses_m');
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
        if ($this->input->post('id_course')) {
            $params['id_course'] = $this->input->post('id_course');
        }
        $select_courses = $this->work_courses_m->convert_to_select();
        $all_graduated = $this->work_graduated_m->get_live($params);
        $this->input->is_ajax_request() and $this->template->set_layout(false);
        $this->template
                ->title($this->module_details['name'])
                ->set('all_graduated', $all_graduated)
                ->set('select_courses', $select_courses)
                ->append_js('admin/filter.js')
        ;
        $this->input->is_ajax_request() ? $this->template->build('admin/tables/graduated') : $this->template->build('admin/graduated/index');
    }

    public function delete($id = 0) {
        
        // Delete one
        $ids = ($id) ? array($id) : array($this->uri->segment(5));
        // Go through the array of slugs to delete
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $this->work_courses_m->delete($id);
                $this->work_graduated_m->delete_by(array('id_course' => $id));
                $this->session->set_flashdata('success', "Deteled");
            }
        }
        redirect('admin/contents/graduated/manage_courses');
    }

    public function edit($id = 0) {
        $id = $this->uri->segment(5) ? $this->uri->segment(5) : $id;
        $course = $this->work_courses_m->get($id);
        if (!empty($course)) {
            if ($this->input->post('name')) {
                $this->form_validation->set_rules($this->validation_rules);
                if ($this->form_validation->run()) {
                    $ids = $this->input->post('course');
                        $value = array(
                            'name' => $this->input->post('name'),
                            'status' => $ids[$id]
                        );
                    $this->work_courses_m->update($course->id, $value);
                    $this->session->set_flashdata('success', "Updated");
                    redirect('admin/contents/graduated/manage_courses');
                } else {
                    $this->session->set_flashdata('notice', 'Not found');
                }
            }
        }
        $course = $this->work_courses_m->get($id);
        $this->template
                ->title($this->module_details['name'])
                ->set('course', $course)
                //->append_metadata($this->load->view('fragments/wysiwyg', array(), true))
                //->append_js('jquery/jquery.tagsinput.js')
                //->append_js('module::contact_form.js')
                //->append_css('module::blog.css')
                //->append_css('jquery/jquery.tagsinput.css')
                ->build('admin/graduated/edit');
    }

    public function create() {
        // Set our validation rules
        $this->form_validation->set_rules($this->validation_rules);
        if ($this->form_validation->run()) {
            $course = array(
                'name' => $this->input->post('name'),
                'status' => 1
            );
            $this->work_courses_m->insert($course);
            $this->session->set_flashdata('success', "Inserted");
            redirect('admin/contents/graduated/manage_courses');
        }
        $this->load->driver('Streams');
        $this->template
                ->title($this->module_details['name'])
                //->append_metadata($this->load->view('fragments/wysiwyg', array(), true))
                //->append_js('jquery/jquery.tagsinput.js')
                //->append_js('module::contact_form.js')
                //->append_css('module::blog.css')
                //->append_css('jquery/jquery.tagsinput.css')
                ->build('admin/graduated/create');
    }

    public function manage_courses() {
        $params = array(
        );
        if ($this->input->post('keyword')) {
            $this->work_courses_m->like('name', $this->input->post('keyword'));
            $params['keyword'] = $this->input->post('keyword');
        }
        if ($this->input->post('courses')) {
            $this->work_courses_m->update_status($this->input->post('courses'));
        }
        $all_courses = $this->work_courses_m->get_live($params);
        $this->template
                ->title($this->module_details['name'])
                ->set('all_courses', $all_courses)
                ->set('params', $params)
                ->build('admin/graduated/manage-courses')
        ;
    }

    public function import() {
        $this->load->library('contents/my_excel_reader');
        $params = array();
        if ($this->input->post('id_course')) {
            $data = $this->importExcel();
            if ($data['status']) {
                $file_path = $data['values']['full_path'];
                $students = $this->my_excel_reader->import($file_path);
                if (!empty($students)) {
                    $id_course = $this->input->post('id_course');
                    $this->work_graduated_m->import($students, $id_course);
                }
            }
            $this->session->set_flashdata('success', "Inserted");
        }

        //redirect('admin/contents/graduated/import');
        $graduated = $this->work_graduated_m->get_live($params);
        $this->load->driver('Streams');

        $select_courses = $this->work_courses_m->convert_to_select();
        $this->template
                ->title($this->module_details['name'])
                ->set('select_courses', $select_courses)
                ->set('graduated', $graduated)
                ->build('admin/graduated/import')
        ;
    }
    public function importExcel() {
        $data = array(
            'status' => TRUE
        );
        $config['upload_path'] = 'public/db';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = '10000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $message = array('error' => $this->upload->display_errors());
            $data['status'] = FALSE;
            $data['message'] = $message['error'];
        } else {
            $values = array('upload_data' => $this->upload->data());
            $data['values'] = $values['upload_data'];
        }
        return $data;
    }

}
