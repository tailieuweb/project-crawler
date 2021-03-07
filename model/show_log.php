<?php
// version for table ;
require_once 'db.php';

class show_log extends DB{
 public $table_name="log"; 
 public function __construct() {
        $this->getConnection();
    }
    public function insert($params=NULL){  
        $query = 'INSERT INTO ' . $this->table_name . '(
                                        crawl_date,
                                        id_site,
                                        id_keyword,
                                        total,
                                        inserted,
                                        id_works
                                        )' .
                    'VALUES(' .
                    '"' . mysqli_escape_string($params['date']) . '",' .
                    '"' . mysqli_escape_string($params['id_site']) . '",' .
                    '"' . mysqli_escape_string($params['id_keywords']) . '",' .
                    '"' . mysqli_escape_string($params['total']) . '",' .
                    '"' . mysqli_escape_string($params['inserted']) . '",' .
                    '"' . mysqli_escape_string($params['id_works']) . '"' .
                    ')';
            $result=$this->query($query);
            if($result)
                return true;
            else
                return false;
                
    }
    public function select($params=NULL, $page=NULL, $counter=FALSE){
                $rows=array();
              // Count rows ;
                $fields = '*';
                   if ($counter) {
                       $fields = 'count(id) AS counter';
                   }
             // Where of query ;
                $where="WHERE (1=1)";
                    // infor search in show_log.php;
                        if(!empty($params["from_date"]) && strcasecmp($params["from_date"],'from')!=0)
                            $where.=" AND (crawl_date >=".strtotime($params['from_date']).")";
                        if(!empty($params["to_date"]) && strcasecmp($params["to_date"],'to')!=0)
                            $where.=" AND (crawl_date <=".strtotime($params['to_date']).")";
                         if(!empty($params["id_site"]))
                            $where.=" AND (id_sites =".$params['id_site'].")";
                     //get list id_works. use in file Works.php;
                        if(!empty($params["id_showlog"]))
                            $where.=" AND (id =".$params['id_showlog'].")";
             // Limit
               $limit = '';
                     if (!empty($page)) {
                         $start = ($page - 1) * PER_PAGE;
                         $limit = "LIMIT $start,".PER_PAGE;
                     }
             // Qeury ;
             $query="SELECT $fields FROM $this->table_name $where ORDER BY id DESC $limit";
                    $results = $this->query($query);
                        while ($row = mysqli_fetch_assoc($results)) {
                            $rows[] = $row;
                            }
             return $rows;
     
 }     
}

