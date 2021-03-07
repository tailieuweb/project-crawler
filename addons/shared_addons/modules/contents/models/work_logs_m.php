<?php

define('PER_PAGE', 10);

class Work_logs_m extends MY_Model {

    public $table_work_logs = 'work_logs';
    public $table_categories_log = 'work_category_logs';
    public $table_detail_logs = 'work_detail_logs';
    public $table_work_all_categories = "work_all_categories";
    public $table_blogs = "blog";
    public $fields = array(
        'name' => TRUE,
        'path' => TRUE,
        'status' => TRUE
    );
    private $limit = 5;
    private $type_id = 4;

    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
    }

    //Get all works categories logs
    public function get_works_category_logs($params = array()) {
        $this->db->order_by('time_start', 'DESC');
        if (!empty($params['limit'])) {
                $this->db->limit($params['limit'], $params['offset']);
            }
        $query = $this->db->get($this->table_categories_log);
        return $query->result_array();
    }

    //Get works all categories...group by id_site
    public function get_works_categories() {
        $params = array();
        //Get all id_site
        $this->db->select('id_site');
        $this->db->group_by('id_site');
        $query = $this->db->get($this->table_work_all_categories);
        $ids_site = $query->result_array();

        //
        foreach ($ids_site as $key => $item) {
            $this->db->where('id_site =', $item['id_site']);
            $query = $this->db->get($this->table_work_all_categories);
            $result = $query->result_array();
            $params[$item['id_site']] = $result;
        }
        return $params;
    }

    public function get_category_mapped($params = array()) {
        $categories = $this->get_works_category_logs();
        $arr = array();
        foreach ($categories as $key => $category) {
            $isHasID = false;
            foreach (arr as $key => $item) {
                if ($key == $category['id_site']) {
                    $isHasID = true;
                    break;
                }
            }
            if (!$isHasID) {
                $this->db->select("$this->table_work_all_categories.*, default_work_categories.name as category_name");
                $this->db->join('default_work_categories', "default_work_categories.id=$this->table_work_all_categories.id_categories");
                $this->db->where('id_site', $category['id_site']);
                $this->db->where('id_categories is not null');
                $query = $this->db->get($this->table_work_all_categories);
                $result = $query->result_array();
                $arr[$category['id_site']] = array();
                $arr[$category['id_site']] = array_merge($arr[$category['id_site']], $result);
            }
        }
        return $arr;
    }

    public function get_works_logs($params = array()) {
        $this->db->order_by('time_start', 'DESC');
        if (!empty($params['limit'])) {
                $this->db->limit($params['limit'], $params['offset']);
            }
        $query = $this->db->get($this->table_work_logs);
        return $query->result_array();
    }
    //Non description and non requirements
    public function get_works_non_requirement($params = array()) {
        
        if (!empty($params['type']))
            $this->db->where("({$params['type']} IS NULL OR {$params['type']} = '')");
            
        $this->db->where('status_crawler', 1);
        $query = $this->db->get($this->table_blogs);
        return $query->result_array();
    }

    public function get_work_detail_logs($params = array()) {
        $this->db->order_by('time_start', 'DESC');
        if (!empty($params['limit'])) {
                $this->db->limit($params['limit'], $params['offset']);
            }
        $query = $this->db->get($this->table_detail_logs);
        return $query->result_array();
    }
    
    public function truncate($tb = null) {
        $this->db->truncate($tb);
    }

}
