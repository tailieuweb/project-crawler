<?php
class companies extends DB {

    private $_table_name = 'companies';//TODO
    private $_query = '';

    public function __construct() {
        $this->getConnection();
    }
    
    function isEmpty($companies){
        $warm=0;
        foreach($companies as $item=>$value){
            if(empty($value)){
                $warm=1;
                break;
            }
        }
        if($warm==1)
            echo "<h3 style='text-align:center'>Warm : </h3>";
        foreach($companies as $item=>$value){
            if(empty($value))
                echo  "<div class='notice'><b>Note:</b> ".$item." Empty !</div>";   
        } 
     
    }

    public function insert($companies) {      
        $flag = $this->hasCompanies($companies['name']); 
        if (empty($flag)) {
            $query = 'INSERT INTO '.$this->_table_name.'(
                                        name,
                                        website,
                                        phones,
                                        address,
                                        status,
                                        notes,
                                        description
                                        )'.
                'VALUES('.
                        '"'.mysqli_escape_string($companies['name']).'",'.
                        '"'.mysqli_escape_string($companies['website']).'",'.
                        '"'.mysqli_escape_string($companies['phones']).'",'.
                        '"'.mysqli_escape_string($companies['address']).'",'.
                        '"'.mysqli_escape_string($companies['status']).'",'.
                        '"'.mysqli_escape_string($companies['notes']).'",'.
                        '"'.mysqli_escape_string($companies['description']).'"'
                        .')';
                $this->isEmpty($companies);
            return $this->query($query);
        } else {
            return NULL;
        }
    }
    public function hasCompanies($name) {
        $query = 'SELECT name FROM ' . $this->_table_name . '
                  WHERE name like "' . mysqli_real_escape_string($name) . '"';
        $results = $this->query($query);
        $row = mysqli_fetch_assoc($results);
        return $row;
    }
    
    public function select($page=NULL,$counter=FALSE){
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
        $query="SELECT $fields FROM works ORDER BY posted_date DESC ".$limit;
        $results=$this->query($query);
        $companies=array();
        while ($row = mysqli_fetch_assoc($results))
            $companies[]=$row;
        return $companies;   
    }    
    
    public function updates($params=null) {
       $query = "UPDATE works  
                                    SET 
                                         name='".$params['name']."',
                                         website='".$params['website']."',
                                         phones=".$params['phones'].",
                                         address='".$params['address']."',
                                         status='".$params['status']."',
                                         notes=".$params['notes'].",
                                         description='".$params['description']."'
                 WHERE id=".$params['id'];
       return $this->query($query);
    }
    public function deleteCompanies($id)
    {
       $query="DELETE FROM $this->_table_name WHERE id=$id";
       return $this->query($query);
    }
}