<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_mapped extends Admin_Controller
{
    protected $section = 'mapped';

    public function __construct()
    {
        parent::__construct();
        //Load model
        $this->load->model('work_statistic_m');
        $this->load->model('all_categories_m');
        $this->load->model('work_categories_m');
                
        $this->template->append_js('module::admin.js')
            ->append_css('module::admin.css')
            ->append_js('admin/filter.js');
    }

    public function index() {
        $sites = $this->work_statistic_m->convert_to_select(array('status'=>1));
        $params = array('id_site'=>key($sites));
        if ($this->input->post('id_site')) {
            $params['id_site'] = $this->input->post('id_site');
            $this->template->set('id_site', $params['id_site']);
        }
        if ($this->input->post('status')) {
            $params['status'] = $this->input->post('status');
        } else {
            $params['status'] = 'checked';
        }
        if ($this->input->post('mapped')) {
            $params['mapped'] = $this->input->post('mapped');
        }
        if ($this->input->post('btnAction')) {
            $this->all_categories_m->update($params['id_site'],$params);
        }
        $all_categories = $this->all_categories_m->get_live($params);
        $categories = $this->work_categories_m->get_valkeys();
        //do we need to unset the layout because the request is ajax?
        $this->input->is_ajax_request() and $this->template->set_layout(false);
        
        $this->template
            ->title($this->module_details['name'])
            ->set('sites', $sites)
            ->set('categories', $categories)
            ->set('all_categories', $all_categories);
        
        $this->input->is_ajax_request()
                ? $this->template->build('admin/tables/mapped')
                : $this->template->build('admin/mapped/index');
    }
}