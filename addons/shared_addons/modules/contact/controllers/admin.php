<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller {

    /**
     * Every time this controller controller is called should:
     * - load the contact model
     * - load the keywords and form validation libraries
     */
    public function __construct() {
        parent::__construct();

        $this->load->model(array('contact_m'));
        $this->lang->load(array('contact'));
        $this->load->library(array('keywords/keywords', 'form_validation'));

        // Date ranges for select boxes
        $this->template
            ->append_css('module::contact.css');
        $this->item_validation_rules = array(
            );
    }

    /**
     * Shows the contact messages list.
     */
    public function index() {

        //set the base/default where clause
        $base_where = array();

        //add post values to base_where if f_module is posted
        if ($this->input->post('f_category')) {
            $base_where['category'] = $this->input->post('f_category');
        }

        if ($this->input->post('f_status')) {
            $base_where['status'] = $this->input->post('f_status');
        }

        if ($this->input->post('f_keywords')) {
//            $base_where['keywords'] = $this->input->post('f_keywords');
           $this->contact_m->like('email', "{$this->input->post('f_keywords')}");
           $this->contact_m->or_like('subject', "{$this->input->post('f_keywords')}");
           $this->contact_m->or_like('message', "{$this->input->post('f_keywords')}");
        }
        
        // Create pagination links
        $total_rows = $this->contact_m->count_by($base_where);
        $pagination = create_pagination('admin/contact/index', $total_rows);

        // Using this data, get the relevant results
        if ($this->input->post('f_keywords')) {
//            $base_where['keywords'] = $this->input->post('f_keywords');
           $this->contact_m->like('email', "{$this->input->post('f_keywords')}");
           $this->contact_m->or_like('subject', "{$this->input->post('f_keywords')}");
           $this->contact_m->or_like('message', "{$this->input->post('f_keywords')}");
        }
        $contact = $this->contact_m
                ->limit($pagination['limit'], $pagination['offset'])
                ->get_many_by($base_where);

        //do we need to unset the layout because the request is ajax?
        $this->input->is_ajax_request() and $this->template->set_layout(false);
        
        $this->template
                ->title($this->module_details['name'])
                ->set_partial('filters', 'admin/partials/filters')
                ->set('pagination', $pagination)
                ->set('contact', $contact)
                ->append_js('admin/filter.js')
                ->set('categories', $this->contact_m->categories);
        $this->input->is_ajax_request()
                ? $this->template->build('admin/tables/posts')
                : $this->template->build('admin/index');
    }

    public function view($id = 0) {
        $this->load->driver('Streams');
        $contact = $this->contact_m->get($id);

        if (isset($_POST['btnAction'])) {
            unset($_POST['btnAction']);

            if ($this->contact_m->update($id, $this->input->post())) {
                // All good...
                $this->session->set_flashdata('success', lang('sample.success'));
                redirect('admin/contact/view/'.$id);
            }
            else {
                $this->session->set_flashdata('error', lang('sample.error'));
                redirect('admin/contact/view/'.$id);
            }
        }

        // Build the view using sample/views/admin/form.php
        $this->template
                ->title($this->module_details['name'], lang('contact:edit'))
                ->set('contact', $contact)
                ->set('categories', $this->contact_m->categories)
                ->set('statuses', $this->contact_m->statuses)
                ->append_metadata($this->load->view('fragments/wysiwyg', array(), true))
                ->append_js('jquery/jquery.tagsinput.js')
                ->append_js('module::contact_form.js')
                ->append_css('module::blog.css')
                ->append_css('jquery/jquery.tagsinput.css')
                ->build('admin/form');
    }
    
    public function delete($id = 0)
	{
		$this->load->model('contact/contact_m');
		role_or_die('contact', 'delete_live');

                
		// Delete one
		$ids = ($id) ? array($id) : $this->input->post('action_to');

		// Go through the array of slugs to delete
		if ( ! empty($ids))
		{
			foreach ($ids as $id)
			{
				$this->contact_m->delete($id);
			}
		}
		redirect('admin/contact');
	}
}