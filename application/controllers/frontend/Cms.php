<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms extends CI_Controller {

   public  function __construct() {
        parent::__construct();
        $this->load->model('frontend/Cms_model', '', TRUE);
        $this->load->model('frontend/accounts', 'accounts');   
		//$this->load->model('Banner_model', '', TRUE);
    }
	public function index() {
		
	    $data_msg = array();	
		$url="home";	
		$data_msg['page'] =$page = $this->Cms_model->get_page($url);
		$data_msg['menu_id'] = $page[0]['menu_id'];
		$data_msg['url'] = $url;
		$data_msg['testimonials'] = $this->Cms_model->get_testimonials();
		$data_msg['gallery'] = $this->Cms_model->get_gallery();
	
			$this->load->view('frontend/include/header', $data_msg);
			$this->load->view('frontend/home');
			$this->load->view('frontend/include/footer');
	}

	public function student_profile() {
		$this->accounts->is_logged_in();
		$data = array();	
		$url="home";	
		$data['page'] =$page = $this->Cms_model->get_page($url);
		$data['menu_id'] = $page[0]['menu_id'];
		$data['url'] = 'student-profile';
		$data['testimonials'] = $this->Cms_model->get_testimonials();

		$data['student_profile']	= get_student_profile();
		$data['title'] = STUDENT . ' | Profile';
		$data['page_title']	= STUDENT . ' | Profile';

		$this->load->view('frontend/include/header', $data);
		$this->load->view('frontend/student-profile');
		$this->load->view('frontend/include/footer');
	}

	public function student_invoices() {
		$this->accounts->is_logged_in();
		$data = array();	
		$url="home";	
		$data['page'] =$page = $this->Cms_model->get_page($url);
		$data['menu_id'] = $page[0]['menu_id'];
		$data['url'] = 'student-invoices';
		$data['testimonials'] = $this->Cms_model->get_testimonials();

		$data['student_invoices']	= get_student_invoices();
		$data['title'] = STUDENT . ' | Invoices';
		$data['page_title']	= STUDENT . ' | Invoices';

		$this->load->view('frontend/include/header', $data);
		$this->load->view('frontend/student-invoices');
		$this->load->view('frontend/include/footer');
	}
	
	public function student_classes() {
		$this->accounts->is_logged_in();
		$data = array();	
		$url="home";	
		$data['page'] =$page = $this->Cms_model->get_page($url);
		$data['classes']  = $this->Cms_model->get_assign_class();
		$data['menu_id'] = $page[0]['menu_id'];
		$data['url'] = 'student-classes';
		//$data['testimonials'] = $this->Cms_model->get_testimonials();

		//$data['student_invoices']	= get_student_invoices();
		$data['title'] = STUDENT . ' | Classes';
		$data['page_title']	= STUDENT . ' | Classes';

		$this->load->view('frontend/include/header', $data);
		$this->load->view('frontend/student-classes');
		$this->load->view('frontend/include/footer');
	}
	
	
	
	public function inner_pages($url) {
		//echo $url;die;
        $data_msg = array();		
		$page = $this->Cms_model->get_page($url);
		$page1 = $this->Cms_model->get_page_others($url); 
		
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
		
		$this->breadcrumbs->push('Home', 'home');
        $this->breadcrumbs->push('404 Page', '404 Page');
		$data_msg['menu_id'] = 0;
		$data_msg['url'] = '404 Page';		
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();
		
		$this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/page-not-found');
        $this->load->view('frontend/include/footer');	
		//die('hiiiii');	
		}
		if($url=='thank-you')
		{
		$this->breadcrumbs->push('Home', 'home');
        $this->breadcrumbs->push($page[0]['page_heading'], '#');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();	
		$this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/thank-you');
        $this->load->view('frontend/include/footer');
		}
		else if($url=='subjects')
		{
		$this->breadcrumbs->push('Login', 'login');
        $this->breadcrumbs->push('Subjects', 'subjects');
		$data_msg['subjects'] = $this->Cms_model->get_subjects();
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();	
		$this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/subjects');
        $this->load->view('frontend/include/footer');
		
		}
		else if($url=='login')
		{
		$this->breadcrumbs->push('Home', 'home');
        $this->breadcrumbs->push('Home', 'home');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();	
		$this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/accounts/login');
        $this->load->view('frontend/include/footer');
		
		}
		else if($url=='reset-password')
		{
		$this->breadcrumbs->push('Home', 'home');
        $this->breadcrumbs->push('Home', 'home');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();	
		$this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/accounts/reset-password');
        $this->load->view('frontend/include/footer');
		
		}
		else if(count($page)>0 && $page[0]['template']=='About Us')
		{
		$this->breadcrumbs->push('Home', 'home');
        $this->breadcrumbs->push('About Us', 'about-us');
        $this->breadcrumbs->push($page[0]['page_heading'], '#');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();	
		$this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/about');
        $this->load->view('frontend/include/footer');
		}
		
		else if(count($page)>0 && $page[0]['template']=='Full Width')
		{
		$this->breadcrumbs->push('Home', 'home');
        $this->breadcrumbs->push($page[0]['page_heading'], '#');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();	
		$this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/inner_page');
        $this->load->view('frontend/include/footer');
		}
		
		
    }
	
	  
	public function testimonial()
	{
		$data_msg = array();
		$data_msg['url'] =$url="testimonial";	
		$data_msg['page'] = $page = $this->Cms_model->get_page($url);
		$data_msg['menu_id'] = $page[0]['menu_id'];
		$this->breadcrumbs->push('Home', 'home');
        $this->breadcrumbs->push($page[0]['page_heading'], '#');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();		
		$data_msg['testimonials'] = $this->Cms_model->get_testimonials();
		
		$this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/testimonial');
        $this->load->view('frontend/include/footer');	
    }
	
	public function miss_class() {
		$this->load->library('form_validation');
		$configForm = array(
               array(
                     'field'   => 'remark',
                     'label'   => 'Remark',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'updated_at',
                     'label'   => 'Date of Absence',
                     'rules'   => 'required'
                  )
            );

		$this->form_validation->set_rules($configForm); 
		
		if($_POST){
			if ($this->form_validation->run() == FALSE)
			{
				$error_msg = validation_errors();
				$data_msg['error_msg'] = $error_msg;
        		$this->session->set_flashdata('error', $error_msg);
				redirect(site_url("student-classes"));
			}else{
				$post_data = $_POST;
				$status=array('0','1','0','0','0','0');
				$data = array(
								'remark' => $post_data['remark'],
								'status' => json_encode($status),
								'updated_at' => $post_data['updated_at']
							); 
							
				$this->db->trans_start();
                $this->db->where('student_id', $post_data['student_id']);
           		$this->db->update(DB_ATTENDANCE, $data);
				//$this->db->last_query();die;
        		$this->db->trans_complete();
							
				$this->session->set_flashdata('success', 'Successfully added');
				redirect(site_url("student-classes"));
						
					
						
			}
		}
	}
	
	
	public function contact_us()
	{
		$data_msg = array();	
		$url="contact-us";	
		//$data_msg['testimonials'] = $this->Cms_model->get_testimonials();
		$this->load->library('form_validation');
		$data_msg['page'] =$page = $this->Cms_model->get_page($url);
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		$data_msg['url'] = $url;
		$this->breadcrumbs->push('Home', 'home');
        $this->breadcrumbs->push('Contact Us', 'contact-us');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();	
		
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
		 $from_email = $to_email = "jafir.verz@gmail.com"; 
         $data = array(
												'name' => $post_data['fname'],
												'email' => $post_data['email_id'],
												'phone_no' => $post_data['phone'],
												'enquiry_type' => $post_data['programme'],
												'message' => $post_data['message'],
												'create_date' => date("Y-m-d H:m:s")
											); 
				$message='<table>
				  <tr>
					<td>Name:</td>
					<td>'.$post_data['fname'].'</td>
				  </tr>
				  <tr>
					<td>Email Id:</td>
					<td>'.$post_data['email_id'].'</td>
				  </tr>
				  <tr>
					<td>Phone No:</td>
					<td>'.$post_data['phone'].'</td>
				  </tr>
				  <tr>
					<td>Enquiry Purpose:</td>
					<td>'.$post_data['programme'].'</td>
				  </tr>
				  <tr>
					<td>MESSAGE:</td>
					<td>'.$post_data['message'].'</td>
				  </tr>
				</table>';		
				
											
		$this->db->insert(DB_CONTACT , $data);
		$insert_id = $this->db->insert_id();
         if(isset($insert_id))
		 {
         //Load email library 
         $this->load->library('email'); 
		  $config = array (
						  'mailtype' => 'html',
						  'charset'  => 'utf-8',
						  'priority' => '1'
						   );
		 $this->email->initialize($config); 
         $this->email->from($from_email, $post_data['fname']); 
         $this->email->to($to_email);
         $this->email->subject('Contact Us form: TSA'); 
         $this->email->message($message); 
   
         	 //Send mail 
			 if($this->email->send())
			 { 
			 redirect(site_url("thank-you"));
			 }
			 else 
			 {
			  $this->session->set_flashdata("error","Error in sending Email."); 
			  redirect(site_url("contact-us")); 
			 }
		 
         }
		 else
		 {
		 $this->session->set_flashdata("error","Error in DB."); 	
		 redirect(site_url("contact-us")); 
	     }

		 
		 
						
					
						
			}
		}
		else
		{
			$this->load->view('frontend/include/header', $data_msg);
			$this->load->view('frontend/contact-us');
			$this->load->view('frontend/include/footer');	
			
		}
	}
	public function quick_enquiry()
	{	
		
		$data_msg = array();	
		$url="quick-enquiry";	
		//$data_msg['testimonials'] = $this->Cms_model->get_testimonials();
		$this->load->library('form_validation');
		
		
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
                     'label'   => 'Phone',
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
				redirect(site_url("contact-us"));
			}else{
				$post_data = $_POST;

				
					
												
								$data = array(
												'name' => $post_data['fname'],
												'email' => $post_data['email_id'],
												'phone_no' => $post_data['phone'],
												'message' => $post_data['message'],
												'create_date' => date("Y-m-d H:m:s")
											); 
		 $this->db->insert(DB_ENQUIRY , $data);
		 $insert_id = $this->db->insert_id();						

		 
											
		
				 if(isset($insert_id))
				 {
				 //Load email library 
				 $this->load->library('email'); 
				  
				 $from_email = $to_email = "jafir.verz@gmail.com"; 
		
				 $message='<table>
						  <tr>
							<td>Name:</td>
							<td>'.$post_data['fname'].'</td>
						  </tr>
						  <tr>
							<td>Email Id:</td>
							<td>'.$post_data['email_id'].'</td>
						  </tr>
						  <tr>
							<td>Phone No:</td>
							<td>'.$post_data['phone'].'</td>
						  </tr>
						  <tr>
							<td>MESSAGE:</td>
							<td>'.$post_data['message'].'</td>
						  </tr>
						</table>';		
					$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				     $this->email->initialize($config); 
					 $this->email->from($from_email, $post_data['fname']); 
					 $this->email->to($to_email);
					 $this->email->subject('Quick Enquiry: TSA'); 
					 $this->email->message($message); 
			   
					 //Send mail 
					 if($this->email->send())
					 { 
					 redirect(site_url("thank-you"));
					 }
					 
				 
				 }
					
						
			}
		}
		
		
	}
	
	public function members()
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