<?php
require_once 'db.php';
class Login extends DB{
    
    public $table_name="default_users";    
    function __construct() {
        parent::getConnection();
    }
    
    public function select(){
        $query='SELECT * FROM '.$this->table_name;
        $result=$this->query($query);
        $rows=array(array());
        while($row=  mysqli_fetch_assoc($result))
                $rows[]=$row;
        return $rows;
    }
    
    public function checkLogin($params=null){
        $where=' WHERE 1 ';
        if(!empty($params['name']))
            $where.=' AND username="'.$params['name'].'"';
        $query='SELECT * FROM '.$this->table_name.$where;
        $result = mysqli_query(DB::$_connection, $query);
        if(!empty($result)){
            $user = mysqli_fetch_assoc($result);
            if(strcmp($user['password'],md5 ($params['pass']))==0){
                return $user;
            }
        }
        else     
            return false;    
    }
    
}
  