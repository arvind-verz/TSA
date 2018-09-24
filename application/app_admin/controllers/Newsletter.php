<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends MY_Controller {

    function __construct() {		
        parent::__construct();
		$this->load->model('Newsletter_model', '', TRUE);
		$this->load->helper("file");
		
		$this->load->library('upload');
		$this->load->library('image_lib');
    }

    public function manage_newsletter(){
		
		$data_msg = array();		
        
        $data_msg['meta_title'] = "Newsletter Manager";
		
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
			$data_msg['total'] = $total_items = $this->Newsletter_model->count_newsletter_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-newsletter'));
			$data_msg['display_result'] = $this->Newsletter_model->get_newsletter_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				$get_result = $this->Newsletter_model->get_newsletter_details($del_id);				
				$details = $get_result->result_array();			
				$file = MAIN_SITE_AB_UPLOAD_PATH.'newsletter/original/'.$details[0]['image_name'];				
				if(is_file($file)){ unlink($file); }
				$file = MAIN_SITE_AB_UPLOAD_PATH.'newsletter/thumb/'.$details[0]['image_name'];
				if(is_file($file)){unlink($file); }
				
				$file = MAIN_SITE_AB_UPLOAD_PATH.'newsletter/banner/original/'.$details[0]['image_banner'];				
				if(is_file($file)){ unlink($file); }
				$file = MAIN_SITE_AB_UPLOAD_PATH.'newsletter/banner/thumb/'.$details[0]['image_banner'];
				if(is_file($file)){unlink($file); }
				 				  
				$this->Newsletter_model->del_newsletter($del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-newsletter'));
			  exit;
			  }else{redirect(base_url('manage-newsletter'));}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Newsletter_model->update_newsletter($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-newsletter'));
			  exit;
			  }else{redirect(base_url('manage-newsletter'));}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Newsletter_model->update_newsletter($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-newsletter'));
			  exit;
			  }else{redirect(base_url('manage-newsletter'));}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Newsletter_model->count_newsletter_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-newsletter'));
			  $data_msg['display_result'] = $this->Newsletter_model->get_newsletter_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		  $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'title'=>'',							
				'post_date'=>'',
				'status'=>''											
				);
			$data_msg['FlterData'] = $FlterData;
			$total_items = $this->Newsletter_model->count_newsletter();
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-newsletter'));
			$get_value = $this->Newsletter_model->get_newsletter($items_per_page, $limit_from);
			$data_msg['display_result'] = $get_value->result_array();
		}		
        $this->view('newsletter/manage_newsletter', $data_msg);
    } //Validation
	
	public function add_newsletter() {
		
        $data_msg = array();

        $data_msg['meta_title'] = "Add newsletter";

        $this->load->library('form_validation');
		
		$config = array(
               array(
                     'field'   => 'title',
                     'label'   => 'Title',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'seo_url',
                     'label'   => 'Url',
                     'rules'   => 'trim|required|is_unique['.TBL_NEWSLETTER.'.seo_url]'
                  ),
				array(
                     'field'   => 'description',
                     'label'   => 'Description',
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
                  )
			   
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){				
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('newsletter/add_newsletter', $data_msg);
			}
			else{

            $post_data = $_POST; $error_msg = "";$image_banner='';$image_name='';
            
           	
              if($_FILES['image_name']['tmp_name']!=''){
				  
				        $config['upload_path'] = MAIN_SITE_AB_UPLOAD_PATH.'newsletter/original/';
                		$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
						$config['remove_spaces'] = TRUE;
						//$config['overwrite'] = TRUE;
						$this->upload->initialize($config);
						if ($this->upload->do_upload('image_name'))
				        {
							$upload_data = $this->upload->data();
							$image_name=$upload_data['file_name'];
							
							$config['image_library'] = 'gd2';
							$config['source_image'] = $upload_data['full_path'];
							$config['create_thumb'] = false;
							$config['maintain_ratio'] = FALSE;
							$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'newsletter/thumb/'.$upload_data['file_name'];
							$config['width']         = 248;
							$config['height']       = 146;
							
							$this->image_lib->initialize($config);
							
							$this->image_lib->resize();
							if (!$this->image_lib->resize()) {
								echo $this->image_lib->display_errors();
						    }
							$this->image_lib->clear();
							
						}
				  
				  }else{$error_msg = "Need newsletter Image.";}
				 
				 
				 ###
			 if($_FILES['image_banner']['tmp_name']!=''){
				  
				  if ($this->all_function->check_image_valid($_FILES['image_banner']['tmp_name'])!=1){
					  $error_msg = "Invalid newsletter Banner Image.";  
				  }else{
					        $config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'newsletter/banner/original/';
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
									$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'newsletter/banner/thumb/'.$upload_data['file_name'];
									$config['width']         = 1400;
									$config['height']       = 350;
								
									$this->image_lib->initialize($config);
									$this->image_lib->resize();
									$this->image_lib->clear();
								}else{
									$upload_error= array('error' => $this->upload->display_errors()); 
									$error_msg=$upload_error['error'];
									
								}
					}
				  
				  }else{$image_banner = '';}
				  ### 
				  
				   
			
            if ($error_msg != '') {    
                $data_msg['error_msg'] = $error_msg;
				$this->view('newsletter/add_newsletter', $data_msg);
            }else { 
					$post_date = str_replace("/", "-", $post_data['post_date']); 
					$post_date = date("Y-m-d", strtotime($post_date));
			
                    $data = array(
                        'title' => $post_data['title'],
						'description' => $post_data['description'],
						'image_banner' => $image_banner,
						'image_name' => $image_name,
						'post_date' => $post_date,
						'status' => $post_data['status'],
						'seo_url' => $post_data['seo_url'],
						'seo_title' => $post_data['seo_title'],
						'seo_keyword' => $post_data['seo_keyword'],
						'seo_description' => $post_data['seo_description'],
						'create_date' => date('Y-m-d H:i:s'),
						'modified_date' => date('Y-m-d H:i:s')
                    ); 
                    $this->Newsletter_model->add_newsletter($data);
                $this->session->set_flashdata('success_msg', 'Successfully added');
				redirect(base_url("manage-newsletter"));
            }

            
        	}
		}else{
        	$this->view('newsletter/add_newsletter', $data_msg);
		}
    } //Validation
		
	public function edit_newsletter($id) {
		
        $data_msg = array();
        $get_result = $this->Newsletter_model->get_newsletter_details($id);		
        $details = $get_result->result_array();
		
		if (count($details) == 0) {
            redirect(base_url('manage-newsletter'));
            exit;
        }
		
		$data_msg['details'] = $details;
        $data_msg['meta_title'] = "Edit Newsletter";
        $this->load->library('form_validation');
		
		$config = array(
               array(
                     'field'   => 'title',
                     'label'   => 'Title',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'seo_url',
                     'label'   => 'Url',
                     'rules'   => 'trim|required|callback_edit_unique['.TBL_NEWSLETTER.'.seo_url.'.$id.']'
                  ),
				array(
                     'field'   => 'description',
                     'label'   => 'Description',
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
                  )
			   
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){				
			if ($this->form_validation->run() == FALSE)
			{
				$error_msg = strip_tags(validation_errors());
				$data_msg['error_msg'] = $error_msg;
				$this->view('newsletter/edit_newsletter', $data_msg);
			}else {           
				$post_data = $_POST; $error_msg = '';
				
				$image_banner=$this->input->post('image_banner_old');
			    $image_name=$this->input->post('image_name_old');
				
				
				$post_date = str_replace("/", "-", $post_data['post_date']); 
				$post_date = date("Y-m-d", strtotime($post_date));
				  
				
					
					
				 if($_FILES['image_name']['tmp_name']!=''){
				  if ($this->all_function->check_image_valid($_FILES['image_name']['tmp_name'])!=1){
					 $error_msg .= 'Invalid newsletter Image.'; 
				  }else{
						
						$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'newsletter/original/';
                		$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
						$config['remove_spaces'] = TRUE;
						//$config['overwrite'] = TRUE;
						$this->upload->initialize($config);
						if ($this->upload->do_upload('image_name'))
				        {
							
							@unlink(MAIN_SITE_AB_UPLOAD_PATH . 'newsletter/thumb/' .$this->input->post('image_name_old'));
	  						@unlink(MAIN_SITE_AB_UPLOAD_PATH . 'newsletter/original/' .$this->input->post('image_name_old'));
							//@unlink(MAIN_SITE_AB_UPLOAD_PATH . 'newsletter/home/' .$this->input->post('image_name_old'));
							
							$upload_data = $this->upload->data();
							$image_name=$upload_data['file_name'];
							
							$config['image_library'] = 'gd2';
							$config['source_image'] = $upload_data['full_path'];
							$config['create_thumb'] = false;
							$config['maintain_ratio'] = FALSE;
							$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'newsletter/thumb/'.$upload_data['file_name'];
							$config['width']         = 248;
							$config['height']       = 146;
							
							$this->image_lib->initialize($config);
							
							$this->image_lib->resize();
							if (!$this->image_lib->resize()) {
								echo $this->image_lib->display_errors();
						    }
							$this->image_lib->clear();
						
						}
						
						
						
					}
				  
				  }
					
				 /*============================== */
				 if($_FILES['image_banner']['tmp_name']!=''){
				  if ($this->all_function->check_image_valid($_FILES['image_banner']['tmp_name'])!=1){
					 $error_msg .= 'Invalid Banner Image.'; 
				  }else{
						
						$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'newsletter/banner/original/';
                		$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
						$config['remove_spaces'] = TRUE;
						//$config['overwrite'] = TRUE;
						$this->upload->initialize($config);
						if ($this->upload->do_upload('image_banner'))
				        {
							
							//@unlink(MAIN_SITE_AB_UPLOAD_PATH . 'newsletter/banner/' .$this->input->post('image_banner_old'));
	  						@unlink(MAIN_SITE_AB_UPLOAD_PATH . 'newsletter/banner/original/' .$this->input->post('image_banner_old'));
							@unlink(MAIN_SITE_AB_UPLOAD_PATH . 'newsletter/banner/thumb/' .$this->input->post('image_banner_old'));
							
							$upload_data = $this->upload->data();
							$image_banner=$upload_data['file_name'];
							
							$config['image_library'] = 'gd2';
							$config['source_image'] = $upload_data['full_path'];
							$config['create_thumb'] = false;
							$config['maintain_ratio'] = FALSE;
							$config['new_image']=MAIN_SITE_AB_UPLOAD_PATH.'newsletter/banner/thumb/'.$upload_data['file_name'];
							$config['width']         = 1400;
							$config['height']       = 350;
							
							$this->image_lib->initialize($config);
							
							$this->image_lib->resize();
							if (!$this->image_lib->resize()) {
								echo $this->image_lib->display_errors();
						    }
							$this->image_lib->clear();
							
							
							
						
						}
						
						
						
					}
				  
				  }	
				  
				  
			  if ($error_msg != '') { 
				$data_msg['error_msg'] = $error_msg;      
                $this->view('newsletter/edit_newsletter', $data_msg);
               }else {
				   
				 $data = array(
							'title' => $post_data['title'],
							'description' => $post_data['description'],
							'image_name' => $image_name,
							'image_banner' => $image_banner,
							'post_date' => $post_date,
							'status' => $post_data['status'],
							'seo_url' => $post_data['seo_url'],
							'seo_title' => $post_data['seo_title'],
							'seo_keyword' => $post_data['seo_keyword'],
							'seo_description' => $post_data['seo_description'],
							'modified_date' => date('Y-m-d H:i:s')
						);  
				  
			   }
				##
				  
				  
					
					
            	$this->Newsletter_model->update_newsletter($data,  $id);

            	$this->session->set_flashdata('success_msg', 'Successfully updated.');
				redirect(base_url("edit-newsletter/$id"));
        	}
		}else{
			$this->view('newsletter/edit_newsletter', $data_msg);
		}
    } //Validation
	
	public function del_newsletter($id) {		
        $data_msg = array();	
        $details = $this->Newsletter_model->get_newsletter_details($id)->result_array();
		$file = MAIN_SITE_AB_UPLOAD_PATH.'newsletter/banner/original/'.$details[0]['image_banner'];
		if(is_file($file)){unlink($file);}
		$file = MAIN_SITE_AB_UPLOAD_PATH.'newsletter/banner/thumb/'.$details[0]['image_banner'];
		if(is_file($file)){unlink($file);}
		
		$file = MAIN_SITE_AB_UPLOAD_PATH.'newsletter/original/'.$details[0]['image_name'];
		if(is_file($file)){unlink($file);}
		$file = MAIN_SITE_AB_UPLOAD_PATH.'newsletter/thumb/'.$details[0]['image_name'];
		if(is_file($file)){unlink($file);}
		
		$this->Newsletter_model->del_newsletter($id);						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');		
		redirect(base_url("manage-newsletter"));
    } //Validation
	
	
	
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