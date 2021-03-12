<?php

$url= '';
$html = file_get_contents($url);
file_put_contents("groupfb.html", $html);
var_dump($html);
?>