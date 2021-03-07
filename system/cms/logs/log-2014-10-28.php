<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2014-10-28 07:28:31 --> Severity: Warning  --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 F:\wamp\www\vl\trunk\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 70
ERROR - 2014-10-28 07:28:31 --> Severity: Warning  --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 F:\wamp\www\vl\trunk\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 70
ERROR - 2014-10-28 07:28:31 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 F:\wamp\www\vl\trunk\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 144
ERROR - 2014-10-28 07:28:31 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 F:\wamp\www\vl\trunk\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 144
ERROR - 2014-10-28 07:28:31 --> Unable to select database: vl
ERROR - 2014-10-28 07:28:31 --> Unable to select database: vl
ERROR - 2014-10-28 07:28:31 --> Severity: Warning  --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 F:\wamp\www\vl\trunk\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 70
ERROR - 2014-10-28 07:28:31 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 F:\wamp\www\vl\trunk\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 144
ERROR - 2014-10-28 07:28:31 --> Unable to select database: vl
ERROR - 2014-10-28 07:28:32 --> Severity: Warning  --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 F:\wamp\www\vl\trunk\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 70
ERROR - 2014-10-28 07:28:32 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 F:\wamp\www\vl\trunk\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 144
ERROR - 2014-10-28 07:28:32 --> Unable to select database: vl
ERROR - 2014-10-28 07:45:06 --> Severity: Warning  --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 F:\wamp\www\vl\trunk\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 70
ERROR - 2014-10-28 07:45:06 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 F:\wamp\www\vl\trunk\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 144
ERROR - 2014-10-28 07:45:06 --> Unable to select database: vl
ERROR - 2014-10-28 07:57:09 --> Page Missing: addons/shared_addons/modules/contents/img/gradient.png
ERROR - 2014-10-28 08:22:15 --> Severity: Notice  --> Undefined property: CI::$companies_m F:\wamp\www\vl\trunk\system\cms\libraries\MX\Controller.php 57
ERROR - 2014-10-28 08:41:54 --> The path to the image is not correct.
ERROR - 2014-10-28 08:41:54 --> Your server does not support the GD function required to process this type of image.
ERROR - 2014-10-28 09:04:38 --> Severity: Warning  --> opendir(F:\wamp\www\vl\trunk\assets/page_types/default/works,F:\wamp\www\vl\trunk\assets/page_types/default/works): The system cannot find the file specified. (code: 2) F:\wamp\www\vl\trunk\system\codeigniter\helpers\file_helper.php 114
ERROR - 2014-10-28 09:04:38 --> Severity: Warning  --> opendir(F:\wamp\www\vl\trunk\assets/page_types/default/works): failed to open dir: No such file or directory F:\wamp\www\vl\trunk\system\codeigniter\helpers\file_helper.php 114
ERROR - 2014-10-28 09:04:47 --> Severity: Warning  --> opendir(F:\wamp\www\vl\trunk\assets/page_types/default/internship,F:\wamp\www\vl\trunk\assets/page_types/default/internship): The system cannot find the file specified. (code: 2) F:\wamp\www\vl\trunk\system\codeigniter\helpers\file_helper.php 114
ERROR - 2014-10-28 09:04:47 --> Severity: Warning  --> opendir(F:\wamp\www\vl\trunk\assets/page_types/default/internship): failed to open dir: No such file or directory F:\wamp\www\vl\trunk\system\codeigniter\helpers\file_helper.php 114
ERROR - 2014-10-28 09:04:58 --> Severity: Warning  --> opendir(F:\wamp\www\vl\trunk\assets/page_types/default/test,F:\wamp\www\vl\trunk\assets/page_types/default/test): The system cannot find the file specified. (code: 2) F:\wamp\www\vl\trunk\system\codeigniter\helpers\file_helper.php 114
ERROR - 2014-10-28 09:04:58 --> Severity: Warning  --> opendir(F:\wamp\www\vl\trunk\assets/page_types/default/test): failed to open dir: No such file or directory F:\wamp\www\vl\trunk\system\codeigniter\helpers\file_helper.php 114
ERROR - 2014-10-28 09:05:04 --> Query error: La table 'vl.default_pages_works' n'existe pas - Invalid query: SELECT `default_pages_works`.`work_overview` as `overview`, `default_pages_works`.`work_description` as `description`, `default_pages`.`title`, `default_files`.`path`, `default_pages`.`slug`
FROM `default_pages_works`
JOIN `default_files` ON `default_files`.`id` = `default_pages_works`.`work_image`
JOIN `default_pages` ON `default_pages`.`type_id` = 7 AND `default_pages`.`entry_id` = `default_pages_works`.`id`
WHERE `default_pages`.`status` =  'live'
AND `default_pages_works`.`work_type` =  'Việc làm'
 LIMIT 10
