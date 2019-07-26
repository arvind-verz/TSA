<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'frontend/Cms/index';

/* FRONTEND */

/* LOGIN */
//$route['login']         = 'frontend/AccountsController/index';
$route['login/process']                                    = 'frontend/AccountsController/process';
$route['login/reset-password/process']                     = 'frontend/AccountsController/reset_password_process';
$route['login/reset-password/new-password/(:any)']         = 'frontend/AccountsController/reset_new_password/$1';
$route['login/reset-password/new-password/process/(:any)'] = 'frontend/AccountsController/reset_new_password_process/$1';
$route['logout']                                           = 'frontend/AccountsController/logout';

$route['attendance/miss_class_request']   = 'frontend/Cms/miss_class_request';
$route['students/student-classes-search'] = 'frontend/Cms/student_classes_search';

/* FRONTEND */

/* BACKEND */

//$route['default_controller'] = 'backend/AccountsController/index';

/* BACKEND */

//$route['default_controller'] = 'backend/AccountsController/index';

/* BACKEND */

/* PDF */
//$route['admin/pdf/invoice/(:any)']         = 'backend/PdfController/my_mPDF/$1';

$route['admin/testing_cron_invoice'] = 'backend/CronInvoiceController/index';
$route['admin/cronjobs_SMS'] = 'backend/CronReservationController/index';
$route['admin/cronjobs_fee_reminder'] = 'backend/CronFeeReminderController/index';
$route['safelogin']                   = 'backend/AccountsController/index';
$route['safelogin/login']             = 'backend/AccountsController/index';
$route['safelogin/login/process']     = 'backend/AccountsController/process';

$route['safelogin/login/forget_password']             = 'backend/AccountsController/forget_password';
$route['safelogin/login/reset_password']             = 'backend/AccountsController/reset_password';
$route['safelogin/login/forget_process']     = 'backend/AccountsController/forget_process';
$route['safelogin/login/reset_process']     = 'backend/AccountsController/reset_process';

$route['admin/logout']            = 'backend/AccountsController/logout';

/* ADMIN ENQUIRY */
$route['admin/contact-enquiry']      = "backend/EnquiryController/contact_enquiry";
$route['admin/quick-enquiry']      = "backend/EnquiryController/quick_enquiry";

/* ROLES AND PERMISSION */
$route['admin/users/user_details/update']                     = 'backend/AccountsController/userDetailsUpdate';
$route['admin/users/profile']                            = 'backend/AccountsController/profile';
$route['admin/users/profile/update']                     = 'backend/AccountsController/profileUpdate';
$route['admin/users']                                    = 'backend/AccountsController/users';
$route['admin/users/roles-and-permission/create']        = 'backend/AccountsController/permission_create';
$route['admin/users/roles-and-permission/store']         = 'backend/AccountsController/permission_store';
$route['admin/users/roles-and-permission/edit/(:any)']   = 'backend/AccountsController/permission_edit/$1';
$route['admin/users/roles-and-permission/update/(:any)'] = 'backend/AccountsController/permission_update/$1';
$route['admin/users/roles-and-permission/delete/(:any)'] = 'backend/AccountsController/permission_delete/$1';

$route['admin/users/create']        = 'backend/AccountsController/users_create';
$route['admin/users/store']         = 'backend/AccountsController/users_store';
$route['admin/users/edit/(:any)']   = 'backend/AccountsController/users_edit/$1';
$route['admin/users/delete/(:any)']   = 'backend/AccountsController/users_delete/$1';
$route['admin/users/update/(:any)'] = 'backend/AccountsController/users_update/$1';

$route['admin/denied-access-control'] = 'backend/AccountsController/denied_access';

$route['admin/dashboard'] = 'backend/DashboardController/index';

