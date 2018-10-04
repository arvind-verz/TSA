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
$route['admin/subject/moveto_active_list/(:any)'] = 'backend/subjectcontroller/moveto_active_list/$1';

/* CLASS */
$route['admin/classes'] = 'backend/classcontroller/index';
$route['admin/classes/archived'] = 'backend/classcontroller/archived';
$route['admin/classes/create'] = 'backend/classcontroller/create';
$route['admin/classes/store'] = 'backend/classcontroller/store';
$route['admin/classes/edit/(:any)'] = 'backend/classcontroller/edit/$1';
$route['admin/classes/update/(:any)'] = 'backend/classcontroller/update/$1';
$route['admin/classes/delete/(:any)'] = 'backend/classcontroller/delete/$1';
$route['admin/classes/moveto_active_list/(:any)'] = 'backend/classcontroller/moveto_active_list/$1';

/* ATTENDANCE */
$route['admin/attendance'] = 'backend/attendancecontroller/index';
$route['admin/attendance/create'] = 'backend/attendancecontroller/create';
$route['admin/attendance/store'] = 'backend/attendancecontroller/store';
$route['admin/attendance/get_attendance_sheet'] = 'backend/attendancecontroller/get_attendance_sheet';
$route['admin/attendance/get_attendance_summary'] = 'backend/attendancecontroller/get_attendance_summary';
$route['admin/attendance/transfer_student'] = 'backend/attendancecontroller/transfer_student';
$route['admin/attendance/get_class_code_transfer'] = 'backend/attendancecontroller/get_class_code_transfer';



/* ORDER */
$route['admin/order'] = 'backend/ordercontroller/index';
$route['admin/order/create'] = 'backend/ordercontroller/create';
$route['admin/order/store'] = 'backend/ordercontroller/store';
$route['admin/order/update_order_status'] = 'backend/ordercontroller/update_order_status';

/* MATERIAL */
$route['admin/material'] = 'backend/materialcontroller/index';
$route['admin/material/archived'] = 'backend/materialcontroller/archived';
$route['admin/material/create'] = 'backend/materialcontroller/create';
$route['admin/material/store'] = 'backend/materialcontroller/store';
$route['admin/material/edit/(:any)'] = 'backend/materialcontroller/edit/$1';
$route['admin/material/update/(:any)'] = 'backend/materialcontroller/update/$1';
$route['admin/material/delete/(:any)'] = 'backend/materialcontroller/delete/$1';
$route['admin/material/moveto_active_list/(:any)'] = 'backend/materialcontroller/moveto_active_list/$1';

/* INVOICE */
$route['admin/invoice'] = 'backend/invoicecontroller/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
