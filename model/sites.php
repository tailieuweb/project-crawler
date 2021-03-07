<?php
require_once 'db.php';
class Sites_model extends DB {
    private $_table_name = 'default_work_sites';
    private $_query = '';

    public function __construct() {
        $this->getConnection();
    }
    public function get_sites($is_get_all=FALSE) {
        $query = 'SELECT * FROM '.$this->_table_name.' WHERE status = 1';
        $is_get_all ? $query=' SELECT * FROM '.$this->_table_name:'';
        $sites = $this->fetch_assoc($query);
        return $sites;
    }
    
}