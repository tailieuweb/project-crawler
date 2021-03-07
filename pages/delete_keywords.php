<?php
require_once '../config/config.php';
require_once '../model/db.php';
require_once '../model/keywords.php';
?>
<?php
    $keywords = new Keywords();
    if ($keywords->deleteKeyword($_GET["id"])){
        header("location:keywords.php");
    }
    else {
        echo "Erro Back <<";     
    }
