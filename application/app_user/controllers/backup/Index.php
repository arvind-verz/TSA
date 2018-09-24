<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);   
		$this->load->model('Banner_model', '', TRUE); 
		$this->load->model('Search_model', '', TRUE); 
		$this->load->model('Brands_model', '', TRUE);
		$this->load->model('News_model', '', TRUE);
		$this->load->model('Category_model', '', TRUE);
		$this->load->library('form_validation');
		//$this->load->library('recaptcha');
    }
	public function error() { echo $this->session->flashdata('success_msg');
		$this->view('include/error');
    }
	public function home() {

        $data_msg = array();
		
		$data_msg['meta_title'] = "Welcome to ".$this->all_function->get_site_options('site_name');
				
		$data_msg['page'] = $page = $this->Cms_model->get_page('home');
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		$data_msg['cat_id'] = 0;	
		$data_msg['url'] = 'home';
		
		$data_msg['url_name'] = 'home';

        $data_msg['home_banner'] = $this->Banner_model->get_home_banner();
		
		$data_msg['news'] = $this->News_model->get_news();
		
		$data_msg['brands'] = $this->Brands_model->get_brands();
		
		$data_msg['product_cat'] = $this->Category_model->get_root_category();
		
		
		$this->load->library('recaptcha');
		
		$data_msg['widget'] = $this->recaptcha->getWidget();
		
		$data_msg['script'] = $this->recaptcha->getScriptTag();
		##
		$configForm = array(
               array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'telephone',
                     'label'   => 'Telephone',
                     'rules'   => 'required'
                  ),   
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
			   array(
                     'field'   => 'message',
                     'label'   => 'Message',
                     'rules'   => 'required'
                  )
            );
			
			$this->form_validation->set_rules($configForm);
			if($_POST){
				
			if ($this->form_validation->run() == FALSE)
			{
				$error_msg = strip_tags(validation_errors());
				$data_msg['error_msg'] = $error_msg;
        		$this->view('home',$data_msg);
			}else{
				$post_data = $_POST;				
				$recaptcha = $this->input->post('g-recaptcha-response');
				if (!empty($recaptcha)) {
					
				$response = $this->recaptcha->verifyResponse($recaptcha);
				if (isset($response['success']) and $response['success'] === true) {
					
					/*=======================*/
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
						//$body			  = str_replace("{COMPANY}", $post_data['company'], $body);	
						$body			  = str_replace("{NAME}", $post_data['name'], $body);
						$body			  = str_replace("{EMAIL}", $post_data['email'], $body);
						$body			  = str_replace("{PHONE}", $post_data['telephone'], $body);
						$body			  = str_replace("{MESSAGE}", $post_data['message'], $body);
						$body			  = str_replace("{DOMAIN}", $domain, $body);
						
						
						
						
						$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
						$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body_auto);		
						$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
						//$body_auto			  = str_replace("{COMPANY}", $post_data['company'], $body_auto);	
						$body_auto			  = str_replace("{NAME}", $post_data['name'], $body_auto);
						$body_auto			  = str_replace("{EMAIL}", $post_data['email'], $body_auto);
						$body_auto			  = str_replace("{PHONE}", $post_data['telephone'], $body_auto);
						$body_auto			  = str_replace("{MESSAGE}", $post_data['message'], $body_auto);
						$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);
							
						
						//echo $body.$body_auto; die();
						
						$subject = $contact_form["subject"];
						$subject = str_replace("{NAME}", $_POST['name'], $subject);
						$auto_subject = $auto_mail["subject"];
						$auto_subject = str_replace("{NAME}", $_POST['name'], $auto_subject);
						
						//$bcc = $this->all_function->get_site_options('contact_email');
						
						$result = $this->all_function->batch_email($to, $_POST['email'], $_POST['name'], '', $subject, $body);	
							if($result==true){							
								$data = array(
											'name' => $post_data['name'],
											'email' => $post_data['email'],
											'telephone' => $post_data['telephone'],
											'message' => $post_data['message'],
											'create_date' => date("Y-m-d H:m:s"),
											'status' =>'N'
											); 
								$this->db->insert(TBL_QUICK_CONTACT , $data);
								$this->all_function->batch_email($_POST['email'], $auto_from, $auto_from_name, '', $auto_subject, $body_auto);
								 redirect(base_url("thank-you"));
								 
							}else{
								$error_msg='There was an error. Please try again leter.';
								$data_msg['error_msg'] = $error_msg;
        						$this->view('home',$data_msg);
							}
					/*=======================*/
					
				}else{
					$error_msg = 'You have not click on "Security Check".';
					$data_msg['error_msg'] = $error_msg;
					$this->view('home',$data_msg);
				}
				}else {
						$error_msg = 'Please click on "Security Check".';
						$data_msg['error_msg'] = $error_msg;
        				$this->view('home',$data_msg);
				}	
				
				
			}
				
				
			}else{
		##
        	$this->view('home',$data_msg);
			}
		
    } 
	
	public function faq() {

        $data_msg = array();
		if($this->session->flashdata('error_status')){
			$data_msg['error_status'] = $this->session->flashdata('error_status');
		}else{
			$data_msg['error_status'] = 0;
		}
		$data_msg['shop_menu'] = $this->Cms_model->shop_menu();
		
		$data_msg['glossary'] = $this->Store_model->get_glossary();
		
		$data_msg['meta_title'] = "FAQ";
		
		$data_msg['page'] = $page = $this->Cms_model->get_page('faq');
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		
		$data_msg['faq'] = $this->Cms_model->get_faq();
		
		$data_msg['url_name'] = 'faq';
		
		$data_msg['url'] = 'faq';
		
        $this->view('faq',$data_msg);
		
    }  // Done
	
	public function site_map() {

        $data_msg = array();
		if($this->session->flashdata('error_status')){ 
			$data_msg['error_status'] = $this->session->flashdata('error_status');
		}else{
			$data_msg['error_status'] = 0;
		}
		$data_msg['shop_menu'] = $this->Cms_model->shop_menu();
		
		$data_msg['glossary'] = $this->Store_model->get_glossary();

		$page = $this->Cms_model->get_page('site-map');
		
		if(count($page)>0){
			
		$data_msg['page'] = $page;
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		
		$data_msg['url_name'] = 'site-map';
		
		$data_msg['url'] = 'site-map';
		
		}else{

			redirect(base_url("page-not-found"));
			
			exit;  	
		}
		
		$data_msg['meta_title'] = "Hong Ming Store";	
		
		$data_msg['main_pages'] = array();
		$data_msg['store_pages'] = array();
		$data_msg['product_pages'] = array();
		$data_msg['subcat_pages'] = array();
				
		$data_msg['main_pages'] = $this->Search_model->get_main_pages_all();
		$data_msg['store_pages'] = $this->Search_model->get_store_pages_all();
		$data_msg['product_pages'] = $this->Search_model->get_product_pages_all();
		$data_msg['subcat_pages'] = $this->Search_model->get_subcat_pages_all();


		$this->view('site_map',$data_msg);
		
		
    } // Done
	
	public function newsletter_add(){
		if(isset($_POST['email'])){
			$email = $_POST['email'];
			$user = $this->Cms_model->get_newsletter($email);
			if($user>0){
				$notification = 'This email is already registered.';
				$status = 2;
			}else{				
				$store_name = $this->all_function->get_site_options('site_name');
				$domain = $this->all_function->get_site_options('domain_name');
				$auto_from = $this->all_function->get_site_options('from_email_address');
				$auto_from_name = $this->all_function->get_site_options('from_email_name');	
				
				$to = $this->all_function->get_site_options('to_email_address');
				
				$contact_form = $this->all_function->get_template(7);
				$auto_mail = $this->all_function->get_template(8);
				
				$body_auto = $auto_mail["body"];	
				$body = $contact_form["body"];						
										
				$body			  = str_replace("{SITE_URL}", base_url('/'), $body);
				$body			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body);		
				$body			  = str_replace("{SITE_NAME}", $store_name, $body);	
				$body			  = str_replace("{EMAIL}", $email, $body);
				$body			  = str_replace("{DOMAIN}", $domain, $body);
				
				$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
				$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body_auto);		
				$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
				$body_auto			  = str_replace("{EMAIL}", $email, $body_auto);
				$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);
				
				$subject = $contact_form["subject"];
				$auto_subject = $auto_mail["subject"];
				
				$bcc = $this->all_function->get_site_options('contact_email');
				
				$result = $this->all_function->batch_email($to, $email, '', $bcc, $subject, $body);
				$result=true;	
				if($result==true){
						$data = array(
								'email ' => $email,
								'status' => '1',
								'date' => date('Y-m-d')
							); 
						$this->Cms_model->add_newsletter($data);
						$notification = 'You have successfully submitted.';
						$status = 1;				
						$this->all_function->batch_email($email, $auto_from, $auto_from_name, '', $auto_subject, $body_auto);
					}else{
					$notification = 'There was an error. Please try again leter.';
					$status = 0;
				}
			}
		}else{
			$email = '';
			$notification = 'Please enter your email.';
			$status = 0;
		}
		$data_msg['email'] = $email;
		$data_msg['status'] = $status;
		$data_msg['notification'] = $notification;
		$this->view('newsletter',$data_msg);
	}
	
	public function search() {

        $data_msg = array();
		$data_msg['cat_id'] = 0;
		
		$page = $this->Cms_model->get_page_others('search');
		
		if(count($page)>0){
			
		$data_msg['page'] = $page;
		
		$data_msg['menu_id'] = 0;
		
		$data_msg['url_name'] = 'search';
		
		$data_msg['url'] = 'search';
		
		}else{

			redirect(base_url("page-not-found"));
			
			exit;  	
		}
		
		$data_msg['meta_title'] = "Search | ".$this->all_function->get_site_options('site_name');;	
		
		$data_msg['inner_pages'] = array();
		$data_msg['product_pages'] = array();
		//$data_msg['blog_pages'] = array();
		$data_msg['news_pages'] = array();
		
		if(isset($_POST['key'])){
			
			$data_msg['key'] = $key = $_POST['key'];
			
			$data_msg['inner_pages'] = $this->Search_model->get_main_pages($key);
			$data_msg['product_pages'] = $this->Search_model->get_product_pages($key);
			//$data_msg['blog_pages'] = $this->Search_model->get_blog_pages($key);
			$data_msg['news_pages'] = $this->Search_model->get_news_pages($key);
			
		}else{
			$data_msg['key'] ='';
		}

		$this->view('search',$data_msg);
		
		
    } // Done
	
	public function page_not_found() { 

        redirect(base_url("/"));
		
		
		/*$data_msg = array();
		
		$data_msg['page'] = '';
		
		$data_msg['url'] = '404';
		
		$data_msg['meta_title'] = "Page not found";
		
		$data_msg['url_name'] = 'page-not-found';
		
		$data_msg['brands'] = $this->Brands_model->get_brands();
				
        $this->view('404',$data_msg);*/
		
    } 
	
	#####
	public function quick_contact() {

        $data_msg = array();
		
		$data_msg['meta_title'] = "Welcome to ".$this->all_function->get_site_options('site_name');
		
		$this->load->library('recaptcha');
		
		$data_msg['widget'] = $this->recaptcha->getWidget();
		
		$data_msg['script'] = $this->recaptcha->getScriptTag();
		##
		$configForm = array(
               array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'telephone',
                     'label'   => 'Telephone',
                     'rules'   => 'required'
                  ),   
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
			   array(
                     'field'   => 'message',
                     'label'   => 'Message',
                     'rules'   => 'required'
                  )
            );
			
			$this->form_validation->set_rules($configForm);
			if($_POST){
				
			if ($this->form_validation->run() == FALSE)
			{
				$error_msg = strip_tags(validation_errors());
				$data_msg['error_msg'] = $error_msg;
        		//$this->view('home',$data_msg);
				$arr['err_msg']=$error_msg;
			}else{
				$post_data = $_POST;				
				$recaptcha = $this->input->post('g-recaptcha-response');
				if (!empty($recaptcha)) {
					
				$response = $this->recaptcha->verifyResponse($recaptcha);
				if (isset($response['success']) and $response['success'] === true) {
					
					/*=======================*/
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
						//$body			  = str_replace("{COMPANY}", $post_data['company'], $body);	
						$body			  = str_replace("{NAME}", $post_data['name'], $body);
						$body			  = str_replace("{EMAIL}", $post_data['email'], $body);
						$body			  = str_replace("{PHONE}", $post_data['telephone'], $body);
						$body			  = str_replace("{MESSAGE}", $post_data['message'], $body);
						$body			  = str_replace("{DOMAIN}", $domain, $body);
						
						
						
						
						$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
						$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body_auto);		
						$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
						//$body_auto			  = str_replace("{COMPANY}", $post_data['company'], $body_auto);	
						$body_auto			  = str_replace("{NAME}", $post_data['name'], $body_auto);

						$body_auto			  = str_replace("{EMAIL}", $post_data['email'], $body_auto);
						$body_auto			  = str_replace("{PHONE}", $post_data['telephone'], $body_auto);
						$body_auto			  = str_replace("{MESSAGE}", $post_data['message'], $body_auto);
						$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);
							
						
						//echo $body.$body_auto; die();
						
						$subject = $contact_form["subject"];
						$subject = str_replace("{NAME}", $_POST['name'], $subject);
						$auto_subject = $auto_mail["subject"];
						$auto_subject = str_replace("{NAME}", $_POST['name'], $auto_subject);
						
						//$bcc = $this->all_function->get_site_options('contact_email');
						
						$result = $this->all_function->batch_email($to, $_POST['email'], $_POST['name'], '', $subject, $body);	
							if($result==true){							
								$data = array(
											'name' => $post_data['name'],
											'email' => $post_data['email'],
											'telephone' => $post_data['telephone'],
											'message' => $post_data['message'],
											'create_date' => date("Y-m-d H:m:s"),
											'status' =>'N'
											); 
								$this->db->insert(TBL_QUICK_CONTACT , $data);
								$this->all_function->batch_email($_POST['email'], $auto_from, $auto_from_name, '', $auto_subject, $body_auto);
								 //redirect(base_url("thank-you"));
								 $arr['success']='ok';
								 $arr['redirect']=base_url('thank-you');
								 
							}else{
								$error_msg='There was an error. Please try again leter.';
								$data_msg['error_msg'] = $error_msg;
								$arr['err_msg']=$error_msg;
							}
					/*=======================*/
					
				}else{
					$error_msg = 'You have not click on "Security Check".';
					$data_msg['error_msg'] = $error_msg;
					$arr['err_msg']=$error_msg;
				}
				}else {
						$error_msg = 'Please click on "Security Check".';
						$data_msg['error_msg'] = $error_msg;
						$arr['err_msg']=$error_msg;
				}	
				
				
			}
				
				
				
			}
		echo json_encode($arr);
    } 
	#####
	
	
}