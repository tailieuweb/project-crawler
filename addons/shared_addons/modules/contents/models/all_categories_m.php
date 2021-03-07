<?php

/**
 * Description of pages_slideshow_m
 *
 * @author ptnhuan
 */
class All_categories_m extends MY_Model {
    private $limit = 5;
    private $type_id = 4;
    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'default_work_all_categories';
    }

     public function get_live($params = array()) {
        //id_site
        if (!empty($params['id_site'])) {
            $this->db->where('id_site', $params['id_site']);
        }
        //status
        if (!empty($params['status'])) {
            switch ($params['status']) {
                case 'checked':
                    $this->db->where('status', 1);
                    break;
                case 'unchecked':
                    $this->db->where('status !=', 1);
                    break;
                default :
                    
                    break;
            }
        }
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get($this->_table);
        $categories = $query->result_array();
        return $categories;
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
        $this->load->model('work_categories_m');
        $data = array(
               'id_categories' => NULL,
               'status' => 0,
            );
        $this->db->where('id_site', $id);
        $this->db->update($this->_table, $data);
        //Set new data
        if (!empty($input['mapped'])) {
            foreach ($input['mapped'] as $key => $value) {
                foreach ($value as $index => $item) {
                    $id_category = $this->work_categories_m->get($item);
                    $data = array('status'=>0);
                    if ($id_category->status == 1) {
                        $data = array('status' => 1);
                        break;
                    }
                }
                $data = array_merge($data, array('id_categories' => implode(',', $value)));
                $this->db->where('id', $key);
                $this->db->where('id_site', $id);
                $this->db->update($this->_table, $data);
            }
        }
    }
    
    public function count_rows($table) {
        return $this->db->count_all($table);
    }
    
    public function update_status($categories) {
          $params = array();
          $this->db->where('status', 1);
          $work_categories = $this->db->get('default_work_categories')->result_array();
          $this->db->flush_cache();
          $this->db->update($this->_table, array('status'=>0));
          foreach ($work_categories as $key => $item) {
            $this->db->flush_cache();
            $this->db->like('id_categories', $item['id'], 'none');
            $this->db->or_like('id_categories', "{$item['id']},", 'after');
            $this->db->or_like('id_categories', ",{$item['id']}", 'before' );
            $this->db->or_like('id_categories', ",{$item['id']},");
            $all_categories = $this->db->get($this->_table)->result_array();
            foreach ($all_categories as $category) {
                $params = array_merge(array_unique($params), array($category['id']));
            }
          }
          $this->db->flush_cache();
          foreach ($params as $item) {
            $this->db->where('id', $item);
            $this->db->update($this->_table, array('status'=>1));
          }
//        foreach ($categories as $id => $status) {
//            $params = array(
//                'status' => (int)$status
//            );
//            $this->db->like('id_categories', $id );
//            $this->db->or_like('id_categories', "$id," );
//            $this->db->or_like('id_categories', ",$id" );
//            $this->db->or_like('id_categories', ",$id,");
//            $this->db->update($this->_table, $params);
//        }
    }
    
}
