<?php

require_once 'db.php';

class Locations_model extends DB {

    private $_table_locations  = "default_work_locations";
    
    public function get_locations(){
        $query = 'SELECT name FROM '.$this->_table_locations.
                ' WHERE status = 1';
        $results = $this->fetch_assoc($query);
       
        $locations = array();
        foreach ($results as $location){
            $locations[] = $location['name'];
        }
        return $locations;
    }
    
}
