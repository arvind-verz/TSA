<?php
defined('BASEPATH') or exit('No direct script access allowed');


/* FRONTEND */

$route['testimonial']        = "frontend/cms/testimonial";
$route['home']               = "frontend/cms/index";
$route['contact-us']         = "frontend/cms/contact_us";
$route['(:any)']             = "frontend/cms/inner_pages/$1";
/* FRONTEND */


$route['default_controller'] = 'backend/AccountsController/index';

/* BACKEND */


//$route['default_controller'] = 'backend/AccountsController/index';

/* BACKEND */


/* PDF */
//$route['admin/pdf/invoice/(:any)']         = 'backend/PdfController/my_mPDF/$1';
$route['admin/login']         = 'backend/AccountsController/index';
$route['admin/login/process'] = 'backend/AccountsController/process';
$route['admin/logout']        = 'backend/AccountsController/logout';

/* ROLES AND PERMISSION */
$route['admin/users/profile']                            = 'backend/AccountsController/profile';
$route['admin/users/profile/update']                     = 'backend/AccountsController/profileUpdate';
$route['admin/users']                                    = 'backend/AccountsController/users';
$route['admin/users/roles-and-permission/create']        = 'backend/AccountsController/permission_create';
$route['admin/users/roles-and-permission/store']         = 'backend/AccountsController/permission_store';
$route['admin/users/roles-and-permission/edit/(:any)']   = 'backend/AccountsController/permission_edit/$1';
$route['admin/users/roles-and-permission/update/(:any)'] = 'backend/AccountsController/permission_update/$1';

$route['admin/users/create']        = 'backend/AccountsController/users_create';
$route['admin/users/store']         = 'backend/AccountsController/users_store';
$route['admin/users/edit/(:any)']   = 'backend/AccountsController/users_edit/$1';
$route['admin/users/update/(:any)'] = 'backend/AccountsController/users_update/$1';

$route['admin/denied-access-control'] = 'backend/AccountsController/denied_access';

$route['admin/dashboard'] = 'backend/DashboardController/index';

/* SUBJECT */
$route['admin/subject']                           = 'backend/SubjectController/index';
$route['admin/subject/archived']                  = 'backend/SubjectController/archived';
$route['admin/subject/create']                    = 'backend/SubjectController/create';
$route['admin/subject/store']                     = 'backend/SubjectController/store';
$route['admin/subject/edit/(:any)']               = 'backend/SubjectController/edit/$1';
$route['admin/subject/update/(:any)']             = 'backend/SubjectController/update/$1';
$route['admin/subject/delete/(:any)']             = 'backend/SubjectController/delete/$1';
$route['admin/subject/moveto_active_list/(:any)'] = 'backend/SubjectController/moveto_active_list/$1';

/* CLASS */
$route['admin/classes']                           = 'backend/ClassController/index';
$route['admin/classes/archived']                  = 'backend/ClassController/archived';
$route['admin/classes/create']                    = 'backend/ClassController/create';
$route['admin/classes/store']                     = 'backend/ClassController/store';
$route['admin/classes/edit/(:any)']               = 'backend/ClassController/edit/$1';
$route['admin/classes/update/(:any)']             = 'backend/ClassController/update/$1';
$route['admin/classes/delete/(:any)']             = 'backend/ClassController/delete/$1';
$route['admin/classes/moveto_active_list/(:any)'] = 'backend/ClassController/moveto_active_list/$1';

/* Student Admin */

$route['admin/students']                = 'backend/StudentController/index';
$route['admin/students/archive/(:any)'] = 'backend/StudentController/archive/$1';

$route['admin/students/archived'] = 'backend/StudentController/archived';
$route['admin/students/create'] = 'backend/StudentController/create';
$route['admin/students/store'] = 'backend/StudentController/store';
$route['admin/students/search'] = 'backend/StudentController/search';
$route['admin/students/enroll'] = 'backend/StudentController/enroll';
$route['admin/students/edit/(:any)'] = 'backend/StudentController/edit/$1';
$route['admin/students/update/(:any)'] = 'backend/StudentController/update/$1';
$route['admin/students/delete/(:any)'] = 'backend/StudentController/delete/$1';
$route['admin/students/moveto_active_list/(:any)'] = 'backend/StudentController/moveto_active_list/$1';


