<?php

/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
class Work_courses_m extends MY_Model {
    private $limit = 5;
    private $type_id = 4;
    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'default_work_courses';
    }

     public function get_live($params = array()) {
        if (!empty($params['keyword'])) {
            $this->db->like('name', $params['keyword']); 
        }
        
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get($this->_table);
        $courses = $query->result_array();
        return $courses;
    }
    
    public function convert_to_select(){
        $sites = $this->get_live();
        $_sites = array();
        foreach ($sites as $index => $site) {
            $_sites[$site['id']] = $site['name'];
        }
        return $_sites;
    }
    
    public function update($id, $input, $skip_validation = false) {
        //Set null id_categories & status
        $data = array(
                'name'=>$input['name'],
                'status'=>$input['status']
            );
        $this->db->where('id', $id);
        $this->db->update($this->_table, $data);
        //Set new data
        if (!empty($input['mapped'])) {
            foreach ($input['mapped'] as $key => $value) {
                $data = array(
                    'id_categories' => implode(',', $value),
                    'status' => 1
                );
                $this->db->where('id', $key);
                $this->db->where('id_site', $id);
                $this->db->update($this->_table, $data);
            }
        }
    }
    
    public function update_status($courses) {
        foreach ($courses as $id => $status) {
            $params = array(
                'status' => (int)$status
            );
            $this->db->where('id', $id);
            $this->db->update($this->_table, $params);
        }
    }
    
    public function count_rows($table) {
        return $this->db->count_all($table);
    }
    
}
