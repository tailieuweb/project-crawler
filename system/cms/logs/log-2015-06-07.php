<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2015-06-07 12:32:32 --> Severity: Notice  --> Use of undefined constant arr - assumed 'arr' D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:32 --> Severity: Warning  --> Invalid argument supplied for foreach() D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:32 --> Severity: Notice  --> Use of undefined constant arr - assumed 'arr' D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:32 --> Severity: Warning  --> Invalid argument supplied for foreach() D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:32 --> Severity: Notice  --> Use of undefined constant arr - assumed 'arr' D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:32 --> Severity: Warning  --> Invalid argument supplied for foreach() D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:32 --> Severity: Notice  --> Use of undefined constant arr - assumed 'arr' D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:32 --> Severity: Warning  --> Invalid argument supplied for foreach() D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:32 --> Severity: Notice  --> Use of undefined constant arr - assumed 'arr' D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:32 --> Severity: Warning  --> Invalid argument supplied for foreach() D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:39 --> Severity: Notice  --> Use of undefined constant arr - assumed 'arr' D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:39 --> Severity: Warning  --> Invalid argument supplied for foreach() D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:39 --> Severity: Notice  --> Use of undefined constant arr - assumed 'arr' D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:39 --> Severity: Warning  --> Invalid argument supplied for foreach() D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:39 --> Severity: Notice  --> Use of undefined constant arr - assumed 'arr' D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:39 --> Severity: Warning  --> Invalid argument supplied for foreach() D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:39 --> Severity: Notice  --> Use of undefined constant arr - assumed 'arr' D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:39 --> Severity: Warning  --> Invalid argument supplied for foreach() D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:39 --> Severity: Notice  --> Use of undefined constant arr - assumed 'arr' D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:32:39 --> Severity: Warning  --> Invalid argument supplied for foreach() D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_logs_m.php 85
ERROR - 2015-06-07 12:36:50 --> Severity: Notice  --> Undefined variable: total D:\wamp\www\works\addons\shared_addons\modules\contents\views\admin\tables\statistic_categories.php 15
ERROR - 2015-06-07 12:36:51 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 12:36:52 --> Page Missing: addons/shared_addons/modules/contents/img/gradient.png
ERROR - 2015-06-07 12:41:16 --> Severity: Notice  --> Undefined variable: total D:\wamp\www\works\addons\shared_addons\modules\contents\views\admin\tables\statistic_categories.php 21
ERROR - 2015-06-07 12:41:17 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 12:43:26 --> Severity: Notice  --> Undefined variable: total D:\wamp\www\works\addons\shared_addons\modules\contents\views\admin\tables\statistic_categories.php 21
ERROR - 2015-06-07 12:43:27 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 13:05:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'WHERE path=0' at line 36 - Invalid query: SELECT c.name,c.path,
                    (	
                        SELECT count(*)
                        FROM default_blog as b
                        WHERE 		 
                                (id_work_categories like CONCAT(c.id,'')) OR
                                (id_work_categories like CONCAT(c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id))	 	 
                    ) AS count_works,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW())
                    ) AS Active,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW()) AND
                             (b.title is not NULL) 	AND 
                             (b.description != '') AND 
                             (b.requirements != '') 
                    ) AS "Full info"
                FROM default_work_categories as c
                ORDER BY name ASC
                WHERE path=0
ERROR - 2015-06-07 13:08:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'WHERE c.path=0' at line 36 - Invalid query: SELECT c.name,c.path,
                    (	
                        SELECT count(*)
                        FROM default_blog as b
                        WHERE 		 
                                (id_work_categories like CONCAT(c.id,'')) OR
                                (id_work_categories like CONCAT(c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id))	 	 
                    ) AS count_works,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW())
                    ) AS Active,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW()) AND
                             (b.title is not NULL) 	AND 
                             (b.description != '') AND 
                             (b.requirements != '') 
                    ) AS "Full info"
                FROM default_work_categories as c
                ORDER BY name ASC
                WHERE c.path=0
