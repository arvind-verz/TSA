<?php if(!defined('BASEPATH'))
          exit('No direct script access allowed');

  class MY_Controller extends CI_Controller {


          private $data = array();
          private $controller_name = '';
          private $method_name = '';
          public $keeplogin_name = ADMIN_LOGIN_PREFIX;
          public $page_name = '';
          public $mdg_admin_id = '';
          public $mdg_user_type = '';
          public $mdg_admin_name = '';
          public $mdg_admin_image = '';
          public $ip = '';
          public $items_per_page = 30;
          public $error_msg = FALSE;
          public $success_msg = FALSE;
          public $mdg_admin_pref_lang = 'es';
          public $site_language = 'english'; // spanish , english
          public $language = array('en' => 'English');
          public $curreny = '&euro;';
          public $language_id = 'en';


          function __construct() {
                  parent::__construct();
                  $this->ip = getenv('REMOTE_ADDR');
                  $this->controller_name = $this->data['controller_name'] = $this->router->class;
                  $this->method_name = $this->data['method_name'] = $this->router->method;

                  $this->_set_message();
                  $this->_check_user_login();
                  $this->lang->load('global' , $this->site_language);
                  if(!in_array($this->controller_name , array('login')))
                  {
                          $this->is_login(TRUE);
                          if($this->mdg_admin_pref_lang == 'en')
                          {
                                  $this->lang->load('global' , 'english');
                          }
                          else
                          {
                                  $this->lang->load('global' , 'spanish');
                          }
                  }
          }


          public function is_login($redirect = FALSE) {
			  
				  if($redirect)
                  {
                          if($this->mdg_admin_id == '')
                          {
                                  redirect(base_url());
                          }
                  }
                  else
                  {
                          if($this->mdg_admin_id != '')
                          {
                                  return true;
                          }
                          else
                          {
                                  return false;
                          }
                  }
                  return;
          }


          public function not_login($redirect = FALSE) {
                  if($redirect && $this->is_login())
                  {
                          redirect(base_url());
                  }
                  else if($this->is_login())
                  {
                          return FALSE;
                  }
                  else
                  {
                          return TRUE;
                  }
                  return;
          }


          public function view($template , $data = array() , $return = FALSE) {
                  //$this->globalLabelVariables();
                  $this->data['currency'] = $this->curreny;
                  $data = array_merge($this->data , $data);
                  //$data['meta_title'] = lang('control_panel');
                  //Console::log("view :: " . $template . '.php');
                  if(!$return)
                  {
                          $this->load->view($template , $data , FALSE);
                  }
                  else
                  {
                          return $this->load->view($template , $data , TRUE);
                  }
                  return;
          }

		private function _remember_me() {
                  $autolog = $this->encrypt->decode(get_cookie(ADMIN_COOKIE));
                  $get_autolog = explode('_mardegalicia_' , $autolog);

                  $this->data['username'] = isset($get_autolog[0]) ? $get_autolog[0] : '';
                  $this->data['password'] = isset($get_autolog[1]) ? $get_autolog[1] : '';
                  if(isset($_COOKIE[ADMIN_COOKIE]))
                  {
                          $this->data[ADMIN_COOKIE] = 1;
                  }
          }
          private function _check_user_login() {

                  if($this->session->userdata(ADMIN_LOGIN_PREFIX.'admin_id') !== '0')
                  {
                          $mdg_admin_id = $this->session->userdata(ADMIN_LOGIN_PREFIX.'admin_id');
                          $mdg_admin_name = $this->session->userdata(ADMIN_LOGIN_PREFIX.'admin_name');
                          //$mdg_user_type = $this->session->userdata(ADMIN_LOGIN_PREFIX.'user_type');
                          $mdg_admin_image = $this->session->userdata(ADMIN_LOGIN_PREFIX.'admin_image');
                          $mdg_admin_email = $this->session->userdata(ADMIN_LOGIN_PREFIX.'admin_email');
                          $mdg_admin_pref_lang = $this->session->userdata(ADMIN_LOGIN_PREFIX.'admin_pref_lang');
                          //   $this->site_language = $mdg_admin_pref_lang;
                  }
                  else
                  {
                          $mdg_admin_id = '0';
                          $mdg_admin_name = '';
                          //$mdg_user_type = $this->session->userdata(ADMIN_LOGIN_PREFIX.'user_type');
                          $mdg_admin_image = '';
                          $mdg_admin_email = '';
                          $mdg_admin_pref_lang = '';
                  }


                  $this->mdg_admin_id = $this->data['admin_id'] = $mdg_admin_id;
                  //$this->user_type = $this->data[ADMIN_LOGIN_PREFIX.'user_type'] = $mdg_user_type;
                  $this->mdg_admin_pref_lang = $mdg_admin_pref_lang;
                  $this->mdg_admin_name = $this->data['admin_name'] = $mdg_admin_name;
                  $this->mdg_admin_image = $this->data['admin_image'] = $mdg_admin_image;
                  $this->data['admin_email'] = $mdg_admin_email;
          }


          //for checking error/success mesage if set then set in $this->data for use in view page
          private function _set_message() {

                  if($this->session->userdata('success_msg') != "")
                  {

                          $this->data['success_msg'] = $this->session->userdata('success_msg');
                          $this->session->unset_userdata('success_msg');
                          $this->success_msg = TRUE;
                  }
          }


          public function globalLabelVariables() {
                  $page = array('global');
                  if($this->page_name != '')
                  {
                          array_push($page , $this->page_name);
                  }
                  $query = $this->db->select('label_id, page_name, content')
                          ->from(TBL_LABEL_PAGE)
                          ->where_in('page_name' , $page)
                          ->where('language_id' , 'es');
                  $res = $query->get()->result_array();

                  // assign all data to its variable name
                  foreach ($res as $value)
                  {
                          $this->data['label_' . $value['label_id']] = $value['content'];
                  }
          }


  }