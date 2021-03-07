<?php

require_once 'db.php';

class All_Categories_Model extends DB {

    private $_table_name = "default_work_all_categories";
    private $_table_categories_log="default_work_category_logs";
    
    
    public function __construct() {
        parent::getConnection();
    }

    public function insertFromArray($categories) {
        $count_new_cate=0;
        foreach ($categories as $index => $category) {
            if($this->insert($category)){
                $count_new_cate++;
            }           
        }
        return $count_new_cate;
    }

    public function insert($category) {
        $flag = $this->hasKeyword($category);        
        if (!$flag) {
            $query = 'INSERT INTO ' . $this->_table_name . '(name, url, id_site, results)' .
                    'VALUES(' .
                    '"' . mysqli_real_escape_string(self::$_connection, $category['name']) . '",' .
                    '"' . mysqli_real_escape_string(self::$_connection, $category['url']) . '",' .
                    $category['id_site']. ','.
                    $category['results']
                    . ')';
            return $this->query($query, $this->QUERY_INSERT);
        } else {
            return NULL;
        }
    }
    public function update($id, $params) {
        $query = ' UPDATE '.$this->_table_name
                .' SET '
                .'      status_crawler = '.$params['status_crawler']
                .' WHERE id='.$id;
        return $this->query($query);
    }

    public function hasKeyword($category) {
        $query = 'SELECT * FROM ' . $this->_table_name . '
                  WHERE url like "' . mysqli_real_escape_string(self::$_connection, $category['url']) . '"';
        $row = $this->fetch_assoc($query);
        if (empty($row)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function get_category_by($where) {
        $wh = ' WHERE (1=1) ';
        if (!empty($where)) {
            foreach ($where as $key => $item) {
                $wh .= " AND ($key = $item)";
            }
        }
        $query = 'SELECT * FROM '.$this->_table_name.$wh;
        $categories = $this->fetch_assoc($query);
        return $categories;
    }
    /**
     * 
     * Get category information
     */
    public function get_category_for_crawling() {
        $query = 'SELECT 
                         c.id,
                         c.results, 
                         c.name AS c_name,
                         c.url AS c_url, 
                         c.id_categories AS id_categories,
                         s.name AS s_name, 
                         s.class,
                         s.id AS id_site,
                         s.url AS s_url '.
                 'FROM '.$this->_table_name. ' AS c '.
                 'INNER JOIN default_work_sites as s ON s.id = c.id_site '.
                 'WHERE (c.status_crawler = 0) AND (c.status = 1) AND (s.status = 1) AND (c.id_categories is not NULL) AND (c.in_progress = 0) '
                 .'LIMIT 1 ';
            
        $caregories = $this->fetch_assoc($query);

        $query = ' UPDATE '.$this->_table_name
                .' SET '
                .' in_progress = 1'
                .' WHERE id=-1 ';
                foreach($caregories as $categorie){
                    $where .= "OR (id=$categorie[id])";
                }
                $query .= $where;
                $this->query($query);
        return $caregories;
    }
    
    public function get_categories_logs(){
        $query=' SELECT * FROM '.$this->_table_categories_log;
        $categories=  $this->fetch_assoc($query);
        return $categories;
    }
    
    public function get_mapped_categories($id_site){
        $query=' SELECT * FROM '.$this->_table_name
                .' WHERE (id_categories IS NOT NULL) '
                .' AND id_site= '.$id_site;
        $categories=  $this->fetch_assoc($query);
        
        return $categories;
    }
}
