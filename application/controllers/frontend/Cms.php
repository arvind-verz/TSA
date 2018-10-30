<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('frontend/Cms_model', '', TRUE);   
		//$this->load->model('Banner_model', '', TRUE);  
    }
	public function index() {
		
	    $data_msg = array();	
		$url="home";	
		$data_msg['page'] =$page = $this->Cms_model->get_page($url);
		$data_msg['menu_id'] = $page[0]['menu_id'];
		$data_msg['url'] = $url;
		$data_msg['testimonials'] = $this->Cms_model->get_testimonials();
	
			$this->load->view('frontend/include/header', $data_msg);
			$this->load->view('frontend/home');
			$this->load->view('frontend/include/footer');
	}
	
	
	public function inner_pages($url) {
		//echo $url;die;
        $data_msg = array();		
		$page = $this->Cms_model->get_page($url);
		$page1 = $this->Cms_model->get_page_others($url); 
		$data_msg['menu_id'] = $page[0]['menu_id'];
		if(count($page)>0){			
			$data_msg['page'] = $page;		
			$data_msg['menu_id'] = $page[0]['menu_id'];
			$data_msg['page_id'] = $page[0]['id'];		
			$data_msg['url_name'] = $url;
			$data_msg['url'] = $url;		
			$data_msg['url_name2'] = $url;		
		}elseif(count($page1)>0){
			$page = $page1;			
			$data_msg['page'] = $page;		
			$data_msg['menu_id'] = 0;
			$data_msg['page_id'] = $page[0]['id'];		
			$data_msg['url_name'] = $url;
			$data_msg['url'] = $url;		
			$data_msg['url_name2'] = $url;		
		}
		else
		{
			redirect(base_url("page-not-found"));	
		}
		
		if($page[0]['template']=='About Us')
		{
		$this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/about');
        $this->load->view('frontend/include/footer');
		}
		else if($page[0]['template']=='Why Join Us')
		{
		 if($page[0]['id']==46)
		 {
			$data_msg['join_us']='<a href="'.base_url('membership-types').'" class="link-red">JOIN US NOW</a>';
		 }
		$this->view('why_join_us_page',$data_msg);
		
		}
		else
		{
		$this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/inner_page');
        $this->load->view('frontend/include/footer');
		}
		
		
    }
	
	  
	function testimonial()
	{
		$data_msg = array();		
		$data_msg['testimonials'] = $this->Cms_model->get_testimonials();
		
		$this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/testimonial');
        $this->load->view('frontend/include/footer');	
    }
	function contact_us()
	{
		$data_msg = array();	
		$url="contact-us";	
		//$data_msg['testimonials'] = $this->Cms_model->get_testimonials();
		$this->load->library('form_validation');
		$page = $this->Cms_model->get_page($url);
		$page1 = $this->Cms_model->get_page_others($url); 
		$data_msg['menu_id'] = $page[0]['menu_id'];
		$data_msg['url'] = $url;
		
		$configForm = array(
               array(
                     'field'   => 'fname',
                     'label'   => 'Name',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'email_id',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
               array(
                     'field'   => 'phone',
                     'label'   => 'Contact Number',
                     'rules'   => 'required'
                  ), 
				  array(
                     'field'   => 'programme',
                     'label'   => 'Type of Enquiry',
                     'rules'   => 'required'
                  ),  
			   array(
                     'field'   => 'message',
                     'label'   => 'Comment',
                     'rules'   => 'required'
                  )
            );

		$this->form_validation->set_rules($configForm); 
		if($_POST){
			if ($this->form_validation->run() == FALSE)
			{
				$error_msg = validation_errors();
				$data_msg['error_msg'] = $error_msg;
        		$this->view('contact',$data_msg);
			}else{
				$post_data = $_POST;

				
						/*	
						$store_name = $this->Cms_model->get_site_options('site_name');
						
						$to = $this->Cms_model->get_site_options('to_email_address');
						$domain = $this->Cms_model->get_site_options('domain_name');
						
						$auto_from = $this->Cms_model->get_site_options('from_email_address');
						$auto_from_name = $this->Cms_model->get_site_options('from_email_name');
						
						
						$contact_form = $this->Cms_model->get_template(3);
						$auto_mail = $this->Cms_model->get_template(5);
						
						$body_auto = $auto_mail["body"];
		
						$body = $contact_form["body"];
						
						$body			  = str_replace("{SITE_URL}", base_url('/'), $body);
						$body			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->Cms_model->get_site_options('logo')).'" border="0"/>', $body);		
						$body			  = str_replace("{SITE_NAME}", $store_name, $body);
						$body			  = str_replace("{SALUTATION}", $post_data['salutation'], $body);	
						$body			  = str_replace("{NAME}", $post_data['name'], $body);
						$body			  = str_replace("{EMAIL}", $post_data['email'], $body);
						$body			  = str_replace("{COMPANY}", $post_data['company'], $body);
						$body			  = str_replace("{PHONE_NO}", $post_data['phone_no'], $body);
						$body			  = str_replace("{ENQUIRY_TYPE}", $post_data['enquiry_type'], $body);
						$body			  = str_replace("{MESSAGE}", $post_data['message'], $body);
						$body			  = str_replace("{DOMAIN}", $domain, $body);
						
						$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
						$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->Cms_model->get_site_options('logo')).'" border="0"/>', $body_auto);		
						$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
						$body_auto			  = str_replace("{SALUTATION}", $post_data['salutation'], $body_auto);	
						$body_auto			  = str_replace("{NAME}", $post_data['name'], $body_auto);
						$body_auto			  = str_replace("{EMAIL}", $post_data['email'], $body_auto);
						$body_auto			  = str_replace("{COMPANY}", $post_data['company'], $body_auto);
						$body_auto			  = str_replace("{PHONE_NO}", $post_data['phone_no'], $body_auto);
						$body_auto			  = str_replace("{ENQUIRY_TYPE}", $post_data['enquiry_type'], $body_auto);
						$body_auto			  = str_replace("{MESSAGE}", $post_data['message'], $body_auto);
						$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);	
						
						
						
						$subject = $contact_form["subject"];
						$subject = str_replace("{NAME}", $_POST['name'], $subject);
						$auto_subject = $auto_mail["subject"];
						$auto_subject = str_replace("{NAME}", $_POST['name'], $auto_subject);
						
						$bcc = $this->Cms_model->get_site_options('contact_email');
						
						$result = $this->Cms_model->batch_email($to, $_POST['email'], $_POST['name'], '', $subject, $body);
						*/
												
								$data = array(
												'name' => $post_data['name'],
												'email' => $post_data['email'],
												'company' => $post_data['company'],
												'phone_no' => $post_data['phone_no'],
												'enquiry_type' => $post_data['enquiry_type'],
												'message' => $post_data['message'],
												'create_date' => date("Y-m-d H:m:s"),
												'status' =>'N'
											); 
								$this->db->insert(TBL_CONTACT , $data);
								
								//$this->Cms_model->batch_email($_POST['email'], $auto_from, $auto_from_name, '', $auto_subject, $body_auto);
								redirect(base_url("thank-you/contact"));
						
					
						
			}
		}
		else
		{
			$this->load->view('frontend/include/header', $data_msg);
			$this->load->view('frontend/contact-us');
			$this->load->view('frontend/include/footer');	
			
		}
	}
	function members()
	{
		$data_msg = array();
				
		$data_msg['page'] = $page = $this->Cms_model->get_page('our-members');
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		/*
		$data_msg['cat_id'] = 0;
		$data_msg['top_parent_id'] = 0;*/
			
		$data_msg['url'] = 'our-members';
		
		$data_msg['url_name'] = 'our-members';
		$data_msg['url_name2'] = 'our-members';
		$data_msg['mc'] = $this->Cms_model->get_members_cms();
		
        $this->view('members_cms',$data_msg);
		
	}
	
	function success()
	{
		$data_msg = array();
		$data_msg['page'] = $page = $this->Cms_model->get_page_others('success');
		$data_msg['menu_id'] = 0;
		$data_msg['url_name'] = 'success';
		$data_msg['url'] = 'success';
		//$this->session->userdata = array();
		$this->view('payment_success',$data_msg);
	}
	function cancel()
	{
		$data_msg = array();
		$data_msg['page'] = $page = $this->Cms_model->get_page_others('cancel');
		$data_msg['menu_id'] = 0;
		$data_msg['url_name'] = 'cancel';
		$data_msg['url'] = 'cancel';
		//$this->session->userdata = array();
		$this->view('payment_cancel',$data_msg);
	}
	
	function membership_type()
	{
		$data_msg = array();
				
		$data_msg['page'] = $page = $this->Cms_model->get_page('membership-types');
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		
			
		$data_msg['url'] = 'membership-types';
		
		$data_msg['url_name'] = 'membership-types';
		$data_msg['url_name2'] = 'membership-types';
		$data_msg['mt'] = $this->Cms_model->get_membership_type();
		
        $this->view('membership_type_cms',$data_msg);
		
	}
	
	
}