/* SUBJECT */
$route['admin/subject']                           = 'backend/SubjectController/index';
$route['admin/subject/archive']                  = 'backend/SubjectController/archive';
$route['admin/subject/archived']                  = 'backend/SubjectController/archived';
$route['admin/subject/create']                    = 'backend/SubjectController/create';
$route['admin/subject/store']                     = 'backend/SubjectController/store';
$route['admin/subject/edit/(:any)']               = 'backend/SubjectController/edit/$1';
$route['admin/subject/update/(:any)']             = 'backend/SubjectController/update/$1';
$route['admin/subject/delete/(:any)']             = 'backend/SubjectController/delete/$1';
$route['admin/subject/moveto_active_list/(:any)'] = 'backend/SubjectController/moveto_active_list/$1';
$route['admin/subject/delete-archive/(:any)'] = 'backend/SubjectController/delete_archive/$1';

/* CLASS */
$route['admin/classes']                           = 'backend/ClassController/index';
$route['admin/classes/archived']                  = 'backend/ClassController/archived';
$route['admin/classes/create']                    = 'backend/ClassController/create';
$route['admin/classes/store']                     = 'backend/ClassController/store';
$route['admin/classes/edit/(:any)']               = 'backend/ClassController/edit/$1';
$route['admin/classes/update/(:any)']             = 'backend/ClassController/update/$1';
$route['admin/classes/delete/(:any)']             = 'backend/ClassController/delete/$1';
$route['admin/classes/moveto_active_list/(:any)'] = 'backend/ClassController/moveto_active_list/$1';
$route['admin/classes/delete-archive/(:any)'] = 'backend/ClassController/delete_archive/$1';

/* Student Admin */

$route['admin/students']                           = 'backend/StudentController/index';
$route['admin/students/archive']            = 'backend/StudentController/archive';
$route['admin/students/archived']                  = 'backend/StudentController/archived';
$route['admin/students/create']                    = 'backend/StudentController/create';
$route['admin/students/store']                     = 'backend/StudentController/store';
$route['admin/students/search']                    = 'backend/StudentController/search';
$route['admin/students/enroll']                    = 'backend/StudentController/enroll';
$route['admin/students/enroll/update_enrollment']             = 'backend/StudentController/update_enrollment';
$route['admin/students/edit/(:any)']               = 'backend/StudentController/edit/$1';
$route['admin/students/update/(:any)']             = 'backend/StudentController/update/$1';
$route['admin/students/delete/(:any)']             = 'backend/StudentController/delete/$1';
$route['admin/students/moveto_active_list/(:any)'] = 'backend/StudentController/moveto_active_list/$1';
$route['admin/students/get_student_status']        = 'backend/StudentController/get_student_status';
$route['admin/students/get_enrollment_type_popup_content']        = 'backend/StudentController/get_enrollment_type_popup_content';
$route['admin/students/get_enrollment_type_popup_content_update']        = 'backend/StudentController/get_enrollment_type_popup_content_update';
$route['admin/students/get_class_size']        = 'backend/StudentController/get_class_size';
$route['admin/students/get_class_deposit_amount']        = 'backend/StudentController/get_class_deposit_amount';
$route['admin/students/enrollment_decision']        = 'backend/StudentController/enrollment_decision';
$route['admin/students/get_view_all_contents']        = 'backend/StudentController/get_view_all_contents';
$route['admin/students/final_settlement/(:any)/(:any)']            = 'backend/StudentController/final_settlement/$1/$2';
$route['admin/students/delete-archive/(:any)'] = 'backend/StudentController/delete_archive/$1';
$route['admin/students/get_p_content'] = 'backend/StudentController/get_p_content';


/* ORDER */
$route['admin/order']                     = 'backend/OrderController/index';
$route['admin/order/archive']            = 'backend/OrderController/archive';
$route['admin/order/archived']                  = 'backend/OrderController/archived';
$route['admin/order/create']              = 'backend/OrderController/create';
$route['admin/order/store']               = 'backend/OrderController/store';
$route['admin/order/update_order_status'] = 'backend/OrderController/update_order_status';
$route['admin/order/order_status_change'] = 'backend/OrderController/order_status_change';
$route['admin/order/moveto_active_list/(:any)'] = 'backend/OrderController/moveto_active_list/$1';
$route['admin/order/delete-archive/(:any)'] = 'backend/OrderController/delete_archive/$1';

