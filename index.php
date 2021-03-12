<?php

$url= 'https://www.facebook.com/groups/499467900233207';
$html = file_get_contents($url);
file_put_contents("groupfb.html", $html);
var_dump($html);
?>