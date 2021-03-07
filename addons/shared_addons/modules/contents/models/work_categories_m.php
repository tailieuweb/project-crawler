<?php
define('PER_PAGE', 10);
class Work_categories_m extends MY_Model{
    public $table='work_categories';
    public $fields = array(
        'name' => TRUE,
        'path' => TRUE,
        'status' => TRUE
    );
    private $limit = 5;
    private $type_id = 4;
    public function __construct() {
        parent::__construct();
        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
    }
    public function get_categories($params=array(),$counter=FALSE, $is_pagination=TRUE){
        $where = array();
        $this->db->where('name !=', 'NULL');
        if(!isset($params['page']))
            $params['page']=0;
        if (!$counter) {
            if (isset($params['name']))
                $this->db->like('name',$params['name']); 
            $this->db->order_by('name','asc');
            if ($is_pagination) {
                $query = $this->db->get_where($this->table, $where, $params['limit'], $params['page']);
            } else {
                $query = $this->db->get($this->table);
            }
            return $query->result_array();
        } else {
            if (isset($params['name']))
                $this->db->like('name',$params['name']);  
            $query = $this->db->get_where($this->table,$where);
            return $query->num_rows();
        }
    }
    /**
     * 10-07-2014
     */
    public function get_parent_categories($params = array(), $counter=FALSE) {
        $this->db->where('path', 0);
        $this->db->order_by('name', 'asc');
        
        if (!empty($params['id_category'])) {
            $this->db->where('id', (int)$params['id_category']);
        }
            
        if ($counter) {
            $this->db->from($this->table);
            return $this->db->count_all_results();
        } else {
            if (!empty($params['limit'])) {
                $this->db->limit($params['limit'], $params['offset']);
            }
            $query = $this->db->get($this->table);
            $parents= $query->result_array();
            $this->get_sub_categories($parents);
            return $parents;
        }
    }
    public function get_sub_categories(&$parents) {
        $sub_categories = array();
        foreach ($parents as $index => $category) {
            $this->db->where('path', $category['id']);
            $this->db->order_by('name', 'ASC');
            $query = $this->db->get($this->table);
            $parents[$index]['child'] = $query->result_array();
        }
        return $parents;
    }
    public function get_valkeys() {
        $categories = $this->get_categories(array(), FALSE, FALSE);
        $list = $categories;
        $valkeys = array();
        foreach ($categories as $category) {
            if (empty($category['path'])) {
                $valkeys[$category['name']][$category['id']] = $category['name'];
                foreach ($list as $sub) {
                    if ($sub['path'] == $category['id']) {
                        $valkeys[$category['name']][$sub['id']] = $sub['name'];
                    }
                }
            } 
        };
        return $valkeys;
    }
    public function get_valkeys_by_id() {
        $categories = $this->get_categories(array(), FALSE, FALSE);
        $list = $categories;
        $valkeys = array();
        foreach ($categories as $category) {
                $valkeys[$category['id']] = $category['name'];
        };
        return $valkeys;
    }
    public function get_parent_valkeys($parents) {
        $categories = array(0 => '---');
        foreach ($parents as $category) {
            $categories[$category['id']] = $category['name'];
        }
        return $categories;
    }
    public function get_work_categories(&$work) {
        if (!empty($work['id_categories'])) {
            $id_categories = explode(',', $work['id_categories']);
            $this->db->where_in('id', $id_categories);
        }
        $this->db->select('name');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get($this->table);
        $categories = $query->result_array();
        $list = array();
        foreach ($categories as $category) {
            $list[] = $category['name'];
        }
        $name =  implode(' , ', $list);
        $work['name_categories'] = $name;
        return $name;
    }
    public function get_works_categories(&$works=array(), $multiple = 1){
        foreach ($works as $key => $work) {
            $works[$key]['name_categories'] = $this->get_work_categories($work);
        }
        return $works;
    }
    public function get_keyvals() {
        $query = $this->db->get($this->table);
        $categories = $query->result_array();
        $keyvals = array();
        foreach ($categories as $category) {
            $keyvals[$category['id']] = $category['name'];
        }
        return $keyvals;
    }
    public function find_categories(&$jobs) {
        foreach ($jobs as $index => $job) {
            $jobs[$index]['work_categories'] = array();
            $ids = explode(',', $job['id_work_categories']);
            if (!empty($ids)) {
                foreach ($ids as $id) {
                    $this->db->where('id', (int)$id);
                    $category = $this->db->get($this->table)->result_array();
                    $jobs[$index]['work_categories'][] = $category[0]['name'];
                }
            }
        }
    }
    public function get_cities($id = null) {
        $cities = array("An Giang",
                        "Bà Rịa - Vũng Tàu",
                        "Bạc Liêu",
                        "Bến Tre",
                        "Bình Dương",
                        "Bình Phước",
                        "Bình Thuận",
                        "Cà Mau",
                        "Cần Thơ",
                        "Đắk Lắk",
                        "Đắk Nông",
                        "Đồng Nai",
                        "Đồng Tháp",
                        "Gia Lai",
                        "Hậu Giang",
                        "Khánh Hòa",
                        "Kiên Giang",
                        "Kon Tum",
                        "Lâm Đồng",
                        "Long An",
                        "Ninh Thuận",
                        "Phú Yên",
                        "Sóc Trăng",
                        "Tây Ninh",
                        "Tiền Giang",
                        "Hồ Chí Minh",
                        "Trà Vinh",
                        "Vĩnh Long"
                    );
        if (!empty($id)) {
            return $cities[$id];
        }
        return $cities;
    }
   
    public function update_status($categories) {
        foreach ($categories as $id => $status) {
            $params = array(
                'status' => (int)$status
            );
            $this->update($id, $params);
        }
    }
    public function convert_to_select(){
        $sites = $this->get_parent_categories();
        $_sites = array();
        foreach ($sites as $index => $site) {
            $_sites[$site['id']] = $site['name'];
        }
        return $_sites;
    }
    public function getRowById($id) {
        $query = $this->db->get_where($this->table, array('id' => $id));
        $row = $query->row_array();
        return $row;
    }
}