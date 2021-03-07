<?php
require_once 'db.php';
define('PRI_NORMAL', 0);
define('PRI_TOP', 99);
class Works extends DB {
    private $_table_name = 'default_blog';
    private $_table_work_log='default_work_logs';
    private $_table_work_detail_log='default_work_detail_logs';
    private $_query = '';
    
    public $STATUS_DELETED = - 2;
    public $STATUS_LOCKED = -1;
    public $STATUS_NONE = 0;
    public $STATUS_UPDATED = 1;
    public $STATUS_RELEASE = 2;




    public function __construct() {
        $this->getConnection();
    }
    public function lock($id) {
        $query = ' UPDATE '.$this->_table_name.' '
                . ' SET status_crawler = '.$this->STATUS_LOCKED
                . ' WHERE id = '.$id;
        return $this->query($query);
    }
    public function updateWork($work) {
        //Log params
        $log=array();
        $work['description']=  trim($work['description']);
        $work['requirements']=  trim($work['requirements']);
        empty($work['requirements'])?$log['none_requirement']=1:$log['none_requirement']=0;
        empty($work['description'])?$log['none_description']=1:$log['none_description']=0;
        //
        $id_company = $this->insertCompany($work);
        $query = ' UPDATE '.$this->_table_name.' '
                .' SET '
                . 'title = "'.  mysqli_escape_string(self::$_connection,$work['title']).'", '
                . 'slug = "'.  mysqli_escape_string(self::$_connection,$work['slug']).'", '
                .' description = "'. mysqli_escape_string(self::$_connection,$work['description']).'", '
                .' requirements = "'.  mysqli_escape_string(self::$_connection,$work['requirements']).'", '
                .' location = "'.  mysqli_escape_string(self::$_connection,$work['location']).'", '
                .' created = "'.  $work['created'].'", '
                .' start = "'.  $work['start'].'", '
                .' end = "'.  $work['end'].'", '
                .' id_company = '.$id_company.', '
                .' category_id = 5, '
                .' created_on = '.time().', '
                .' status_crawler = '.$this->STATUS_UPDATED
                .' WHERE id = '.$work['id'];
                $this->query($query);
                return $log;
    }
    