$route['admin/students']                           = 'backend/StudentController/index';
$route['admin/students/archive/(:any)']            = 'backend/StudentController/archive/$1';
$route['admin/students/archived']                  = 'backend/StudentController/archived';
$route['admin/students/create']                    = 'backend/StudentController/create';
$route['admin/students/store']                     = 'backend/StudentController/store';
$route['admin/students/search']                    = 'backend/StudentController/search';
$route['admin/students/enroll']                    = 'backend/StudentController/enroll';
$route['admin/students/edit/(:any)']               = 'backend/StudentController/edit/$1';
$route['admin/students/update/(:any)']             = 'backend/StudentController/update/$1';
$route['admin/students/delete/(:any)']             = 'backend/StudentController/delete/$1';
$route['admin/students/moveto_active_list/(:any)'] = 'backend/StudentController/moveto_active_list/$1';


$route['admin/classes/moveto_active_list/(:any)'] = 'backend/classcontroller/moveto_active_list/$1';

/* ORDER */
$route['admin/order']                     = 'backend/OrderController/index';
$route['admin/order/create']              = 'backend/OrderController/create';
$route['admin/order/store']               = 'backend/OrderController/store';
$route['admin/order/update_order_status'] = 'backend/OrderController/update_order_status';

/* MATERIAL */
$route['admin/material']                           = 'backend/MaterialController/index';
$route['admin/material/archived']                  = 'backend/MaterialController/archived';
$route['admin/material/create']                    = 'backend/MaterialController/create';
$route['admin/material/store']                     = 'backend/MaterialController/store';
$route['admin/material/edit/(:any)']               = 'backend/MaterialController/edit/$1';
$route['admin/material/update/(:any)']             = 'backend/MaterialController/update/$1';
$route['admin/material/delete/(:any)']             = 'backend/MaterialController/delete/$1';
$route['admin/material/moveto_active_list/(:any)'] = 'backend/MaterialController/moveto_active_list/$1';

$route['admin/material/get_student_by_class_code'] = 'backend/MaterialController/get_student_by_class_code';

/* INVOICE */
$route['admin/invoice']                       = 'backend/InvoiceController/index';
$route['admin/invoice/get_invoice_sheet']     = 'backend/InvoiceController/get_invoice_sheet';
$route['admin/invoice/payment_status_update'] = 'backend/InvoiceController/payment_status_update';

/* SMS */
$route['admin/sms_template']                            = 'backend/SmsController/index';
$route['admin/sms_template/sms_template_create']        = 'backend/SmsController/sms_template_create';
$route['admin/sms_template/sms_template_store']         = 'backend/SmsController/sms_template_store';
$route['admin/sms_template/sms_template_edit/(:any)']   = 'backend/SmsController/sms_template_edit/$1';
$route['admin/sms_template/sms_template_update/(:any)'] = 'backend/SmsController/sms_template_update/$1';

$route['admin/sms_history'] = 'backend/SmsController/sms_history';

/* BILLING */
$route['admin/billing']               = 'backend/BillingController/index';
$route['admin/billing/create']        = 'backend/BillingController/create';
$route['admin/billing/store']         = 'backend/BillingController/store';
$route['admin/billing/edit/(:any)']   = 'backend/BillingController/edit/$1';
$route['admin/billing/update/(:any)'] = 'backend/BillingController/update/$1';

/* ATTENDANCE */
$route['admin/attendance']                         = 'backend/AttendanceController/index';
$route['admin/attendance/create']                  = 'backend/AttendanceController/create';
$route['admin/attendance/store']                   = 'backend/AttendanceController/store';
$route['admin/attendance/get_attendance_sheet']    = 'backend/AttendanceController/get_attendance_sheet';
$route['admin/attendance/get_attendance_summary']  = 'backend/AttendanceController/get_attendance_summary';
$route['admin/attendance/transfer_student']        = 'backend/AttendanceController/transfer_student';
$route['admin/attendance/get_class_code_transfer'] = 'backend/AttendanceController/get_class_code_transfer';

/* ORDER */
$route['admin/order']                     = 'backend/OrderController/index';
$route['admin/order/create']              = 'backend/OrderController/create';
$route['admin/order/store']               = 'backend/OrderController/store';
$route['admin/order/update_order_status'] = 'backend/OrderController/update_order_status';

/* REPORTING */
$route['admin/reporting'] = 'backend/ReportingController/index';

/* MATERIAL */
$route['admin/material']                           = 'backend/materialcontroller/index';
$route['admin/material/archived']                  = 'backend/materialcontroller/archived';
$route['admin/material/create']                    = 'backend/materialcontroller/create';
$route['admin/material/store']                     = 'backend/materialcontroller/store';
$route['admin/material/edit/(:any)']               = 'backend/materialcontroller/edit/$1';
$route['admin/material/update/(:any)']             = 'backend/materialcontroller/update/$1';
$route['admin/material/delete/(:any)']             = 'backend/materialcontroller/delete/$1';
$route['admin/material/moveto_active_list/(:any)'] = 'backend/materialcontroller/moveto_active_list/$1';