/* MATERIAL */
$route['admin/material']                           = 'backend/MaterialController/index';
$route['admin/material/archived']                  = 'backend/MaterialController/archived';
$route['admin/material/create']                    = 'backend/MaterialController/create';
$route['admin/material/store']                     = 'backend/MaterialController/store';
$route['admin/material/edit/(:any)']               = 'backend/MaterialController/edit/$1';
$route['admin/material/update/(:any)']             = 'backend/MaterialController/update/$1';
$route['admin/material/delete/(:any)']             = 'backend/MaterialController/delete/$1';
$route['admin/material/moveto_active_list/(:any)'] = 'backend/MaterialController/moveto_active_list/$1';
$route['admin/material/archive']                  = 'backend/MaterialController/archive';
$route['admin/material/get_book_price_range'] = 'backend/MaterialController/get_book_price_range';
$route['admin/material/get_books_by_subject'] = 'backend/MaterialController/get_books_by_subject';

$route['admin/material/get_student_by_class_code'] = 'backend/MaterialController/get_student_by_class_code';
$route['admin/material/delete-archive/(:any)'] = 'backend/MaterialController/delete_archive/$1';

/* INVOICE */
$route['admin/invoice']                       = 'backend/InvoiceController/index';
$route['admin/invoice/get_invoice_sheet']     = 'backend/InvoiceController/get_invoice_sheet';
$route['admin/invoice/invoice_remark']     = 'backend/InvoiceController/invoice_remark';
$route['admin/invoice/payment_status_update'] = 'backend/InvoiceController/payment_status_update';

/* SMS */
$route['admin/sms_template']                            = 'backend/SmsController/index';
$route['admin/sms_template/sms_template_create']        = 'backend/SmsController/sms_template_create';
$route['admin/sms_template/sms_template_store']         = 'backend/SmsController/sms_template_store';
$route['admin/sms_template/sms_template_edit/(:any)']   = 'backend/SmsController/sms_template_edit/$1';
$route['admin/sms_template/sms_template_update/(:any)'] = 'backend/SmsController/sms_template_update/$1';

$route['admin/sms_history']               = 'backend/SmsController/sms_history';
$route['admin/delete_sms_history/(:any)'] = 'backend/SmsController/delete_sms_history/$1';

$route['admin/sms_reminder']       = 'backend/SmsController/sms_reminder';
$route['admin/sms_reminder/store'] = 'backend/SmsController/sms_reminder_store';

$route['admin/sms_announcement'] = 'backend/SmsController/sms_announcement';

/* BILLING */
$route['admin/billing']               = 'backend/BillingController/index';
$route['admin/billing/create']        = 'backend/BillingController/create';
$route['admin/billing/archived']                  = 'backend/BillingController/archived';
$route['admin/billing/store']         = 'backend/BillingController/store';
$route['admin/billing/edit/(:any)']   = 'backend/BillingController/edit/$1';
$route['admin/billing/update/(:any)'] = 'backend/BillingController/update/$1';
$route['admin/billing/archive']                  = 'backend/BillingController/archive';
$route['admin/billing/moveto_active_list/(:any)'] = 'backend/BillingController/moveto_active_list/$1';
$route['admin/billing/delete-archive/(:any)'] = 'backend/BillingController/delete_archive/$1';

