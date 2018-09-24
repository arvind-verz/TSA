<?php   
// Need to be change project wise
define('ADMIN_LOGIN_PREFIX' , 'svca_admin_');
define('USER_LOGIN_PREFIX' , 'svca_user_');
define('ADMIN_COOKIE' , 'svca_admin_remember_me');
define('USER_COOKIE' , 'svca_remember_me');
define('ADMIN_ENCRYPTION_KEY' , '111edb903159af8500736c75ca9138f21svca');
define('USER_ENCRYPTION_KEY' , '555edb903159af8505736c75ca9138f21svca'); 
// Need to be change project wise

define('DB_PREFIX' , 'svca_');


define('TBL_ADMIN' , DB_PREFIX . 'admin_user');
define('TBL_ADMIN_LOG_DETAILS' , DB_PREFIX . 'admin_login_track');

define('TBL_SITE_OPTIONS' , DB_PREFIX . 'site_options');
define('TBL_EMAIL_TEMP' , DB_PREFIX . 'email_template');

define('TBL_GOOGLE' , DB_PREFIX . 'google_analytics');
define('TBL_CMS' , DB_PREFIX . 'pages');


define('TBL_BANNER' , DB_PREFIX . 'banner');
define('TBL_MENU_POSITION' , DB_PREFIX . 'menu_position');
define('TBL_MENU' , DB_PREFIX . 'menu');  


define('TBL_HOME_ADVERTISE', DB_PREFIX . 'home_advertise');
define('TBL_COMMITTEE_CATEGORY', DB_PREFIX . 'committee_category');
define('TBL_COMMITTEE_MEMBER', DB_PREFIX . 'committee_member');
define('TBL_SECRETARIAT', DB_PREFIX . 'secretariat');
define('TBL_RDIRECTORY', DB_PREFIX . 'rdirectory');
define('TBL_FAQ' , DB_PREFIX . 'faq');
define('TBL_TOOLKIT' , DB_PREFIX . 'toolkit');
define('TBL_PUBLICATIONS' , DB_PREFIX . 'publications');

define('TBL_OUR_NETWORK', DB_PREFIX . 'our_network');
define('TBL_JOIN_US_MEMBER', DB_PREFIX . 'join_us_member');

define('TBL_NEWSLETTER' , DB_PREFIX . 'newsletter');
define('TBL_LATESTNEWS' , DB_PREFIX . 'latestnews');

define('TBL_OTHER_EVENT' , DB_PREFIX . 'other_event');
define('TBL_EVENTS' , DB_PREFIX . 'events');
define('TBL_EVENTS_PDF' , DB_PREFIX . 'events_pdf');

define('TBL_MEMBER' , DB_PREFIX . 'member');
define('TBL_MEMBER_TYPE' , DB_PREFIX . 'member_type');

define('TBL_CONTACT' , DB_PREFIX . 'contact');
define('TBL_EVENT_REGISTRATION',DB_PREFIX . 'event_registration');
define('TBL_PAYPAL_TRANSACTION',DB_PREFIX . 'paypal_transaction');
define('TBL_MEMBERSHIP_TYPE', DB_PREFIX . 'membership_type');