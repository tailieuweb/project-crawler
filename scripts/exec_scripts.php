<?php

set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

$script = $argv[1];
$threads = intval($argv[2]);
$sleep = @intval($argv[3]);

$cmd = "php $script";

if (!empty($threads)) {
    for ($i = 0; $i < $threads; $i++) {
        execInBackground($cmd);
        
        if (!empty($sleep)) {
            sleep($sleep);
        }
    }
}

function execInBackground($cmd) {
    if (substr(php_uname(), 0, 7) == "Windows") {
        pclose(popen("start /B " . $cmd, "r"));
    } else {
        exec($cmd . " > /dev/null &");
    }
}
