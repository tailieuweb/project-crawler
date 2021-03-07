<?php
function inputfile($log=array()){
    $fp= realpath("../log/log.txt");
    $file = fopen($fp,'w') or exit("khong the mo file");  
    $savelog=array();
    foreach($log["works"] as $contemt)    {
        $savelog["posted"]=date("d/m/Y",$contemt["posted"]);
        $savelog["satus"]="ok";
        $savelog["site"]=$log["site"];
        $savelog["keywords"]=$log["keywords"];
        $savelog["total"]=$log["total"];
        $savelog["description_erro"]="ok";
        if(empty($savelog))
           $save="";
        else
            $save=implode(";-;",$savelog);
    fwrite($file,$save.PHP_EOL);  
    }
    fclose($file); 
}


function outputfile(){
    $fp= realpath("../log/log.txt");
    $file = fopen($fp,'w') or exit("Not open file");  
    $rows=array();
    while(feof($file))
        $rows[]=  fgetc ($file);
    fclose($file); 
    return $rows[];
}
