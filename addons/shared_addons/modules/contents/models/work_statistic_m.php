<?php

/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
class Work_statistic_m extends MY_Model {

    private $limit = 5;
    private $type_id = 4;
    public $table_work_categories = 'default_work_categories';

    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'default_work_sites';
    }

    public function get_live($params = array()) {
        if (!empty($params['join'])) {
            $this->db->select('default_blog.*');
            $this->db->join($params['join'], $params['join'] . '.id=default_work_graduated.id_course');
        }
        if (!empty($params['status'])) {
            $this->db->where('status', $params['status']);
        }

        $this->db->order_by('name', 'ASC');
        $query = $this->db->get($this->_table);
        $graduated = $query->result_array();
        return $graduated;
    }

    public function get_work_categories($params = array()) {
//        if (!empty($params['join'])) {
//            $this->db->select('default_blog.*');
//            $this->db->join($params['join'], $params['join'] . '.id=default_work_graduated.id_course');
//        }
        $sql = "SELECT c.id,c.name,c.path,
                    (	
                        SELECT count(*)
                        FROM default_blog as b
                        WHERE 		 
                                (id_work_categories like CONCAT(c.id,'')) OR
                                (id_work_categories like CONCAT(c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id))	 	 
                    ) AS count_works,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW())
                    ) AS Active,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW()) AND
                             (b.title is not NULL) 	AND 
                             (b.description != '') AND 
                             (b.requirements != '') 
                    ) AS \"Full info\"
                FROM {$this->table_work_categories} as c
                WHERE c.path = 0
                ORDER BY name ASC";
        $query = $this->db->query($sql);
        $work_categories = $query->result_array();
        $this->get_sub_work_categories($work_categories);
        return $work_categories;
    }

    public function get_sub_work_categories(&$parent) {
        foreach ($parent as $key => $item) {
            $sql = "SELECT c.id,c.name,
                    (	
                        SELECT count(*)
                        FROM default_blog as b
                        WHERE 		 
                                (id_work_categories like CONCAT(c.id,'')) OR
                                (id_work_categories like CONCAT(c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id))	 	 
                    ) AS count_works,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW())
                    ) AS Active,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW()) AND
                             (b.title is not NULL) 	AND 
                             (b.description != '') AND 
                             (b.requirements != '') 
                    ) AS \"Full info\"
                FROM {$this->table_work_categories} as c
                WHERE c.path = {$item['id']} 
                ORDER BY name ASC";
            $query = $this->db->query($sql);
            $parent[$key]['child'] = $query->result_array();
        }
        return $parent;
    }

    public function convert_to_select($params = array()) {
        $sites = $this->get_live($params);
        $_sites = array();
        foreach ($sites as $index => $site) {
            $_sites[$site['id']] = $site['name'];
        }
        return $_sites;
    }

    public function count() {
        $this->db->select($this->_table . '.id, count(default_blog.id) as count');
        //$this->db->from($this->_table);
        $this->db->join('default_blog', 'default_blog.id_site=' . $this->_table . '.id', 'left');
        $this->db->group_by($this->_table . '.id');
        //$this->db->get();
        $query = $this->db->get($this->_table);
        $counts = $query->result_array();
        return $counts;
    }

    public function update_status($sites) {
        foreach ($sites as $id => $status) {
            $params = array(
                'status' => (int) $status
            );
            $this->update($id, $params);
        }
    }

}
