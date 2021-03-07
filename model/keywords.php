<?php
require_once 'db.php';
class Keywords extends DB {

    private $_table_name = 'default_keywords';
    private $_query = '';

    public function __construct() {
        $this->getConnection();
    }

    public function insert($params=NULL) {
        $flag = $this->hasKeyword($params);
        if (empty($flag)) {
            $query = 'INSERT INTO ' . $this->_table_name . '(name,id_categories)' .
                    'VALUES(' .
                    '"' . mysqli_real_escape_string($params['name']) . '"'
                    .','.$params['id_categories']
                    . ')';
            return $this->query($query, $this->QUERY_INSERT);
        } else {
            return NULL;
        }
    }

    public function notice($test) {
        if ($test != null)
            echo SUCCESS;
        else
            echo FAIL;
    }

    public function hasKeyword($params=NULL) {
        $query = 'SELECT * FROM ' . $this->_table_name . '
                  WHERE 
                  name like "' . mysqli_real_escape_string($params['name']) . '" '.
                  'AND id_categories='.$params['id_categories'];
        $results = $this->query($query);
        $row = mysqli_fetch_assoc($results);
        return $row;
    }

    public function select($params=null,$page=null,$counter=FALSE) {
        $where="WHERE (1) ";
            if(!empty($params["id"]))
                $where.=" AND id=".$params['id_categories'];
            if(!empty($params["id_categories"]))
                $where.=" AND id=".$params['id_categories'];
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
        $query = "SELECT  $fields FROM " . $this->_table_name .' '.$where. ' ORDER BY ID DESC '.$limit;
        // var_dump($query);die();
        $keywords = array();
        $data = $this->query($query);
        while ($row = mysqli_fetch_assoc($data)) {
            $keywords[] = $row;
        }
        return $keywords;
    }
    public function updates($params=NULL) {
        $set_values="" ;
            if(!isset($params['status'])){ 
                $flag = $this->hasKeyword($params);
                    if (empty($flag)){
                        $set_values.="name='" .mysqli_escape_string ($params['name']) . "',";
                        $set_values.=" id_categories=".$params['id_categories'];
                    }
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

    public function deleteKeyword($id) {
        $query = "DELETE FROM $this->_table_name WHERE id=$id";
        return $this->query($query);
    }

}
