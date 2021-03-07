<?php

require_once '../model/sites.php';
$obj = new Sites_model();

$array = $obj->demo();
var_dump(($array));
echo microtime();
foreach ($array as $value_arrays) {
    foreach ($value_arrays as $key => $value) {
        if ($key == 'machine_name' or $key == 'value_pattern') {
            var_dump($key . ' --> ' . $value);
            if ($key == 'machine_name') {
                $pattern = $value;
            } else {
                $results[$pattern][] = $value;
            }
        }
    }
}

var_dump($results);
echo microtime();
die();

file_put_contents('test.txt', 'aaaa' . PHP_EOL, FILE_APPEND);
return 0;
