<?php 
require_once '../model/keywords.php';
require_once '../model/categories.php';
   if(strcasecmp($_GET["name_site"],'keywords.php')==0) 
            $site_update=new Keywords();
   if(strcasecmp($_GET["name_site"],'categories.php')==0)
           $site_update=new categories ();
   
   if(isset($_GET["id"]) && isset($_GET["status"])):
    $params=array(
            "id"=>$_GET["id"],
            "status"=>$_GET["status"],
    );
    
   if($site_update->updates($params)):
       if($params["status"]==1):
           echo "Enable success";
       else: 
           echo "Disable success";
       endif;
   else:
       echo "Update not success";
   endif;
endif;
?>

