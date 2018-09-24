<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Resgister extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE); 
		$this->load->model('Events_model', '', TRUE);
		$this->load->model('Resgister_model', '', TRUE);
		$this->load->library('form_validation');  
    }
	
	function resgister_details($seo_url)
	{
		$page = $this->Events_model->get_event_details($seo_url);
		if(count($page)>0){
		}else{
			redirect(base_url("page-not-found"));
		}
		if($this->session->flashdata('error_status')){
			$data_msg['error_status'] = $this->session->flashdata('error_status');
		}else{
			$data_msg['error_status'] = 0;
		}
		if($this->is_login()){
			$this->register_form_member($seo_url);
		}else{
			if(isset($this->session->userdata[USER_LOGIN_PREFIX.'promo_code']) && $this->session->userdata[USER_LOGIN_PREFIX.'promo_code']==$page[0]['promo_code']){ 
				$this->session->set_userdata(array( USER_LOGIN_PREFIX.'member_type_id' => 4 ) );
			}else{
				$this->session->set_userdata(array( USER_LOGIN_PREFIX.'member_type_id' => 5 ) );
			}
			$this->register_form($seo_url);
		}		
	}
	
	function seat_limit_checking_from($id,$member_type_id){
		$limit_checking = $this->Resgister_model->get_events_reg_limit_checking($member_type_id,$id);
		$reg_this_member_type = $this->Resgister_model->count_reg_this_member_type($member_type_id,$id);
		if($limit_checking > $reg_this_member_type){
			$status = 'Y';
		}else{
			$status = 'N';
		}
		return $status;
	}
	
	function max_no_reg_per_company($id,$member_type_id,$member_id){
		if($member_type_id==4 || $member_type_id==5){
			$status = 'Y';
		}else{
			$reg_per_company = $this->Resgister_model->get_reg_per_company($member_type_id,$id);
			$reg_this_company = $this->Resgister_model->count_reg_this_company($member_type_id,$id,$member_id);
			if($reg_per_company > $reg_this_company){
				$status = 'Y';
			}else{
				$status = 'N';
			}	
		}
		return $status;
	}
	
	function set_event_price($id,$member_type_id){
		$price = 0.00;
		$istevent_reg = $this->Resgister_model->count_register($member_type_id,$id);
		if($istevent_reg==0){
			$price = $this->Resgister_model->get_event_price1($id,$member_type_id);
		}else{
			$price = $this->Resgister_model->get_event_price2($id,$member_type_id);
		}	
		return $price;	
	}
	
	function checking_payment_type($id,$member_type_id){
		return $payment_type = $this->Resgister_model->get_events_reg_payment_type($member_type_id,$id);
	}	
	
	public function ajax_promo_code($event_id) {
		if(isset($_POST['promo_code'])){
			$promo_code = $_POST['promo_code'];
			$code = $this->Resgister_model->get_event_promo_code_details($event_id);
			if($code == $promo_code){
				$member_type_id = 4;				
				$this->session->set_userdata(array( USER_LOGIN_PREFIX.'member_type_id' => $member_type_id ) );
				$this->session->set_userdata(array( USER_LOGIN_PREFIX.'promo_code' => $promo_code ) );
				$this->session->set_userdata(array( USER_LOGIN_PREFIX.'event_id' => $event_id ) );
				$price = $this->set_event_price($event_id,$member_type_id);
				$data = array('promo_code'=>$promo_code,'price'=>number_format($price,2),'notification'=>'<span class="send">Promo code successfully applied.</span>');
			}else{
				$member_type_id = 5;
				$this->session->set_userdata(array( USER_LOGIN_PREFIX.'member_type_id' => $member_type_id ) );
				$this->session->set_userdata(array( USER_LOGIN_PREFIX.'promo_code' => '' ) );
				$this->session->set_userdata(array( USER_LOGIN_PREFIX.'event_id' => $event_id ) );
				$price = $this->set_event_price($event_id,$member_type_id);
				$data = array('promo_code'=>'','price'=>number_format($price,2),'notification'=>'<span class="error">Invalid promo code.</span>');
			}
		}else{
			$member_type_id = 5;
			$this->session->set_userdata(array( USER_LOGIN_PREFIX.'member_type_id' => $member_type_id ) );
			$this->session->set_userdata(array( USER_LOGIN_PREFIX.'promo_code' => '' ) );
				$this->session->set_userdata(array( USER_LOGIN_PREFIX.'event_id' => $event_id ) );
			$price = $this->set_event_price($event_id,$member_type_id);
			$data = array('promo_code'=>'','price'=>number_format($price,2),'notification'=>'<span class="error">Please enter your coupon code.</span>');
				
		}	
		echo json_encode($data);	
		exit;
    }
	
	function register_form_member($seo_url){
		$data_msg = array();
		$data_msg['menu_id'] = 0;
		$data_msg['url_name'] = 'svca-events';
		$data_msg['url'] = 'svca-events';
		if($this->session->flashdata('error_status')){
			$data_msg['error_status'] = $this->session->flashdata('error_status');
		}else{
			$data_msg['error_status'] = 0;
		}		
		$data_msg['reset'] = FALSE;
		$page = $this->Events_model->get_event_details($seo_url);
		$data_msg['page'] = $page;
		$event_id = $id = $page[0]['id'];
		$member_id = $this->session->userdata[USER_LOGIN_PREFIX.'member_id'];
		$user_name = $this->session->userdata[USER_LOGIN_PREFIX.'user_name'];
		$company_name = $this->session->userdata[USER_LOGIN_PREFIX.'company_name'];
		$company_type = $this->session->userdata[USER_LOGIN_PREFIX.'company_type'];
		$company_email = $this->session->userdata[USER_LOGIN_PREFIX.'company_email'];
		$member_type_id = $this->session->userdata[USER_LOGIN_PREFIX.'member_type_id'];
		
		$data_msg['seat_limit_status'] = $seat_limit_status = $this->seat_limit_checking_from($id,$member_type_id);
		$data_msg['company_limit_status'] = $company_limit_status = $this->max_no_reg_per_company($id,$member_type_id,$member_id);
		$data_msg['price'] = $price = $this->set_event_price($id,$member_type_id);
		$data_msg['paypal'] = $paypal = $this->checking_payment_type($id,$member_type_id);
		$today = date('Y-m-d');
		if($page[0]['registration_date']<$today){
			$error_msg = '<p>Sorry, Registration date has been over.</p>';
			$this->session->set_flashdata('error_status', 1);
			$this->session->set_userdata(array('msg_type' =>0,'error_msg' => $error_msg));
			redirect(base_url("event-details/".$seo_url));
		}elseif($seat_limit_status=='N'){
			$error_msg = '<p>Sorry seats are full!</p>';
			$this->session->set_flashdata('error_status', 1);
			$this->session->set_userdata(array('msg_type' =>0,'error_msg' => $error_msg));
			redirect(base_url("event-details/".$seo_url));
		}elseif($company_limit_status=='N'){
			$error_msg = '<p>Sorry seats are full!</p>';
			$this->session->set_flashdata('error_status', 1);
			$this->session->set_userdata(array('msg_type' =>0,'error_msg' => $error_msg));
			redirect(base_url("event-details/".$seo_url));
		}
		$configFormAll = array();
		$configForm2 = array();
		$configForm = array(
                 array(
                     'field'   => 'first_name',
                     'label'   => 'First Name',
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'last_name',
                     'label'   => 'Last Name',
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'designation',
                     'label'   => 'Designation',
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|valid_email'
                  ),
				  array(
                     'field'   => 'phone_no',
                     'label'   => 'Contact Number',
                     'rules'   => 'trim|required'
                  ),  
			   array(
                     'field'   => 'billing_address',
                     'label'   => 'Billing Address',
                     'rules'   => 'trim|required'
                  ),  
			   array(
                     'field'   => 'price',
                     'label'   => 'Price',
                     'rules'   => 'trim|required'
                  )
            );
		$payment_type = trim(strip_tags($this->input->post('payment_type')));
		if($payment_type=='Offline' && $price>0){
			$configForm2 = array(
				array(
                     'field'   => 'offline_payment',
                     'label'   => 'Offline Payment Comment',
                     'rules'   => 'trim|required'
                  )
            );
			$configFormAll = array_merge($configForm,$configForm2);
		}else{
			$configFormAll = array_merge($configForm,$configForm2);
		}
		$this->form_validation->set_rules($configFormAll); 
		if($_POST){
			if ($this->form_validation->run() == FALSE)
			{
				$error_msg = validation_errors();
				$data_msg['error_msg'] = $error_msg;
				$data_msg['reset'] = FALSE;
        		$this->view('register_form_member',$data_msg);
			}else{
				$first_name = trim(strip_tags($this->input->post('first_name')));
				$last_name = trim(strip_tags($this->input->post('last_name')));
				$email = trim(strip_tags($this->input->post('email')));
				$designation = trim(strip_tags($this->input->post('designation')));
				$phone_no = trim(strip_tags($this->input->post('phone_no')));
				$billing_address = trim(strip_tags($this->input->post('billing_address')));
				$comments = trim(strip_tags($this->input->post('comments')));
				$ShowPrice = trim(strip_tags($this->input->post('price')));
				if($payment_type=='Offline'){
					$offline_payment = trim(strip_tags($this->input->post('offline_payment')));
					$is_paid = 'Pending';
					$status = 'N';
					$booking_status = 'N';
				}else{
					$offline_payment = '';
					$is_paid = 'Pending';
					$status = 'N';
					$booking_status = 'N';
				}
				$seat_limit_status = $this->seat_limit_checking_from($id,$member_type_id);
				$company_limit_status = $this->max_no_reg_per_company($id,$member_type_id,$member_id);
				$price = $this->set_event_price($id,$member_type_id);
				
				if($seat_limit_status=='N'){
					// Error MSG
					$this->session->set_flashdata('err_msg','Sorry seats are full!');
					redirect(base_url("event-details/".$seo_url));
				}elseif($company_limit_status=='N'){
					// Error MSG
					$this->session->set_flashdata('err_msg','Sorry seats are full!');
					redirect(base_url("event-details/".$seo_url));
				}
				if($price!=$ShowPrice){
					$data_msg['error_msg'] = '<p>Event registration price is not matching.</p>';
					$this->view('register_form_member',$data_msg);
				}else{
					$data_msg['reset'] = TRUE;//Clear the form validation field data
					if($price==0){
						$is_paid = 'Paid';
						$status = 'N';
						$booking_status = 'N';
					}
					$data = array(
						'event_id' =>$event_id,
						'member_id' =>$member_id,
						'member_type_id' =>$member_type_id,						
						'first_name' =>$first_name,
						'last_name' =>$last_name,
						'user_name' =>$user_name,
						'company_name' =>$company_name,
						'company_type' =>$company_type,
						'company_email' =>$company_email,									
						'email' =>$email,
						'designation' =>$designation,
						'phone_no' => $phone_no,
						'billing_address' => $billing_address,
						'comments' => $comments,
						'price' => $price,
						'payment_type' => $payment_type,
						'offline_payment' => $offline_payment,
						'is_paid' => $is_paid,
						'status' => $status,
						'exp_time' => (time()+30*60),
						'booking_status' => $booking_status,
						'modified_date' => date('Y-m-d H:i:s'),
						'create_date' => date('Y-m-d H:i:s')
					);
					$event_reg_id = $this->Resgister_model->add_event_resgistration($data);					
					$this->invoice_create($event_reg_id);
					if($price==0 || $payment_type=='Offline'){
						$this->resgistration_email_member($event_reg_id);
					}					
					if($price>0 && $payment_type=='Paypal'){
						$data['event_reg_id']=$event_reg_id;
						$this->load->view('paypal_view',$data);
						
					}else{
						redirect(base_url("thank-you"));	
					}
				}
			}
		}else{
			$this->view('register_form_member',$data_msg);
		}
	}
	function register_form($seo_url){
		$data_msg = array();
		$data_msg['menu_id'] = 0;
		$data_msg['url_name'] = 'svca-events';
		$data_msg['url'] = 'svca-events';
		$data_msg['reset'] = FALSE;
		if($this->session->flashdata('error_status')){
			$data_msg['error_status'] = $this->session->flashdata('error_status');
		}else{
			$data_msg['error_status'] = 0;
		}
		$page = $this->Events_model->get_event_details($seo_url);
		$data_msg['page'] = $page;
		$event_id = $id = $page[0]['id'];		
		$member_type_id = $this->session->userdata[USER_LOGIN_PREFIX.'member_type_id'];
		
		//$data_msg['seat_limit_status'] = $seat_limit_status = $this->seat_limit_checking_from($id,$member_type_id);
		$seat_limit_status4 = $this->seat_limit_checking_from($id,4);
		$seat_limit_status5 = $this->seat_limit_checking_from($id,5);
		if($seat_limit_status4=='N' && $seat_limit_status5=='N'){
		$data_msg['seat_limit_status'] = $seat_limit_status = 'N';
		}else{
		$data_msg['seat_limit_status'] = $seat_limit_status = 'Y';
		}
		
		
		$data_msg['price'] = $price = $this->set_event_price($id,$member_type_id);
		$data_msg['paypal'] = $paypal = $this->checking_payment_type($id,$member_type_id);
		$today = date('Y-m-d');
		if($page[0]['registration_date']<$today){
			$error_msg = '<p>Sorry, Registration date has been over.</p>';
			$this->session->set_flashdata('error_status', 1);
			$this->session->set_userdata(array('msg_type' =>0,'error_msg' => $error_msg));
			redirect(base_url("event-details/".$seo_url));
		}elseif($seat_limit_status=='N'){
			$error_msg = '<p>Sorry seats are full!</p>';
			$this->session->set_flashdata('error_status', 1);
			$this->session->set_userdata(array('msg_type' =>0,'error_msg' => $error_msg));
			redirect(base_url("event-details/".$seo_url));
		}
		$configFormAll = array();
		$configForm2 = array();
		$configForm = array(
                 array(
                     'field'   => 'first_name',
                     'label'   => 'First Name',
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'last_name',
                     'label'   => 'Last Name',
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'company_name',
                     'label'   => 'Company Name',
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'designation',
                     'label'   => 'Designation',
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|valid_email|required|callback_edit_unique['.TBL_EVENT_REGISTRATION.'.email.'.$event_id.']'
                  ),
				  array(
                     'field'   => 'phone_no',
                     'label'   => 'Contact Number',
                     'rules'   => 'trim|required'
                  ),  
			   array(
                     'field'   => 'billing_address',
                     'label'   => 'Billing Address',
                     'rules'   => 'trim|required'
                  ),  
			   array(
                     'field'   => 'price',
                     'label'   => 'Price',
                     'rules'   => 'trim|required'
                  )
            );
		$payment_type = trim(strip_tags($this->input->post('payment_type')));
		if($payment_type=='Offline' && $price>0){
			$configForm2 = array(
				array(
                     'field'   => 'offline_payment',
                     'label'   => 'Offline Payment Comment',
                     'rules'   => 'trim|required'
                  )
            );
			$configFormAll = array_merge($configForm,$configForm2);
		}else{
			$configFormAll = array_merge($configForm,$configForm2);
		}
		$this->form_validation->set_rules($configFormAll); 
		if($_POST){
			if ($this->form_validation->run() == FALSE)
			{
				$error_msg = validation_errors();
				$data_msg['error_msg'] = $error_msg;
				$data_msg['reset'] = FALSE;
        		$this->view('register_form',$data_msg);
			}else{
				$first_name = trim(strip_tags($this->input->post('first_name')));
				$last_name = trim(strip_tags($this->input->post('last_name')));
				$company_name = trim(strip_tags($this->input->post('company_name')));
				$email = trim(strip_tags($this->input->post('email')));
				$designation = trim(strip_tags($this->input->post('designation')));
				$phone_no = trim(strip_tags($this->input->post('phone_no')));
				$billing_address = trim(strip_tags($this->input->post('billing_address')));
				$comments = trim(strip_tags($this->input->post('comments')));
				$ShowPrice = trim(strip_tags($this->input->post('price')));
				if($payment_type=='Offline'){
					$offline_payment = trim(strip_tags($this->input->post('offline_payment')));
					$is_paid = 'Pending';
					$status = 'N';
					$booking_status = 'N';
				}else{
					$offline_payment = '';
					$is_paid = 'Pending';
					$status = 'N';
					$booking_status = 'N';
				}
				$seat_limit_status = $this->seat_limit_checking_from($id,$member_type_id);
				$price = $this->set_event_price($id,$member_type_id);
				
				if($seat_limit_status=='N'){
					$error_msg = '<p>Sorry seats are full!</p>';
					$this->session->set_flashdata('error_status', 1);
					$this->session->set_userdata(array('msg_type' =>0,'error_msg' => $error_msg));
					redirect(base_url("event-details/".$seo_url));
				}
				if($price!=$ShowPrice){
					$error_msg = '<p>Event registration price is not matching.</p>';
					$this->session->set_flashdata('error_status', 1);
					$this->session->set_userdata(array('msg_type' =>0,'error_msg' => $error_msg));
					$this->view('register_form',$data_msg);
				}else{
					$data_msg['reset'] = TRUE;//Clear the form validation field data
					if($price==0){
						$is_paid = 'Paid';
						$status = 'N';
						$booking_status = 'N';
					}
					$data = array(
						'event_id' =>$event_id,
						'member_id' =>'',
						'member_type_id' =>$member_type_id,						
						'first_name' =>$first_name,
						'last_name' =>$last_name,
						'user_name' =>'',
						'company_name' =>$company_name,
						'company_type' =>'',
						'company_email' =>$email,									
						'email' =>$email,
						'designation' =>$designation,
						'phone_no' => $phone_no,
						'promo_code' =>isset($this->session->userdata[USER_LOGIN_PREFIX.'promo_code'])?$this->session->userdata[USER_LOGIN_PREFIX.'promo_code']:'',
						'billing_address' => $billing_address,
						'comments' => $comments,
						'price' => $price,
						'payment_type' => $payment_type,
						'offline_payment' => $offline_payment,
						'is_paid' => $is_paid,
						'status' => $status,
						'exp_time' => (time()+30*60),
						'booking_status' => $booking_status,
						'modified_date' => date('Y-m-d H:i:s'),
						'create_date' => date('Y-m-d H:i:s')
					);
					$event_reg_id = $this->Resgister_model->add_event_resgistration($data);					
					$this->invoice_create($event_reg_id);
					if($price==0 || $payment_type=='Offline'){
						$this->resgistration_email($event_reg_id);
					}
					if($price>0 && $payment_type=='Paypal'){
						$data['event_reg_id']=$event_reg_id;
						$this->load->view('paypal_view',$data);
					}else{
						redirect(base_url("thank-you"));
					}
				}
			}
		}else{
			$this->view('register_form',$data_msg);
		}
	}
	
	function resgistration_email($event_reg_id){
		
		$details=$this->Resgister_model->get_event_registration_detail($event_reg_id);
		$full_name=$details['first_name'].' '.$details['last_name']; 
		
		$store_name = $this->all_function->get_site_options('site_name');						
		$to = $this->all_function->get_site_options('to_email_address');
		$domain = $this->all_function->get_site_options('domain_name');		
		$auto_from = $this->all_function->get_site_options('from_email_address');
		$auto_from_name = $this->all_function->get_site_options('from_email_name');	
		
		$contact_form = $this->all_function->get_template(7);
		$auto_mail = $this->all_function->get_template(8);
		
		$body_auto = $auto_mail["body"];
		$body = $contact_form["body"];
		
		$body			  = str_replace("{SITE_URL}", base_url('/'), $body);
		$body			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body);		
		$body			  = str_replace("{SITE_NAME}", $store_name, $body);
		$body			  = str_replace("{FIRST_NAME}", $details['first_name'], $body);	
		$body			  = str_replace("{LAST_NAME}", $details['last_name'], $body);
		$body			  = str_replace("{COMPANY_NAME}", $details['company_name'], $body);
		$body			  = str_replace("{DESIGNATION}", $details['designation'], $body);
		$body			  = str_replace("{EMAIL}", $details['email'], $body);
		$body			  = str_replace("{CONTACT_NUMBER}", $details['phone_no'], $body);
		$body			  = str_replace("{PROMO_CODE}", $details['promo_code'], $body);
		$body			  = str_replace("{BILLING_ADDRESS}", $details['billing_address'], $body);
		$body			  = str_replace("{ADDITIONAL_COMMENTS}", $details['comments'], $body);
		$body			  = str_replace("{PRICE}", $details['price'], $body);
		$body			  = str_replace("{PAYMENT_TYPE}", $details['payment_type'], $body);
		$body			  = str_replace("{OFFLINE_PAYMENT_COMMENT}", $details['offline_payment'], $body);
		$body			  = str_replace("{DOMAIN}", $domain, $body);
		
		$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
		$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body_auto);		
		$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
		$body_auto			  = str_replace("{FIRST_NAME}", $details['first_name'], $body_auto);	
		$body_auto			  = str_replace("{LAST_NAME}", $details['last_name'], $body_auto);
		$body_auto			  = str_replace("{COMPANY_NAME}", $details['company_name'], $body_auto);
		$body_auto			  = str_replace("{DESIGNATION}", $details['designation'], $body_auto);
		$body_auto			  = str_replace("{EMAIL}", $details['email'], $body_auto);
		$body_auto			  = str_replace("{CONTACT_NUMBER}", $details['phone_no'], $body_auto);
		$body_auto			  = str_replace("{PROMO_CODE}", $details['promo_code'], $body_auto);
		$body_auto			  = str_replace("{BILLING_ADDRESS}", $details['billing_address'], $body_auto);
		$body_auto			  = str_replace("{ADDITIONAL_COMMENTS}", $details['comments'], $body_auto);
		$body_auto			  = str_replace("{PRICE}", $details['price'], $body_auto);
		$body_auto			  = str_replace("{PAYMENT_TYPE}", $details['payment_type'], $body_auto);
		$body_auto			  = str_replace("{OFFLINE_PAYMENT_COMMENT}", $details['offline_payment'], $body_auto);
		$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);	
		
		//echo $body.$body_auto; die();
		$subject = $contact_form["subject"];
		$subject = str_replace("{NAME}", $full_name, $subject);
		$auto_subject = $auto_mail["subject"];
		$auto_subject = str_replace("{NAME}", $full_name, $auto_subject);
		
		$bcc = $this->all_function->get_site_options('contact_email');
		$fullPathInvoice = MAIN_SITE_PATH.'/'.$details['invoice'];	
		
		$this->all_function->batch_email_attach($to, $details['email'], $full_name, $bcc, $subject, $body,$fullPathInvoice);
		$this->all_function->batch_email_attach($details['company_name'], $auto_from, $auto_from_name,$details['email'], $auto_subject, $body_auto,$fullPathInvoice);
	}
	
	
	public function resgistration_email_member($event_reg_id)
	{
			$details=$this->Resgister_model->get_event_registration_detail($event_reg_id);
			$full_name=$details['first_name'].' '.$details['last_name'];
			$event_details = $this->Events_model->get_event_details_by_id($details['event_id']);
			
			$store_name = $this->all_function->get_site_options('site_name');						
		    $to = $this->all_function->get_site_options('to_email_address');
		    $domain = $this->all_function->get_site_options('domain_name');		
		    $auto_from = $this->all_function->get_site_options('from_email_address');
		    $auto_from_name = $this->all_function->get_site_options('from_email_name');	
		
		    $contact_form = $this->all_function->get_template(9);
		    $auto_mail    = $this->all_function->get_template(10);
		
		    $body_auto = $auto_mail["body"];
		    $body = $contact_form["body"];
			
			
			$body			  = str_replace("{SITE_URL}", base_url('/'), $body);
			$body			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body);		
			$body			  = str_replace("{SITE_NAME}", $store_name, $body);
			$body			  = str_replace("{MEMBER_ID}", $details['user_name'], $body);	
			$body			  = str_replace("{COMPANY_NAME}", $details['company_name'], $body);
			$body			  = str_replace("{COMPANY_TYPE}", $details['company_type'], $body);
			$body			  = str_replace("{COMPANY_EMAIL}", $details['company_email'], $body);
			$body			  = str_replace("{FIRST_NAME}", $details['first_name'], $body);
			$body			  = str_replace("{LAST_NAME}", $details['last_name'], $body);
			$body			  = str_replace("{DESIGNATION}", $details['designation'], $body);
			$body			  = str_replace("{EMAIL}", $details['email'], $body);
			$body			  = str_replace("{CONTACT_NUMBER}", $details['phone_no'], $body);
			$body			  = str_replace("{BILLING_ADDRESS}", $details['billing_address'], $body);
			$body			  = str_replace("{ADDITIONAL_COMMENTS}", $details['comments'], $body);
			$body			  = str_replace("{PRICE}", $details['price'], $body);
			$body			  = str_replace("{PAYMENT_TYPE}", $details['payment_type'], $body);
			$body			  = str_replace("{OFFLINE_PAYMENT_COMMENT}",$details['offline_payment'], $body);
			$body			  = str_replace("{DOMAIN}", $domain, $body);
		
			$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
			$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body_auto);		
			$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
			$body_auto			  = str_replace("{NAME}", $full_name, $body_auto);
			$body_auto			  = str_replace("{MEMBER_ID}", $details['user_name'], $body_auto);	
			$body_auto			  = str_replace("{COMPANY_NAME}", $details['company_name'], $body_auto);
			$body_auto			  = str_replace("{COMPANY_TYPE}", $details['company_type'], $body_auto);
			$body_auto			  = str_replace("{COMPANY_EMAIL}", $details['company_email'], $body_auto);
			$body_auto			  = str_replace("{FIRST_NAME}", $details['first_name'], $body_auto);	
			$body_auto			  = str_replace("{LAST_NAME}", $details['last_name'], $body_auto);
			$body_auto			  = str_replace("{DESIGNATION}", $details['designation'], $body_auto);
			$body_auto			  = str_replace("{EMAIL}", $details['email'], $body_auto);
			$body_auto			  = str_replace("{CONTACT_NUMBER}", $details['phone_no'],$body_auto);
			$body_auto			  = str_replace("{BILLING_ADDRESS}", $details['billing_address'],$body_auto);
			$body_auto			  = str_replace("{ADDITIONAL_COMMENTS}", $details['comments'], $body_auto);
			$body_auto			  = str_replace("{PRICE}", $details['price'], $body_auto);
			$body_auto			  = str_replace("{PAYMENT_TYPE}", $details['payment_type'], $body_auto);
			$body_auto			  = str_replace("{OFFLINE_PAYMENT_COMMENT}", $details['offline_payment'], $body_auto);
			$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);	
		
			//echo $body.$body_auto; die();
			 
			$subject = $contact_form["subject"];
			$subject = str_replace("{NAME}", $full_name, $subject);
			$auto_subject = $auto_mail["subject"];
			$auto_subject = str_replace("{NAME}", $full_name, $auto_subject);
			
			$bcc = $this->all_function->get_site_options('contact_email');
			$fullPathInvoice = MAIN_SITE_PATH.'/'.$details['invoice'];	
						
			$this->all_function->batch_email_attach($to, $details['email'], $full_name,$bcc , $subject, $body,$fullPathInvoice);					
			$this->all_function->batch_email_attach($details['company_email'], $auto_from, $auto_from_name,$details['email'], $auto_subject, $body_auto,$fullPathInvoice);
		
	}
	
	public function invoice_create($event_reg_id)
	{
			$details=$this->Resgister_model->get_event_registration_detail($event_reg_id);
			$full_name=$details['first_name'].' '.$details['last_name'];
			$event_details = $this->Events_model->get_event_details_by_id($details['event_id']);			
			$store_name = $this->all_function->get_site_options('site_name');
			
			$html='<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body style="margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:9px; color:#393a42;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td align="center" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top"><img src="assets/pdf/logo.png" alt=""></td>
    </tr>
    <tr>
      <td align="center" valign="top" >&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" style="font-size:30px; text-transform:uppercase; font-weight:bold;">TAX INVOICE</td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td align="left" valign="top" width="50%">'.date("d F, Y").'</td>
            <td align="right" valign="top">';
	if($details['user_name']!=''){
		$html .='Member ID: '.$details['user_name'];
	}
	$html .='</td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="right" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top"><strong>Order  Number: '.$event_reg_id.'</strong></td>
            <td align="right" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="right" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top">Dear '.$full_name.',</td>
            <td align="right" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="right" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top">Please find the event details as below:</td>
            <td align="right" valign="top">&nbsp;</td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td align="left" valign="top" style="padding:10px; background:#f5f5f5;  line-height:30px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td width="29%" align="left" valign="top"  >Event Title </td>
                  <td width="2%" align="left" valign="top">:</td>
                  <td width="69%" align="left" valign="top">'.$event_details['title'].'</td>
                </tr>
                <tr>
                  <td align="left" valign="top">Start Date </td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.date("F d, Y", strtotime($event_details['start_date'])).'</td>
                </tr>
                <tr>
                  <td align="left" valign="top">End Date </td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.date("F d, Y", strtotime($event_details['end_date'])).'</td>
                </tr>
                <tr>
                  <td align="left" valign="top">Time </td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.$event_details['event_time'].'</td>
                </tr>
                <tr>
                  <td align="left" valign="top">Venue</td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.$event_details['venue'].'</td>
                </tr>
              </tbody>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top" style="padding:0 10px; font-size:18px;"><strong>Details of Participant</strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
      <tr>
            <td align="left" valign="top" style="padding:10px; background:#f5f5f5;  line-height:30px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td width="29%" align="left" valign="top">First Name </td>
                  <td width="2%" align="left" valign="top">:</td>
                  <td width="69%" align="left" valign="top">'.$details['first_name'].'</td>
                </tr>
                <tr>
                  <td align="left" valign="top">Last Name </td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.$details['last_name'].'</td>
                </tr>
                <tr>
                  <td align="left" valign="top">Company Name </td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.$details['company_name'].'</td>
                </tr>
                <tr>
                  <td align="left" valign="top">Company Type </td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.$details['company_type'].'</td>
                </tr>
                <tr>
                  <td align="left" valign="top">Designation</td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.$details['designation'].'</td>
                </tr>
				<tr>
                  <td align="left" valign="top">Company Email</td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.$details['company_email'].'</td>
                </tr>
				<tr>
                  <td align="left" valign="top">Participent Email</td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.$details['email'].'</td>
                </tr>
				<tr>
                  <td align="left" valign="top">Additional Comments</td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.$details['comments'].'</td>
                </tr>
              </tbody>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
  <tr>
            <td align="left" valign="top" style="padding:0 10px; font-size:18px;"><strong>Payment Details</strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
       <tr>
            <td align="left" valign="top" style="padding:10px; background:#f5f5f5;  line-height:30px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td width="29%" align="left" valign="top">Amount Paid</td>
                  <td width="2%" align="left" valign="top">:</td>
                  <td width="69%" align="left" valign="top">'.$details['price'].'</td>
                </tr>
                <tr>
                  <td align="left" valign="top">Payment Method</td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.$details['payment_type'].'</td>
                </tr>
                <tr>
                  <td align="left" valign="top">Billing Address </td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.$details['billing_address'].'</td>
                </tr>
                <tr>
                  <td align="left" valign="top">Offline Payment Comments </td>
                  <td align="left" valign="top">:</td>
                  <td align="left" valign="top">'.$details['offline_payment'].'</td>
                </tr>
              </tbody>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top">Please note that prior payment is required by '.date("F d, Y", strtotime($event_details['last_payment_date'])).' to secure your seat. <br>
              Thank you for your support.</td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top"><i style="font-size:12px">This is an auto-generated invoice and does not require any signature.</i></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="top" style="border-top:5px solid #ed1b24; padding:5px 0; font-size:8px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td align="left" valign="middle" ><img src="assets/pdf/address.jpg" alt="" style="vertical-align:middle; margin-right:5px;">'.$this->all_function->get_site_options('site_address1').','.$this->all_function->get_site_options('site_address2').','.$this->all_function->get_site_options('site_address3').'</td>
            <td align="left" valign="middle"><img src="assets/pdf/phone.jpg" alt="" style="vertical-align:middle; margin-right:5px;">Tel : '.$this->all_function->get_site_options('cantact_no').'</td>
            <td align="left" valign="middle"><img src="assets/pdf/fax.jpg" alt="" style="vertical-align:middle; margin-right:5px;">Fax : '.$this->all_function->get_site_options('cantact_fax').'</td>
            <td align="left" valign="middle"><img src="assets/pdf/email.jpg" alt="" style="vertical-align:middle; margin-right:5px;">'.$this->all_function->get_site_options('contact_email').'</td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>

</body>
</html>
';
			
			require_once(APPPATH.'third_party/dompdf/dompdf_config.inc.php');
			$dompdf = new DOMPDF();
			$dompdf->load_html($html);
			$dompdf->set_paper('A4', 'portrait');
			$dompdf->render();
			$output = $dompdf->output();
			$file_to_save = "attachment/invoice{$event_reg_id}.pdf";
			file_put_contents($file_to_save, $output);			
			$data = array(
				'invoice' =>$file_to_save
			);
			$this->Resgister_model->update_event_resgistration($data,$event_reg_id);
	}
	
	public function resgistration_email_paypal($event_reg_id,$order_transaction_id)
	{
		$details=$this->Resgister_model->get_event_registration_detail($event_reg_id);
		$full_name = $details['first_name'].' '.$details['last_name'];
		$event_details = $this->Events_model->get_event_details_by_id($details['event_id']);
		$transaction_details = $this->Resgister_model->get_transaction_details_by_id($order_transaction_id);
		
		$store_name = $this->all_function->get_site_options('site_name');						
		$to = $this->all_function->get_site_options('to_email_address');
		$domain = $this->all_function->get_site_options('domain_name');		
		$auto_from = $this->all_function->get_site_options('from_email_address');
		$auto_from_name = $this->all_function->get_site_options('from_email_name');	
	
		$contact_form = $this->all_function->get_template(11);
		$auto_mail    = $this->all_function->get_template(12);
	
		$body_auto = $auto_mail["body"];
		$body = $contact_form["body"];
		if($details['member_type_id']==1){$member_type = 'Full Corporate';}
		elseif($details['member_type_id']==2){$member_type = 'Associate Corporate';}
		elseif($details['member_type_id']==3){$member_type = 'Individual Corporate';}
		elseif($details['member_type_id']==4){$member_type = 'Partner';}
		else{$member_type = 'Non Member';}
		$MemberInfo = '<table style="width: 100%;" border="1" cellspacing="0" cellpadding="10">
                  <tbody>
                    <tr>
                      <td width="50%">Member ID:</td>
                      <td width="50%">'.$details['user_name'].'</td>
                    </tr>
					<tr>
                      <td>Member Type:</td>
                      <td>'.$member_type.'</td>
                    </tr>
					<tr>
                      <td width="50%">Company Name:</td>
                      <td width="50%">'.$details['company_name'].'</td>
                    </tr>
                    <tr>
                      <td>Company Type:</td>
                      <td>'.$details['company_type'].'</td>
                    </tr>                    
                  </tbody>
                </table>';
		$payment_summery = '<table style="width: 100%;" border="1" cellspacing="0" cellpadding="10">
                  <tbody>
                    <tr>
                      <td width="50%">Event Registration ID:</td>
                      <td width="50%">'.$transaction_details['event_reg_id'].'</td>
                    </tr>
                    <tr>
                      <td>Transaction ID:</td>
                      <td>'.$transaction_details['transaction_id'].'</td>
                    </tr>
                    <tr>
                      <td>Payment Status:</td>
                      <td>'.$transaction_details['payment_status'].'</td>
                    </tr>
                    <tr>
                      <td>Payment Amount:</td>
                      <td>'.$transaction_details['payment_amount'].'</td>
                    </tr> 
					<tr>
                      <td>Payment Currency:</td>
                      <td>'.$transaction_details['payment_currency'].'</td>
                    </tr> 
					<tr>
                      <td>Transaction Type:</td>
                      <td>'.$transaction_details['transaction_type'].'</td>
                    </tr> 
					<tr>
                      <td>Receiver Email:</td>
                      <td>'.$transaction_details['receiver_email'].'</td>
                    </tr> 
					<tr>
                      <td>Payer Email:</td>
                      <td>'.$transaction_details['payer_email'].'</td>
                    </tr>
					<tr>
                      <td>Pament Date:</td>
                      <td>'.$transaction_details['payment_date'].'</td>
                    </tr>                   
                  </tbody>
                </table>';
		
		$body			  = str_replace("{SITE_URL}", base_url('/'), $body);
		$body			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body);		
		$body			  = str_replace("{SITE_NAME}", $store_name, $body);
		$body			  = str_replace("{MEMBER_ID}", $details['user_name'], $body);	
		$body			  = str_replace("{NAME}", $full_name, $body);
		$body			  = str_replace("{COMPANY_NAME}", $details['company_name'], $body);
		$body			  = str_replace("{COMPANY_TYPE}", $details['company_type'], $body);
		$body			  = str_replace("{COMPANY_EMAIL}", $details['company_email'], $body);
		$body			  = str_replace("{FIRST_NAME}", $details['first_name'], $body);
		$body			  = str_replace("{LAST_NAME}", $details['last_name'], $body);
		$body			  = str_replace("{DESIGNATION}", $details['designation'], $body);
		$body			  = str_replace("{EMAIL}", $details['email'], $body);
		$body			  = str_replace("{CONTACT_NUMBER}", $details['phone_no'], $body);
		$body			  = str_replace("{BILLING_ADDRESS}", $details['billing_address'], $body);
		$body			  = str_replace("{PRICE}", $details['price'], $body);
		$body			  = str_replace("{PAYMENT_SUMMERY}", $payment_summery, $body);
		$body			  = str_replace("{MEMBER_INFO}", $MemberInfo, $body);
		$body			  = str_replace("{DOMAIN}", $domain, $body);
	
		$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
		$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body_auto);		
		$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
		$body_auto			  = str_replace("{NAME}", $full_name, $body_auto);
		$body_auto			  = str_replace("{MEMBER_ID}", $details['user_name'], $body_auto);	
		$body_auto			  = str_replace("{COMPANY_NAME}", $details['company_name'], $body_auto);
		$body_auto			  = str_replace("{COMPANY_TYPE}", $details['company_type'], $body_auto);
		$body_auto			  = str_replace("{COMPANY_EMAIL}", $details['company_email'], $body_auto);
		$body_auto			  = str_replace("{FIRST_NAME}", $details['first_name'], $body_auto);	
		$body_auto			  = str_replace("{LAST_NAME}", $details['last_name'], $body_auto);
		$body_auto			  = str_replace("{DESIGNATION}", $details['designation'], $body_auto);
		$body_auto			  = str_replace("{EMAIL}", $details['email'], $body_auto);
		$body_auto			  = str_replace("{CONTACT_NUMBER}", $details['phone_no'],$body_auto);
		$body_auto			  = str_replace("{BILLING_ADDRESS}", $details['billing_address'],$body_auto);
		$body_auto			  = str_replace("{PRICE}", $details['price'], $body_auto);
		$body_auto			  = str_replace("{PAYMENT_SUMMERY}", $payment_summery, $body_auto);
		$body_auto			  = str_replace("{MEMBER_INFO}", $MemberInfo, $body_auto);
		$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);	
		
		//echo $body.$body_auto; die();
		 
		$subject = $contact_form["subject"];
		$subject = str_replace("{NAME}", $full_name, $subject);
		$auto_subject = $auto_mail["subject"];
		$auto_subject = str_replace("{NAME}", $full_name, $auto_subject);
		
		$bcc = $this->all_function->get_site_options('contact_email');
		$fullPathInvoice = MAIN_SITE_PATH.'/'.$details['invoice'];	
					
		$this->all_function->batch_email_attach($to, $details['company_email'], $full_name, $bcc, $subject, $body,$fullPathInvoice);					
		$this->all_function->batch_email_attach($details['company_email'], $auto_from, $auto_from_name,$details['email'], $auto_subject, $body_auto,$fullPathInvoice);
		
	}
	
	public function edit_unique($value, $params)
	{
		
		$this->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");
        list($table, $field, $current_id) = explode(".", $params);
		$query = $this->db->select()->from($table)->where($field, $value)->where('event_id', $current_id)->get()->result_array();
		//echo $this->db->last_query();
		//echo count($query);
		if (count($query)==0)
		{
			return TRUE;
		} else {
			return FALSE;
		}
		
	}
}