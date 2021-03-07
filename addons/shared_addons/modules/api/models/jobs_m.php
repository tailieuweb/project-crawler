<?php
/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
define('JOB_TYPE_WORK', 5);
define('JOB_TYPE_INTERNSHIP', 6);

class Jobs_m extends MY_Model {
    private $limit = 6;
    protected $type = array(
        JOB_TYPE_WORK => 'Work',
        JOB_TYPE_INTERNSHIP => 'Internship'
    );
    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'blog';
    }

    public function get_live($params, $count = FALSE) {
        $this->db->select("{$this->_table}.*, files.path");
        $this->db->join('files', 'files.id = blog.image', 'left');
        $this->db->where('status', 'live');
        if (!empty($params['id_categories'])) {
            foreach ($params['id_categories'] as $id) {
                $this->db->or_like('id_work_categories', "$id");
                $this->db->or_like('id_work_categories', "$id,%");
                $this->db->or_like('id_work_categories', "%,$id");
                $this->db->or_like('id_work_categories', "%,$id,%");
            }
        }
        if (!empty($params['type'])) {
            switch ($params['type']) {
                case 'Work':
                    $this->db->where('category_id', JOB_TYPE_WORK);
                    break;
                case 'Internship':
                    $this->db->where('category_id', JOB_TYPE_INTERNSHIP);
                    break;
            }
        }
        $this->db->order_by('created', 'DESC');
        
        if (isset($params['limit'])) {
            $this->db->limit($params['limit'], $params['offset']);
        }
        
        if (!$count) {
            $query = $this->db->get($this->_table);
            return $query->result_array();
        } else {
            $this->db->from($this->_table);
            return $this->db->count_all_results();
        }
    }
}