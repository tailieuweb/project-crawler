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
| 	www.your-site.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://www.codeigniter.com/user_guide/general/routing.html
*/

// front-end
$route['contents/admin/index']				= 'admin_statistic';
$route['contents/admin/statistic']				= 'admin_statistic';
$route['contents/admin/mapped']				= 'admin_mapped';


$route['contents/admin/company(/:num)?']				= 'admin_company$3';
$route['contents/admin/company/delete/(:num)?']				= 'admin_company/delete$4';
$route['contents/admin/company/edit(/:num)?']                      = 'admin_company/edit/$5';
$route['contents/admin/company/create']                      = 'admin_company/create';

$route['contents/admin/categories(/:num)?']				= 'admin_categories$3';
$route['contents/admin/categories/delete(/:num)?']                      = 'admin_categories/delete/$5';
$route['contents/admin/categories/edit(/:num)?']                      = 'admin_categories/edit/$5';
$route['contents/admin/categories/create']                      = 'admin_categories/create';

$route['contents/admin/candidates(/:num)?']				= 'admin_candidates$3';
$route['contents/admin/candidates/delete(/:num)?']                      = 'admin_candidates/delete/$5';
$route['contents/admin/candidates/edit(/:num)?']                      = 'admin_candidates/edit/$5';
$route['contents/admin/candidates/create']                      = 'admin_candidates/create';

$route['contents/admin/recruitments(/:num)?']				= 'admin_recruitments$3';
$route['contents/admin/recruitments/delete(/:num)?']                      = 'admin_recruitments/delete/$5';
$route['contents/admin/recruitments/edit(/:num)?']                      = 'admin_recruitments/edit/$5';
$route['contents/admin/recruitments/create']                      = 'admin_recruitments/create';


$route['contents/admin/graduated(/:num)?']				= 'admin_graduated$3';
$route['contents/admin/graduated/delete(/:num)?']                      = 'admin_graduated/delete/$5';
$route['contents/admin/graduated/edit(/:num)?']                      = 'admin_graduated/edit/$5';
$route['contents/admin/graduated/create']                      = 'admin_graduated/create';
$route['contents/admin/graduated/manage_courses']                      = 'admin_graduated/manage_courses';
$route['contents/admin/graduated/import']                      = 'admin_graduated/import';

$route['contents/admin/statistic/manage_sites']				= 'admin_statistic/manage_sites';
$route['contents/admin/statistic/cron_tab']				= 'admin_statistic/cron_tab';

$route['contents/admin/logs']                               = 'admin_logs';
$route['contents/admin/logs(/:num)?']				= 'admin_logs$3';
$route['contents/admin/logs/truncate(/:any)?']                               = 'admin_logs/truncate/$5';
//$route['contents/admin/logs#works(/:num)?']				= 'admin_logs$3';
//$route['contents/admin/logs##details(/:num)?']				= 'admin_logs$3';

$route['contents/admin/locations']                               = 'admin_locations';
$route['contents/admin/locations(/:num)?']				= 'admin_locations$3';
$route['contents/admin/locations/create']                      = 'admin_locations/create';
$route['contents/admin/locations/delete(/:num)?']                      = 'admin_locations/delete/$5';
$route['contents/admin/locations/edit(/:num)?']                      = 'admin_locations/edit/$5';

$route['contents/admin/patterns']                               = 'admin_patterns';
$route['contents/admin/patterns/create']                      = 'admin_patterns/create';
$route['contents/admin/patterns/delete(/:num)?']                      = 'admin_patterns/delete/$5';
$route['contents/admin/patterns/edit(/:num)(/:num)?']                      = 'admin_patterns/edit/$5/$6';

$route['contents/admin/crawler']                               = 'admin_crawler';