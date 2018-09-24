<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Toolkit extends MY_Controller {

    function __construct() {		
        parent::__construct();
        $this->load->model('Toolkit_model', '', TRUE);
    }
	
	 public function manage_toolkit() {
		
		$data_msg = array();		
        		
        $data_msg['meta_title'] = "Toolkit Manager";
		
		
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
			$data_msg['total'] = $total_items = $this->Toolkit_model->count_toolkit_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-toolkit'));
			$data_msg['display_result'] = $this->Toolkit_model->get_toolkit_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $details = $this->Toolkit_model->get_toolkit_details($del_id)->result_array();
				  
						 $file = MAIN_SITE_AB_UPLOAD_PATH.'toolkit/pdf/'.$details[0]['pdf_name'];
		                 if(is_file($file)){unlink($file); } 
		 
		 				$file = MAIN_SITE_AB_UPLOAD_PATH.'toolkit/original/'.$details[0]['image_name'];
		 				if(is_file($file)){unlink($file); } 
		 				$file = MAIN_SITE_AB_UPLOAD_PATH.'toolkit/thumb/'.$details[0]['image_name'];
		 				if(is_file($file)){unlink($file); }
				  
				  
				$this->Toolkit_model->del_toolkit($del_id);	
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-toolkit'));
			  exit;
			  }else{redirect(base_url('manage-toolkit'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Toolkit_model->update_toolkit($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-toolkit'));
			  exit;
			  }else{redirect(base_url('manage-toolkit'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Toolkit_model->update_toolkit($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-toolkit'));
			  exit;
			  }else{redirect(base_url('manage-toolkit'));exit;}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Toolkit_model->count_toolkit_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-toolkit'));
			  $data_msg['display_result'] = $this->Toolkit_model->get_toolkit_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'name'=>'',
				'status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Toolkit_model->count_toolkit();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-toolkit'));
        	$get_value = $this->Toolkit_model->get_toolkit($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
        $this->view('toolkit/manage_toolkit', $data_msg);
    }
	public function add_toolkit() {
		
        $data_msg = array();

        $data_msg['meta_title'] = "Add Toolkit";
		
		
		
		$this->load->library('form_validation');
		
		$config = array(
               array(
				 'field'   => 'name',
				 'label'   => 'Title',
				 'rules'   => 'required'
				),
				array(
                     'field'   => 'post_date',
                     'label'   => 'Post Date',
                     'rules'   => 'required'
                  ), 
				array(
				 'field'   => 'status',
				 'label'   => 'Status',
				 'rules'   => 'required'
				),
				array(
				 'field'   => 'sort_order',
				 'label'   => 'Sort Order',
				 'rules'   => 'numeric'
				) 
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('toolkit/add_toolkit', $data_msg);
			}
			else {
              $post_data = $_POST; $error_msg = '';$im_bn='';
				
					
							$this->load->library('upload');
							$this->load->library('image_lib');
							$im_nm='';
							$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'toolkit/original/';
							$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
							$config['remove_spaces'] = TRUE;
							$this->upload->initialize($config);
								if ($this->upload->do_upload('image_name'))
								{ 
									$upload_data = $this->upload->data();
									$im_nm=$upload_data['file_name'];
									
									$config['image_library'] = 'gd2';
									$config['source_image'] = $upload_data['full_path'];
									$config['create_thumb'] = false;
									$config['maintain_ratio'] = false;
									$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'toolkit/thumb/'.$upload_data['file_name'];
									$config['width']         = 72;
									$config['height']       = 106;
								
									$this->image_lib->initialize($config);
									$this->image_lib->resize();
									$this->image_lib->clear();
								}
					
					
				
				
				if ($_FILES['pdf_name']['name'] == '') {$error_msg = 'Need PDF.';}
				else{
					
							
							$pdf_name='';
							$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'toolkit/pdf/';
							$config['allowed_types']        = 'pdf|PDF';
							$config['remove_spaces'] = TRUE;
							$this->upload->initialize($config);
								if ($this->upload->do_upload('pdf_name'))
								{ 
									$upload_data = $this->upload->data();
									$pdf_name=$upload_data['file_name'];
									
									
								}else{
									$upload_error= array('error' => $this->upload->display_errors()); 
									$error_msg=$upload_error['error'];
									
								}
					
					
				}
				
				
				
					
			  if ($error_msg != '') {       
					$data_msg['error_msg'] = $error_msg;
					$this->view('toolkit/add_toolkit', $data_msg);
                }else {
					
					$post_date = str_replace("/", "-", $post_data['post_date']); 
					$post_date = date("Y-m-d", strtotime($post_date));
			  
			  $data = array(					
						'name' => $post_data['name'],
						'image_name' => $im_nm,
						'pdf_name' => $pdf_name,
						'post_date' => $post_date,
						'sort_order' => $post_data['sort_order'],
						'create_date' => date('Y-m-d H:i:s'),
						'status' => $post_data['status']
                    );
                    $page_id = $this->Toolkit_model->add_toolkit($data);
					
                $this->session->set_flashdata('success_msg', 'Successfully added');
            	redirect(base_url("manage-toolkit"));
				}
        	}
		}else{		
        	$this->view('toolkit/add_toolkit', $data_msg);
		}
    }
	
	public function del_toolkit($id) {
		
        $data_msg = array();
		
		$details = $this->Toolkit_model->get_toolkit_details($id)->result_array();
		
		
		 
		  $file = MAIN_SITE_AB_UPLOAD_PATH.'toolkit/pdf/'.$details[0]['pdf_name'];
		 if(is_file($file)){unlink($file); } 
		 
		 
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'toolkit/original/'.$details[0]['image_name'];
		 if(is_file($file)){unlink($file); } 
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'toolkit/thumb/'.$details[0]['image_name'];
		 if(is_file($file)){unlink($file); }
		 
		 
		
		
		$this->Toolkit_model->del_toolkit($id);			
						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');
		
		redirect(base_url("manage-toolkit"));
       
    }
	
	public function edit_toolkit($id){
		
        $data_msg = array();

        $data_msg['meta_title'] = "Edit Directory";
		$this->load->library('form_validation');
		
		$config = array(
               array(
				 'field'   => 'name',
				 'label'   => 'Title',
				 'rules'   => 'required'
				), 
				array(
                     'field'   => 'post_date',
                     'label'   => 'Post Date',
                     'rules'   => 'required'
                  ), 
				array(
				 'field'   => 'status',
				 'label'   => 'Status',
				 'rules'   => 'required'
				),
				array(
				 'field'   => 'sort_order',
				 'label'   => 'Sort Order',
				 'rules'   => 'numeric'
				) 
            );

		$this->form_validation->set_rules($config);
		
		$get_result = $this->Toolkit_model->get_toolkit_details($id);
		$details = $get_result->result_array();
        if (count($details) == 0) {			
				redirect(base_url("manage-toolkit"));
        }
		$data_msg['details'] = $details;
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{	
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('toolkit/edit_toolkit', $data_msg);
			}else {           
             $post_data = $_POST;$error_msg = '';
			$image_name=$post_data['old_image_name'];
			$pdf_name=$post_data['old_pdf_name'];
			##
					$this->load->library('upload');
					$this->load->library('image_lib');
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'toolkit/original/';
                	$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
						if($this->upload->do_upload('image_name'))
				        { 
						
						   $file = MAIN_SITE_AB_UPLOAD_PATH.'toolkit/original/'.$image_name;
		 				   if(is_file($file)){unlink($file); } 
		 				   $file = MAIN_SITE_AB_UPLOAD_PATH.'toolkit/thumb/'.$image_name;
		                   if(is_file($file)){unlink($file); }
						
							$upload_data = $this->upload->data();
							$image_name=$upload_data['file_name'];
							
							$config['image_library'] = 'gd2';
							$config['source_image'] = $upload_data['full_path'];
							$config['create_thumb'] = false;
							$config['maintain_ratio'] = false;
							$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'toolkit/thumb/'.$upload_data['file_name'];
							$config['width']         = 72;
							$config['height']       = 106;
						
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
							$this->image_lib->clear();
					    }
					/*=================pdf=======================*/	
						
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'toolkit/pdf/';
                	$config['allowed_types']        = 'pdf|PDF';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
						if ($this->upload->do_upload('pdf_name'))
				        { 
						
						$file = MAIN_SITE_AB_UPLOAD_PATH.'toolkit/pdf/'.$pdf_name;
		 				if(is_file($file)){unlink($file); }
						 
							$upload_data = $this->upload->data();
							$pdf_name=$upload_data['file_name'];
							
							
					    }
						
						
					##
			
			
			
				  
			 
			 if ($error_msg != '') {       
                $data_msg['error_msg'] = $error_msg;
				$this->view('toolkit/edit_toolkit', $data_msg);
            }else{
				$post_date = str_replace("/", "-", $post_data['post_date']); 
				$post_date = date("Y-m-d", strtotime($post_date));
				
             $data = array(					
						'name' => $post_data['name'],
						'image_name' => $image_name,
						'pdf_name' => $pdf_name,
						'post_date' => $post_date,
						'sort_order' => $post_data['sort_order'],
						'create_date' => date('Y-m-d H:i:s'),
						'status' => $post_data['status']
                    );
				
				$this->Toolkit_model->update_toolkit($data,  $id);
                $this->session->set_flashdata('success_msg', 'Successfully updated.');				
				redirect(base_url("edit-toolkit/$id")); 
			 
			}
        	}
		}else{
			$this->view('toolkit/edit_toolkit', $data_msg);
		}
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