<?php

/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
class Pages_slideshow_m extends MY_Model {
    private $limit = 5;
    private $type_id = 2;
    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'default_pages_slideshow';
    }

    public function get_live() {
        $this->db->select("{$this->_table}.*, default_files.filename, default_files.path, default_pages.uri, default_pages.title, default_pages.slug");
        $this->db->limit($this->limit);
        $this->db->join('default_files', "default_files.id = {$this->_table}.slideshow_image");
        $this->db->join('default_pages', "default_pages.type_id = {$this->type_id} AND default_pages.entry_id = {$this->_table}.id");
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }
}
