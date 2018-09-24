<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

  class Dashboard extends MY_Controller {


          function __construct() {
                  parent::__construct();
                  $this->load->model('Dashboard_model' , '' , TRUE);
          }


          function admin_home() {
			 
			 	  $data_msg = array();
				  $data_msg['meta_title'] = "Dashboard";	
				  $user_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];	
				  if($user_type=='Super Administrator'){	  
                  	$this->view('dashboard/superadmin_home' , $data_msg);
				  }elseif($user_type=='Administrator'){
					  $this->view('dashboard/admin_home' , $data_msg);
				  }else{
					  $this->view('dashboard/blog_home' , $data_msg);
				  }
          }


  }

  