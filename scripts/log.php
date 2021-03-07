<?php
require_once '../model/db.php';

class Log extends DB {
    
    public $tbl_work_categorie_logs = 'default_work_category_logs';
    public $tbl_work_logs = 'default_work_logs';
    public $tbl_work_detail_logs = 'default_work_detail_logs';

    public function __construct() {
        parent::getConnection();
    }

    /**
     * 
     */
    public function crawl_categories($categories, $site) {
        //params
        $number_of_cate=  sizeof($categories);
        $elapsed=$this->get_subtract_time($site['start'], $site['end']);
        
        //SQL query
        $query = ' INSERT INTO '. $this->tbl_work_categorie_logs. '('
                . 'id_site, '
                . 'site_name, '
                . 'time_start, '
                . 'time_count, '
                . 'categories_count,'
                . 'new_categories) '
                
                . 'VALUES ("'.
                $site['id'].'","'.
                $site['name'].'","'.
                $site['start'].'","'.
                $elapsed.'","'.
                $number_of_cate.'","'.
                $site['new_cate'].'") ';
        
        
        $this->query($query); 
        
    }
    
    public function write_crawl_work_log($info){
        //Get eplapsed time
        $elapsed=$this->get_subtract_time($info['start'], $info['end']);

        $query=' INSERT INTO '.$this->tbl_work_logs.'('
                . 'id_site, '
                . 'id_category, '
                . 'site_name, '
                . 'category_name,'
                . 'new_works,'
                . 'works_count,'
                . 'time_start,'
                . 'time_count) '
                . 'VALUES ("'.
                $info['id_site'].'","'.
                $info['id'].'","'.
                $info['s_name'].'","'.
                $info['c_name'].'","'.
                $info['new_works'].'","'.
                $info['total'].'","'.
                $info['start'].'","'.
                $elapsed.'") '; 
        
        //Excute query
        $this->query($query);
    }
    
    public function write_crawl_work_detail_log($log,$work){
        //Get eplapsed time
        $elapsed=$this->get_subtract_time($log['start'], $log['end']);

        $query=' INSERT INTO '.$this->tbl_work_detail_logs.'('
                . 'id_site, '
                . 'id_category, '
                . 'site_name, '
                . 'category_name,'
                . 'total_works,'
                . 'valid_works,'
                . 'none_description,'
                . 'none_requirement,'
                . 'time_start,'
                . 'time_count) '
                . 'VALUES ("'.
                $work['id_site'].'","'.
                $work['category_of_site'].'","'.
                $work['name'].'","'.
                $work['category_name'].'","'.
                $log['total_works'].'","'.
                $log['valid_works'].'","'.
                $log['none_description'].'","'.
                $log['none_requirement'].'","'.
                $log['start'].'","'.
                $elapsed.'") '; 
        
        //Excute query
        $this->query($query);
    }

        /**
     * 
     * @param type $start_time : timestamp
     * @param type $end_time: timestamp
     * @return type string
     */
    public function get_subtract_time($start_time,$end_time)
    {
        $start=new DateTime($start_time);
        $end=new DateTime($end_time);
        $elapsed=$end->diff($start)->format('%D:%H:%I:%S');
        return $elapsed;
    }
}
