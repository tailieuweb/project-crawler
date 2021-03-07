<?php

define('PER_PAGE', 10);

class Work_locations_m extends MY_Model {

    public $table = 'work_locations';
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
    public function get_works_locations($params = array()) {
        $this->db->where('id_alias', 0);
        $this->db->order_by('name', 'ASC');
        if (!empty($params['limit'])) {
            $this->db->limit($params['limit'], $params['offset']);
        }
        $query = $this->db->get($this->table);
        $parents = $query->result_array();
        $this->get_sub_works_locations($parents);
        return $parents;
    }

    //Get sub work locations
    public function get_sub_works_locations(&$parents) {
        foreach ($parents as $key => $location) {
            $this->db->where('id_alias', $location['id']);
            $this->db->order_by('name', 'ASC');
            $query = $this->db->get($this->table);
            $parents[$key]['child'] = $query->result_array();
        }
        return $parents;
    }
    
    public function convert_to_select(){
        $locations = $this->get_works_locations();
        $_locations = array();
        foreach ($locations as $index => $location) {
            $_locations[$location['id']] = $location['name'];
        }
        return $_locations;
    }
    
    public function update_status($sites) {
        foreach ($sites as $id => $status) {
            $params = array(
                'status' => (int)$status
            );
            $this->update($id, $params);
        }
    }

}
