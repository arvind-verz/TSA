<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Publications extends MY_Controller {

    function __construct() {		
        parent::__construct();
        $this->load->model('Publications_model', '', TRUE);
    }
	
	 public function manage_publications(){
		
		$data_msg = array();		
        		
        $data_msg['meta_title'] = "Publications Manager";
		
		
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
			$data_msg['total'] = $total_items = $this->Publications_model->count_publications_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-publications'));
			$data_msg['display_result'] = $this->Publications_model->get_publications_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $details = $this->Publications_model->get_publications_details($del_id)->result_array();
				  
						 $file = MAIN_SITE_AB_UPLOAD_PATH.'publications/banner/original/'.$details[0]['image_banner'];
		 				 if(is_file($file)){unlink($file); } 
		 				 $file = MAIN_SITE_AB_UPLOAD_PATH.'publications/banner/thumb/'.$details[0]['image_banner'];
		 				 if(is_file($file)){unlink($file); }
		 
		 				$file = MAIN_SITE_AB_UPLOAD_PATH.'publications/original/'.$details[0]['image_name'];
		 				if(is_file($file)){unlink($file); } 
		 				$file = MAIN_SITE_AB_UPLOAD_PATH.'publications/thumb/'.$details[0]['image_name'];
		 				if(is_file($file)){unlink($file); }
				  
				  
				$this->Publications_model->del_publications($del_id);	
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-publications'));
			  exit;
			  }else{redirect(base_url('manage-publications'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Publications_model->update_publications($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-publications'));
			  exit;
			  }else{redirect(base_url('manage-publications'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Publications_model->update_publications($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-publications'));
			  exit;
			  }else{redirect(base_url('manage-publications'));exit;}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Publications_model->count_publications_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-publications'));
			  $data_msg['display_result'] = $this->Publications_model->get_publications_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'name'=>'',
				'status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Publications_model->count_publications();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-publications'));
        	$get_value = $this->Publications_model->get_publications($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
        $this->view('publications/manage_publications', $data_msg);
    }
	public function add_publications() {
		
        $data_msg = array();

        $data_msg['meta_title'] = "Add Publications";
		
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
                     'rules'   => 'trim|required|is_unique['.TBL_PUBLICATIONS.'.seo_url]'
                  ),
				array(
				 'field'   => 'short_descriptions',
				 'label'   => 'Short Description',
				 'rules'   => 'required'
				),
				array(
				 'field'   => 'descriptions',
				 'label'   => 'Description',
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
				$this->view('publications/add_publications', $data_msg);
			}
			else {
              $post_data = $_POST; $error_msg = '';$im_bn='';
				if ($_FILES['image_name']['name'] == '') {$error_msg = 'Need Image.';}
				else{
					
							$this->load->library('upload');
							$this->load->library('image_lib');
							$im_nm='';
							$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'publications/original/';
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
									$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'publications/thumb/'.$upload_data['file_name'];
									$config['width']         = 170;
									$config['height']       = 245;
								
									$this->image_lib->initialize($config);
									$this->image_lib->resize();
									$this->image_lib->clear();
								}else{
									$upload_error= array('error' => $this->upload->display_errors()); 
									$error_msg=$upload_error['error'];
									
								}
					
					
				}
				
				if ($_FILES['image_banner']['name'] != ''){
					
							//$this->load->library('upload');
							//$this->load->library('image_lib');
							$im_bn='';
							$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'publications/banner/original/';
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
									$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'publications/banner/thumb/'.$upload_data['file_name'];
									$config['width']         = 1400;
									$config['height']       = 350;
								
									$this->image_lib->initialize($config);
									$this->image_lib->resize();
									$this->image_lib->clear();
								}else{
									$upload_error= array('error' => $this->upload->display_errors()); 
									$error_msg=$upload_error['error'];
									
								}
					
					
				}else{$im_bn = '';}
				
				
				
					
			  if ($error_msg != '') {       
					$data_msg['error_msg'] = $error_msg;
					$this->view('publications/add_publications', $data_msg);
                }else {
			  
			  $data = array(					
						'name' => $post_data['name'],
						'image_name' => $im_nm,
						'image_banner' => $im_bn,
						'descriptions' => $post_data['descriptions'],
						'short_descriptions' => $post_data['short_descriptions'],
						'sort_order' => $post_data['sort_order'],
						'seo_url' => $post_data['seo_url'],
						'seo_keyword' => $post_data['seo_keyword'],
						'seo_description' => $post_data['seo_description'],
						'seo_title' => $post_data['seo_title'],
						'create_date' => date('Y-m-d H:i:s'),
						'status' => $post_data['status']
                    );
                    $page_id = $this->Publications_model->add_publications($data);
					
                $this->session->set_flashdata('success_msg', 'Successfully added');
            	redirect(base_url("manage-publications"));
				}
        	}
		}else{		
        	$this->view('publications/add_publications', $data_msg);
		}
    }
	
	public function del_publications($id) {
		
        $data_msg = array();
		
		$details = $this->Publications_model->get_publications_details($id)->result_array();
		
		
		 
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'publications/banner/original/'.$details[0]['image_banner'];
		 if(is_file($file)){unlink($file); } 
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'publications/banner/thumb/'.$details[0]['image_banner'];
		 if(is_file($file)){unlink($file); }
		 
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'publications/original/'.$details[0]['image_name'];
		 if(is_file($file)){unlink($file); } 
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'publications/thumb/'.$details[0]['image_name'];
		 if(is_file($file)){unlink($file); }
		 
		 
		
		
		$this->Publications_model->del_publications($id);			
						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');
		
		redirect(base_url("manage-publications"));
       
    }
	
	public function edit_publications($id){
		
        $data_msg = array();

        $data_msg['meta_title'] = "Edit Publications";
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
                     'rules'   => 'trim|required|callback_edit_unique['.TBL_PUBLICATIONS.'.seo_url.'.$id.']'
                  ),
				array(
				 'field'   => 'short_descriptions',
				 'label'   => 'Short Description',
				 'rules'   => 'required'
				),
				array(
				 'field'   => 'descriptions',
				 'label'   => 'Description',
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
		
		$get_result = $this->Publications_model->get_publications_details($id);
		$details = $get_result->result_array();
        if (count($details) == 0) {			
				redirect(base_url("manage-publications"));
        }
		$data_msg['details'] = $details;
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{	
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('publications/edit_publications', $data_msg);
			}else {           
             $post_data = $_POST;$error_msg = '';
			$image_name=$post_data['old_image_name'];
			$image_banner=$post_data['old_image_banner'];
			##
					$this->load->library('upload');
					$this->load->library('image_lib');
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'publications/original/';
                	$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
						if($this->upload->do_upload('image_name'))
				        { 
						
						   $file = MAIN_SITE_AB_UPLOAD_PATH.'publications/original/'.$image_name;
		 				   if(is_file($file)){unlink($file); } 
		 				   $file = MAIN_SITE_AB_UPLOAD_PATH.'publications/thumb/'.$image_name;
		                   if(is_file($file)){unlink($file); }
						
							$upload_data = $this->upload->data();
							$image_name=$upload_data['file_name'];
							
							$config['image_library'] = 'gd2';
							$config['source_image'] = $upload_data['full_path'];
							$config['create_thumb'] = false;
							$config['maintain_ratio'] = false;
							$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'publications/thumb/'.$upload_data['file_name'];
							$config['width']         = 170;
							$config['height']       = 245;
						
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
							$this->image_lib->clear();
					    }
					/*=================Banner=======================*/	
						
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'publications/banner/original/';
                	$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
						if ($this->upload->do_upload('image_banner'))
				        { 
						
						$file = MAIN_SITE_AB_UPLOAD_PATH.'publications/banner/original/'.$image_banner;
		 				if(is_file($file)){unlink($file); } 
		 				$file = MAIN_SITE_AB_UPLOAD_PATH.'publications/banner/thumb/'.$image_banner;
		 				if(is_file($file)){unlink($file); }
						
						
							$upload_data = $this->upload->data();
							$image_banner=$upload_data['file_name'];
							
							$config['image_library'] = 'gd2';
							$config['source_image'] = $upload_data['full_path'];
							$config['create_thumb'] = false;
							$config['maintain_ratio'] = false;
							$config['new_image']=MAIN_SITE_AB_UPLOAD_PATH.'publications/banner/thumb/'.$upload_data['file_name'];
							$config['width']         = 1400;
							$config['height']       = 350;
						
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
							$this->image_lib->clear();
					    }
						
						
					##
			
			
			
				  
			 
			 if ($error_msg != '') {       
                $data_msg['error_msg'] = $error_msg;
				$this->view('publications/edit_publications', $data_msg);
            }else{
             $data = array(					
						'name' => $post_data['name'],
						'image_name' => $image_name,
						'image_banner' => $image_banner,
						'short_descriptions' => $post_data['short_descriptions'],
						'descriptions' => $post_data['descriptions'],
						'sort_order' => $post_data['sort_order'],
						'seo_url' => $post_data['seo_url'],
						'seo_keyword' => $post_data['seo_keyword'],
						'seo_description' => $post_data['seo_description'],
						'seo_title' => $post_data['seo_title'],
						'status' => $post_data['status']
                    );
				
				$this->Publications_model->update_publications($data,  $id);
                $this->session->set_flashdata('success_msg', 'Successfully updated.');				
				redirect(base_url("edit-publications/$id")); 
			 
			}
        	}
		}else{
			$this->view('publications/edit_publications', $data_msg);
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