ERROR - 2015-06-07 13:08:21 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'WHERE c.path = '0'' at line 36 - Invalid query: SELECT c.name,c.path,
                    (	
                        SELECT count(*)
                        FROM default_blog as b
                        WHERE 		 
                                (id_work_categories like CONCAT(c.id,'')) OR
                                (id_work_categories like CONCAT(c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id))	 	 
                    ) AS count_works,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW())
                    ) AS Active,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW()) AND
                             (b.title is not NULL) 	AND 
                             (b.description != '') AND 
                             (b.requirements != '') 
                    ) AS "Full info"
                FROM default_work_categories as c
                ORDER BY name ASC
                WHERE c.path = '0'
ERROR - 2015-06-07 13:17:15 --> Severity: Notice  --> Undefined variable: tiem D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_statistic_m.php 120
ERROR - 2015-06-07 13:17:15 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY name ASC' at line 36 - Invalid query: SELECT c.name,c.path,
                    (	
                        SELECT count(*)
                        FROM default_blog as b
                        WHERE 		 
                                (id_work_categories like CONCAT(c.id,'')) OR
                                (id_work_categories like CONCAT(c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id))	 	 
                    ) AS count_works,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW())
                    ) AS Active,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW()) AND
                             (b.title is not NULL) 	AND 
                             (b.description != '') AND 
                             (b.requirements != '') 
                    ) AS "Full info"
                FROM default_work_categories as c
                WHERE c.path = 
                ORDER BY name ASC
ERROR - 2015-06-07 13:18:43 --> Severity: Notice  --> Undefined variable: tiem D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_statistic_m.php 120
ERROR - 2015-06-07 13:18:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY name ASC' at line 36 - Invalid query: SELECT c.name,c.path,
                    (	
                        SELECT count(*)
                        FROM default_blog as b
                        WHERE 		 
                                (id_work_categories like CONCAT(c.id,'')) OR
                                (id_work_categories like CONCAT(c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id))	 	 
                    ) AS count_works,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW())
                    ) AS Active,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW()) AND
                             (b.title is not NULL) 	AND 
                             (b.description != '') AND 
                             (b.requirements != '') 
                    ) AS "Full info"
                FROM default_work_categories as c
                WHERE c.path =  
                ORDER BY name ASC
ERROR - 2015-06-07 13:20:37 --> Severity: Notice  --> Undefined variable: tiem D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_statistic_m.php 120
ERROR - 2015-06-07 13:20:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY name ASC' at line 36 - Invalid query: SELECT c.name,c.path,
                    (	
                        SELECT count(*)
                        FROM default_blog as b
                        WHERE 		 
                                (id_work_categories like CONCAT(c.id,'')) OR
                                (id_work_categories like CONCAT(c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id))	 	 
                    ) AS count_works,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW())
                    ) AS Active,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW()) AND
                             (b.title is not NULL) 	AND 
                             (b.description != '') AND 
                             (b.requirements != '') 
                    ) AS "Full info"
                FROM default_work_categories as c
                WHERE c.path =  
                ORDER BY name ASC
ERROR - 2015-06-07 13:20:48 --> Severity: Notice  --> Undefined variable: tiem D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_statistic_m.php 120
ERROR - 2015-06-07 13:20:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY name ASC' at line 36 - Invalid query: SELECT c.name,c.path,
                    (	
                        SELECT count(*)
                        FROM default_blog as b
                        WHERE 		 
                                (id_work_categories like CONCAT(c.id,'')) OR
                                (id_work_categories like CONCAT(c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id))	 	 
                    ) AS count_works,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW())
                    ) AS Active,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW()) AND
                             (b.title is not NULL) 	AND 
                             (b.description != '') AND 
                             (b.requirements != '') 
                    ) AS "Full info"
                FROM default_work_categories as c
                WHERE c.path =  
                ORDER BY name ASC
ERROR - 2015-06-07 13:20:59 --> Severity: Notice  --> Undefined variable: tiem D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_statistic_m.php 120
ERROR - 2015-06-07 13:20:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY name ASC' at line 36 - Invalid query: SELECT c.id,c.name,c.path,
                    (	
                        SELECT count(*)
                        FROM default_blog as b
                        WHERE 		 
                                (id_work_categories like CONCAT(c.id,'')) OR
                                (id_work_categories like CONCAT(c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id))	 	 
                    ) AS count_works,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW())
                    ) AS Active,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW()) AND
                             (b.title is not NULL) 	AND 
                             (b.description != '') AND 
                             (b.requirements != '') 
                    ) AS "Full info"
                FROM default_work_categories as c
                WHERE c.path =  
                ORDER BY name ASC
