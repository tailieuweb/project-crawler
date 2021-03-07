<?php

/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
define('CAT_TECHNOLOGY', 1);
define('CAT_STUDENT', 2);
define('CAT_PROFESSOR', 3);
define('CAT_ALUMNUS', 4);
class Blogs_m extends MY_Model {
    private $limit = 6;
    public $categories = array(
        
    );
    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'default_blog';
    }

    public function get_live_technologies($offset=0, $is_counter=FALSE) {
        $this->db->select("{$this->_table}.*, default_files.filename");
        $this->db->join('default_blog_categories', "default_blog_categories.slug='blog_technology' AND default_blog_categories.id = {$this->_table}.category_id");
        $this->db->join('default_files', "default_files.id = {$this->_table}.blog_image");
        if ($is_counter) {
            $this->db->from($this->_table);
            return $this->db->count_all_results();
        } else {
            $this->db->limit($this->limit);
            $query = $this->db->get($this->_table);
            return $query->result_array();
        }
    }
    public function get_live_alumnus() {
        $this->db->select("{$this->_table}.*, default_files.filename");
        $this->db->limit($this->limit);
        $this->db->join('default_blog_categories', "default_blog_categories.slug='blog_alumnus' AND default_blog_categories.id = {$this->_table}.category_id");
        $this->db->join('default_files', "default_files.id = {$this->_table}.blog_image");
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }
    public function get_live_blogs($category_id, $offset=0, $is_counter=FALSE) {
        $this->db->select("{$this->_table}.*, default_files.filename, default_files.path");
        $this->db->join('default_files', "default_files.id = {$this->_table}.blog_image");
        $this->db->where('category_id', $category_id);
        if ($is_counter) {
            $this->db->from($this->_table);
            return $this->db->count_all_results();
        } else {
            $offset = $offset < 1?0:($offset-1)*10;
            $this->db->limit(10, $offset);
            $this->db->order_by('created_on','DESC');
            $query = $this->db->get($this->_table);
            return $query->result_array();
        }
    }
}
