<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Core\Modules\Contact\Models
 */
define('REQUEST_WAITING', '10');
define('REQUEST_SPAM', '20');
define('REQUEST_RESOLVED', '30');
define('REQUEST_NEW', '40');
class Contact_m extends MY_Model {
    protected $_table = 'contact_log';
    public $categories = array();
    public $statuses = array();
     public $configs = array();
    public function __construct() {
        parent::__construct();
        //Categories
        $this->categories = array(
            'support' => 'Support',
            'feedback' => 'Feedback',
            'other' => 'Other'
        );
        //Status
        $this->statuses = array(
            REQUEST_NEW => 'New',
            REQUEST_SPAM => 'Spam',
            REQUEST_RESOLVED => 'Resolved',
            REQUEST_WAITING => 'Waiting'
        );
      
        $this->configs = array(
            'img_path' => './uploads/default/captcha/',
            'img_url' => base_url('uploads/default/captcha') . '/',
            'border' => 0,
            'expiration' => 1800
        );
    }
    public function get_log()
    {
        return $this->db
                ->get($this->_table)
                ->result();
    }

    public function insert_log($input)
    {		
        return $this->db->insert($this->_table, array(
                'email'		=> isset($input['email']) ? $input['email'] : '',
                'subject' 		=> substr($input['subject'], 0, 255),
                'message' 		=> $input['body'],
                'sender_agent' 	=> $input['sender_agent'],
                'sender_ip' 	=> $input['sender_ip'],
                'sender_os' 	=> $input['sender_os'],	
                'sent_at' 		=> time(),
                'attachments'	=> isset($input['attach']) ? implode('|', $input['attach']) : '',
        ));
    }
    
     public function is_valid_captcha($params, $session){
        if (strcmp($params['word'], $session['word']) != 0) return FALSE;
        if (strcmp($params['ip'], $session['ip']) != 0) return FALSE;
        if ($params['time'] - $this->configs['expiration'] >  $session['time']) return FALSE;
        return TRUE;
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
}