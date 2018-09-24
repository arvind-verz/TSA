<?php  if(!defined('BASEPATH'))exit('No direct script access allowed');
class Login extends MY_Controller {

  function __construct() {
		  parent::__construct();
		  $this->lang->load('global' , 'spanish');
		  $this->load->model('Login_model' , '' , TRUE);
		  $this->load->library('encrypt');
		  $this->load->model('user_model', '', TRUE);
  }

  public function index() {
		  
		  if($this->is_login()){ redirect(base_url('dashboard'));}
		  $data_msg = array();
		  $data_msg['meta_title'] = 'Admin Login';
		  $data_msg['username'] = '';
		  $get_rem_log = $this->input->cookie(ADMIN_COOKIE,TRUE);

		  if($get_rem_log)
		  {
				  $get_rem_log = explode('~####~' , $get_rem_log);
				  $rem_username = $get_rem_log[0];
				  $rem_password = $this->encrypt->decode($get_rem_log[1]);
				  $initial_array = array('username' => $rem_username ,
										   'password' => $rem_password ,
										   ADMIN_COOKIE => 1 ,
				  );
		  }
		  else
		  {
				  $initial_array = array('username' => '' ,
										   'password' => '' ,
										   ADMIN_COOKIE => '' ,
										   'error_msg' => '' ,
				  );
		  }

		  if($this->session->userdata('error_msg') != "")
		  {
				  foreach ($initial_array as $v => $key)
				  {
						  $data_msg[$v] = $this->session->userdata($v);
				  }
				  $this->session->unset_userdata($initial_array);
		  }
		  if($get_rem_log){
				  foreach ($initial_array as $v => $key){ $data_msg[$v] = $key;}
		  }

		  if($this->input->post('admin_login')){

				  $error_msg = "";
				  $username = trim(strip_tags($this->input->post('username')));
				  $password = trim(strip_tags($this->input->post('password')));
				  $chk_remember = trim(strip_tags($this->input->post(ADMIN_COOKIE)));

				  if($username == ""){ $error_msg = "Please enter email address."; }
				  else if($password == ""){ $error_msg .= "Please enter Password.";}
				  else{
				  		  $get_userinformation = $this->Login_model->matchuser($username , md5($password));
						  $admin_info = $get_userinformation->row_array();
						  if(!isset($admin_info['admin_id'])){ 
								  $error_msg = "Email or Password is not valid.";
						  }else{ 
								  $admin_login_id = $this->all_function->rand_string(8);                                          
								  $admin_id = $admin_info['admin_id'];
								  $admin_name = $admin_info['first_name'].' '.$admin_info['last_name'];
								  $admin_email = $admin_info['email'];
								  $user_type = $admin_info['user_type'];

								  $this->session->set_userdata(
										  array(
												   ADMIN_LOGIN_PREFIX.'admin_id' => $admin_id ,
												   ADMIN_LOGIN_PREFIX.'login_id' => $admin_login_id ,
												   ADMIN_LOGIN_PREFIX.'admin_name' => $admin_name ,
												   ADMIN_LOGIN_PREFIX.'admin_email' => $admin_email,
												   ADMIN_LOGIN_PREFIX.'user_type' => $user_type 
										  )
								  );
								  $db_insert = array(
												   'login_id' => $admin_login_id ,
												   'admin_id' => $admin_id ,
												   'login_time' => date('Y-m-d H:i:s') ,
												   'ip_address' => $this->input->ip_address()
								  );
								  $this->Login_model->admin_login($db_insert);

								  if($chk_remember == '1')
								  {
										  $cookie = array(
																   'name' => ADMIN_COOKIE ,
																   'value' => $username . '~####~' . $this->encrypt->encode($password) ,
																   'expire' => time() + 31536000  // cookie set for 5 years
										  );

										  $this->input->set_cookie($cookie);
								  }
								  else{
									 $cookie = array(
																   'name' => ADMIN_COOKIE ,
																   'value' => '' ,
																   'expire' => time()- 31536000 // cookie set for 5 years
										  );

										  $this->input->set_cookie($cookie);
								  }
								  redirect(base_url('dashboard'));
						  }
				  }

				  if($error_msg != "")
				  {
					  $data_msg['error_msg'] = $error_msg;
					  $this->load->view('login/login' , $data_msg);
				  }
		  }else{
		  	$this->load->view('login/login' , $data_msg);
		  }
  }

  public function login_details() {

		  $this->is_login(TRUE);
		  
		  $admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];

		  //$permission = $this->user_model->get_user_permission($admin_type,'user','login_details');
		  
		  $permission = 'Y';
		
