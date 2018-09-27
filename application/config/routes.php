<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';


/* BACKEND */
$route['admin/dashboard'] = 'backend/dashboardcontroller/index';

/* SUBJECT */
$route['admin/subject'] = 'backend/subjectcontroller/index';
$route['admin/subject/archived'] = 'backend/subjectcontroller/archived';
$route['admin/subject/create'] = 'backend/subjectcontroller/create';
$route['admin/subject/store'] = 'backend/subjectcontroller/store';
$route['admin/subject/edit/(:any)'] = 'backend/subjectcontroller/edit/$1';
$route['admin/subject/update/(:any)'] = 'backend/subjectcontroller/update/$1';
$route['admin/subject/delete/(:any)'] = 'backend/subjectcontroller/delete/$1';

/* CLASS */
$route['admin/classes'] = 'backend/classcontroller/index';
$route['admin/classes/archived'] = 'backend/classcontroller/archived';
$route['admin/classes/create'] = 'backend/classcontroller/create';
$route['admin/classes/store'] = 'backend/classcontroller/store';
$route['admin/classes/edit/(:any)'] = 'backend/classcontroller/edit/$1';
$route['admin/classes/update/(:any)'] = 'backend/classcontroller/update/$1';
$route['admin/classes/delete/(:any)'] = 'backend/classcontroller/delete/$1';

/* ATTENDANCE */
$route['admin/attendance'] = 'backend/attendancecontroller/index';
$route['admin/attendance/create'] = 'backend/attendancecontroller/create';

$route['admin/attendance/get_attendance_sheet'] = 'backend/attendancecontroller/get_attendance_sheet';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
