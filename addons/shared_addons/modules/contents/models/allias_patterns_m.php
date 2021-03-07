<?php

define('PER_PAGE', 10);

class Allias_patterns_m extends MY_Model {

    public $table = 'allias_patterns';
    public $table_site = 'work_site_patterns';
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

    public function get_live_patterns($params = array()) {
        $this->db->select("$this->table_site.*,default_allias_patterns.machine_name,default_allias_patterns.pattern_name ");
        $this->db->join('default_allias_patterns', "default_allias_patterns.id = $this->table_site.id_pattern");
        if (!empty($params['id_site'])) {
            $this->db->where("id_site", $params['id_site']);
        }
        
        $this->db->order_by('id_pattern', 'ASC');
        $query = $this->db->get($this->table_site);
        $parents = $query->result_array();
        $this->get_value_patterns($parents);
        return $parents;
    }
    public function get_value_patterns(&$parents) {
        
        foreach ($parents as $key => $item) {
            $this->db->select('value_pattern, status');
            $this->db->where('id_pattern', $item['id_pattern']);
            $this->db->where('id_site', $item['id_site']);
            $query = $this->db->get('default_value_patterns');
            $result = $query->result_array();
            $parents[$key]['child'] = $query->result_array();
        }
        return $parents;
    }
    
    public function insert_site_pattern($params = array()) {
        $this->db->insert($this->table_site, $params);
    }
    
    public function insert_value_pattern($params = array()) {
        $this->db->insert('default_value_patterns', $params);
    }
    
    public function delete_by_idsite($params = array()) {
        $where = array();
        if (!empty($params['id_site'])) {
            $where = array('id_site' => $params['id_site']);
        }
        $this->db->delete('default_value_patterns', $where);
    }
    
    public function delete_site_pattern_by_idpattern($id_pattern) {
        $this->db->delete($this->table_site, array('id_pattern' => $id_pattern));
    }
    
    public function get_allias_patterns(){
        $query = $this->db->get($this->table);
        $allias_pattern = $query->result_array();
        return $allias_pattern;
    }
    
//    public function convert_to_select(){
//        $allias_pattern = $this->get_allias_patterns();
//        $patterns = array();
//        foreach ($allias_pattern as $index => $item) {
//            $patterns[$item['id']] = $item['machine_name'];
//        }
//        return $patterns;
//    }
    
    //Get all works categories logs
    public function update_status($sites) {
        foreach ($sites as $id => $status) {
            $params = array(
                'status' => (int)$status
            );
            $this->update($id, $params);
        }
    }

}