/* INVOICE */
$route['admin/invoice'] = 'backend/invoicecontroller/index';

/* Tutor Admin */
$route['admin/tutors']                           = 'backend/TutorController/index';
$route['admin/tutors/create']                    = 'backend/TutorController/create';
$route['admin/tutors/store']                     = 'backend/TutorController/store';
$route['admin/tutors/archive/(:any)']            = 'backend/TutorController/archive/$1';
$route['admin/tutors/archived']                  = 'backend/TutorController/archived';
$route['admin/tutors/edit/(:any)']               = 'backend/TutorController/edit/$1';
$route['admin/tutors/update/(:any)']             = 'backend/TutorController/update/$1';
$route['admin/tutors/moveto_active_list/(:any)'] = 'backend/TutorController/moveto_active_list/$1';


/* End Tutor Admin */

/* Permission Admin */
$route['admin/permission']               = 'backend/PermissionController/index';
$route['admin/permission/create']        = 'backend/PermissionController/create';
$route['admin/permission/store']         = 'backend/PermissionController/store';
$route['admin/permission/edit/(:any)']   = 'backend/PermissionController/edit/$1';
$route['admin/permission/update/(:any)'] = 'backend/PermissionController/update/$1';
$route['admin/permission/delete/(:any)'] = 'backend/PermissionController/delete/$1';

$route['admin/role/create']        = 'backend/PermissionController/create_user';
$route['admin/role/store']         = 'backend/PermissionController/store_user';
$route['admin/role/edit/(:any)']   = 'backend/PermissionController/edit_user/$1';
$route['admin/role/update/(:any)'] = 'backend/PermissionController/update_user/$1';
$route['admin/role/delete/(:any)'] = 'backend/PermissionController/delete_user/$1';
/* End Permission Admin */

$route['404_override']         = '';
$route['translate_uri_dashes'] = false;
/* CMS Admin */

$route['admin/manage-menu']                  = "backend/CmsController/manage_menu";
$route['admin/manage-menu-list/(:any)']      = "backend/CmsController/manage_menu_list/$1";
$route['admin/add-menu-item/(:any)']         = "backend/CmsController/add_menu_item/$1";
$route['admin/edit-menu-item/(:any)/(:any)'] = "backend/CmsController/edit_menu_item/$1/$2";
$route['admin/del-menu-item/(:any)/(:any)']  = "backend/CmsController/del_menu_item/$1/$2";
$route['admin/manage-cms']                   = "backend/CmsController/manage_cms";
$route['admin/add-cms']                      = "backend/CmsController/add_cms";
$route['admin/edit-cms/(:any)']              = "backend/CmsController/edit_cms/$1";
$route['admin/del-cms/(:any)']               = "backend/CmsController/del_cms/$1";
$route['admin/generate-page-list']           = "backend/CmsController/generate_page_list";

$route['admin/manage-testimonial']      = "backend/TestimonialController/manage_testimonial";
$route['admin/add-testimonial']         = "backend/TestimonialController/add_testimonial";
$route['admin/edit-testimonial/(:any)'] = "backend/TestimonialController/edit_testimonial/$1";
$route['admin/del-testimonial/(:any)']  = "backend/TestimonialController/del_testimonial/$1";
/* CMS Admin */


/* Tutor Admin */
$route['404_override']         = '';
$route['translate_uri_dashes'] = false;
/* CMS Admin */

$route['admin/manage-menu']                  = "backend/CmsController/manage_menu";
$route['admin/manage-menu-list/(:any)']      = "backend/CmsController/manage_menu_list/$1";
$route['admin/add-menu-item/(:any)']         = "backend/CmsController/add_menu_item/$1";
$route['admin/edit-menu-item/(:any)/(:any)'] = "backend/CmsController/edit_menu_item/$1/$2";
$route['admin/del-menu-item/(:any)/(:any)']  = "backend/CmsController/del_menu_item/$1/$2";
$route['admin/manage-cms']                   = "backend/CmsController/manage_cms";
$route['admin/add-cms']                      = "backend/CmsController/add_cms";
$route['admin/edit-cms/(:any)']              = "backend/CmsController/edit_cms/$1";
$route['admin/del-cms/(:any)']               = "backend/CmsController/del_cms/$1";
/* CMS Admin */

