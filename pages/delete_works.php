<?php
require_once '../config/config.php';
require_once '../model/db.php';
require_once '../model/works.php';
require_once '../model/keywords.php';
require_once '../model/keys_works.php';

require_once '../pages/Sites.php';
?>
<?php
    $words=new Works();
    if ($words->deleteWorks($_GET["id"])){
        header("location:works.php");
    }
    else {
   echo "Erro Back <<";     
}


