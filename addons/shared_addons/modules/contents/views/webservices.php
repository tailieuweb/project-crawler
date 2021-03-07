<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?php
   $json = array();
   $json["Categories"]= array();
   foreach ($data as $item)
       array_push ($json["Categories"], $item);
   echo json_encode($json);
