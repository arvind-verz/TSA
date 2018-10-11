<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';


/* BACKEND */
$route['admin/dashboard'] = 'backend/DashboardController/index';

/* SUBJECT */
$route['admin/subject'] = 'backend/SubjectController/index';
$route['admin/subject/archived'] = 'backend/SubjectController/archived';
$route['admin/subject/create'] = 'backend/SubjectController/create';
$route['admin/subject/store'] = 'backend/SubjectController/store';
$route['admin/subject/edit/(:any)'] = 'backend/SubjectController/edit/$1';
$route['admin/subject/update/(:any)'] = 'backend/SubjectController/update/$1';
$route['admin/subject/delete/(:any)'] = 'backend/SubjectController/delete/$1';
$route['admin/subject/moveto_active_list/(:any)'] = 'backend/SubjectController/moveto_active_list/$1';

/* CLASS */
$route['admin/classes'] = 'backend/ClassController/index';
$route['admin/classes/archived'] = 'backend/ClassController/archived';
$route['admin/classes/create'] = 'backend/ClassController/create';
$route['admin/classes/store'] = 'backend/ClassController/store';
$route['admin/classes/edit/(:any)'] = 'backend/ClassController/edit/$1';
$route['admin/classes/update/(:any)'] = 'backend/ClassController/update/$1';
$route['admin/classes/delete/(:any)'] = 'backend/ClassController/delete/$1';

/* Student Admin */
$route['admin/students'] = 'backend/StudentController/index';
$route['admin/students/archive/(:any)'] = 'backend/StudentController/archive/$1';
$route['admin/students/archived'] = 'backend/StudentController/archived';
$route['admin/students/create'] = 'backend/StudentController/create';
$route['admin/students/store'] = 'backend/StudentController/store';
$route['admin/students/search'] = 'backend/StudentController/search';
$route['admin/students/enroll'] = 'backend/StudentController/enroll';
$route['admin/students/edit/(:any)'] = 'backend/StudentController/edit/$1';
$route['admin/students/update/(:any)'] = 'backend/StudentController/update/$1';
$route['admin/students/delete/(:any)'] = 'backend/StudentController/delete/$1';

$route['admin/classes/moveto_active_list/(:any)'] = 'backend/classcontroller/moveto_active_list/$1';

/* ATTENDANCE */
$route['admin/attendance'] = 'backend/AttendanceController/index';
$route['admin/attendance/create'] = 'backend/AttendanceController/create';
$route['admin/attendance/store'] = 'backend/AttendanceController/store';
$route['admin/attendance/get_attendance_sheet'] = 'backend/AttendanceController/get_attendance_sheet';
$route['admin/attendance/get_attendance_summary'] = 'backend/AttendanceController/get_attendance_summary';
$route['admin/attendance/transfer_student'] = 'backend/AttendanceController/transfer_student';
$route['admin/attendance/get_class_code_transfer'] = 'backend/AttendanceController/get_class_code_transfer';



/* ORDER */
$route['admin/order'] = 'backend/OrderController/index';
$route['admin/order/create'] = 'backend/OrderController/create';
$route['admin/order/store'] = 'backend/OrderController/store';
$route['admin/order/update_order_status'] = 'backend/OrderController/update_order_status';

/* MATERIAL */
$route['admin/material'] = 'backend/MaterialController/index';
$route['admin/material/archived'] = 'backend/MaterialController/archived';
$route['admin/material/create'] = 'backend/MaterialController/create';
$route['admin/material/store'] = 'backend/MaterialController/store';
$route['admin/material/edit/(:any)'] = 'backend/MaterialController/edit/$1';
$route['admin/material/update/(:any)'] = 'backend/MaterialController/update/$1';
$route['admin/material/delete/(:any)'] = 'backend/MaterialController/delete/$1';
$route['admin/material/moveto_active_list/(:any)'] = 'backend/MaterialController/moveto_active_list/$1';

/* INVOICE */
$route['admin/invoice'] = 'backend/InvoiceController/index';


/* SMS */
$route['admin/sms_template'] = 'backend/SmsController/index';
$route['admin/sms_template/sms_template_create'] = 'backend/SmsController/sms_template_create';
$route['admin/sms_template/sms_template_store'] = 'backend/SmsController/sms_template_store';
$route['admin/sms_template/sms_template_edit/(:any)'] = 'backend/SmsController/sms_template_edit/$1';
$route['admin/sms_template/sms_template_update/(:any)'] = 'backend/SmsController/sms_template_update/$1';

$route['admin/sms_history'] = 'backend/SmsController/sms_history';


/* BILLING */
$route['admin/billing'] = 'backend/BillingController/index';
$route['admin/billing/create'] = 'backend/BillingController/create';
$route['admin/billing/store'] = 'backend/BillingController/store';
$route['admin/billing/edit/(:any)'] = 'backend/BillingController/edit/$1';
$route['admin/billing/update/(:any)'] = 'backend/BillingController/update/$1';


/* Student Admin */
/* Tutor Admin */
$route['admin/tutors'] = 'backend/TutorController/index';
$route['admin/tutors/create'] = 'backend/TutorController/create';
$route['admin/tutors/store'] = 'backend/TutorController/store';
/* Tutor Admin */
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
