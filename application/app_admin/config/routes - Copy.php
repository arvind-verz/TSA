<?php defined('BASEPATH') OR exit('No direct script access allowed');

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
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/  
  
  $route['login'] = "login/index";
  $route['login-details'] = 'login/login_details';
  $route['forgot-password'] = "login/forgot_password";
  $route['reset-password/(:any)/(:any)'] = "login/reset_password/$1/$2";
  $route['logout'] = 'login/logout';
  $route['login-details-delete'] = 'login/delete';
  
  $route['email'] = 'newsletter/email';
  
  $route['dashboard'] = 'dashboard/admin_home';
  
  $route['default_controller'] = "login";
  $route['404_override'] = 'error/page_missing';
  
  $route['manage-email-templates'] = "templates/manage_email_templates";
  $route['email-templates/(:any)'] = "templates/edit_email_templates/$1";
  $route['pre-email-templates/(:any)'] = "templates/pre_email_templates/$1";
  
 /* $route['manage-cart-enquery'] = "cart/manage_cart_enquery";
  $route['view-cart-enquery/(:any)'] = "cart/view_cart_enquery/$1";
  $route['del-cart-enquery/(:any)'] = "cart/del_cart_enquery/$1";*/
  
  $route['settings/general'] = 'settings/general/all_general';
  $route['settings/update-general/(:any)'] = 'settings/general/update_general/$1';
  $route['access-denied'] = 'user/access_denied';
  
  
  /*$route['manage-faq'] = "faq/manage_faq";
  $route['add-faq'] = "faq/add_faq";
  $route['view-faq/(:any)'] = "faq/view_faq/$1";
  $route['del-faq/(:any)'] = "faq/del_faq/$1";
  $route['edit-faq/(:any)'] = "faq/edit_faq/$1";*/
  
  /*$route['manage-options'] = "attributes/manage_options";
  $route['add-options'] = "attributes/add_options";
  $route['del-options/(:any)'] = "attributes/del_options/$1";
  $route['edit-options/(:any)'] = "attributes/edit_options/$1";
  
  $route['manage-values/(:any)'] = "attributes/manage_values/$1";
  $route['add-values/(:any)'] = "attributes/add_values/$1";
  $route['del-values/(:any)/(:any)'] = "attributes/del_values/$1/$2";
  $route['edit-values/(:any)/(:any)'] = "attributes/edit_values/$1/$2";
  
  $route['manage-contact'] = "contact/manage_contact";
  $route['view-contact/(:any)'] = "contact/view_contact/$1";
  $route['del-contact/(:any)'] = "contact/del_contact/$1";*/
  
  $route['manage-banner'] = "banner/manage_banner";
  $route['add-banner'] = "banner/add_banner";
  $route['edit-banner/(:any)'] = "banner/edit_banner/$1";
  $route['del-banner/(:any)'] = "banner/del_banner/$1";
  
  /*$route['manage-categories'] = "categories/manage_categories";
  $route['add-categories'] = "categories/add_categories";
  $route['edit-categories/(:any)'] = "categories/edit_categories/$1";
  $route['del-categories/(:any)'] = "categories/del_categories/$1";*/
  
  
  
  $route['manage-cms'] = "cms/manage_cms";
  $route['add-cms'] = "cms/add_cms";
  $route['edit-cms/(:any)'] = "cms/edit_cms/$1";
  $route['del-cms/(:any)'] = "cms/del_cms/$1";
  
  $route['generate-page-list'] = "cms/generate_page_list";
  $route['generate-parent-id/(:any)'] = "cms/generate_parent_id/$1";
  
  $route['manage-menu'] = "cms/manage_menu";
  $route['manage-menu-list/(:any)'] = "cms/manage_menu_list/$1";
  $route['add-menu-item/(:any)'] = "cms/add_menu_item/$1";
  $route['edit-menu-item/(:any)/(:any)'] = "cms/edit_menu_item/$1/$2";
  $route['del-menu-item/(:any)/(:any)'] = "cms/del_menu_item/$1/$2";
  
  /*$route['manage-members'] = "members/manage_members";
  $route['add-members'] = "members/add_members";
  $route['edit-members/(:any)'] = "members/edit_members/$1";
  $route['del-members/(:any)'] = "members/del_members/$1";*/
  
  $route['manage-users'] = "user/manage_users";
  $route['add-users'] = "user/add_users";  
  $route['edit-user/(:any)'] = "user/edit_user/$1";
  $route['edit-profile/(:any)'] = "user/edit_profile/$1";
  $route['view-users/(:any)'] = "user/view_user/$1";
  $route['del-user/(:any)'] = "user/del_user/$1";
 
  
    
  
  
 
  ##
  
   
  /*$route['manage-our-client'] = "ourClient/manage_ourclient";
  $route['add-our-client'] = "ourClient/add_ourclient";
  $route['edit-our-client/(:any)'] = "ourClient/edit_ourclient/$1";
  $route['del-our-client/(:any)'] = "ourClient/del_ourclient/$1";
   
  $route['manage-quick-contact'] = "quickContact/manage_qcontact";
  $route['view-quick-contact/(:any)'] = "quickContact/view_qcontact/$1";
  $route['del-quick-contact/(:any)'] = "quickContact/del_qcontact/$1";
  $route['export-quick-contact'] = "quickContact/export_contact";*/
  
  
  /*$route['manage-tools-categories'] = "tools_categories/manage_tools_categories";
  $route['add-tools-categories'] = "tools_categories/add_tools_categories";
  $route['edit-tools-categories/(:any)'] = "tools_categories/edit_tools_categories/$1";
  $route['del-tools-categories/(:any)'] = "tools_categories/del_tools_categories/$1";  
  
  
  $route['manage-tools-products'] = "tools_products/manage_tools_products";
  $route['add-tools-products'] = "tools_products/add_tools_products";
  $route['edit-tools-products/(:any)'] = "tools_products/edit_tools_products/$1";
  $route['del-tools-products/(:any)'] = "tools_products/del_tools_products/$1";
  $route['remove-file/(:any)'] = "tools_products/remove_file/$1";
  $route['deletepdf'] = "tools_products/deletepdf";
  $route['export-tool-products'] = "tools_products/export_products";
  $route['import-tool-products'] = "tools_products/import_products";
  
  $route['manage-video/(:any)'] = "tools_products/manage_video/$1";
  $route['add-video/(:any)'] = "tools_products/add_video/$1";
  $route['del-video/(:any)/(:any)'] = "tools_products/del_video/$1/$2";
  $route['edit-video/(:any)/(:any)'] = "tools_products/edit_video/$1/$2";
  
  
  $route['manage-products'] = "products/manage_products";
  $route['add-products'] = "products/add_products";
  $route['edit-products/(:any)'] = "products/edit_products/$1";
  $route['del-products/(:any)'] = "products/del_products/$1";
  $route['remove-file2/(:any)'] = "products/remove_file/$1";
  $route['export-products'] = "products/export_products";
  $route['import-products'] = "products/import_products";
  
  
  
  
  $route['manage-service-centre'] = "service_centre/manage_service_centre";
  $route['add-service-centre'] = "service_centre/add_service_centre";
  $route['edit-service-centre/(:any)'] = "service_centre/edit_service_centre/$1";
  $route['del-service-centre/(:any)'] = "service_centre/del_service_centre/$1";
  
  
  
  
  $route['manage-country'] = "country/manage_country";
  $route['add-country'] = "country/add_country";
  $route['edit-country/(:any)'] = "country/edit_country/$1";
  $route['del-country/(:any)'] = "country/del_country/$1";
  
  $route['manage-dealer'] = "dealer/manage_dealer";
  $route['add-dealer'] = "dealer/add_dealer";
  $route['edit-dealer/(:any)'] = "dealer/edit_dealer/$1";
  $route['del-dealer/(:any)'] = "dealer/del_dealer/$1";
  
  
  $route['manage-country-contact'] = "countryContact/manage_country_contact";
  $route['add-country-contact'] = "countryContact/add_country_contact";
  $route['edit-country-contact/(:any)'] = "countryContact/edit_country_contact/$1";
  $route['del-country-contact/(:any)'] = "countryContact/del_country_contact/$1";
  
  $route['manage-contact'] = "contact/manage_contact";
  $route['view-contact/(:any)'] = "contact/view_contact/$1";
  $route['del-contact/(:any)'] = "contact/del_contact/$1";
  $route['export-contact'] = "contact/export_contact";
  
  
  $route['manage-tools-contact'] = "toolsContact/manage_tools_contact";
  $route['view-tools-contact/(:any)'] = "toolsContact/view_tools_contact/$1";
  $route['del-tools-contact/(:any)'] = "toolsContact/del_tools_contact/$1";
  $route['export-tools-contact'] = "toolsContact/export_tools_contact";
  
  $route['manage-acc-contact'] = "accContact/manage_acc_contact";
  $route['view-acc-contact/(:any)'] = "accContact/view_acc_contact/$1";
  $route['del-acc-contact/(:any)'] = "accContact/del_acc_contact/$1";
  $route['export-acc-contact'] = "accContact/export_acc_contact";
  
  $route['manage-registration'] = "registration/manage_registration";
  $route['view-registration/(:any)'] = "registration/view_registration/$1";
  $route['del-registration/(:any)'] = "registration/del_registration/$1";
  $route['export-registration'] = "registration/export_registration";*/
  
 /* ===============svca==========*/
  /*$route['manage-parts'] = "parts/manage_parts";
  $route['add-parts'] = "parts/add_parts";
  $route['edit-parts/(:any)'] = "parts/edit_parts/$1";
  $route['del-parts/(:any)'] = "parts/del_parts/$1";*/
  
  $route['manage-advertise'] = "advertise/manage_advertise";
  $route['add-advertise'] = "advertise/add_advertise";
  $route['edit-advertise/(:any)'] = "advertise/edit_advertise/$1";
  $route['del-advertise/(:any)'] = "advertise/del_advertise/$1";
  
  $route['manage-faq'] = "faq/manage_faq";
  $route['add-faq'] = "faq/add_faq";
  $route['view-faq/(:any)'] = "faq/view_faq/$1";
  $route['del-faq/(:any)'] = "faq/del_faq/$1";
  $route['edit-faq/(:any)'] = "faq/edit_faq/$1";
  
 
  $route['manage-committee-categtory'] = "committeeCategory/manage_committee_categtory";
  $route['add-committee-categtory'] = "committeeCategory/add_committee_categtory";
  $route['edit-committee-categtory/(:any)'] = "committeeCategory/edit_committee_categtory/$1";
  $route['del-committee-categtory/(:any)'] = "committeeCategory/del_committee_categtory/$1";
  
  $route['manage-committee-member'] = "committeeMember/manage_committee_member";
  $route['add-committee-member'] = "committeeMember/add_committee_member";
  $route['edit-committee-member/(:any)'] = "committeeMember/edit_committee_member/$1";
  $route['del-committee-member/(:any)'] = "committeeMember/del_committee_member/$1";
  
  $route['manage-secretariat'] = "secretariat/manage_secretariat";
  $route['add-secretariat'] = "secretariat/add_secretariat";
  $route['edit-secretariat/(:any)'] = "secretariat/edit_secretariat/$1";
  $route['del-secretariat/(:any)'] = "secretariat/del_secretariat/$1";
  
  
  $route['manage-rdirectory'] = "rdirectory/manage_rdirectory";
  $route['add-rdirectory'] = "rdirectory/add_rdirectory";
  $route['edit-rdirectory/(:any)'] = "rdirectory/edit_rdirectory/$1";
  $route['del-rdirectory/(:any)'] = "rdirectory/del_rdirectory/$1";
  
  $route['manage-toolkit'] = "toolkit/manage_toolkit";
  $route['add-toolkit'] = "toolkit/add_toolkit";
  $route['edit-toolkit/(:any)'] = "toolkit/edit_toolkit/$1";
  $route['del-toolkit/(:any)'] = "toolkit/del_toolkit/$1";
  
  
  $route['manage-publications'] = "publications/manage_publications";
  $route['add-publications'] = "publications/add_publications";
  $route['edit-publications/(:any)'] = "publications/edit_publications/$1";
  $route['del-publications/(:any)'] = "publications/del_publications/$1";
  
  $route['manage-our-network'] = "our_network/edit_our_network";
  $route['manage-join-us-member'] = "join_us_member/edit_join_us_member";
  
  $route['manage-newsletter'] = "newsletter/manage_newsletter";
  $route['add-newsletter'] = "newsletter/add_newsletter";
  $route['edit-newsletter/(:any)'] = "newsletter/edit_newsletter/$1";
  $route['del-newsletter/(:any)'] = "newsletter/del_newsletter/$1";
  
  
  $route['manage-latestnews'] = "latestnews/manage_latestnews";
  $route['add-latestnews'] = "latestnews/add_latestnews";
  $route['edit-latestnews/(:any)'] = "latestnews/edit_latestnews/$1";
  $route['del-latestnews/(:any)'] = "latestnews/del_latestnews/$1";
  
  
  $route['manage-otherevent'] = "otherevent/manage_otherevent";
  $route['add-otherevent'] = "otherevent/add_otherevent";
  $route['edit-otherevent/(:any)'] = "otherevent/edit_otherevent/$1";
  $route['del-otherevent/(:any)'] = "otherevent/del_otherevent/$1";
  
  
  $route['manage-svcaevent'] = "svcaevent/manage_svcaevent";
  $route['add-svcaevent'] = "svcaevent/add_svcaevent";
  $route['edit-svcaevent/(:any)'] = "svcaevent/edit_svcaevent/$1";
  $route['del-svcaevent/(:any)'] = "svcaevent/del_svcaevent/$1";
  $route['deletepdf'] = "svcaevent/deletepdf";
  
  
  $route['manage-members'] = "members/manage_members";
  $route['add-members'] = "members/add_members";
  $route['edit-members/(:any)'] = "members/edit_members/$1";
  $route['del-members/(:any)'] = "members/del_members/$1";
  
  
  $route['manage-contact'] = "contact/manage_contact";
  $route['view-contact/(:any)'] = "contact/view_contact/$1";
  $route['del-contact/(:any)'] = "contact/del_contact/$1";
  $route['export-contact'] = "contact/export_contact";
  
  
  $route['translate_uri_dashes'] = FALSE;