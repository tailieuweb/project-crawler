<?php
date_default_timezone_set("Asia/Bangkok");
require_once '../config/config.php';
require_once '../model/db.php';
require_once '../model/works.php';
require_once '../model/keywords.php';
require_once '../model/keys_works.php';

require_once '../pages/pages.php';
require_once '../utilities/crawl.php';


$crawl = new Crawl();
$works = new Works();
$keywords = new Keywords();
$keys_works = new KeysWorks();
$id_key = 1;