<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Api extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jobs_m');
    }
    public function index_get()
    {
        $jobs = $this->jobs_m->get_live(array());
        $this->response($jobs);
    }
}