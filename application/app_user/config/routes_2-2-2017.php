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
$route['404_override'] = 'index/page_not_found';
$route['default_controller'] = "index/home";

$route['home'] = "index/home";
$route['error'] = "index/error";
$route['page-not-found'] = "index/page_not_found";
$route['about/committees/(:any)'] = "about/committees/$1";

$route['secretariat'] = "about/secretariat";
$route['members'] = "cms/members";
$route['faq'] = "index/faq";
$route['other-events'] = "events/other_events";
$route['newsletter'] = "news/newsletter_all";
$route['newsletter-details/(:any)'] = "news/newsletter_details/$1";

$route['latest-news'] = "news/latest_news_all";
$route['latest-news/(:any)/(:any)'] = "news/news_list/$1/$2";
$route['news-details/(:any)'] = "news/news_details/$1";

$route['rdirectory/(:any)'] = "rdirectory/rdirectory_listing/$1";
$route['toolkit'] = "rdirectory/toolkit";

$route['publications'] = "publications/index";
$route['publications/(:any)'] = "publications/publications_details/$1";

$route['our-network'] = "publications/our_network";

$route['svca-events'] = "events/event_listing";
$route['event-details/(:any)'] = "events/event_details/$1";


$route['contact-us'] = "contact/index";

$route['login'] = "login/index";
$route['logout'] = 'login/logout';
$route['dashboard'] = "login/dashboard";
$route['resgister/(:any)'] = "resgister/resgister_details/$1";

$route['search'] = "index/search";
$route['thank-you/(:any)'] = "thank_you/$1";
$route['thank-you'] = "thank_you/index";
$route['(:any)'] = "cms/inner_pages/$1";

$route['translate_uri_dashes'] = FALSE;