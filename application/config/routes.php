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
/* Student Admin */
$route['admin/students'] = 'backend/studentcontroller/index';
$route['admin/students/archive/(:any)'] = 'backend/studentcontroller/archive/$1';
$route['admin/students/archived'] = 'backend/studentcontroller/archived';
$route['admin/students/create'] = 'backend/studentcontroller/create';
$route['admin/students/store'] = 'backend/studentcontroller/store';
$route['admin/students/search'] = 'backend/studentcontroller/search';
$route['admin/students/enroll'] = 'backend/studentcontroller/enroll';
$route['admin/students/edit/(:any)'] = 'backend/studentcontroller/edit/$1';
$route['admin/students/update/(:any)'] = 'backend/studentcontroller/update/$1';
$route['admin/students/delete/(:any)'] = 'backend/studentcontroller/delete/$1';

/* Student Admin */
/* Tutor Admin */
$route['admin/tutors'] = 'backend/TutorController/index';
$route['admin/tutors/create'] = 'backend/TutorController/create';
$route['admin/tutors/store'] = 'backend/TutorController/store';
/* Tutor Admin */
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
