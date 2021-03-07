<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2014-10-30 08:28:21 --> Page Missing: khao-sat-viec-lam
ERROR - 2014-10-30 08:38:09 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY `name` asc' at line 4 - Invalid query: SELECT *
FROM `default_work_categories`
WHERE `name` !=
ORDER BY `name` asc
ERROR - 2014-10-30 08:44:35 --> Severity: Warning  --> preg_match(): Compilation failed: unrecognized character after (? or (?- at offset 33 F:\wamp\www\vl\trunk\system\codeigniter\core\Router.php 374
ERROR - 2014-10-30 08:44:51 --> Severity: Notice  --> Trying to get property of non-object F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\controllers\contents.php 975
ERROR - 2014-10-30 08:44:51 --> Severity: Notice  --> Trying to get property of non-object F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\controllers\contents.php 975
ERROR - 2014-10-30 08:44:52 --> Page Missing: thong-tin-tuyen-dung
ERROR - 2014-10-30 08:45:00 --> Severity: Warning  --> preg_match(): Compilation failed: unrecognized character after (? or (?- at offset 33 F:\wamp\www\vl\trunk\system\codeigniter\core\Router.php 374
ERROR - 2014-10-30 08:45:05 --> Severity: Notice  --> Trying to get property of non-object F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\controllers\contents.php 975
ERROR - 2014-10-30 08:45:05 --> Severity: Notice  --> Trying to get property of non-object F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\controllers\contents.php 975
ERROR - 2014-10-30 08:45:06 --> Page Missing: thong-tin-tuyen-dung
ERROR - 2014-10-30 08:54:10 --> Severity: Notice  --> Undefined property: CI_Input::$post F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\controllers\contents.php 67
ERROR - 2014-10-30 08:56:18 --> Severity: Warning  --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 F:\wamp\www\vl\trunk\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 70
ERROR - 2014-10-30 08:56:18 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 F:\wamp\www\vl\trunk\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 144
ERROR - 2014-10-30 08:56:18 --> Unable to select database: vl
ERROR - 2014-10-30 09:13:29 --> Severity: Notice  --> Array to string conversion F:\wamp\www\vl\trunk\system\codeigniter\database\DB_query_builder.php 484
ERROR - 2014-10-30 09:13:29 --> Query error: Champ 'id_categories' inconnu dans where clause - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `default_blog`
WHERE `status` =  'live'
AND `id_categories` =  Array
AND `type` =  'Work'
ERROR - 2014-10-30 09:21:53 --> Severity: Notice  --> Undefined index: limit F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\models\job_m.php 40
ERROR - 2014-10-30 09:21:53 --> Severity: Notice  --> Undefined index: offset F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\models\job_m.php 40
ERROR - 2014-10-30 09:21:53 --> Query error: Champ 'id_categories' inconnu dans where clause - Invalid query: SELECT `default_blog`.*, `default_files`.`path`
FROM `default_blog`
LEFT JOIN `default_files` ON `default_files`.`id` = `default_blog`.`image`
WHERE `status` =  'live'
AND  `id_categories`  LIKE '%9%' ESCAPE '!' 
OR  `id_categories`  LIKE '%9,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,9%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,9,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%13%' ESCAPE '!' 
OR  `id_categories`  LIKE '%13,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,13%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,13,%' ESCAPE '!' 
ORDER BY `created` DESC
ERROR - 2014-10-30 09:22:44 --> Page Missing: addons/shared_addons/modules/contents/img/gradient.png
ERROR - 2014-10-30 09:34:01 --> Severity: Notice  --> Undefined index: limit F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\models\job_m.php 40
ERROR - 2014-10-30 09:34:01 --> Severity: Notice  --> Undefined index: offset F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\models\job_m.php 40
ERROR - 2014-10-30 09:34:01 --> Query error: Champ 'id_categories' inconnu dans where clause - Invalid query: SELECT `default_blog`.*, `default_files`.`path`
FROM `default_blog`
LEFT JOIN `default_files` ON `default_files`.`id` = `default_blog`.`image`
WHERE `status` =  'live'
AND  `id_categories`  LIKE '%9%' ESCAPE '!' 
OR  `id_categories`  LIKE '%9,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,9%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,9,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%13%' ESCAPE '!' 
OR  `id_categories`  LIKE '%13,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,13%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,13,%' ESCAPE '!' 
ORDER BY `created` DESC
ERROR - 2014-10-30 09:34:32 --> Severity: Notice  --> Undefined index: limit F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\models\job_m.php 41
ERROR - 2014-10-30 09:34:32 --> Query error: Champ 'id_categories' inconnu dans where clause - Invalid query: SELECT `default_blog`.*, `default_files`.`path`
FROM `default_blog`
LEFT JOIN `default_files` ON `default_files`.`id` = `default_blog`.`image`
WHERE `status` =  'live'
AND  `id_categories`  LIKE '%9%' ESCAPE '!' 
OR  `id_categories`  LIKE '%9,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,9%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,9,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%13%' ESCAPE '!' 
OR  `id_categories`  LIKE '%13,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,13%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,13,%' ESCAPE '!' 
ORDER BY `created` DESC
ERROR - 2014-10-30 09:34:35 --> Severity: Notice  --> Undefined index: limit F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\models\job_m.php 41
ERROR - 2014-10-30 09:34:35 --> Query error: Champ 'id_categories' inconnu dans where clause - Invalid query: SELECT `default_blog`.*, `default_files`.`path`
FROM `default_blog`
LEFT JOIN `default_files` ON `default_files`.`id` = `default_blog`.`image`
WHERE `status` =  'live'
AND  `id_categories`  LIKE '%9%' ESCAPE '!' 
OR  `id_categories`  LIKE '%9,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,9%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,9,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%13%' ESCAPE '!' 
OR  `id_categories`  LIKE '%13,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,13%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,13,%' ESCAPE '!' 
ORDER BY `created` DESC
ERROR - 2014-10-30 09:34:46 --> Query error: Champ 'id_categories' inconnu dans where clause - Invalid query: SELECT `default_blog`.*, `default_files`.`path`
FROM `default_blog`
LEFT JOIN `default_files` ON `default_files`.`id` = `default_blog`.`image`
WHERE `status` =  'live'
AND  `id_categories`  LIKE '%9%' ESCAPE '!' 
OR  `id_categories`  LIKE '%9,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,9%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,9,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%13%' ESCAPE '!' 
OR  `id_categories`  LIKE '%13,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,13%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,13,%' ESCAPE '!' 
ORDER BY `created` DESC
ERROR - 2014-10-30 09:35:06 --> Query error: Champ 'id_categories' inconnu dans where clause - Invalid query: SELECT `default_blog`.*, `default_files`.`path`
FROM `default_blog`
LEFT JOIN `default_files` ON `default_files`.`id` = `default_blog`.`image`
WHERE `status` =  'live'
AND  `id_categories`  LIKE '%9%' ESCAPE '!' 
OR  `id_categories`  LIKE '%9,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,9%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,9,%' ESCAPE '!' 
AND  `id_categories`  LIKE '%13%' ESCAPE '!' 
OR  `id_categories`  LIKE '%13,%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,13%' ESCAPE '!' 
OR  `id_categories`  LIKE '%,13,%' ESCAPE '!' 
ORDER BY `created` DESC
ERROR - 2014-10-30 13:17:03 --> Page Missing: addons/shared_addons/modules/contents/img/gradient.png
ERROR - 2014-10-30 13:29:15 --> Page Missing: addons/shared_addons/modules/contents/img/gradient.png
ERROR - 2014-10-30 13:52:43 --> Page Missing: addons/shared_addons/modules/contents/img/gradient.png
ERROR - 2014-10-30 14:14:02 --> Severity: Notice  --> Undefined property: CI::$contacts_m F:\wamp\www\vl\trunk\system\cms\libraries\MX\Controller.php 57
ERROR - 2014-10-30 14:14:02 --> Severity: Notice  --> Trying to get property of non-object F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\controllers\contents.php 1196
ERROR - 2014-10-30 15:49:04 --> Severity: Notice  --> Undefined property: CI::$contacts_m F:\wamp\www\vl\trunk\system\cms\libraries\MX\Controller.php 57
ERROR - 2014-10-30 15:49:04 --> Severity: Notice  --> Trying to get property of non-object F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\controllers\contents.php 1196
ERROR - 2014-10-30 16:37:03 --> Page Missing: l
ERROR - 2014-10-30 20:06:45 --> Page Missing: addons/shared_addons/modules/contents/img/gradient.png
ERROR - 2014-10-30 20:41:35 --> The path to the image is not correct.
ERROR - 2014-10-30 20:41:35 --> Your server does not support the GD function required to process this type of image.
ERROR - 2014-10-30 20:56:46 --> Page Missing: files/large/2ccf244d1fd81277f2e2aed8466bd1bd.jpg
ERROR - 2014-10-30 21:00:35 --> Severity: Notice  --> Undefined index: word F:\wamp\www\vl\trunk\addons\shared_addons\modules\contact\models\contact_m.php 73
ERROR - 2014-10-30 21:13:48 --> Page Missing: addons/shared_addons/modules/contents/img/gradient.png
ERROR - 2014-10-30 21:28:30 --> Query error: Field 'attachments' doesn't have a default value - Invalid query: INSERT INTO `default_contact_log` (`subject`, `email`, `message`, `sent_at`, `status`) VALUES ('asfasdfasf', 'ptnhuan@gmail.com', 'asdf', 1414679310, 'new')
ERROR - 2014-10-30 21:28:43 --> Query error: Field 'attachments' doesn't have a default value - Invalid query: INSERT INTO `default_contact_log` (`subject`, `email`, `message`, `sent_at`, `status`) VALUES ('asfasdfasf', 'ptnhuan@gmail.com', 'asdf', 1414679323, 'new')
ERROR - 2014-10-30 21:28:59 --> Query error: Incorrect integer value: 'new' for column 'status' at row 1 - Invalid query: INSERT INTO `default_contact_log` (`subject`, `email`, `message`, `sent_at`, `status`) VALUES ('asfasdfasf', 'ptnhuan@gmail.com', 'asdf', 1414679339, 'new')
ERROR - 2014-10-30 21:47:40 --> Severity: Notice  --> Undefined property: stdClass::$category F:\wamp\www\vl\trunk\addons\shared_addons\modules\contact\views\admin\form.php 45
ERROR - 2014-10-30 21:47:40 --> Severity: Notice  --> Undefined property: stdClass::$notes F:\wamp\www\vl\trunk\addons\shared_addons\modules\contact\views\admin\form.php 50
ERROR - 2014-10-30 22:03:05 --> Query error: Unknown column 'id_category' in 'field list' - Invalid query: INSERT INTO `default_contact_log` (`subject`, `email`, `id_category`, `message`, `sent_at`, `status`, `sender_ip`) VALUES ('asdfasdf', 'ptnhuanfr@gmail.com', 'support', 'asdfasdf', 1414681385, '40', '::1')
ERROR - 2014-10-30 22:03:21 --> Query error: Unknown column 'id_category' in 'field list' - Invalid query: INSERT INTO `default_contact_log` (`subject`, `email`, `id_category`, `message`, `sent_at`, `status`, `sender_ip`) VALUES ('asdfasdf', 'ptnhuanfr@gmail.com', 'support', 'asdfasdf', 1414681401, '40', '::1')
