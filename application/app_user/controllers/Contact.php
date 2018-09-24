<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);   
    }
	
	public function index() {

        $data_msg = array();
		
		$this->load->library('recaptcha');
		
		$data_msg['widget'] = $this->recaptcha->getWidget();
		
		$data_msg['script'] = $this->recaptcha->getScriptTag();
		
		$data_msg['meta_title'] = "Contact Us";
		
		$data_msg['url_name'] = 'contact-us';
		
		$data_msg['url'] = 'contact-us';
		
		$data_msg['page'] = $page = $this->Cms_model->get_page_others('contact-us');
		
		$data_msg['menu_id'] = 0;
		
		$data_msg['success'] = '';
		
		$this->load->library('form_validation');
		
		$configForm = array(
               array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
               /*array(
                     'field'   => 'phone_no',
                     'label'   => 'Contact Number',
                     'rules'   => 'required'
                  ),*/ 
				  array(
                     'field'   => 'enquiry_type',
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
				$post_data = $_POST;$country_name='';				
				$recaptcha = $this->input->post('g-recaptcha-response');
					
					if (!empty($recaptcha)) {
						
						$response = $this->recaptcha->verifyResponse($recaptcha);
						//$response['success'] = true;
						if (isset($response['success']) and $response['success'] === true) {
							
						$store_name = $this->all_function->get_site_options('site_name');
						
						$to = $this->all_function->get_site_options('to_email_address');
						$domain = $this->all_function->get_site_options('domain_name');
						
						$auto_from = $this->all_function->get_site_options('from_email_address');
						$auto_from_name = $this->all_function->get_site_options('from_email_name');
						
						
						$contact_form = $this->all_function->get_template(3);
						$auto_mail = $this->all_function->get_template(5);
						
						$body_auto = $auto_mail["body"];
		
						$body = $contact_form["body"];
						
						$body			  = str_replace("{SITE_URL}", base_url('/'), $body);
						$body			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body);		
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
						$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body_auto);		
						$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
						$body_auto			  = str_replace("{SALUTATION}", $post_data['salutation'], $body_auto);	
						$body_auto			  = str_replace("{NAME}", $post_data['name'], $body_auto);
						$body_auto			  = str_replace("{EMAIL}", $post_data['email'], $body_auto);
						$body_auto			  = str_replace("{COMPANY}", $post_data['company'], $body_auto);
						$body_auto			  = str_replace("{PHONE_NO}", $post_data['phone_no'], $body_auto);
						$body_auto			  = str_replace("{ENQUIRY_TYPE}", $post_data['enquiry_type'], $body_auto);
						$body_auto			  = str_replace("{MESSAGE}", $post_data['message'], $body_auto);
						$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);	
						
						//echo $body.$body_auto; die();
						
						$subject = $contact_form["subject"];
						$subject = str_replace("{NAME}", $_POST['name'], $subject);
						$auto_subject = $auto_mail["subject"];
						$auto_subject = str_replace("{NAME}", $_POST['name'], $auto_subject);
						
						$bcc = $this->all_function->get_site_options('contact_email');
						
						$result = $this->all_function->batch_email($to, $_POST['email'], $_POST['name'], '', $subject, $body);
						//$result=true;	
							if($result==true){							
								$data = array(
												'salutation' => $post_data['salutation'],
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
								
								$this->all_function->batch_email($_POST['email'], $auto_from, $auto_from_name, '', $auto_subject, $body_auto);
								redirect(base_url("thank-you/contact"));
							}else{
								$error_msg='There was an error. Please try again leter.';
								$data_msg['error_msg'] = $error_msg;
        						$this->view('contact',$data_msg);
							}
					}else{
							$error_msg = 'You have not click on "Security Check".';
							$data_msg['error_msg'] = $error_msg;
        					$this->view('contact',$data_msg);
						}
				}else {
						$error_msg = 'Please click on "Security Check".';
						$data_msg['error_msg'] = $error_msg;
        				$this->view('contact',$data_msg);
					}		
			}
		}else{
        	$this->view('contact',$data_msg);
		}
    } 
	
	
	
	
	
	
	
}