<?php

/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
class Pages_news_m extends MY_Model {
    private $limit = 5;
    private $type_id = 4;
    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'default_pages_news';
    }

    public function get_live($type) {
        $this->db->select(""
                . "default_pages_news.id, .default_pages_news.created, news_description as body, news_overview as overview,"
                . "default_files.path, default_pages.uri, default_pages.title,"
                . "default_pages.slug");
        $this->db->limit($this->limit);
        $this->db->where('default_pages_news.type', $type);
        $this->db->where('status', 'live');
        $this->db->join('default_files', "default_files.id = {$this->_table}.news_image");
        $this->db->join('default_pages', "default_pages.type_id = {$this->type_id} AND default_pages.entry_id = {$this->_table}.id");
        $this->db->order_by('created', 'DESC');
        $query = $this->db->get($this->_table);
        $news = $query->result_array();
        return $news;
    }
    public function get_live_list($params) {
        $this->db->select("{$this->_table}.*, default_files.filename, default_files.path, default_pages.uri, default_pages.title");
        if (!empty($params['type'])) {
            $this->db->where("{$this->_table}.type", $params['type']);
        }
        $this->db->where('status', 'live');
        $this->db->join('default_files', "default_files.id = {$this->_table}.news_image");
        $this->db->join('default_pages', "default_pages.type_id = {$this->type_id} AND default_pages.entry_id = {$this->_table}.id");
        $this->db->order_by('created_on', 'DESC');
        $this->db->limit($params['limit'], $params['offset']);
        $query = $this->db->get($this->_table);
        
        return $query->result_array();
    }
    public function get_live_count() {
        $this->db->from($this->_table);
        $count = $this->db->count_all_results();
        return $count;
    }
}
