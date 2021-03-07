<?php

define('REQUEST_WAITING', 'waiting');
define('REQUEST_SPAM', 'spam');
define('REQUEST_RESOLVED', 'resolved');
define('REQUEST_NEW', 'new');

class Contacts_m extends MY_Model {

    public $configs = array();
    protected $_table = 'contacts';
    public function __construct() {
        $this->fields = array(
            'name' => TRUE,
            'message' => TRUE,
            'email' => TRUE,
            'status' => TRUE,
            'posted' => TRUE
        );
        $this->statuses = array(
            REQUEST_WAITING => 'Chờ trả lời',
            REQUEST_SPAM => 'Spam',
            REQUEST_RESOLVED => 'Đã trả lời',
            REQUEST_NEW => 'Mới',
        );
        $this->configs = array(
            'img_path' => './uploads/default/captcha/',
            'img_url' => base_url('uploads/default/captcha') . '/',
            'border' => 0,
            'expiration' => 1800
        );
    }

    public function get_contacts($request = array(), $counter = FALSE) {
        //Subject
        if (!empty($request['subject'])) {
            $this->db->like('subject', $request['subject']);
        }
        //Status
        if (!empty($request['status'])) {
            $this->db->where('status', $request['status']);
        } else if (!isset($request['status'])) {
            $this->db->where('status', REQUEST_NEW);
        }
        if (!$counter) {
            $request['page'] = !empty($request['page']) ? $request['page'] : 0;
            $this->db->order_by('posted', 'DESC');
            $query = $this->db->get($this->_table, PER_PAGE, $request['page']);
            return $query->result_array();
        } else {
            $this->db->from($this->_table);
            $num_rows = $this->db->count_all_results();
            return $num_rows;
        }
    }
    public function is_valid_captcha($params, $session){
        if (strcmp($params['word'], $session['word']) != 0) return FALSE;
        if (strcmp($params['ip'], $session['ip']) != 0) return FALSE;
        if ($params['time'] - $this->configs['expiration'] >  $session['time']) return FALSE;
        return TRUE;
    }

}
