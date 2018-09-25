<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';


/* BACKEND */
$route['admin/dashboard'] = 'backend/dashboard/index';

$route['admin/classes'] = 'backend/classes/index';
$route['admin/classes/create'] = 'backend/classes/create';
$route['admin/classes/store'] = 'backend/classes/store';
$route['admin/classes/edit/(:any)'] = 'backend/classes/edit/$1';
$route['admin/classes/update/(:any)'] = 'backend/classes/update/$1';
$route['admin/classes/delete/(:any)'] = 'backend/classes/delete/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