    public function insertCompany($work) {
        $flag = $this->hasCompany($work['company_name']);
        if (empty($flag)) {
            $query = 'INSERT INTO default_work_companies(website, email, name, description, address) ' .
                    'VALUES(
                    "'.mysqli_escape_string(self::$_connection,$work['company_website']) . '",
                    "'.mysqli_escape_string(self::$_connection,$work['company_email']) . '",
                    "'.mysqli_escape_string(self::$_connection,$work['company_name']) . '",
                    "'.mysqli_escape_string(self::$_connection,$work['company_description']) . '",
                    "'.mysqli_escape_string(self::$_connection,$work['company_address']) . '"
                    )';
            
            $this->query($query);
            return mysqli_insert_id(self::$_connection);
        } else {
            return $flag['id'];
        }
    }
    public function hasCompany($name) {
        $query = 'SELECT * FROM default_work_companies 
                  WHERE name like "' . mysqli_real_escape_string(self::$_connection,$name) . '"';
        $results = $this->query($query);
        $row = mysqli_fetch_assoc($results);
        return $row;
    }


    public function updateStatus($id, $status) {
        $query = 'UPDATE '.$this->_table_name.' 
                  SET status = '.$status.' 
                  WHERE id = '.$id;
        return $this->query($query);
    }
    public function getWorksForCrawling($limit,$id_site,$id_cate) {
        $query  = ' SELECT w.url,
                           w.id,
                           w.id_site,
                           w.created,
                           s.name,
                           s.class,
                           w.category_name,
                           w.category_of_site
                    FROM '.$this->_table_name.' AS w '.
                  ' INNER JOIN default_work_sites AS s ON s.id = w.id_site'.
                  ' WHERE (w.status_crawler = 0)  AND (w.url != "")'.
                  ' AND (w.id_site='.$id_site.')'.
                  ' AND (w.category_of_site='.$id_cate.')'.
                  ' LIMIT '.$limit;
        $works = $this->fetch_assoc($query);
        return $works;
    }

    public function insertFromArray($works) {
             $ids=array();
             foreach ($works as $index=>$work) { 
                 $flag=$this->insert($work);
                        if(!empty($flag))
                            $ids[]=$flag;
             }
        return $ids;
    }

    function isEmpty($Works) {
        $warm = 0;
            foreach ($Works as $item => $value) {
                if (empty($value)) {
                    $warm = 1;
                    break;
                 }
              }
            if ($warm == 1)
                echo "<h3 style='text-align:center'>Warm : </h3>";
            foreach ($Works as $item => $value) {
                if (empty($value))
                    echo "<div class='notice'><b>Note:</b> " . $item . " Empty !</div>";
            }
    }

    public function insert($work) {
        /** works = array(
         * 'name',
         * 'description',
         * 'experience_requirements',
         * 'posted_date',
         * 'company_name',
         * 'company_address',
         * 'company_profile',
         * 'url'
         * )
         */
        $flag = $this->hasWorks($work['url']);
        if (empty($flag)) {
            $query = 'INSERT INTO ' . $this->_table_name . '(
                                        name,
                                        url,
                                        location,
                                        description,
                                        experience_requirements,
                                        company_name,
                                        company_address,
                                        company_profile,
                                        id_site
                                        )' .
                    'VALUES(' .
                    '"' . mysqli_escape_string(self::$_connection,$work['name']) . '",' .
                    '"' . mysqli_escape_string(self::$_connection,$work['url']) . '",' .
                    '"' . mysqli_escape_string(self::$_connection,$work['location']) . '",' .
                    '"' . mysqli_escape_string(self::$_connection,$work['description']) . '",' .
                    '"' . mysqli_escape_string(self::$_connection,$work['experience_requirements']) . '",' .
                    '"' . mysqli_escape_string(self::$_connection,$work['company_name']) . '",' .
                    '"' . mysqli_escape_string(self::$_connection,$work['company_address']) . '",' .
                    '"' . mysqli_escape_string(self::$_connection,$work['company_profile']) . '",'.
                    '"' . mysqli_escape_string(self::$_connection,$work['id_site']). '"'.
                    ')';
           // $this->isEmpty($work);
            $this->query($query);
            return mysqli_insert_id(self::$_connection);
        } else {
            return NULL;
        }
    }

    public function hasWorks($url) {
        $query = 'SELECT url FROM ' . $this->_table_name . '
                  WHERE url like "' . mysqli_real_escape_string(self::$_connection, $url) . '"';
        $results = $this->query($query);
        $row = mysqli_fetch_assoc($results);
        return $row;
    }

    public function select($params = NULL, $page = NULL,$counter=FALSE) {

        $works = array();
        //Where
                $where = "WHERE ( 1 )";
            //Where site;
                if (!empty($params['id_site'])) {
                    $where .= " AND (id_site = {$params['id_site']})";
                }
            //Where keyword
                if (!empty($params['keyword'])) {
                    $where .= " AND (description LIKE '% {$params['keyword']} %')";
                }
           //Where listId_works relative with show_lop.php;
                if (!empty($params['listId_works'])) {
                    $where .= ' AND id IN ('.$params['listId_works'].')';
                }
        //Limit
        $limit = '';
        if (!empty($page)) {
            $start = ($page - 1) * PER_PAGE;
            $limit = "LIMIT $start,".PER_PAGE;
        } 
        //Fields
        $fields = '*';
        if ($counter) {
            $fields = 'count(*) AS counter';
            $limit='';
        }
        //Query string
        $query = "SELECT $fields FROM $this->_table_name 
                  $where
                  $limit";

       
        $results = $this->query($query);
        while ($row = mysqli_fetch_assoc($results)) {
            $works[] = $row;
        }
        return $works;
    }
    
    public function selectAll() {
        $works = array();
        
        $limit = '';
        if (!empty($page)) {
            $start = ($page - 1) * PER_PAGE;
            $limit = "LIMIT $start,".PER_PAGE;
        } 
        //Fields
        $fields = '*';

        $query = "SELECT wlc.name, wc.name as namecompany, wc.address, wc.description, wr.requirements
                FROM default_work_companies as wc
                INNER JOIN default_work_recruitments as wr
                ON wc.id = wr.id_companies
                INNER JOIN default_work_all_categories as wlc
                ON wr.id_categories = wlc.id
                $limit";

        $results = $this->query($query);
        while ($row = mysqli_fetch_assoc($results)) {
            $works[] = $row;
        }
        return $works;
    }
    
    public function updates($work = array()) {
        $set_values="id=".mysqli_escape_string(self::$_connection, $work['id']).", ";
            if(isset($work['name']))
                            $set_values.="name='" .mysqli_escape_string(self::$_connection, $work['name']) . "', ";
            if(isset($work['url']))
                            $set_values.="url='" .mysqli_escape_string(self::$_connection, $work['url']) . "', ";
            if(isset($work['localtion']))
                            $set_values.="localtion='" .mysqli_escape_string(self::$_connection, $work['localtion']) . "', ";
            if(isset($work['company_name']))
                            $set_values.="company_name='" . mysqli_escape_string(self::$_connection,$work['company_name']). "', ";
            if(isset($work['company_address']))
                            $set_values.="company_address='" . mysqli_escape_string(self::$_connection,$work['company_address']) . "', ";
            if(isset($work['company_profile']))
                            $set_values.="company_profile='" . mysqli_escape_string(self::$_connection,$work['company_profile']) . "', ";
            if(isset($work['description']))
                            $set_values.="description='" . mysqli_escape_string(self::$_connection,$work['description']) . "', ";
            if(isset($work['experience_requirements']))
                            $set_values.="experience_requirements='" . mysqli_escape_string(self::$_connection,$work['experience_requirements']) . "' ";
        $query = "UPDATE " . $this->_table_name . "  SET $set_values WHERE id=" . $work['id'];
        return $this->query($query);
    }

    public function deleteWorks($id) {
        $query = "DELETE FROM $this->_table_name WHERE id=$id";
        return $this->query($query);
    }
    
    public function getCategoriesFromWork(){
        $query='SELECT DISTINCT b.id_site,b.category_of_site
                FROM `default_blog` as b
                WHERE b.status_crawler=0';
        $categories = $this->fetch_assoc($query);
        return $categories;
    }

        public function insertUrls($data) {
        $new_works_count=0;
        foreach ($data['urls'] as $index => $url) {
            $flag = $this->hasWorks($url);
            if (empty($flag)) {
                $posted = 0;
                if (!empty($data['created'])) {
                    $posted = $data['created'][$index];
                }
                $query = 'INSERT INTO '.$this->_table_name.'(url, id_work_categories, created, id_site, category_id, author_id, status_crawler,category_of_site,category_name) '.
                         'VALUES("'.mysqli_escape_string(self::$_connection,$url).'",'
                        . '"'.$data['id_work_categories'].'","'
                        . $posted.'",'
                        . $data['id_site'].','
                        . $data['category_id'].','
                        . $data['author_id'].','
                        . $data['status_crawler'].','
                        . $data['category_of_site'].',"'
                        . $data['category_name'].
                        '")';
                $this->query($query);
                $new_works_count++;
            } else {
                //echo $url."\n";
            }
        }
        return $new_works_count;
    }
    public function get_works_log(){
        $query=' SELECT * FROM '.$this->_table_work_log;
        $works=$this->fetch_assoc($query);
        return $works;
    }
    
    public function get_work_details_log(){
         $query=' SELECT * FROM '.$this->_table_work_detail_log;
        $works=$this->fetch_assoc($query);
        return $works;
    }
    
    public function get_none_description_work($id_site,$id_category){
        $query=' SELECT * FROM '.$this->_table_name
                .' WHERE id_site= '.$id_site
                .' AND category_of_site= '.$id_category
                .' AND (description IS NULL OR description="") '
                .' AND status_crawler=1 ';
        $works=$this->fetch_assoc($query);
        return $works;
    }
     public function get_none_requirement_work($id_site,$id_category){
        $query=' SELECT * FROM '.$this->_table_name
                .' WHERE id_site= '.$id_site
                .' AND category_of_site= '.$id_category
                .' AND (requirements IS NULL OR requirements="") '
                .' AND status_crawler=1 ';
        $works=$this->fetch_assoc($query);
        return $works;
    }
}