/* ATTENDANCE */
$route['admin/attendance']                           = 'backend/AttendanceController/index';
$route['admin/attendance/create']                           = 'backend/AttendanceController/create_attendance';
$route['admin/attendance/create-edit/(:any)/(:any)']                    = 'backend/AttendanceController/create/$1/$2';
$route['admin/attendance/store']                     = 'backend/AttendanceController/store';
//$route['admin/attendance/edit']                      = 'backend/AttendanceController/edit';
$route['admin/attendance/update']                    = 'backend/AttendanceController/update';
$route['admin/attendance/get_attendance_sheet']      = 'backend/AttendanceController/get_attendance_sheet';
$route['admin/attendance/get_attendance_summary']    = 'backend/AttendanceController/get_attendance_summary';
$route['admin/attendance/transfer_student']          = 'backend/AttendanceController/transfer_student';
$route['admin/attendance/get_class_code_transfer']   = 'backend/AttendanceController/get_class_code_transfer';
$route['admin/attendance/get_attendance_edit_sheet'] = 'backend/AttendanceController/get_attendance_edit_sheet';
$route['admin/attendance/get_attendance_date_by_class_code'] = 'backend/AttendanceController/get_attendance_date_by_class_code';
$route['admin/attendance/schedule_store'] = 'backend/AttendanceController/schedule_store';
$route['admin/attendance/raw-delete'] = 'backend/AttendanceController/raw_delete';


/* ORDER */
$route['admin/order']                     = 'backend/OrderController/index';
$route['admin/order/create']              = 'backend/OrderController/create';
$route['admin/order/store']               = 'backend/OrderController/store';
$route['admin/order/update_order_status'] = 'backend/OrderController/update_order_status';
$route['admin/order/update_order_date'] = 'backend/OrderController/update_order_date';

/* REPORTING */
$route['admin/reporting']                     = 'backend/ReportingController/index';
$route['admin/reporting/get_reporting_sheet'] = 'backend/ReportingController/get_reporting_sheet';

/* Tutor Admin */
$route['admin/tutors']                           = 'backend/TutorController/index';
$route['admin/tutors/create']                    = 'backend/TutorController/create';
$route['admin/tutors/store']                     = 'backend/TutorController/store';
$route['admin/tutors/archive']                  = 'backend/TutorController/archive';
//$route['admin/tutors/archive/(:any)']            = 'backend/TutorController/archive/$1';
$route['admin/tutors/archived']                  = 'backend/TutorController/archived';
$route['admin/tutors/edit/(:any)']               = 'backend/TutorController/edit/$1';
$route['admin/tutors/update/(:any)']             = 'backend/TutorController/update/$1';
$route['admin/tutors/moveto_active_list/(:any)'] = 'backend/TutorController/moveto_active_list/$1';
$route['admin/tutors/delete-archive/(:any)'] = 'backend/TutorController/delete_archive/$1';

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

/* CMS Admin */

$route['admin/manage-logo']                  = "backend/CmsController/manage_logo";
$route['admin/manage-logo/upload']                  = "backend/CmsController/manage_logo_upload";
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

$route['admin/manage-gallery']      = "backend/GalleryController/manage_gallery";
$route['admin/add-gallery']         = "backend/GalleryController/add_gallery";
$route['admin/edit-gallery/(:any)'] = "backend/GalleryController/edit_gallery/$1";
$route['admin/del-gallery/(:any)']  = "backend/GalleryController/del_gallery/$1";

$route['admin/manage-footer']      = "backend/CmsController/manage_footer";
$route['admin/manage-footer/update']      = "backend/CmsController/update_footer";
/* CMS Admin */

/* Tutor Admin */



/* FRONTEND */
$route['contact-us/submit']           = "frontend/cms/contact_us_form";
$route['quick-enquiry/submit']           = "frontend/cms/quick_enquiry_form";
$route['student-profile']  = 'frontend/Cms/student_profile';
$route['student-invoices'] = 'frontend/Cms/student_invoices';
$route['student-classes']  = 'frontend/Cms/student_classes';
$route['miss-class']       = 'frontend/Cms/miss_class';
$route['gallery']          = "frontend/gallery/index";
//$route['testimonial']      = "frontend/cms/testimonial";
$route['home']             = "frontend/cms/index";
$route['contact-us']       = "frontend/cms/contact_us";
$route['quick-enquiry']    = "frontend/cms/quick_enquiry";
$route['(:any)']           = "frontend/cms/inner_pages/$1";

/* END FRONTEND */

$route['404_override']         = '';
$route['translate_uri_dashes'] = false;
