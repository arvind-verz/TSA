<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';


/* BACKEND */
$route['admin/dashboard'] = 'backend/dashboard/index';

$route['admin/classes'] = 'backend/classcontroller/index';
$route['admin/classes/archived'] = 'backend/classcontroller/archived';
$route['admin/classes/create'] = 'backend/classcontroller/create';
$route['admin/classes/store'] = 'backend/classcontroller/store';
$route['admin/classes/edit/(:any)'] = 'backend/classcontroller/edit/$1';
$route['admin/classes/update/(:any)'] = 'backend/classcontroller/update/$1';
$route['admin/classes/delete/(:any)'] = 'backend/classcontroller/delete/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