ERROR - 2014-10-28 09:17:50 --> Severity: Notice  --> Undefined index: path F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\views\partials\overview-work.php 14
ERROR - 2014-10-28 09:30:35 --> Query error: Champ 'default_file.path' inconnu dans field list - Invalid query: SELECT `default_blog`.*, `default_file`.`path`
FROM `default_blog`
LEFT JOIN `default_files` ON `default_files`.`id` = `default_blog`.`image`
WHERE `status` =  'live'
 LIMIT 6
ERROR - 2014-10-28 09:32:28 --> Page Missing: addons/shared_addons/modules/contents/img/gradient.png
ERROR - 2014-10-28 09:39:03 --> Page Missing: admin/contents/candidates
ERROR - 2014-10-28 09:58:32 --> Severity: Notice  --> Trying to get property of non-object F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\controllers\contents.php 935
ERROR - 2014-10-28 09:58:32 --> Severity: Notice  --> Trying to get property of non-object F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\controllers\contents.php 935
ERROR - 2014-10-28 09:58:32 --> Page Missing: viec-lam/work
ERROR - 2014-10-28 10:33:53 --> Page Missing: addons/shared_addons/modules/contents/img/gradient.png
ERROR - 2014-10-28 10:40:45 --> Severity: Warning  --> implode(): Invalid arguments passed F:\wamp\www\vl\trunk\system\cms\modules\blog\controllers\admin.php 382
ERROR - 2014-10-28 10:40:45 --> Query error: Champ 'id_work_categories' inconnu dans field list - Invalid query: UPDATE `default_blog` SET `start` = '2014-10-01', `end` = '2014-10-31', `image` = '21b0589531e0d81', `overview` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">Overview&nbsp;</span><span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: red; font-weight: bold; line-height: 18.2000007629395px;\">*</span>', `description` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">Description&nbsp;</span><span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: red; font-weight: bold; line-height: 18.2000007629395px;\">*</span>', `requirements` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">Requirements&nbsp;</span><span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: red; font-weight: bold; line-height: 18.2000007629395px;\">*</span>', `more_info` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">More info</span>', `contact` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">Contact&nbsp;</span><span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: red; font-weight: bold; line-height: 18.2000007629395px;\">*</span>', `title` = 'Work', `slug` = 'work', `category_id` = '5', `keywords` = '', `body` = 'asdfasf', `status` = 'live', `created_on` = 1414350720, `updated_on` = 1414350720, `created` = '2014-10-27 02:12:00', `updated` = '2014-10-27 02:12:00', `comments_enabled` = '3 months', `author_id` = '1', `type` = 'wysiwyg-advanced', `parsed` = '', `preview_hash` = '', `id_company` = '29', `id_work_categories` = NULL WHERE `id` =  '37'
ERROR - 2014-10-28 10:46:30 --> Query error: Champ 'id_work_categories' inconnu dans field list - Invalid query: UPDATE `default_blog` SET `start` = '2014-10-01', `end` = '2014-10-31', `image` = '21b0589531e0d81', `overview` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">Overview&nbsp;</span><span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: red; font-weight: bold; line-height: 18.2000007629395px;\">*</span>', `description` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">Description&nbsp;</span><span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: red; font-weight: bold; line-height: 18.2000007629395px;\">*</span>', `requirements` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">Requirements&nbsp;</span><span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: red; font-weight: bold; line-height: 18.2000007629395px;\">*</span>', `more_info` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">More info</span>', `contact` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">Contact&nbsp;</span><span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: red; font-weight: bold; line-height: 18.2000007629395px;\">*</span>', `title` = 'Work', `slug` = 'work', `category_id` = '5', `keywords` = '', `body` = 'asdfasf', `status` = 'live', `created_on` = 1414350720, `updated_on` = 1414350720, `created` = '2014-10-27 02:12:00', `updated` = '2014-10-27 02:12:00', `comments_enabled` = '3 months', `author_id` = '1', `type` = 'wysiwyg-advanced', `parsed` = '', `preview_hash` = '', `id_company` = '29', `id_work_categories` = '10' WHERE `id` =  '37'
ERROR - 2014-10-28 10:47:09 --> Query error: Champ 'id_work_categories' inconnu dans field list - Invalid query: UPDATE `default_blog` SET `start` = '2014-10-01', `end` = '2014-10-31', `image` = '21b0589531e0d81', `overview` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">Overview&nbsp;</span><span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: red; font-weight: bold; line-height: 18.2000007629395px;\">*</span>', `description` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">Description&nbsp;</span><span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: red; font-weight: bold; line-height: 18.2000007629395px;\">*</span>', `requirements` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">Requirements&nbsp;</span><span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: red; font-weight: bold; line-height: 18.2000007629395px;\">*</span>', `more_info` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">More info</span>', `contact` = '<span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 18.2000007629395px;\">Contact&nbsp;</span><span style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: red; font-weight: bold; line-height: 18.2000007629395px;\">*</span>', `title` = 'Work', `slug` = 'work', `category_id` = '5', `keywords` = '', `body` = 'asdfasf', `status` = 'live', `created_on` = 1414350720, `updated_on` = 1414350720, `created` = '2014-10-27 02:12:00', `updated` = '2014-10-27 02:12:00', `comments_enabled` = '3 months', `author_id` = '1', `type` = 'wysiwyg-advanced', `parsed` = '', `preview_hash` = '', `id_company` = '29', `id_work_categories` = '10' WHERE `id` =  '37'
ERROR - 2014-10-28 10:49:08 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 316
ERROR - 2014-10-28 10:50:27 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 316
ERROR - 2014-10-28 10:51:24 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 316
ERROR - 2014-10-28 10:51:24 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 316
ERROR - 2014-10-28 10:51:24 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 316
ERROR - 2014-10-28 10:52:30 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 261
ERROR - 2014-10-28 10:52:50 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 261
ERROR - 2014-10-28 10:53:21 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 261
ERROR - 2014-10-28 10:54:08 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 261
ERROR - 2014-10-28 10:55:15 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 261
ERROR - 2014-10-28 10:55:47 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 261
ERROR - 2014-10-28 10:56:04 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 261
ERROR - 2014-10-28 11:01:29 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 316
ERROR - 2014-10-28 11:04:14 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 261
ERROR - 2014-10-28 11:06:32 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 261
ERROR - 2014-10-28 11:06:43 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 261
ERROR - 2014-10-28 11:07:01 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 261
ERROR - 2014-10-28 11:07:12 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 261
ERROR - 2014-10-28 12:06:18 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 262
ERROR - 2014-10-28 12:09:29 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 261
ERROR - 2014-10-28 12:12:06 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 315
ERROR - 2014-10-28 12:12:06 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 315
ERROR - 2014-10-28 12:12:06 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 315
ERROR - 2014-10-28 12:13:41 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 316
ERROR - 2014-10-28 12:13:41 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 316
ERROR - 2014-10-28 12:15:01 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 316
ERROR - 2014-10-28 12:15:01 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 316
ERROR - 2014-10-28 12:15:01 --> Severity: Notice  --> Uninitialized string offset: 0 F:\wamp\www\vl\trunk\system\cms\modules\streams_core\field_types\choice\field.choice.php 316
ERROR - 2014-10-28 12:19:05 --> Page Missing: addons/shared_addons/modules/contents/img/gradient.png
ERROR - 2014-10-28 12:26:54 --> Page Missing: addons/shared_addons/modules/contents/img/gradient.png
ERROR - 2014-10-28 14:13:27 --> Page Missing: addons/shared_addons/modules/contents/img/gradient.png
ERROR - 2014-10-28 14:15:23 --> Page Missing: ky-nang/ky-nang
ERROR - 2014-10-28 14:34:11 --> Page Missing: ky-nang/ky-nang
ERROR - 2014-10-28 14:38:26 --> Severity: Notice  --> Trying to get property of non-object F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\controllers\contents.php 746
ERROR - 2014-10-28 14:38:26 --> Severity: Notice  --> Trying to get property of non-object F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\controllers\contents.php 746
ERROR - 2014-10-28 14:38:26 --> Page Missing: su-kien
ERROR - 2014-10-28 14:39:18 --> Page Missing: dang-ky-tim-viec
ERROR - 2014-10-28 14:40:14 --> Page Missing: dang-ky-tim-viec
ERROR - 2014-10-28 14:42:44 --> Page Missing: dang-ky-tim-viec
ERROR - 2014-10-28 14:42:57 --> Page Missing: dang-ky-tim-viec
ERROR - 2014-10-28 14:51:51 --> Page Missing: dang-ky-tuyen-dung
ERROR - 2014-10-28 15:21:51 --> Severity: Notice  --> Trying to get property of non-object F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\controllers\contents.php 746
ERROR - 2014-10-28 15:21:51 --> Severity: Notice  --> Trying to get property of non-object F:\wamp\www\vl\trunk\addons\shared_addons\modules\contents\controllers\contents.php 746
ERROR - 2014-10-28 15:21:51 --> Page Missing: su-kien
