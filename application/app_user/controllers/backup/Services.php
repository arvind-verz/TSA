<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Services extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);
		$this->load->model('Services_model', '', TRUE);
		$this->load->library('form_validation');   
    }
	
	public function service_customer() {

        $data_msg = array();
				
		$page = $this->Cms_model->get_page('servicing-the-customer');
		
		if(count($page)>0){
			$data_msg['page'] =$page;
			$data_msg['menu_id'] = $page[0]['menu_id'];
			$data_msg['cat_id'] = 0;
		    $data_msg['top_parent_id'] = 0;
			$data_msg['url'] = 'services';
		    $data_msg['url_name'] = 'services';
			$data_msg['left_url'] = 'servicing-the-customer';
			
			$data_msg['sc'] = $this->Services_model->get_service_centres();
			
		
		}else{

			redirect(base_url("page-not-found"));	
		}
        $this->view('service_customer',$data_msg);
		
    } 
	
	function  warranty_registration()
	{
		$data_msg = array();
		$page = $this->Cms_model->get_page('warranty-registration-form');
		//if(count($page)>0){
			
			$data_msg['page']=$page;
			$data_msg['menu_id'] = $page[0]['menu_id'];
			$data_msg['cat_id'] = 0;
		    $data_msg['top_parent_id'] = 0;
			$data_msg['url'] = 'services';
		    $data_msg['url_name'] = 'services';
			$data_msg['left_url'] = 'warranty-registration-form';
			$data_msg['ha'] = $this->Services_model->get_hear_about();
			$data_msg['wc'] = $this->Services_model->get_why_choose();
			
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
                     'field'   => 'mobile_no',
                     'label'   => 'Mobile Number',
                     'rules'   => 'required'
                  ), 
				 array(
                     'field'   => 'model',
                     'label'   => 'Model',
                     'rules'   => 'required'
                  ), 
                 array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
				  array(
                     'field'   => 'date_of_purchase',
                     'label'   => 'Date Of Purchase',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'serial_no',
                     'label'   => 'Serial No',
                     'rules'   => 'required'
                  )
            );
			
			$this->form_validation->set_rules($configForm);
			if($_POST){
				if ($this->form_validation->run() == FALSE)
			    {
				$error_msg = strip_tags(validation_errors());
				$data_msg['error_msg'] = $error_msg;
        		$this->view('warranty_registration',$data_msg);
			    }else{
					$post_data = $_POST;$hear_about='';$why_choose='';
					$recaptcha = $this->input->post('g-recaptcha-response');
					if (!empty($recaptcha)) {
						$response = $this->recaptcha->verifyResponse($recaptcha);
						//$response['success'] =true;
						if (isset($response['success']) and $response['success'] === true) {
							/*=======================*/
						 $chk=$this->input->post('chk');
						 if(!empty($chk) && isset($chk))
						 {
							$chk=implode(',', $chk);
							$this->db->select('GROUP_CONCAT(DISTINCT cp.name) ha_name')
                          			 ->from(TBL_HEAR_ABOUT. ' as `cp`')
						  			 ->where("cp.id IN($chk)");
                           $query = $this->db->get()->row_array();
						   $hear_about=$query['ha_name']; 
						 }
						 
						 $chk2=$this->input->post('chk2');
						 if(!empty($chk2) && isset($chk2))
						 {
							$chk2=implode(',', $chk2);
							$this->db->select('GROUP_CONCAT(DISTINCT cp.name) wc_name')
                          			 ->from(TBL_WHY_CHOOSE. ' as `cp`')
						  			 ->where("cp.id IN($chk2)");
                           $query = $this->db->get()->row_array();
						   $why_choose=$query['wc_name']; 
						 }
						
						
						 
						  
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
						$body			  = str_replace("{ADDRESS}", $post_data['address'], $body);
						$body			  = str_replace("{NAME}", $post_data['name'], $body);
						$body			  = str_replace("{MOBILE}", $post_data['mobile_no'], $body);
						$body			  = str_replace("{DEALER_NAME}", $post_data['dealer_name'], $body);
						$body			  = str_replace("{MODEL}", $post_data['model'], $body);
						$body			  = str_replace("{EMAIL}", $post_data['email'], $body);
						$body			  = str_replace("{DATE_OF_PURCHASE}", $post_data['date_of_purchase'], $body);
						$body			  = str_replace("{SERIAL_NO}", $post_data['serial_no'], $body);
						$body			  = str_replace("{HEAR_ABOUT}", $hear_about, $body);
						$body			  = str_replace("{WHY_CHOOSE}", $why_choose, $body);
						$body			  = str_replace("{DOMAIN}", $domain, $body);
						
						
						
						
						$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
						$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body_auto);		
						$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
						$body_auto			  = str_replace("{ADDRESS}", $post_data['address'], $body_auto);
						$body_auto			  = str_replace("{NAME}", $post_data['name'], $body_auto);
						$body_auto			  = str_replace("{MOBILE}", $post_data['mobile_no'], $body_auto);
						$body_auto			  = str_replace("{DEALER_NAME}", $post_data['dealer_name'], $body_auto);
						$body_auto			  = str_replace("{MODEL}", $post_data['model'], $body_auto);
						$body_auto			  = str_replace("{EMAIL}", $post_data['email'], $body_auto);
						$body_auto			  = str_replace("{DATE_OF_PURCHASE}", $post_data['date_of_purchase'], $body_auto);
						$body_auto			  = str_replace("{SERIAL_NO}", $post_data['serial_no'], $body_auto);
						$body_auto			  = str_replace("{HEAR_ABOUT}", $hear_about, $body_auto);
						$body_auto			  = str_replace("{WHY_CHOOSE}", $why_choose, $body_auto);
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
											'address' => $post_data['address'],
											'date_of_purchase' => $post_data['date_of_purchase'],
											'mobile_no' => $post_data['mobile_no'],
											'serial_no' => $post_data['serial_no'],
											'dealer_name' => $post_data['dealer_name'],
											'model' => $post_data['model'],
											'hear_about' => isset($chk)?$chk:'',
											'why_choose' => isset($chk2)?$chk2:'',
											'create_date' => date("Y-m-d H:m:s"),
											'status' =>'N'
											); 
								$this->db->insert(TBL_REGISTRATION , $data);
								$this->all_function->batch_email($_POST['email'], $auto_from, $auto_from_name, '', $auto_subject, $body_auto);
								 redirect(base_url("thank-you/registration"));
								 
							}else{
								$error_msg='There was an error. Please try again leter.';
								$data_msg['error_msg'] = $error_msg;
        						$this->view('warranty_registration',$data_msg);
							}
							/*=======================*/
					    }else{
							$error_msg = 'You have not click on "Security Check".';
							$data_msg['error_msg'] = $error_msg;
							$this->view('warranty_registration',$data_msg);
				        }
					}else {
							$error_msg = 'Please click on "Security Check".';
							$data_msg['error_msg'] = $error_msg;
        					$this->view('warranty_registration',$data_msg);
				    }	
					
				}
			}else{
		
			$this->view('warranty_registration',$data_msg);
		
		}
		
	}
	
	
	
	
}