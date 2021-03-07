<?php

require_once 'db.php';

class Patterns_model extends DB {

    private $_table_allias_patterns  = "default_allias_patterns";
    private $_table_value_patterns = "default_value_patterns";
    private $_table_site_patterns = "default_work_site_patterns";
    
    
    public function __construct() {
        parent::getConnection();
    }

    public function insert_allias_pattern($data){
        $query=' INSERT INTO '.$this->_table_allias_patterns.' (name_pattern, machine_name) '.
                ' VALUE ('.
                '"'.mysqli_real_escape_string(self::$_connection,$data['pattern_name']).'",'.
                '"'.mysqli_real_escape_string(self::$_connection,$data['machine_name']).'"'.
                ')';
              return $this->query($query,$this->QUERY_INSERT);
    }
    
    /**
     * Insert new pattern 
     * @param type $id_site
     * @param type $id_pattern
     * @return type
     */
    public function insert_site_patterns($id_site,$id_pattern){
        $query= ' INSERT INTO '.$this->_table_site_patterns.' (id_site,id_pattern) '.
                ' VALUE ('.
                '"'.mysqli_real_escape_string(self::$_connection,$id_site).'",'.
                '"'.mysqli_real_escape_string(self::$_connection,$id_pattern).'"'.
                ')';
        return $this->query($query);
    }
    
    public function get_patterns_site($id_site) {
        $query = 'SELECT a.machine_name, v.id_site, v.id_pattern, v.value_pattern '. 
                ' FROM '.$this->_table_value_patterns .' AS v
                  INNER JOIN '.$this->_table_allias_patterns .' AS a ON
                        a.`id` = v.id_pattern '.
                ' WHERE v.id_site ='.  number_format($id_site);
        $patterns = $this->fetch_assoc($query);
        $results = array();
        
        foreach ($patterns as $value_arrays) {
           $results[$value_arrays['machine_name']][] = $value_arrays['value_pattern'];
        }
        return $results;
    }
    
    /**
     * Get pattern name by id site
     * @param type $id_site
     * @return type
     */
    public function get_pattern_name_by_site($id_site){
        $query=' SELECT al.id,al.name_pattern,al.machine_name,st.id_site,st.id_pattern '.
                ' FROM '.$this->_table_allias_patterns.' AS al'.
                ' INNER JOIN '.$this->_table_site_patterns.' AS st'.
                ' ON al.id=st.id_pattern '.
                ' WHERE st.id_site ='.$id_site;
        $rows=$this->fetch_assoc($query);
        return $rows;
    }
    /**
     * Get values of the pattern depend on id site and id pattern
     * @param type $id_site
     * @param type $id_pattern
     * @return type
     */
    public function get_pattern_value($id_site,$id_pattern){
        $query= ' SELECT * '.
                ' FROM '.$this->_table_value_patterns.
                ' WHERE id_site='.$id_site.
                ' AND id_pattern='.$id_pattern; 
        $rows=$this->fetch_assoc($query);
        return $rows;
    }
    
    /**
     * Get pattern id by string
     * @param type $string
     * @return type
     */
    public function get_pattern_id($string){
        $query=' SELECT id FROM '.$this->_table_allias_patterns.
                ' WHERE machine_name LIKE "'.$string.'"';
        $result=$this->query($query);
        $row= mysqli_fetch_assoc($result);
        return $row;
    }
    
    /**
     * insert new pattern value into database
     * @param type $data
     * @return type
     */
    public function insert_pattern_value($data){
        $query=' INSERT INTO '.$this->_table_value_patterns.' (id_site, id_pattern, value_pattern) '.
                ' VALUE ('.
                '"'.mysqli_real_escape_string(self::$_connection,$data['id_site']).'",'.
                '"'.mysqli_real_escape_string(self::$_connection,$data['id_pattern']).'",'.
                '"'.mysqli_real_escape_string(self::$_connection,$data['value_pattern']).'"'.
                ')';
              return $this->query($query,$this->QUERY_INSERT);
    }
    
    public function delete_pattern_value($data){
        $query=' DELETE FROM '.$this->_table_value_patterns.
                ' WHERE id_site='.$data['id_site'].
                ' AND id_pattern='.$data['id_pattern'];
        return $this->query($query);
    }
    /**
     * Get pattern id by string
     * @param type $string
     * @return type
     */
    public function get_name_alilas(){
        $query=' SELECT name_pattern, machine_name FROM '.$this->_table_allias_patterns
                ;
        $rows=$this->fetch_assoc($query);
        return $rows;
    }
}
