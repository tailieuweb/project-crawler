<?php
//Database
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'crawlworks');

//Display
define('PER_PAGE', 10);//$PER_PAGE = 10;
define('DATABASE_WORKS_FIELD_STRING_FROM', 4);
define('DATABASE_WORKS_FIELD_STRING_TO', 9);
//Debug
define('IS_ONLINE', TRUE);
define('DEBUG_CONTENT_FILE_NAME', 'http://localhost/svnrepos/crawlworks/model/search_result.html');

//Crawling
define('TIME_OUT', 10);

//Sites
$crawling_sites = array(
    1   =>  array(
        'id'   =>  1,
        'class' =>  'VietnamWorks',
        'name'  =>  'VietnamWorks',
        'status'    =>  TRUE,
        'is_site'   =>  TRUE
    ),
    2   => array(
        'id'   =>  2,
        'class' =>  'CareerLink',
        'name'  =>  'CareerLink',
        'status'    =>  TRUE,
        'is_site'   =>  TRUE
    ),
    3   =>  array(
        'id'   =>  3,
        'class' =>  'Internship',
        'name'  =>  'Internship',
        'status'    =>  TRUE,
        'is_site'   =>  FALSE
    )
);
