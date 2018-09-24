<?php if(!defined('BASEPATH'))
          exit('No direct script access allowed');

  class MY_Controller extends CI_Controller {


	  private $data = array();
	  private $controller_name = '';
	  private $method_name = '';
	  public $keeplogin_name = USER_LOGIN_PREFIX;
	  public $page_name = '';
	  public $curr_lang = 'en';
	  public $mdg_member_id = '';
	  public $mdg_user_type = '';
	  public $mdg_member_name = '';
	  public $mdg_member_image = '';
	  public $mdg_member_email = '';
	  public $ip = '';
	  public $items_per_page = 20;
	  public $user_data = array();
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
                  $this->_check_user_login();
				  $this->_remember_me();
          }


          public function is_login($redirect = FALSE) {
			  
				  if($redirect)
                  {
                          if($this->mdg_member_id == '')
                          {
                                  redirect(base_url('login'));
                          }
                  }
                  else
                  {
                          if($this->mdg_member_id != '')
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
                          redirect(base_url('login'));
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
                  $data = array_merge($this->data , $data);
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
		private function _check_user_login() {

                  if($this->session->userdata(USER_LOGIN_PREFIX.'member_id') !== '')
                  {
                          $mdg_member_id = $this->session->userdata(USER_LOGIN_PREFIX.'member_id');
                          $mdg_member_name = $this->session->userdata(USER_LOGIN_PREFIX.'member_name');
                          $mdg_user_type = $this->session->userdata(USER_LOGIN_PREFIX.'user_type');
                          $mdg_member_image = $this->session->userdata(USER_LOGIN_PREFIX.'member_image');
                          $mdg_member_email = $this->session->userdata(USER_LOGIN_PREFIX.'member_email');
                          $this->user_data = $this->_get_user_info($mdg_member_id);
                  }
                  else
                  {
                          $mdg_member_id = '';
                          $mdg_member_name = '';
                          $mdg_user_type = '';
                          $mdg_member_image = '';
                          $mdg_member_email = '';
                          $mdg_admin_pref_lang = '';
                  }


                  $this->mdg_member_id = $this->data['member_id'] = $mdg_member_id;
                  $this->mdg_user_type = $this->data['user_type'] = $mdg_user_type;
                  $this->mdg_member_name = $this->data['member_name'] = $mdg_member_name;
                  $this->mdg_member_image = $this->data['member_image'] = $mdg_member_image;
                  $this->mdg_member_email = $this->data['member_email'] = $mdg_member_email;
          }
		  
		private function _remember_me() {
                  $autolog = $this->encrypt->decode(get_cookie(USER_COOKIE));
                  $get_autolog = explode('_mardegalicia_' , $autolog);

                  $this->data['username'] = isset($get_autolog[0]) ? $get_autolog[0] : '';
                  $this->data['password'] = isset($get_autolog[1]) ? $get_autolog[1] : '';
                  if(isset($_COOKIE[USER_COOKIE]))
                  {
                          $this->data[USER_COOKIE] = 1;
                  }
          }
        private function _get_user_info($member_id) {
                 /* $this->db->select('pm.*,pd.*')
                          ->from(TBL_USER_MASTER . ' as pm')
                          ->join(TBL_USER_DETAILS . ' as pd' , 'pd.member_id = pm.member_id')
                          ->where('pm.member_id' , $member_id)
                          ->where('is_active' , 'A');

                  return $this->db->get()->row_array();*/
          }  




  }