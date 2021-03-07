<?php

/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
class Pages_professors_m extends MY_Model {
    private $type_id = 8;
    private $depts = array(
        'fit'           => 'Văn phòng khoa',
        'informatics'   => 'Tin học cơ sở',
        'software'      => 'Công nghệ phần mềm',
        'graphic'       => 'Đồ họa',
        'network'       => 'Mạng máy tính'
    );
    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'default_pages_professor';
    }

    public function get_live() {
        $professors = array();
        foreach ($this->depts as $key => $value) {
            $params = array(
                'professor_dept' => $value,
            );
            $professors[$key] = $this->get_professors($params);
        }
        return $professors;
    }
   
    public function get_professors ($params = array() ) {
        $this->db->select("{$this->_table}.*, default_files.filename, default_pages.uri, default_files.path, default_pages.title");
        if (isset($params['professor_dept'])) {
            $this->db->where('professor_dept', $params['professor_dept']);
        }
        $this->db->join('default_files', "default_files.id = {$this->_table}.professor_image");
        $this->db->join('default_pages', "default_pages.type_id = {$this->type_id} AND default_pages.entry_id = {$this->_table}.id");
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }
}
