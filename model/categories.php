<?php

class categories extends DB{
    
    private $_table_name="default_work_categories";
    
    public function __construct() {
        parent::getConnection();
    }
     public function notice($test) {
        if ($test != null)
            echo 'SUCCESS';
        else
            echo 'FAIL';
    }

    public function hasKeyword($params) {
        $query = 'SELECT name FROM ' . $this->_table_name . '
                  WHERE name like "' . mysqli_real_escape_string(self::$_connection,$params['name_categories']) . '"';
        $results = $this->query($query);
        $row = mysqli_fetch_assoc($results);
        return $row;        
    }
    
    public function insert($params) {
        $flag = $this->hasKeyword($params);
        if (empty($flag)) {
            $query = 'INSERT INTO ' . $this->_table_name . '(name)' .
                    'VALUES(' .
                    '"' . mysqli_real_escape_string($params['name_categories']) . '"'
                    . ')';
            return $this->query($query, $this->QUERY_INSERT);
        } else {
            return NULL;
        }
    }
    //
    public function select($params=null,$page=null,$counter=FALSE) {
        $where="WHERE (1) ";
            if(!empty($params["id"]))
                $where.="AND id=".$params['id'];
        $limit='';
            if(!empty($page)){
                $start=($page-1)*PER_PAGE;
                $limit='LIMIT '.$start.','.PER_PAGE;
            }
         $fields = '*';
            if ($counter) {
                $fields = 'count(*) AS counter';
                $limit='';
            }
        $query = "SELECT  $fields FROM " . $this->_table_name .' '.$where. ' ORDER BY ID ASC '.$limit;
        $rows = array();
        $result = $this->query($query);
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    //
     public function updates($params=NULL) {
         var_dump($params);
        $set_values="" ;
            if(!isset($params['status'])){ 
                $flag = $this->hasKeyword($params);
                    if (empty($flag))
                        $set_values.="name='" .mysqli_escape_string (self::$_connection,$params['name_categories']) . "'";
            }
            else
                $set_values.="status=". $params['status'];
            if(!empty($set_values)){
                $query = "UPDATE " . $this->_table_name . "  
                                        SET $set_values 
                                        WHERE id=".$params['id'];
                return $this->query($query);
            }
            else 
                return NULL;
    }

    public function deleteCategories($id) {
        $query = "DELETE FROM $this->_table_name WHERE id=$id";
        return $this->query($query);
    }
}

