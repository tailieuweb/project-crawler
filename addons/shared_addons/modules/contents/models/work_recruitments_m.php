<?php

/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
class Work_recruitments_m extends MY_Model {
    private $limit = 5;
    private $type_id = 4;
    public $configs = array();
    public function __construct() {
        parent::__construct();

        $this->configs = array(
            'img_path' => './uploads/default/captcha/',
            'img_url' => base_url('uploads/default/captcha') . '/',
            'border' => 0,
            'expiration' => 1800
        );
        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'default_work_recruitments';
    }

     public function get_live($params = array()) {
        if (!empty($params['keyword'])) {
            $this->db->like('name', $params['keyword']); 
        }
        if(!empty($params['limit'])){
            $this->db->limit($params['limit'], $params['offset']);
        }
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get($this->_table);
        $recruitments = $query->result_array();
        return $recruitments;
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
                'id_categories'=>$input['id_categories'],
                'status'=>$input['status'],
                'work_name'=>$input['work_name'],
                'work_description'=>$input['work_description'],
                'work_count'=>$input['work_count'],
                'work_end'=>$input['work_end'],
                'requirements'=>$input['requirements'],
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
    
    public function is_valid_captcha($params, $session){
        if (strcmp($params['word'], $session['word']) != 0) return FALSE;
        if (strcmp($params['ip'], $session['ip']) != 0) return FALSE;
        if ($params['time'] - $this->configs['expiration'] >  $session['time']) return FALSE;
        return TRUE;
    }
}
