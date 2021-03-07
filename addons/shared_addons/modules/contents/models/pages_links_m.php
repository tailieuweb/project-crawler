<?php

/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
class Pages_links_m extends MY_Model {
    private $limit = 3;
    private $type_id = 10;
    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'default_pages_links';
    }

    public function get_live($type, $limit) {
        $this->db->select(
                    "{$this->_table}.link_url as url,"
                . "default_files.path, "
                . "default_pages.slug, default_pages.title");
        $this->db->limit($limit);
        $this->db->where("{$this->_table}.link_type", $type);
        $this->db->where("default_pages.status", 'live');
        $this->db->join('default_files', "default_files.id = {$this->_table}.link_image");
        $this->db->join('default_pages', "default_pages.type_id = {$this->type_id} AND default_pages.entry_id = {$this->_table}.id");
        $query = $this->db->get($this->_table);
        $links = $query->result_array();
        return $links;
    }
    public function get_live_list($offset = 0) {
        $this->db->select("{$this->_table}.*, default_files.filename, default_files.path, default_pages.uri, default_pages.title");
        $offset = $offset < 1?0:($offset-1)*10;
        $this->db->join('default_files', "default_files.id = {$this->_table}.news_image");
        $this->db->join('default_pages', "default_pages.type_id = {$this->type_id} AND default_pages.entry_id = {$this->_table}.id");
        $this->db->order_by('created_on', 'DESC');
        $this->db->limit(10, $offset);
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }
    public function get_live_count() {
        $this->db->from($this->_table);
        $count = $this->db->count_all_results();
        return $count;
    }
}