ERROR - 2015-06-07 13:21:41 --> Severity: Notice  --> Undefined variable: tiem D:\wamp\www\works\addons\shared_addons\modules\contents\models\work_statistic_m.php 120
ERROR - 2015-06-07 13:21:41 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY name ASC' at line 36 - Invalid query: SELECT c.id,c.name,c.path,
                    (	
                        SELECT count(*)
                        FROM default_blog as b
                        WHERE 		 
                                (id_work_categories like CONCAT(c.id,'')) OR
                                (id_work_categories like CONCAT(c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id))	 	 
                    ) AS count_works,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW())
                    ) AS Active,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW()) AND
                             (b.title is not NULL) 	AND 
                             (b.description != '') AND 
                             (b.requirements != '') 
                    ) AS "Full info"
                FROM default_work_categories as c
                WHERE c.path =  
                ORDER BY name ASC
ERROR - 2015-06-07 13:24:55 --> Severity: Notice  --> Undefined variable: total D:\wamp\www\works\addons\shared_addons\modules\contents\views\admin\tables\statistic_categories.php 32
ERROR - 2015-06-07 13:24:56 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 13:25:30 --> Severity: Notice  --> Undefined variable: total D:\wamp\www\works\addons\shared_addons\modules\contents\views\admin\tables\statistic_categories.php 32
ERROR - 2015-06-07 13:25:31 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 13:26:15 --> Severity: Notice  --> Undefined variable: total D:\wamp\www\works\addons\shared_addons\modules\contents\views\admin\tables\statistic_categories.php 32
ERROR - 2015-06-07 13:26:16 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 13:27:09 --> Severity: Notice  --> Undefined variable: total D:\wamp\www\works\addons\shared_addons\modules\contents\views\admin\tables\statistic_categories.php 32
ERROR - 2015-06-07 13:27:09 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 13:27:50 --> Severity: Notice  --> Undefined variable: total D:\wamp\www\works\addons\shared_addons\modules\contents\views\admin\tables\statistic_categories.php 32
ERROR - 2015-06-07 13:27:51 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 13:28:05 --> Severity: Notice  --> Undefined variable: total D:\wamp\www\works\addons\shared_addons\modules\contents\views\admin\tables\statistic_categories.php 32
ERROR - 2015-06-07 13:28:05 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 13:32:42 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 13:33:09 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 13:34:00 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 13:35:26 --> Query error: Table 'vl.work_categories' doesn't exist - Invalid query: SELECT c.id,c.name,c.path,
                    (	
                        SELECT count(*)
                        FROM default_blog as b
                        WHERE 		 
                                (id_work_categories like CONCAT(c.id,'')) OR
                                (id_work_categories like CONCAT(c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id,',%')) OR
                                (id_work_categories like CONCAT('%,',c.id))	 	 
                    ) AS count_works,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW())
                    ) AS Active,
                    (	
                    SELECT count(*)
                    FROM default_blog as b
                    WHERE 		 
                            ((id_work_categories like CONCAT(c.id,'')) OR
                            (id_work_categories like CONCAT(c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id,',%')) OR
                            (id_work_categories like CONCAT('%,',c.id))) AND
                             (b.end >= NOW()) AND
                             (b.title is not NULL) 	AND 
                             (b.description != '') AND 
                             (b.requirements != '') 
                    ) AS "Full info"
                FROM work_categories as c
                WHERE c.path = 0
                ORDER BY name ASC
ERROR - 2015-06-07 13:35:46 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 13:36:13 --> Page Missing: uploads/default/files/logo.png
ERROR - 2015-06-07 13:37:09 --> Query error: Table 'vl.default_work_locations' doesn't exist - Invalid query: SELECT *
FROM `default_work_locations`
WHERE `id_alias` =  0
ORDER BY `name` ASC
