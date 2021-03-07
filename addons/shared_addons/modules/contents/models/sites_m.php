<?php

/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
class Sites_m extends MY_Model {
    private $limit = 5;
    private $type_id = 4;
    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'default_work_sites';
    }

    public function get_live() {
        $this->db->limit($this->limit);
        $query = $this->db->get($this->_table);
        $sites = $query->result_array();
        return $sites;
    }
    
    public function convert_to_select(){
        $sites = $this->get_live();
        $_sites = array();
        foreach ($sites as $index => $site) {
            $_sites[$site['id']] = $site['name'];
        }
        return $_sites;
    }
}
