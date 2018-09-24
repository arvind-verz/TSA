<?php  if(!defined('BASEPATH'))exit('No direct script access allowed');

class Login extends MY_Controller {



  function __construct() {

	  parent::__construct();

	  $this->load->model('Login_model' , '' , TRUE);

	  $this->load->model('Cms_model' , '' , TRUE);

	  $this->load->library('encrypt');

  }



  public function index() {

		  

		 if($this->is_login()){ redirect(base_url('dashboard'));}

		  $data_msg = array();

		  if($this->session->flashdata('error_status')){

				$data_msg['error_status'] = $this->session->flashdata('error_status');

			}else{

				$data_msg['error_status'] = 0;

			}

			

		  $data_msg['meta_title'] = 'Login';

		  $data_msg['url'] = 'login';	

		  $data_msg['menu_id'] = 0;

		  

                $this->load->library('form_validation');



				$configForm = array(

              

				array(

                     'field'   => 'username',

                     'label'   => 'Member Id',

                     'rules'   => 'trim|required'

                  )

				  

				

				

            );



		$this->form_validation->set_rules($configForm);

		 if($_POST){

			 $mode=$this->input->post('mode'); 

			 $formid=$this->input->post('formid'); 

			  if ($this->form_validation->run() == FALSE)

			  {

				

				 $error_msg = validation_errors();

				if(isset($mode) &&  $mode=='listing')

				{

					$this->session->set_flashdata('error_msg3',$error_msg);

					$this->session->set_flashdata('error_status', 3);

					redirect(base_url('svca-events'));

				}else{

				

					$this->session->set_flashdata('error_msg2',$error_msg);

					$this->session->set_flashdata('error_status', 2);

				 	$this->session->set_flashdata('username', $this->input->post('username'));

					redirect(base_url('home'));

				}

				 

			  }else{

				 

				  $username = trim(strip_tags($this->input->post('username')));

				 

				  $this->session->set_flashdata('username', $this->input->post('username'));

				  

				   $get_userinformation = $this->Login_model->matchuser($username);

				   $admin_info = $get_userinformation->row_array();

				   //echo $this->db->last_query();

				   //print_r($admin_info);exit;

				   if(!isset($admin_info['member_id'])){ 

								  $error_msg = "<p>Invalid Member Id.</p>";

								  if(isset($mode) &&  $mode=='listing')

								  {

									  $this->session->set_flashdata('formid', $formid);	

									  $this->session->set_flashdata('error_msg3',$error_msg);

								  	  $this->session->set_flashdata('error_status', 3);

								 	  redirect(base_url('svca-events'));

								  }elseif(isset($mode) &&  $mode=='listing2'){

								   	  $this->session->set_flashdata('formid', $formid);	

								      $this->session->set_flashdata('error_msg4',$error_msg);

								  	  $this->session->set_flashdata('error_status', 4);

								 	  redirect(base_url('svca-events'));

								   

								   }elseif(isset($mode) &&  $mode=='detail'){

									   $seo_url=$this->input->post('seo_url');

									   

									   $this->session->set_flashdata('error_msg5',$error_msg);

								  	   $this->session->set_flashdata('error_status', 5);

								 	   redirect(base_url('event-details/'.$seo_url));

									   

									   

									}

								   

								   else{

								  	$this->session->set_flashdata('error_msg2',$error_msg);

								  	$this->session->set_flashdata('error_status', 2);

								 	redirect(base_url('home'));

								  }

									

				   }else{

				       

					              $member_id = $admin_info['member_id'];								  

								  $this->session->set_userdata(

										  array(

												   USER_LOGIN_PREFIX.'member_id' => $member_id ,

												   USER_LOGIN_PREFIX.'user_name' => $admin_info['user_name'],

												   USER_LOGIN_PREFIX.'company_name' => $admin_info['company_name'],

												   USER_LOGIN_PREFIX.'company_type' => $admin_info['company_type'],

												   USER_LOGIN_PREFIX.'company_email' => $admin_info['company_email'],

												   USER_LOGIN_PREFIX.'member_type_id' => $admin_info['member_type_id']

												   

												  

										  )

								  );

								  if(isset($mode) &&  ($mode=='listing' || $mode=='listing2' || $mode=='detail'))

								  {

									 $event = $this->Login_model->get_event_details($formid);

									 if(count($event)>0){

									 	redirect(base_url('register/'.$event['seo_url']));

									 }

									 

								  }else{

									  redirect(base_url('svca-events'));

								  }

					   

				    } 

				   

			  }

			 



				  

		  }

  }



  public function logout() {

	  	

		  $this->is_login(TRUE);		  

		  

		  

			$this->session->unset_userdata(USER_LOGIN_PREFIX.'member_id');

			$this->session->unset_userdata(USER_LOGIN_PREFIX.'user_name');

			$this->session->unset_userdata(USER_LOGIN_PREFIX.'company_name');

			$this->session->unset_userdata(USER_LOGIN_PREFIX.'company_type');

			$this->session->unset_userdata(USER_LOGIN_PREFIX.'company_email');

			$this->session->unset_userdata(USER_LOGIN_PREFIX.'member_type_id');

			$this->session->sess_destroy();

			//redirect('home','refresh');   

		  redirect(base_url());

  } 



  public function dashboard() { 

		

		$this->is_login(TRUE);

		//$member_id = $this->session->userdata[USER_LOGIN_PREFIX.'member_id'];		

		$data_msg = array();

		if($this->session->flashdata('error_status')){

			$data_msg['error_status'] = $this->session->flashdata('error_status');

		}else{

			$data_msg['error_status'] = 0;

		}

		

		$page[0]['seo_title'] = "Dashboard | ".$this->all_function->get_site_options('site_name');

		$page[0]['seo_keyword'] = "Dashboard | ".$this->all_function->get_site_options('site_name');

		$page[0]['seo_description'] = "Dashboard | ".$this->all_function->get_site_options('site_name');

		

	    $data_msg['page'] =$page;					

		$data_msg['url'] = 'dashboard';

		$data_msg['url_name'] = 'dashboard';

		$data_msg['menu_id'] = 0;			

		$this->view('dashboard',$data_msg);    

    }

	

}?>