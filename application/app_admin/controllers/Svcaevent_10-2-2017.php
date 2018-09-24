<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Svcaevent extends MY_Controller {

    function __construct() {		
        parent::__construct();
        $this->load->model('Svcaevent_model', '', TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
    }
	
	 public function manage_svcaevent() {
		
		$data_msg = array();
        		
        $data_msg['meta_title'] = "SVCA Event Manager";
		
		$items_per_page = $this->all_function->get_site_options('admin_listing_per_page');
        
        $current_page = (int) $this->input->get('page');
		
        $current_page = $current_page > 0 ? $current_page : 1;
		
		$data_msg['start_count'] = ($current_page * $items_per_page - $items_per_page + 1);

        $limit_from = ($current_page - 1) * $items_per_page;

        if(!isset($_POST['OkFilter']) & !isset($_GET['page'])){
			$this->session->set_userdata(array('FlterData' => '' ));
		}		
		if(isset($_POST['OkFilter'])){
			$this->session->set_userdata(array('FlterData' => $_POST['FlterData'] ));
			$data_msg['FlterData'] = $FlterData = $_POST['FlterData'];
			$data_msg['total'] = $total_items = $this->Svcaevent_model->count_svcaevent_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-svcaevent'));
			$data_msg['display_result'] = $this->Svcaevent_model->get_svcaevent_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $details = $this->Svcaevent_model->get_svcaevent_details($del_id)->result_array();
				         
					 $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/original/'.$details[0]['image_name'];
					 if(is_file($file)){unlink($file); } 
					 $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/detail/'.$details[0]['image_name'];
					 if(is_file($file)){unlink($file); }
					 $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/listing/'.$details[0]['image_name'];
					 if(is_file($file)){unlink($file); }
		 
		 
					 $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/banner/original/'.$details[0]['image_banner'];
					 if(is_file($file)){unlink($file); } 
					 $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/banner/thumb/'.$details[0]['image_banner'];
					 if(is_file($file)){unlink($file); }	 
						 
		 			 
					 $chk=$this->Svcaevent_model->get_additional_pdf_file($del_id)->result_array();
						foreach($chk as $val){
							 $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/pdf/'.$val['pdf_name'];
							 if(is_file($file)){unlink($file); } 
						}
						$this->Svcaevent_model->del_event_pdf($del_id);
		 				
						 
						 
						  
				$this->Svcaevent_model->del_svcaevent($del_id);	
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-svcaevent'));
			  exit;
			  }else{redirect(base_url('manage-svcaevent'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Svcaevent_model->update_svcaevent($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-svcaevent'));
			  exit;
			  }else{redirect(base_url('manage-svcaevent'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Svcaevent_model->update_svcaevent($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-svcaevent'));
			  exit;
			  }else{redirect(base_url('manage-svcaevent'));exit;}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Svcaevent_model->count_svcaevent_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-svcaevent'));
			  $data_msg['display_result'] = $this->Svcaevent_model->get_svcaevent_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'title'=>'',
				'registration_date'=>'',
				'start_date'=>'',
				'promo_code'=>'',
				'status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Svcaevent_model->count_svcaevent();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-svcaevent'));
        	$get_value = $this->Svcaevent_model->get_svcaevent($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
        $this->view('svcaevent/manage_svcaevent', $data_msg);
    }
	public function add_svcaevent(){
		
        $data_msg = array();

        $data_msg['meta_title'] = "Add SVCA Event";
		
		$this->load->library('form_validation');
		
		$config = array(
               array(
				 'field'   => 'title',
				 'label'   => 'Event Name',
				 'rules'   => 'required'
				),
				array(
                     'field'   => 'seo_url',
                     'label'   => 'Url',
                     'rules'   => 'trim|required|is_unique['.TBL_EVENTS.'.seo_url]'
                  ),
				  array(
                     'field'   => 'description',
                     'label'   => 'Description',
                     'rules'   => 'required'
                  ), 
				 array(
                     'field'   => 'registration_date',
                     'label'   => 'Registration End Date',
                     'rules'   => 'required'
                  ),
				 array(
                     'field'   => 'start_date',
                     'label'   => 'Event Start Date',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'end_date',
                     'label'   => 'Event End Date',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'last_payment_date',
                     'label'   => 'Last Payment Date',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'event_time',
                     'label'   => 'Event Time',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'venue',
                     'label'   => 'Event Venue',
                     'rules'   => 'required'
                  ),
				array(
				 'field'   => 'status',
				 'label'   => 'Status',
				 'rules'   => 'required'
				)
				/*,
				array(
				 'field'   => 'sort_order',
				 'label'   => 'Sort Order',
				 'rules'   => 'numeric'
				) */
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('svcaevent/add_svcaevent', $data_msg);
			}
			else {
              $post_data = $_POST; $error_msg = '';$image_name='';$image_banner='';
					##
					if ($_FILES['image_name']['name'] == '') {$error_msg = 'Need Event Image.';}
					else{
							$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/original/';
							$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
							$config['remove_spaces'] = TRUE;
							$this->upload->initialize($config);
								if ($this->upload->do_upload('image_name'))
								{ 
									$upload_data = $this->upload->data();
									$image_name=$upload_data['file_name'];
									
									$config['image_library'] = 'gd2';
									$config['source_image'] = $upload_data['full_path'];
									$config['create_thumb'] = false;
									$config['maintain_ratio'] = false;
									$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/listing/'.$upload_data['file_name'];
									$config['width']   = 248;
									$config['height']  = 146;
								
									$this->image_lib->initialize($config);
									$this->image_lib->resize();
									$this->image_lib->clear();
									
									
									$config['image_library'] = 'gd2';
									$config['source_image'] = $upload_data['full_path'];
									$config['create_thumb'] = false;
									$config['maintain_ratio'] = false;
									$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/detail/'.$upload_data['file_name'];
									$config['width']   = 400;
									$config['height']  = 236;
								
									$this->image_lib->initialize($config);
									$this->image_lib->resize();
									$this->image_lib->clear();
									
								}
					}
					##
					if ($_FILES['image_banner']['name'] == '') {
				       $error_msg = "Need Banner Image.";
                    }
                   elseif($_FILES['image_banner']['tmp_name']!=''){
				  if ($this->all_function->check_image_valid($_FILES['image_banner']['tmp_name'])!=1){
					  $error_msg = "Invalid Banner Image.";  
				  }else{
					        $config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/banner/original/';
							$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
							$config['remove_spaces'] = TRUE;
							$this->upload->initialize($config);
								if ($this->upload->do_upload('image_banner'))
								{ 
									$upload_data = $this->upload->data();
									$image_banner=$upload_data['file_name'];
									
									$config['image_library'] = 'gd2';
									$config['source_image'] = $upload_data['full_path'];
									$config['create_thumb'] = false;
									$config['maintain_ratio'] = false;
									$config['new_image']=MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/banner/thumb/'.$upload_data['file_name'];
									$config['width']         = 1400;
									$config['height']       = 350;
								
									$this->image_lib->initialize($config);
									$this->image_lib->resize();
									$this->image_lib->clear();
								}
					}
				  
				  }
					
					##
					
			  if ($error_msg != '') {       
					$data_msg['error_msg'] = $error_msg;
					$this->view('svcaevent/add_svcaevent', $data_msg);
                }else {
			  $promo_code=uniqid('SVCA');
			  $data = array(					
						'title' => $post_data['title'],
						'promo_code' => $promo_code,
						'image_name' => $image_name,
						'image_banner' => $image_banner,
						'registration_date'=> $post_data['registration_date'],
                        'start_date'=> $post_data['start_date'],
						'end_date'=> $post_data['end_date'],
						'last_payment_date'=> $post_data['last_payment_date'],
						'event_time'=> $post_data['event_time'],
						'venue'=> $post_data['venue'],
						'for_member'=>isset($post_data['for_member'])?$post_data['for_member']:'N',
						'contact'=> $post_data['contact'],
						'description'=> $post_data['description'],
						'programme'=> $post_data['programme'],
						'max_no_registrant_full'=> $post_data['max_no_registrant_full'],
						'max_no_registrant_associate'=> $post_data['max_no_registrant_associate'],
						'max_no_registrant_individual'=> $post_data['max_no_registrant_individual'],
						'max_no_registrant_partner'=> $post_data['max_no_registrant_partner'],
						'max_no_registrant_visitor'=> $post_data['max_no_registrant_visitor'],
						'fee_ist_registrant_full'=> $post_data['fee_ist_registrant_full'],
						'fee_ist_registrant_associate'=> $post_data['fee_ist_registrant_associate'],
						'fee_ist_registrant_individual'=> $post_data['fee_ist_registrant_individual'],
						'fee_ist_registrant_partner'=> $post_data['fee_ist_registrant_partner'],
						'fee_ist_registrant_visitor'=> $post_data['fee_ist_registrant_visitor'],
						'fee_subsequent_registrant_full'=> $post_data['fee_subsequent_registrant_full'],
						'fee_subsequent_registrant_associate'=> $post_data['fee_subsequent_registrant_associate'],
						'fee_subsequent_registrant_individual'=> $post_data['fee_subsequent_registrant_individual'],
						'fee_subsequent_registrant_partner'=> $post_data['fee_subsequent_registrant_partner'],
						'fee_subsequent_registrant_visitor'=> $post_data['fee_subsequent_registrant_visitor'],
						'epayment_allowed_full'=>isset($post_data['epayment_allowed_full'])?$post_data['epayment_allowed_full']:'N',
						'epayment_allowed_associate'=>isset($post_data['epayment_allowed_associate'])?$post_data['epayment_allowed_associate']:'N',
						'epayment_allowed_individual'=>isset($post_data['epayment_allowed_individual'])?$post_data['epayment_allowed_individual']:'N',
						'epayment_allowed_partner'=>isset($post_data['epayment_allowed_partner'])?$post_data['epayment_allowed_partner']:'N',
						'epayment_allowed_visitor'=>isset($post_data['epayment_allowed_visitor'])?$post_data['epayment_allowed_visitor']:'N',
						'max_no_registrant_company_full'=> $post_data['max_no_registrant_company_full'],
						'max_no_registrant_company_associate'=> $post_data['max_no_registrant_company_associate'],
						'max_no_registrant_company_individual'=> $post_data['max_no_registrant_company_individual'],
						'seo_url' => $post_data['seo_url'],
						'seo_keyword' => $post_data['seo_keyword'],
						'seo_description' => $post_data['seo_description'],
						'seo_title' => $post_data['seo_title'],
						//'sort_order' => $post_data['sort_order'],
						'create_date' => date('Y-m-d H:i:s'),
						'status' => $post_data['status'],
						'modified_date' => date('Y-m-d H:i:s')
                    );
					 
                    $event_id = $this->Svcaevent_model->add_svcaevent($data);
					
					##
					$im_nm='';$cnt=0;
					$pdf_title=$this->input->post('pdf_title');
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/pdf/';
                	$config['allowed_types']        = 'pdf|PDF';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
					$number_of_files = sizeof($_FILES['pdf_name']['tmp_name']);
					$files = $_FILES['pdf_name'];
					for ($k = 0; $k < $number_of_files; $k++)
				    {
						$_FILES['pdf_name']['name'] = $files['name'][$k];
						$_FILES['pdf_name']['type'] = $files['type'][$k];
						$_FILES['pdf_name']['tmp_name'] = $files['tmp_name'][$k];
						$_FILES['pdf_name']['error'] = $files['error'][$k];
						$_FILES['pdf_name']['size'] = $files['size'][$k];
						
						if ($this->upload->do_upload('pdf_name'))
				        { $cnt++;
							$upload_data = $this->upload->data();
							$im_nm=$upload_data['file_name'];
							$path_parts = pathinfo($im_nm);

							
								$data_to_store = array(
								'event_id' => $event_id,
								'title' => !empty($pdf_title[$k])?$pdf_title[$k]:$path_parts['filename'],
								'pdf_name' => $im_nm,
								'sort_order' => $cnt
								);
								$this->db->insert(TBL_EVENTS_PDF, $data_to_store);
							
							
					    }
						
					}
					##
					
					
					
					
					
                $this->session->set_flashdata('success_msg', 'Successfully added');
            	redirect(base_url("manage-svcaevent"));
				}
        	}
		}else{		
        	$this->view('svcaevent/add_svcaevent', $data_msg);
		}
    }
	
	public function del_svcaevent($id) {
		
        $data_msg = array();
		
		$details = $this->Svcaevent_model->get_svcaevent_details($id)->result_array();
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/original/'.$details[0]['image_name'];
		 if(is_file($file)){unlink($file); } 
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/detail/'.$details[0]['image_name'];
		 if(is_file($file)){unlink($file); }
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/listing/'.$details[0]['image_name'];
		 if(is_file($file)){unlink($file); }
		 
		 
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/banner/original/'.$details[0]['image_banner'];
		 if(is_file($file)){unlink($file); } 
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/banner/thumb/'.$details[0]['image_banner'];
		 if(is_file($file)){unlink($file); }
		  
		$this->Svcaevent_model->del_svcaevent($id);
		
		$chk=$this->Svcaevent_model->get_additional_pdf_file($id)->result_array();
		foreach($chk as $val){
			 $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/pdf/'.$val['pdf_name'];
		     if(is_file($file)){unlink($file); } 
		}
		$this->Svcaevent_model->del_event_pdf($id);
					
						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');
		
		redirect(base_url("manage-svcaevent"));
       
    }
	
	public function edit_svcaevent($id){
		
        $data_msg = array();

        $data_msg['meta_title'] = "Edit SVCA Event";
		
		
		$data_msg['pdf'] = $this->Svcaevent_model->get_additional_pdf_file($id)->result_array();
		
		
		
		$this->load->library('form_validation');
		
		
		$config = array(
               array(
				 'field'   => 'title',
				 'label'   => 'Event Name',
				 'rules'   => 'required'
				),
				array(
                     'field'   => 'seo_url',
                     'label'   => 'Url',
                     'rules'   => 'trim|required|callback_edit_unique['.TBL_EVENTS.'.seo_url.'.$id.']'
                  ),
				  array(
                     'field'   => 'description',
                     'label'   => 'Description',
                     'rules'   => 'required'
                  ), 
				 array(
                     'field'   => 'registration_date',
                     'label'   => 'Registration End Date',
                     'rules'   => 'required'
                  ),
				 array(
                     'field'   => 'start_date',
                     'label'   => 'Event Start Date',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'end_date',
                     'label'   => 'Event End Date',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'last_payment_date',
                     'label'   => 'Last Payment Date',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'event_time',
                     'label'   => 'Event Time',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'venue',
                     'label'   => 'Event Venue',
                     'rules'   => 'required'
                  ),
				array(
				 'field'   => 'status',
				 'label'   => 'Status',
				 'rules'   => 'required'
				)/*,
				array(
				 'field'   => 'sort_order',
				 'label'   => 'Sort Order',
				 'rules'   => 'numeric'
				)*/ 
            );

		$this->form_validation->set_rules($config);
		
		$get_result = $this->Svcaevent_model->get_svcaevent_details($id);
		$details = $get_result->result_array();
        if (count($details) == 0) {			
				redirect(base_url("manage-svcaevent"));
        }
		$data_msg['details'] = $details;
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{	
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('svcaevent/edit_svcaevent', $data_msg);
			}else {           
             $post_data = $_POST;$error_msg = '';
			  $image_name=$post_data['image_name_old'];
			  $image_banner=$post_data['image_banner_old'];
					##
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/original/';
                	$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
						if($this->upload->do_upload('image_name'))
				        { 
						
						   $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/original/'.$image_name;
		 				   if(is_file($file)){unlink($file); } 
		 				   $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/listing/'.$image_name;
		                   if(is_file($file)){unlink($file); }
						   $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/detail/'.$image_name;
		                   if(is_file($file)){unlink($file); }
						
							$upload_data = $this->upload->data();
							$image_name=$upload_data['file_name'];
							
							        $config['image_library'] = 'gd2';
									$config['source_image'] = $upload_data['full_path'];
									$config['create_thumb'] = false;
									$config['maintain_ratio'] = false;
									$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/listing/'.$upload_data['file_name'];
									$config['width']   = 248;
									$config['height']  = 146;
								
									$this->image_lib->initialize($config);
									$this->image_lib->resize();
									$this->image_lib->clear();
									
									
									$config['image_library'] = 'gd2';
									$config['source_image'] = $upload_data['full_path'];
									$config['create_thumb'] = false;
									$config['maintain_ratio'] = false;
									$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/detail/'.$upload_data['file_name'];
									$config['width']   = 400;
									$config['height']  = 236;
								
									$this->image_lib->initialize($config);
									$this->image_lib->resize();
									$this->image_lib->clear();
					    }
					##
					
					        $config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/banner/original/';
							$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
							$config['remove_spaces'] = TRUE;
							$this->upload->initialize($config);
								if ($this->upload->do_upload('image_banner'))
								{ 
								
								    $file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/banner/original/'.$image_banner;
		 				   			if(is_file($file)){unlink($file); } 
		 				   			$file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/banner/thumb/'.$image_banner;
		                   			if(is_file($file)){unlink($file); }
								
									$upload_data = $this->upload->data();
									$image_banner=$upload_data['file_name'];
									
									$config['image_library'] = 'gd2';
									$config['source_image'] = $upload_data['full_path'];
									$config['create_thumb'] = false;
									$config['maintain_ratio'] = false;
									$config['new_image']=MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/banner/thumb/'.$upload_data['file_name'];
									$config['width']         = 1400;
									$config['height']       = 350;
								
									$this->image_lib->initialize($config);
									$this->image_lib->resize();
									$this->image_lib->clear();
								}
					
					##
			 if ($error_msg != '') {       
                $data_msg['error_msg'] = $error_msg;
				$this->view('svcaevent/edit_svcaevent', $data_msg);
            }else{
			  $data = array(					
						'title' => $post_data['title'],
						'image_name' => $image_name,
						'image_banner' => $image_banner,
						'registration_date'=> $post_data['registration_date'],
                        'start_date'=> $post_data['start_date'],
						'end_date'=> $post_data['end_date'],
						'last_payment_date'=> $post_data['last_payment_date'],
						'event_time'=> $post_data['event_time'],
						'venue'=> $post_data['venue'],
						'for_member'=>isset($post_data['for_member'])?$post_data['for_member']:'N',
						'contact'=> $post_data['contact'],
						'description'=> $post_data['description'],
						'programme'=> $post_data['programme'],
						'max_no_registrant_full'=> $post_data['max_no_registrant_full'],
						'max_no_registrant_associate'=> $post_data['max_no_registrant_associate'],
						'max_no_registrant_individual'=> $post_data['max_no_registrant_individual'],
						'max_no_registrant_partner'=> $post_data['max_no_registrant_partner'],
						'max_no_registrant_visitor'=> $post_data['max_no_registrant_visitor'],
						'fee_ist_registrant_full'=> $post_data['fee_ist_registrant_full'],
						'fee_ist_registrant_associate'=> $post_data['fee_ist_registrant_associate'],
						'fee_ist_registrant_individual'=> $post_data['fee_ist_registrant_individual'],
						'fee_ist_registrant_partner'=> $post_data['fee_ist_registrant_partner'],
						'fee_ist_registrant_visitor'=> $post_data['fee_ist_registrant_visitor'],
						'fee_subsequent_registrant_full'=> $post_data['fee_subsequent_registrant_full'],
						'fee_subsequent_registrant_associate'=> $post_data['fee_subsequent_registrant_associate'],
						'fee_subsequent_registrant_individual'=> $post_data['fee_subsequent_registrant_individual'],
						'fee_subsequent_registrant_partner'=> $post_data['fee_subsequent_registrant_partner'],
						'fee_subsequent_registrant_visitor'=> $post_data['fee_subsequent_registrant_visitor'],
						'epayment_allowed_full'=>isset($post_data['epayment_allowed_full'])?$post_data['epayment_allowed_full']:'N',
						'epayment_allowed_associate'=>isset($post_data['epayment_allowed_associate'])?$post_data['epayment_allowed_associate']:'N',
						'epayment_allowed_individual'=>isset($post_data['epayment_allowed_individual'])?$post_data['epayment_allowed_individual']:'N',
						'epayment_allowed_partner'=>isset($post_data['epayment_allowed_partner'])?$post_data['epayment_allowed_partner']:'N',
						'epayment_allowed_visitor'=>isset($post_data['epayment_allowed_visitor'])?$post_data['epayment_allowed_visitor']:'N',
						'max_no_registrant_company_full'=> $post_data['max_no_registrant_company_full'],
						'max_no_registrant_company_associate'=> $post_data['max_no_registrant_company_associate'],
						'max_no_registrant_company_individual'=> $post_data['max_no_registrant_company_individual'],
						'seo_url' => $post_data['seo_url'],
						'seo_keyword' => $post_data['seo_keyword'],
						'seo_description' => $post_data['seo_description'],
						'seo_title' => $post_data['seo_title'],
						//'sort_order' => $post_data['sort_order'],
						'status' => $post_data['status'],
						'modified_date' => date('Y-m-d H:i:s')
                    );		
				
				$this->Svcaevent_model->update_svcaevent($data,  $id);
				
				##
					$im_nm='';$cnt=0;
					$pdf_title=$this->input->post('pdf_title');
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/pdf/';
                	$config['allowed_types']        = 'pdf|PDF';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
					$number_of_files = sizeof($_FILES['pdf_name']['tmp_name']);
					$files = $_FILES['pdf_name'];
					for ($k = 0; $k < $number_of_files; $k++)
				    {
						$_FILES['pdf_name']['name'] = $files['name'][$k];
						$_FILES['pdf_name']['type'] = $files['type'][$k];
						$_FILES['pdf_name']['tmp_name'] = $files['tmp_name'][$k];
						$_FILES['pdf_name']['error'] = $files['error'][$k];
						$_FILES['pdf_name']['size'] = $files['size'][$k];
						
						if ($this->upload->do_upload('pdf_name'))
				        { $cnt++;
							$upload_data = $this->upload->data();
							$im_nm=$upload_data['file_name'];
							$path_parts = pathinfo($im_nm);

							
								$data_to_store = array(
								'event_id' => $id,
								'title' => !empty($pdf_title[$k])?$pdf_title[$k]:$path_parts['filename'],
								'pdf_name' => $im_nm,
								'sort_order' => $cnt
								);
								$this->db->insert(TBL_EVENTS_PDF, $data_to_store);
							
							
					    }
						
					}
					##
				
				
				
                $this->session->set_flashdata('success_msg', 'Successfully updated.');				
				redirect(base_url("edit-svcaevent/$id")); 
			 
			 
			 
			}
        	}
		}else{
			$this->view('svcaevent/edit_svcaevent', $data_msg);
		}
    }
	
	
	
	public function deletepdf(){
        $id = $this->input->post('id');
		
        $cms=$this->Svcaevent_model->get_event_pdf($id);
		$img=$cms['pdf_name'];
		
			$file = MAIN_SITE_AB_UPLOAD_PATH.'svcaevent/pdf/'.$img;
			if(is_file($file)){
			unlink($file); 
			} 
			
		
		$this->db->where('id', $id);
		$this->db->delete(TBL_EVENTS_PDF); 
		echo json_encode(array('id' =>$id));
		
    }
	
	
	
	public function edit_unique($value, $params)
	{
		
		$this->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");
        list($table, $field, $current_id) = explode(".", $params);
		$query = $this->db->select()->from($table)->where($field, $value)->limit(1)->get();
		
		if ($query->row() && $query->row()->id!= $current_id)
		{
		return FALSE;
		} else {
		return TRUE;
		}
		
	}

}