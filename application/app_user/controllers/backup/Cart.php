<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);   
		$this->load->model('Product_model', '', TRUE);
		$this->load->library('form_validation');
    }
	
	public function cart_enquiry() {

        $data_msg = array(); 		
		$page = $this->Cms_model->get_page_others('cart');				
		if(count($page)>0){		
		$data_msg['page'] = $page;		
		$data_msg['menu_id'] = 0;		
		$data_msg['url_name'] = 'cart';		
		}else{redirect(base_url("page-not-found"));}
		
		$data_msg['cat_id'] =0;
		
		
		$data_msg['meta_title'] = "Thank You";
		$data_msg['url'] = 'cart-enquiry';
		
		$this->load->library('recaptcha');
		
		$data_msg['widget'] = $this->recaptcha->getWidget();
		
		$data_msg['script'] = $this->recaptcha->getScriptTag();
		
		
						
				
		
			
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
        		$this->view('cart_enquiry',$data_msg);
			}else{	
				
				
		
			$cart_item = $this->session->userdata('cart');
			
			/*if(!empty($cart_item)){*/
				
				if(!empty($cart_item)){
					
					$recaptcha = $this->input->post('g-recaptcha-response');
					
					if (!empty($recaptcha)){
						$response = $this->recaptcha->verifyResponse($recaptcha);
						
						//$response['success'] = true;
						
						if (isset($response['success']) and $response['success'] === true) {
							
							/*===============================*/
							$cart = '';
					/*foreach ($cart_item as $key => $val){ 
								 $products_id = $val['products_id'];
								 $cart .= '<div class="cart-itemt">';
								 $product = $this->all_function->get_cart_product($products_id);
								 $cart .= '<h3>'.$product[0]['product_name'].'</h3>';
								 $i = 0;
								 $cart .= '<div>';
								 foreach ($val['options'] as $key => $val){
										$cart .= '<span><strong>'.$val['products_options'].': </strong>'.$val['products_options_values'].'</span>';
								 }
								 $cart .='</div>';
								 $cart .= '<div>'.$product[0]['product_description'].'</div>';
								 $cart .='</div>';
						}*/
						
						
						$cart .= '<table style="width: 100%;" border="1" cellspacing="0" cellpadding="10">';
									foreach ($cart_item as $key => $val){ 
										 $products_id = $val['products_id'];
										 $cart .= '<tr>';
										 $product = $this->all_function->get_cart_product($products_id);
										 $cart .= '<td colspan="2" valign="top"><h3>'.$product[0]['product_name'].'</h3></td></tr>';
										 $cart .= '<tr><td valign="top"><a href="'.base_url('product/'.$product[0]['seo_url']).'"><figure> <img src="'.base_url('assets/upload/products/thumb/'.$product[0]['image_name']).'" alt=""> </figure></a></td>';
										 
										 $cart .= '<td valign="top">';
										 foreach ($val['options'] as $key => $val){
												$cart .= '<span><strong>'.$val['products_options'].': </strong>'.$val['products_options_values'].'</span><br/>';
										 }
										 $content = preg_replace("/<img[^>]+\>/i", " ", $product[0]['product_description']);
										 $content = strip_tags($content);
										 if(strlen($content)>240){
											$product_description =  substr($content,0,240).'...';
										 }else{
											$product_description = $content;
										 }
										 $cart .= '<p>'.$product_description.'</p>';						 
										 $cart .='</td></tr>';
									}
						
						
						
						
						$post_data = $_POST;
					
					$store_name = $this->all_function->get_site_options('site_name');
					
					$to = $this->all_function->get_site_options('to_email_address');
					
					$domain = $this->all_function->get_site_options('domain_name');
					
					$auto_from = $this->all_function->get_site_options('from_email_address');
					
					$auto_from_name = $this->all_function->get_site_options('from_email_name');
					
					
					$contact_form = $this->all_function->get_template(4);					
					$auto_mail = $this->all_function->get_template(6);
					
					$body_auto = $auto_mail["body"];
	
					$body = $contact_form["body"];
					
					$body			  = str_replace("{SITE_URL}", base_url('/'), $body);
					$body			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body);		
					$body			  = str_replace("{SITE_NAME}", $store_name, $body);	
					//$body			  = str_replace("{TITLE}", $post_data['enquiry_title'], $body);
					$body			  = str_replace("{NAME}", $post_data['name'], $body);
					$body			  = str_replace("{EMAIL}", $post_data['email'], $body);
					$body			  = str_replace("{COMPANY}", $post_data['company'], $body);
					//$body			  = str_replace("{ADDRESS}", $post_data['address'], $body);
					//$body			  = str_replace("{POSTAL_CODE}", $post_data['postal_code'], $body);
					$body			  = str_replace("{PHONE}", $post_data['telephone'], $body);
					$body			  = str_replace("{MESSAGE}", $post_data['message'], $body);
					$body			  = str_replace("{CART}", $cart, $body);
					$body			  = str_replace("{DOMAIN}", $domain, $body);
					
					$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
					$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo')).'" border="0"/>', $body_auto);		
					$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);	
					//$body_auto			  = str_replace("{TITLE}", $post_data['enquiry_title'], $body_auto);
					$body_auto			  = str_replace("{NAME}", $post_data['name'], $body_auto);
					$body_auto			  = str_replace("{EMAIL}", $post_data['email'], $body_auto);
					$body_auto			  = str_replace("{PHONE}", $post_data['telephone'], $body_auto);
					$body_auto			  = str_replace("{COMPANY}", $post_data['company'], $body_auto);
					//$body_auto			  = str_replace("{ADDRESS}", $post_data['address'], $body_auto);
					//$body_auto			  = str_replace("{POSTAL_CODE}", $post_data['postal_code'], $body_auto);
					$body_auto			  = str_replace("{MESSAGE}", $post_data['message'], $body_auto);
					$body_auto			  = str_replace("{CART}", $cart, $body_auto);
					$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);
						
					$subject = $contact_form["subject"];
					$subject = str_replace("{NAME}", $_POST['name'], $subject);
					$auto_subject = $auto_mail["subject"];
					$auto_subject = str_replace("{NAME}", $_POST['name'], $auto_subject);
					
					$bcc = $this->all_function->get_site_options('contact_email');
					
					$result = $this->all_function->batch_email($to, $_POST['email'], $_POST['name'], '', $subject, $body);
					//$result=true;
					if($result==true){
							
							$data = array(
											'name' => $post_data['name'],
											'company' => $post_data['company'],
											'email' => $post_data['email'],
											'contact_no' => $post_data['telephone'],
											'comment' => $post_data['message'],
											'create_date' => date("Y-m-d H:m:s"),
											'status' =>'N'
										); 
								$cart_id = $this->Cms_model->add_cart($data);
								
								foreach ($cart_item as $key => $val){
									$products_id = $val['products_id'];
									$item_id = $val['timeID'];
									if(count($val['options'])>0){
									foreach ($val['options'] as $key => $val){
										$itemData = array(
											'cart_id' => $cart_id,
											'products_id' => $products_id,
											'item_id' => $item_id,
											'products_options' => $val['products_options'],
											'products_options_values' => $val['products_options_values']
										);
										$this->Cms_model->add_cart_item($itemData);
									 }
									}else{
										$itemData = array(
											'cart_id' => $cart_id,
											'products_id' => $products_id,
											'item_id' => $item_id
										);
										$this->Cms_model->add_cart_item($itemData);
									}
							    	
									
								}
								
							  
							$data_msg['msg_form']='<p class="send">Thanks, we will be in contact with more information soon.</p>'; 	
							$this->all_function->batch_email($_POST['email'], $auto_from, $auto_from_name, '', $auto_subject, $body_auto);						
							$this->session->unset_userdata('cart');
							redirect(base_url("thank-you"));
														
						}else{
							$data_msg['error_msg']='<p class="error">There was an error. Please try again leter.</p>';
						}
							
							/*===============================*/
							
							
						}else{
							$error_msg = 'You have not click on "Security Check".';
							$data_msg['error_msg'] = $error_msg;
							//$this->view('cart_enquiry',$data_msg);
				       }
						
						
					
					}else {
						$error_msg = 'Please click on "Security Check".';
						$data_msg['error_msg'] = $error_msg;
        				//$this->view('cart_enquiry',$data_msg);
				   }	
					
				
					
				}
				/*}*/
				/*else{
				$data_msg['error_msg']='<p class="error">Please try again leter.</p>';	
			    }*/
		  }
		}		
		$this->view('cart_enquiry',$data_msg);		
    }	 // Done
	
	public function ajax_add_enquiry_cart() {

        $data_msg = array();
				
		$data_msg['products_id'] = $products_id = $this->input->post('products_id');
		
		$products_options = $this->Product_model->get_products_options($products_id);
		
		$data_items['cart'] = array();
				
		$items_options = array();
		
		$optionAll = '';
		
		foreach ($products_options as $key => $val){
			$products_options = $this->Product_model->get_products_options_name($val['products_options_id']);
			$products_options_values = $this->input->post('options_'.$val['products_options_id']);
			$items_options[] = array(
							'products_options' => $products_options,
							'products_options_values' => $products_options_values
						); 
			$optionAll .= $products_options.$products_options_values;
		}
		if($optionAll!=''){
			$optionZ = strtolower($optionAll);
			$productsOptions = str_replace(' ', '',$optionZ);
			$timeID = $productsOptions.$products_id;
		}else{
			$timeID = $products_id;
		}
		
		$data_items['cart'][] = array('products_id' => $products_id, 'timeID' => $timeID, 'options' => $items_options);
		
		$add_item = $this->session->userdata('cart');
		
		$old_cart = count($add_item);
		$new_cart = $old_cart + count($data_items['cart']);
		if(!empty($add_item)){
			
			$data_items['cart'] = array_merge($this->session->userdata('cart'),$data_items['cart']);
			$data_items['cart'] = array_unique($data_items['cart'], SORT_REGULAR);
		}	
				
		$this->session->set_userdata('cart',$data_items['cart']);
		$cart_now = count($this->session->userdata('cart'));
		if($new_cart==$cart_now){
			$this->view('ajax_add_enquiry_cart',$data_msg);
		}elseif($new_cart>$cart_now){
			$this->view('ajax_repet_enquiry_cart',$data_msg);
		}
    } 
	
	public function ajax_remove_cart_item() {

        $data_msg = array();
		
		if(isset($_POST['timeID'])){
			$timeID = $this->input->post('timeID');					
		}else{
			$timeID = 0;
		}
		
		$cart_item = $this->session->userdata('cart');
				
		$items = array(); $i=0;
		
		foreach ($cart_item as $key => $val){ 
			
			if($val['timeID']!=$timeID){
				$items[$i] = array_merge($items,$val);
				$i++;
			}
		}
				
		$this->session->set_userdata('cart', $items);  
				
    } 
	
	public function ajax_count_enquiry_item() {

        $cartItem = $this->session->userdata('cart'); 
		if(!empty($cartItem)){$countCartItem = count($cartItem);}
		else{$countCartItem = 0;}	
		echo $countCartItem;
		exit;
    }
	
}