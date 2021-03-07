<?php

class Work_crawler_m extends MY_Model {

    private $limit = 5;
    private $type_id = 4;

    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'work_crawler';
    }

    //Get all works categories logs
    public function get_value_fields($params = array()) {
        $this->db->order_by('id', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get($this->_table);
        $result = $query->result_array();
        if (empty($result)) {
            $id = $this->insert(array('threads' => '0', 'sleep' => '0'));
            $this->db->where('id', $id);
            $query = $this->db->get($this->_table);
            $result = $query->result_array();
        }
        return $result[key($result)];
    }

}
