<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller']                = 'contents';
$route['404_override']                      = 'pages';

$route['admin/help/([a-zA-Z0-9_-]+)']       = 'admin/help/$1';
$route['admin/([a-zA-Z0-9_-]+)/(:any)']	    = '$1/admin/$2';
$route['admin/(login|logout|remove_installer_directory)']			    = 'admin/$1';
$route['admin/([a-zA-Z0-9_-]+)']            = '$1/admin/index';

$route['api/ajax/(:any)']          			= 'api/ajax/$1';
$route['api/([a-zA-Z0-9_-]+)/(:any)']	    = '$1/api/$2';
$route['api/([a-zA-Z0-9_-]+)']              = '$1/api/index';

$route['register']                          = 'users/register';
$route['user/(:any)']	                    = 'users/view/$1';
$route['my-profile']	                    = 'users/index';
$route['edit-profile']	                    = 'users/edit';

$route['sitemap.xml']                       = 'sitemap/xml';

/* End of file routes.php */
$route['tin-tuc(/:num)?'] = 'contents/news$1';
$route['tin-tuc(/:any)?'] = 'contents/view_news$1';

$route['thong-tin-tuyen-dung(/:num)?(\?:any)?'] = 'contents/job$1';
$route['tuyen-dung(/:any)?'] = 'contents/view_work$1';

$route['su-kien(/:num)?'] = 'contents/event$1';
$route['su-kien(/:any)?'] = 'contents/view_event$1';

$route['nhan-su(/:num)?'] = 'contents/professors$1';
$route['chuyen-de(/:num)?'] = 'contents/technologies$1';

$route['sinh-vien(/:num)?'] = 'contents/students$1';
$route['tin-tuc-noi-bat(/:any)?'] = 'contents/view_slideshow$1';
$route['viec-lam(/:any)?'] = 'contents/view_work$1';

$route['lien-he'] = 'contents/contact';
$route['dao-tao'] = 'contents/daotao';

$route['ky-nang(/:num)?'] = 'contents/skill$1';
$route['ky-nang(/:any)?'] = 'contents/view_skill$1';


$route['dang-ky-tim-viec'] = "contents/reg";
$route['dang-ky-tim-viec'] = "contents/reg";
$route['dang-ky-tuyen-dung'] = "contents/find";

$route['danh-sach-cuu-hssv'] = "contents/graduated";
$route['hoat-dong-cuu-hssv(/:num)?'] = "contents/blog$1";
$route['hoat-dong-cuu-hssv(/:any)?'] = "contents/view_blog$1";
$route['khao-sat-viec-lam'] = "contents/survey";

