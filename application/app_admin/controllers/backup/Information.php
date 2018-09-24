<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class information extends MY_Controller {

    function __construct() {		
        parent::__construct();
        $this->load->model('Information_model', '', TRUE);
    }
	
	 public function manage_information() {
		
		$data_msg = array();		
        		
        $data_msg['meta_title'] = "Information Manager";
		
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
			$data_msg['total'] = $total_items = $this->Information_model->count_information_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-information'));
			$data_msg['display_result'] = $this->Information_model->get_information_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $details = $this->Information_model->get_information_details($del_id)->result_array();
				         
						 
						 $file = MAIN_SITE_AB_UPLOAD_PATH.'information/banner/original/'.$details[0]['image_banner'];
		 				 if(is_file($file)){unlink($file); } 
		 				 $file = MAIN_SITE_AB_UPLOAD_PATH.'information/banner/thumb/'.$details[0]['image_banner'];
		 				 if(is_file($file)){unlink($file); }
		 
		 				$file = MAIN_SITE_AB_UPLOAD_PATH.'information/original/'.$details[0]['image_name'];
		 				if(is_file($file)){unlink($file); } 
		 				$file = MAIN_SITE_AB_UPLOAD_PATH.'information/thumb/'.$details[0]['image_name'];
		 				if(is_file($file)){unlink($file); }
						 
						 
						  
				$this->Information_model->del_information($del_id);	
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-information'));
			  exit;
			  }else{redirect(base_url('manage-information'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Information_model->update_information($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-information'));
			  exit;
			  }else{redirect(base_url('manage-information'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Information_model->update_information($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-information'));
			  exit;
			  }else{redirect(base_url('manage-information'));exit;}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Information_model->count_information_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-information'));
			  $data_msg['display_result'] = $this->Information_model->get_information_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'name'=>'',
				'status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Information_model->count_information();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-information'));
        	$get_value = $this->Information_model->get_information($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
        $this->view('information/manage_information', $data_msg);
    }
	public function add_information() {
		
        $data_msg = array();

        $data_msg['meta_title'] = "Add Information";
		
		$this->load->library('form_validation');
		
		$config = array(
               array(
				 'field'   => 'name',
				 'label'   => 'Title',
				 'rules'   => 'required'
				),
				array(
                     'field'   => 'seo_url',
                     'label'   => 'Url',
                     'rules'   => 'trim|required|is_unique['.TBL_INFORMATION.'.seo_url]'
                  ), 
				array(
				 'field'   => 'descriptions',
				 'label'   => 'Descriptions',
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
				$this->view('information/add_information', $data_msg);
			}
			else {
              $post_data = $_POST; $error_msg = '';$im_bn='';
					##
					$this->load->library('upload');
					$this->load->library('image_lib');
					$im_nm='';
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'information/original/';
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
							$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'information/thumb/'.$upload_data['file_name'];
							$config['width']         = 266;
							$config['height']       = 90;
						
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
							$this->image_lib->clear();
					    }else{
							$upload_error= array('error' => $this->upload->display_errors()); 
							$error_msg=$upload_error['error'];
							
						}
						/*=================Banner=======================*/
						
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'information/banner/original/';
                	$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
						if ($this->upload->do_upload('image_banner'))
				        { 
							$upload_data = $this->upload->data();
							$im_bn=$upload_data['file_name'];
							
							$config['image_library'] = 'gd2';
							$config['source_image'] = $upload_data['full_path'];
							$config['create_thumb'] = false;
							$config['maintain_ratio'] = false;
							$config['new_image']=MAIN_SITE_AB_UPLOAD_PATH.'information/banner/thumb/'.$upload_data['file_name'];
							$config['width']         = 1400;
							$config['height']       = 251;
						
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
							$this->image_lib->clear();
					    }else{
							$upload_error= array('error' => $this->upload->display_errors()); 
							$error_msg=$upload_error['error'];
							
						}
					##
					
			  if ($error_msg != '') {       
					$data_msg['error_msg'] = $error_msg;
					$this->view('information/add_information', $data_msg);
                }else {
			  
			  $data = array(					
						'name' => $post_data['name'],
						'image_name' => $im_nm,
						'image_banner' => $im_bn,
						'descriptions' => $post_data['descriptions'],
						'sort_order' => $post_data['sort_order'],
						'seo_url' => $post_data['seo_url'],
						'seo_keyword' => $post_data['seo_keyword'],
						'seo_description' => $post_data['seo_description'],
						'seo_title' => $post_data['seo_title'],
						'create_date' => date('Y-m-d H:i:s'),
						'status' => $post_data['status']
                    ); 
                    $page_id = $this->Information_model->add_information($data);
					
                $this->session->set_flashdata('success_msg', 'Successfully added');
            	redirect(base_url("manage-information"));
				}
        	}
		}else{		
        	$this->view('information/add_information', $data_msg);
		}
    }
	
	public function del_information($id) {
		
        $data_msg = array();
		
		$details = $this->Information_model->get_information_details($id)->result_array();
		
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'information/banner/original/'.$details[0]['image_banner'];
		 if(is_file($file)){unlink($file); } 
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'information/banner/thumb/'.$details[0]['image_banner'];
		 if(is_file($file)){unlink($file); }
		 
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'information/original/'.$details[0]['image_name'];
		 if(is_file($file)){unlink($file); } 
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'information/thumb/'.$details[0]['image_name'];
		 if(is_file($file)){unlink($file); }
		 
		  
		
		$this->Information_model->del_information($id);			
						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');
		
		redirect(base_url("manage-information"));
       
    }
	
	public function edit_information($id){
		
        $data_msg = array();

        $data_msg['meta_title'] = "Edit information";
		
		$this->load->library('form_validation');
		
		$config = array(
               array(
				 'field'   => 'name',
				 'label'   => 'Title',
				 'rules'   => 'required'
				),
				array(
                     'field'   => 'seo_url',
                     'label'   => 'Url',
                     'rules'   => 'trim|required|callback_edit_unique['.TBL_INFORMATION.'.seo_url.'.$id.']'
                  ), 
				array(
				 'field'   => 'descriptions',
				 'label'   => 'Descriptions',
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
		
		$get_result = $this->Information_model->get_information_details($id);
		$details = $get_result->result_array();
        if (count($details) == 0) {			
				redirect(base_url("manage-information"));
        }
		$data_msg['details'] = $details;
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{	
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('information/edit_information', $data_msg);
			}else {           
             $post_data = $_POST;$error_msg = '';
			  $image_name=$post_data['old_image_name'];
			  $image_banner=$post_data['old_image_banner'];
					##
					$this->load->library('upload');
					$this->load->library('image_lib');
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'information/original/';
                	$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
						if($this->upload->do_upload('image_name'))
				        { 
						
						   $file = MAIN_SITE_AB_UPLOAD_PATH.'information/original/'.$image_name;
		 				   if(is_file($file)){unlink($file); } 
		 				   $file = MAIN_SITE_AB_UPLOAD_PATH.'information/thumb/'.$image_name;
		                   if(is_file($file)){unlink($file); }
						
							$upload_data = $this->upload->data();
							$image_name=$upload_data['file_name'];
							
							$config['image_library'] = 'gd2';
							$config['source_image'] = $upload_data['full_path'];
							$config['create_thumb'] = false;
							$config['maintain_ratio'] = false;
							$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'information/thumb/'.$upload_data['file_name'];
							$config['width']         = 266;
							$config['height']       = 90;
						
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
							$this->image_lib->clear();
					    }
						/*=================Banner=======================*/
						
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'information/banner/original/';
                	$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
						if ($this->upload->do_upload('image_banner'))
				        { 
						
						$file = MAIN_SITE_AB_UPLOAD_PATH.'information/banner/original/'.$image_banner;
		 				if(is_file($file)){unlink($file); } 
		 				$file = MAIN_SITE_AB_UPLOAD_PATH.'information/banner/thumb/'.$image_banner;
		 				if(is_file($file)){unlink($file); }
						
						
							$upload_data = $this->upload->data();
							$image_banner=$upload_data['file_name'];
							
							$config['image_library'] = 'gd2';
							$config['source_image'] = $upload_data['full_path'];
							$config['create_thumb'] = false;
							$config['maintain_ratio'] = false;
							$config['new_image']=MAIN_SITE_AB_UPLOAD_PATH.'information/banner/thumb/'.$upload_data['file_name'];
							$config['width']         = 1400;
							$config['height']       = 251;
						
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
							$this->image_lib->clear();
					    }
					##
					
					
					
					
					
				   
			 
			 if ($error_msg != '') {       
                $data_msg['error_msg'] = $error_msg;
				$this->view('information/edit_information', $data_msg);
            }else{
             $data = array(					
						'name' => $post_data['name'],
						'image_name' => $image_name,
						'image_banner' => $image_banner,
						'descriptions' => $post_data['descriptions'],
						'sort_order' => $post_data['sort_order'],
						'seo_url' => $post_data['seo_url'],
						'seo_keyword' => $post_data['seo_keyword'],
						'seo_description' => $post_data['seo_description'],
						'seo_title' => $post_data['seo_title'],
						'status' => $post_data['status']
                    );
				
				$this->Information_model->update_information($data,  $id);
                $this->session->set_flashdata('success_msg', 'Successfully updated.');				
				redirect(base_url("edit-information/$id")); 
			 
			 
			 
			}
        	}
		}else{
			$this->view('information/edit_information', $data_msg);
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