		  if($permission=='Y'){

		  $data_msg = array();

		  $data_msg['meta_title'] = 'Members Login Details';
		  
		  $items_per_page = $this->all_function->get_site_options('admin_listing_per_page');

		  $current_page = (int) $this->input->get('page');
		  
		  $current_page = $current_page > 0 ? $current_page : 1;
		  
		  $data_msg['start_count'] = ($current_page * $items_per_page - $items_per_page + 1);

		  $limit_from = ($current_page - 1) * $items_per_page;

		  $total_items = $this->Login_model->tot_get_admin_login_details();
		  
		  $data_msg['total_items'] = $total_items;

		  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items , $items_per_page , $current_page , 3);

		  $get_value = $this->Login_model->get_login_details($items_per_page , $limit_from);

		  $data_msg['display_result'] = $get_value->result_array();
		  
		  if($this->input->post('frm_display_submit') == '1')
		  {
				  $checkbox_arr = $this->input->post('id');

				  if(count($checkbox_arr) !== 0)
				  {
						  foreach ($checkbox_arr as $del_id)
						  {
								  $this->Login_model->delete_admin_login_details($del_id);
						  }
						  
						  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');	
						  
						  redirect(base_url('login-details'));
						  exit;
				  }else{redirect(base_url('login-details'));}
		  }

		
		  $this->view('login/login_details' , $data_msg);
		  
			  }if($permission=='N'){
		
		 redirect(base_url('access-denied'));
		 exit;
		
		}
  }

  public function logout() {
	  
		  $this->is_login(TRUE);
		  
		  if($this->session->userdata[ADMIN_LOGIN_PREFIX.'login_id']){
			  $login_id = $this->session->userdata[ADMIN_LOGIN_PREFIX.'login_id'];
			  $data = array('logout_time' => date('Y-m-d H:i:s'));
			  $this->Login_model->admin_login_update($data,$login_id);
		  }
		  
		  $this->session->sess_destroy();		  
		  $this->session->set_flashdata('success_msg', 'Your have successfully logout.');		  
		  redirect(base_url());
  } 

  public function forgot_password() {

		  $data_msg = array();		  
		  $data_msg['meta_title'] = 'Forgot Password';
		  
		  if($this->input->post('admin_login')){

				$error_msg = "";
				$email = trim(strip_tags($this->input->post('email')));
				if($email == ""){
					$error_msg = "Please enter your emai address.";
					$this->session->set_flashdata('error_msg', $error_msg);
					redirect(base_url('forgot-password'));
				}
				$get_userinformation = $this->Login_model->matchuser_email($email);
				$admin_info = $get_userinformation->row_array();
				if(!isset($admin_info['admin_id'])){
					  $error_msg = "Your email is not valid.";
					  $this->session->set_flashdata('error_msg', $error_msg);
					  redirect(base_url('forgot-password'));
					  exit;
				}else{
				   function rand_string( $length ) {
						$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
						return substr(str_shuffle($chars),0,$length);										
					}					
					$reset_key = rand_string(8);
					$data = array(
							'reset_key' => $reset_key,
							'reset_status' => 'Y',
							'last_updated_on' => date('Y-m-d H:i:s')
					);
					$this->Login_model->update_user($data, $email);	
					//Email with reset Url.
					$config = Array(
					  'protocol' => $this->all_function->get_site_options('protocol'),
					  'smtp_host' => $this->all_function->get_site_options('smtp_host'),
					  'smtp_port' => $this->all_function->get_site_options('smtp_port'),
					  'smtp_user' => $this->all_function->get_site_options('smtp_user'),
					  'smtp_pass' => $this->all_function->get_site_options('smtp_pass'),
					  'mailtype' => $this->all_function->get_site_options('mailtype'), 
					  'charset'   => $this->all_function->get_site_options('charset')
					);
					
					$store_name = $this->all_function->get_site_options('site_name');
					$domain = $this->all_function->get_site_options('domain_name');
					$from_email_address = $this->all_function->get_site_options('from_email_address');
					$from_email_name = $this->all_function->get_site_options('from_email_name');
					$to_email = $email;
					
					$mail_body = $this->all_function->get_template(1);
				
					$url = '<a href="'.base_url('reset-password/'.$admin_info['admin_id'].'/'.$reset_key).'">click here</a>';
					$name = $admin_info['first_name'].' '.$admin_info['last_name'];
					$body = $mail_body["body"];
					
					$body			  = str_replace("{SITE_URL}", base_url('/'), $body);
					$body			  = str_replace("{SITE_LOGO}", '<img src="'.get_site_image('upload/logo/original').$this->all_function->get_site_options('logo').'" border="0"/>', $body);		
					$body			  = str_replace("{SITE_NAME}", $store_name, $body);	
					$body			  = str_replace("{NAME}", $name, $body);
					$body			  = str_replace("{EMAIL}", $to_email, $body);
					$body			  = str_replace("{DOMAIN}", $domain, $body);
					$body			  = str_replace("{RESET}", $url, $body);
					$body			  = str_replace("{NAME}", $name, $body);
					
								
					$this->load->library('email', $config);
					$this->email->set_newline("\r\n");
					$subject = $mail_body["subject"];
					$subject = str_replace("{NAME}", $name, $subject);
				
					$this->email->to($to_email);
					$this->email->from($from_email_address,$from_email_name);
					$this->email->subject($subject);
					$this->email->message($body);
					$result = $this->email->send();
					$this->session->set_flashdata('success_msg', 'Your can reset your password. The reset url has been Sent to your email address.');	
					redirect(base_url('forgot-password'));
				}
		  }
		  $this->view('login/forgot_password' , $data_msg);
		  
  }
  
  public function reset_password($admin_id=0, $reset_key=0) {

	  if($this->is_login()){ redirect(base_url('dashboard'));}
	  $data_msg = array();		  
	  $data_msg['meta_title'] = 'Reset Your Password';
	  $user = $this->Login_model->matchuser_reset_password($admin_id, $reset_key)->row_array();
	  if(count($user)==0){
		  $this->session->set_flashdata('error_msg', 'Your can reset your password again.');
		  redirect(base_url('forgot-password'));
	  }else{
		$this->load->library('form_validation');		
		$config = array(
				array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required|min_length[5]|matches[confirm_password]'
                  ),
				array(
                     'field'   => 'confirm_password',
                     'label'   => 'Confirm Password',
                     'rules'   => 'trim|required'
                  )
			   
            );
		$this->form_validation->set_rules($config);
		if($_POST){				
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('login/reset_password' , $data_msg);
			}
			else{
				$password = trim(strip_tags($this->input->post('password')));
				$confirm_password = trim(strip_tags($this->input->post('confirm_password')));
				$data = array(
						'reset_key' => '',
						'reset_status' => 'N',
						'password' => md5($password),
						'last_updated_on' => date('Y-m-d H:i:s')
					);
				$this->user_model->update_user($data, $admin_id);
				$config = Array(
					  'protocol' => $this->all_function->get_site_options('protocol'),
					  'smtp_host' => $this->all_function->get_site_options('smtp_host'),
					  'smtp_port' => $this->all_function->get_site_options('smtp_port'),
					  'smtp_user' => $this->all_function->get_site_options('smtp_user'),
					  'smtp_pass' => $this->all_function->get_site_options('smtp_pass'),
					  'mailtype' => $this->all_function->get_site_options('mailtype'), 
					  'charset'   => $this->all_function->get_site_options('charset')
				);
				
				$store_name = $this->all_function->get_site_options('site_name');
				$domain = $this->all_function->get_site_options('domain_name');
				$from_email_address = $this->all_function->get_site_options('from_email_address');
				$from_email_name = $this->all_function->get_site_options('from_email_name');
				$to_email = $user['email'];
				
				$mail_body = $this->all_function->get_template(2);			
				$url = '<a href="'.base_url('/').'">click here</a>';	
				$name = $user['first_name'].' '.$user['last_name'];			
				$body = $mail_body["body"];
				
				$body			  = str_replace("{SITE_URL}", base_url('/'), $body);
				$body			  = str_replace("{SITE_LOGO}", '<img src="'.get_site_image('upload/logo/original').$this->all_function->get_site_options('logo').'" border="0"/>', $body);		
				$body			  = str_replace("{SITE_NAME}", $store_name, $body);	
				$body			  = str_replace("{NAME}", $name, $body);
				$body			  = str_replace("{EMAIL}", $to_email, $body);
				$body			  = str_replace("{DOMAIN}", $domain, $body);
				$body			  = str_replace("{CLICKHERE}", $url, $body);
				$body			  = str_replace("{PASSWORD}", $password, $body);
				
							
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$subject = $mail_body["subject"];
				$subject = str_replace("{NAME}", $name, $subject);
			
				$this->email->to($to_email);
				$this->email->from($from_email_address,$from_email_name);
				$this->email->subject($subject);
				$this->email->message($body);
				$result = $this->email->send();	
				
			    $this->session->set_flashdata('success_msg', 'Your password has been reset.');	
			    redirect(base_url('login'));
			}			
		}else{
	  		$this->view('login/reset_password' , $data_msg);
		}
	  }
	}
}
?>