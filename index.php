<?php

$url= 'https://stackoverflow.com/tags';
$html = file_get_contents($url);
file_put_contents("tag.html", $html);
var_dump($html);

$ret = $html->find('.post-tag');
var_dump($ret);

?>