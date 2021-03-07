<?php

/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
class Pages_works_m extends MY_Model {
    private $limit = 10;
    private $type_id = 7;
    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'default_pages_works';
    }

    public function get_live($type) {
        $this->db->select("{$this->_table}.work_overview as overview, {$this->_table}.work_description as description, default_pages.title, default_files.path, default_pages.slug");
        $this->db->limit($this->limit);
        $this->db->where("default_pages.status", 'live');
        $this->db->where("{$this->_table}.work_type", $type);
        $this->db->join('default_files', "default_files.id = {$this->_table}.work_image");
        $this->db->join('default_pages', "default_pages.type_id = {$this->type_id} AND default_pages.entry_id = {$this->_table}.id");
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }
    public function w_get_live($params){
        if(!empty($params['limit'])){
            $this->db->limit($params['limit']);
        }
        $results = $this->db->get($this->_table);
        return $results;
    }
}
