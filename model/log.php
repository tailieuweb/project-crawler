<?php
class log{
    public $file=null;
    public $path=null;
    
public function openfile(){
        $this->path= realpath("../log/log.txt");
        $this->file = fopen($this->path,'a+') or exit("khong the mo file");  
    }
public function writefile($log=array()){
            $save=implode(";-;",$log);    
            fwrite($this->file,$save.PHP_EOL);    
    }
function close(){
        fclose($this->file);
    }
    
public function outputfiles(){
        $fp= realpath("../log/log.txt");
        $file = fopen($fp,'r+') or exit("Not open file");  
        $rows=array();
        while(!feof($file)){
            $rows[]= fgets($file);
        }
        fclose($file); 
        return $rows;
    }

public function search_log($log=array(),$params=NULL){
    $rows=array();
       foreach ($log as $item):
           if(!empty($item)):
               $item=(explode(";-;", $item));
               $from_date=strtotime($params["from_date"]);
               $to_date=strtotime($params["to_date"]);
               $date=strtotime($item[0]);
               if($params["search"]!=NULL&&
                      $date>=$from_date&&
                        $date<=$to_date &&
                      strcasecmp($item[1],$params["site"])==0 //&&
                      //strcasecmp($item[4],$params["error"])==0
                      ):
                $rows[]=  implode(";-;", $item);
               endif;
           endif;
       endforeach;
    return $rows;
}
}