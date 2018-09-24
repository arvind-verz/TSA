<?php

 

  require_once("tbl_define.php");



  define('SYSTEM_DIR_NAME' , 'system');



  define('USER_APP_NAME' , 'app_user');



  define('ADMIN_APP_NAME' , 'app_admin');



  define('BASE_URL' , 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/');

  

  define('DB_HOSTNAME' , 'localhost');



  define('DB_USERNAME' , 'root');



  define('DB_PASSWORD' , '');



  define('DB_DATABASE' , 'tsa');

  define('SESS_COOKIE_NAME_ADMIN' , 'verzincc_svca');

  

  define('SITE_URL' , 'http://' . $_SERVER['HTTP_HOST'] . '/');  

  

  define('MAIN_SITE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');

  

  define('ABSOLUTE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');	 



  define('MAIN_SITE_UPLOAD_PATH', MAIN_SITE_PATH . 'assets/upload');

  

  define('MAIN_SITE_AB_UPLOAD_PATH', ABSOLUTE_PATH . 'assets/upload/');



  ini_set('max_execution_time', 90000);

  

  ini_set('memory_limit', '500M');

  

  ini_set('display_errors',"1");

  

  define('MAIN_SITE_URL' , BASE_URL);



  define('SKIP_MAIL' , TRUE);

  define('SAVE_MAIL' , TRUE);

  date_default_timezone_set("Asia/Singapore");

  define('DEFAULT_RECEIVER' , FALSE);