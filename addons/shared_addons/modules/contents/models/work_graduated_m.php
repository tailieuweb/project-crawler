<?php

/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
class Work_graduated_m extends MY_Model {
    private $limit = 5;
    private $type_id = 4;
    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'default_work_graduated';
    }

     public function get_live($params = array()) {
        if (!empty($params['id_course'])) {
            $this->db->where('id_course', $params['id_course']); 
        }
        if(!empty($params['join'])){
            $this->db->select('default_work_graduated.*');
            $this->db->join($params['join'],$params['join'].'.id=default_work_graduated.id_course');
        }
        
        if (!empty($params['id_course'])) {
            $this->db->where('id_course', $params['id_course']); 
        }
        
        $this->db->order_by('ten', 'ASC');
        $query = $this->db->get($this->_table);
        $graduated = $query->result_array();
        return $graduated;
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
                'level'=>$input['level'],
                'id_category'=>$input['id_category'],
                'status'=>$input['status'],
                'description'=>$input['description'],
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
    
    public function count_rows($table) {
        return $this->db->count_all($table);
    }
    
    public $fields = array(
        'masv' => TRUE,
        'ho_lot' => TRUE,
        'ten' => TRUE,
        'gioi_tinh' => TRUE,
        'ngay_sinh' => TRUE,
        'noi_sinh' => TRUE,
        'so_tin_chi' => TRUE,
        'diem_tb' => TRUE,
        'xep_loai' => TRUE,
        'ghi_chu' => TRUE,
        'khoa' => TRUE,
        'dien_thoai' => TRUE,
        'email' => TRUE,
        'id_course' => TRUE,
    );
    public $index = array(
        1 => 'masv',
        2 => 'ho_lot',
        3 => 'ten',
        4 => 'gioi_tinh',
        5 => 'ngay_sinh',
        6 => 'noi_sinh',
        7 => 'so_tin_chi',
        8 => 'diem_tb',
        9 => 'xep_loai',
        10 => 'ghi_chu',
        11 => 'khoa',
        12 => 'dien_thoai',
        13 => 'email'
    );
    public function import($students, $id_course) {
        $students = $this->get_valid_students($students);
        foreach ($students as $student) {
            $student = $this->synkeydata($student);
            $student['id_course'] = $id_course;
            $this->insert($student);
        }
    }
    public function get_valid_students($students) {
        $temp = array();
        foreach ($students as $student) {
            $flag = $this->is_valid_row($student);
            if ($flag) {
                $temp[] = $student;
            }
        }
        if (!empty($temp)) {
            //Remove first row title
            unset($temp[0]);
        }
        return $temp;
    }
    public function is_valid_row($row) {
        $flag = TRUE;
        $count = 0;
        $max = 9;
        foreach ($row as $index => $value) {
            if ($index <= $max) {
                if (empty($value)) {
                    $flag = FALSE;
                    break;
                }
            }
        }
        return $flag;
    }
    public function synkeydata($params) {
        $student = array();
        foreach ($params as $key => $value) {
            if (isset($this->index[$key])) {
                $student[$this->index[$key]] = $value;
            }
        }
        return $student;
    }
    public function list_students($params = array()) {
        if (isset($params['id_course'])) {
            $this->db->where('id_course', $params['id_course']);
        }
        $this->db->order_by('ten', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    
}
