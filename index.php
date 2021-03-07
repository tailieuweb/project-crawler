<?php

$url= 'https://stackoverflow.com/questions/11227809/why-is-processing-a-sorted-array-faster-than-processing-an-unsorted-array';
$html = file_get_contents($url);
file_put_contents("detail.html", $html);
var_dump($html);
?>