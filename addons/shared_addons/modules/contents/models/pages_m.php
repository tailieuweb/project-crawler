<?php

/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
class Pages_m extends MY_Model {
    private $limit = 5;
    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'default_pages';
    }

    public function get_similar_items($type_id, $entry_id = NULL) {
        $this->db->select("{$this->_table}.*");
        $this->db->where('type_id', $type_id);
        if (!empty($entry_id)) {
            $this->db->where('entry_id !=', $entry_id);
        }
        $this->db->limit($this->limit);
        $this->db->order_by('created_on', 'DESC');
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }
}
