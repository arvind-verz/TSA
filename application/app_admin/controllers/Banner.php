<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
class banner extends MY_Controller {

    function __construct() {		
        parent::__construct();
        $this->load->model('Banner_model', '', TRUE);
    }

    public function manage_banner() {
		
		$data_msg = array();	        
        $data_msg['meta_title'] = "Banner Manager";		
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
			$data_msg['total'] = $total_items = $this->Banner_model->count_banner_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-banner'));
			$data_msg['display_result'] = $this->Banner_model->get_banner_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				$get_result = $this->Banner_model->get_page_cms_details($del_id);				
				$details = $get_result->result_array();				
				$file = MAIN_SITE_AB_UPLOAD_PATH.'banner/original/'.$details[0]['image_name'];
				if(is_file($file)){unlink($file); } 
				$file = MAIN_SITE_AB_UPLOAD_PATH.'banner/thumb/'.$details[0]['image_name'];
				if(is_file($file)){unlink($file); } 
				$this->Banner_model->del_banner($del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-banner'));
			  }else{redirect(base_url('manage-banner'));}
		}
		elseif( isset($_POST['action']) && $_POST['action']=='SortOrder'){
			$checkbox_arr = $this->input->post('orderid');
			$order_arr = $this->input->post('sort_order');
			$c = 0;
			foreach ($checkbox_arr as $del_id){
			  $data = array('sort_order' => $order_arr[$c]);
			  $this->Banner_model->update_page_cms($data,  $del_id);
			  $c++;
			}
			$this->session->set_flashdata('success_msg', 'Records have been sorted successfully');
			redirect(base_url('manage-banner'));
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => '1');
                  $this->Banner_model->update_page_cms($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-banner'));
			  }else{redirect(base_url('manage-banner'));}
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => '0');
                 $this->Banner_model->update_page_cms($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-banner'));
			  }else{redirect(base_url('manage-banner'));}
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Banner_model->count_banner_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-banner'));
			  $data_msg['display_result'] = $this->Banner_model->get_banner_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'title'=>'',							
				'content'=>'',
				'url'=>'',
				'status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Banner_model->count_banner();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-banner'));
        	$get_value = $this->Banner_model->get_banner($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
        $this->view('banner/manage_banner', $data_msg);
    }
	
	public function add_banner() {
		
        $data_msg = array();
        $data_msg['meta_title'] = "Add Banner";		
        $this->load->library('form_validation');
		
		$config = array(
               array(
                     'field'   => 'title',
                     'label'   => 'Title',
                     'rules'   => 'required'
                  ), 
				array(
                     'field'   => 'url',
                     'label'   => 'Url',
                     'rules'   => 'prep_url'
                  ),  
				array(
                     'field'   => 'sort_order',
                     'label'   => 'Sort Order',
                     'rules'   => 'numeric'
                  ),    
               array(
                     'field'   => 'status',
                     'label'   => 'Status',
                     'rules'   => 'required'
                  ),
			   
			  array(
                     'field'   => 'content',
                     'label'   => 'Content',
                     'rules'   => ''
                  )
			   
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){	
			
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('banner/add_banner', $data_msg);
			}else{
				$post_data = $_POST;
				$error = FALSE;	
				if ($_FILES['image_name']['name'] == '') {$error = TRUE;}
				elseif($_FILES['image_name']['tmp_name']!=''){					  
					  if ($this->all_function->check_image_valid($_FILES['image_name']['tmp_name'])!=1){						  
						 $error = TRUE;  
					  }else{
						  $config = array(
							'source' => 'image_name', 
							'temp' => 'temp',
							'resize' => array(
							array('height' => 80, 'width' => 150, 'save' => 'banner/thumb/'),
							array('height' => 500, 'width' => 1400,'save' => 'banner/original/')
							)
							);							
							$image_name_name = $this->all_function->resize_image($config); // return the file anme
						}					  
					  }  
				$error_msg = "";				
				if ($error) {
					$error_msg = "Invalid Image.";
				}			   
				if ($error_msg != '') {       
					$data_msg['error_msg'] = $error_msg;
					$this->view('banner/add_banner', $data_msg);
				}
				else { 						
						$data = array(
							'title' => $post_data['title'],
							'image_name' => $image_name_name,
							'url' => $post_data['url'],
							'sort_order' => $post_data['sort_order'],
							'date' => date('Y-m-d'),
							'status' => $post_data['status'],
							'content' => $post_data['content']
						); 
						$this->Banner_model->add_banner($data);	
					$this->session->set_flashdata('success_msg', 'Successfully added');
					redirect(base_url("manage-banner"));
				}
			}
		}else{
			$this->view('banner/add_banner', $data_msg);
		}
    }
		
	public function edit_banner($id) {
		
        $data_msg = array();
        $get_result = $this->Banner_model->get_banner_details($id);
        $details = $get_result->result_array();
		
		if (count($details) == 0) { redirect(base_url('manage-banner'));}
		
		$data_msg['details'] = $details;        
		$data_msg['meta_title'] = "Edit Banner";
		$this->load->library('form_validation');
		
		$config = array(
              array(
                     'field'   => 'title',
                     'label'   => 'Title',
                     'rules'   => 'required'
                  ), 
				array(
                     'field'   => 'url',
                     'label'   => 'Url',
                     'rules'   => 'prep_url'
                  ),  
				array(
                     'field'   => 'sort_order',
                     'label'   => 'Sort Order',
                     'rules'   => 'numeric'
                  ),    
               array(
                     'field'   => 'status',
                     'label'   => 'Status',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'content',
                     'label'   => 'Content',
                     'rules'   => ''
                  )
			   
            );

		$this->form_validation->set_rules($config); 
		
		if($_POST){				
			if ($this->form_validation->run() == FALSE){
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('banner/edit_banner', $data_msg);				
			}else{	
				$post_data = $_POST;
				$error = FALSE;
				
				if($_FILES['image_name']['tmp_name']!=''){
					  if ($this->all_function->check_image_valid($_FILES['image_name']['tmp_name'])!=1){						  
						 $error = TRUE;  
					  }else{
						  $config = array(
							'source' => 'image_name', 
							'temp' => 'temp',
							'resize' => array(
							array('height' => 80, 'width' => 150, 'save' => 'banner/thumb/'),
							array('height' => 500, 'width' => 1400, 'save' => 'banner/original/')
							)
							);
							
							$image_name_name = $this->all_function->resize_image($config); // return the file anme
						}
					  }      
				$error_msg = "";
				if ($error) {
					$error_msg = "Invalid Banner Image.";
				}
				if ($error_msg != '') {   
					$data_msg['error_msg'] = $error_msg;
					$this->view('banner/edit_banner', $data_msg);
				}else { 
						 if ($_FILES['image_name']['name'] == '') {
							$data = array(
							'title' => $post_data['title'],
							'url' => $post_data['url'],
							'sort_order' => $post_data['sort_order'],
							'date' => date('Y-m-d'),
							'status' => $post_data['status'],
							'content' => $post_data['content']
						);
						}else{							
					$file = MAIN_SITE_AB_UPLOAD_PATH.'banner/original/'.$details[0]['image_name'];
					if(is_file($file)){unlink($file); } 
					$file = MAIN_SITE_AB_UPLOAD_PATH.'banner/thumb/'.$details[0]['image_name'];
					if(is_file($file)){unlink($file); } 					 
						$data = array(
							'title' => $post_data['title'],
							'image_name' => $image_name_name,
							'url' => $post_data['url'],
							'sort_order' => $post_data['sort_order'],
							'date' => date('Y-m-d'),
							'status' => $post_data['status'],
							'status' => $post_data['status'],
							'content' => $post_data['content']
						);
						}
						$this->Banner_model->update_page_cms($data,  $id);	
					$this->session->set_flashdata('success_msg', 'Successfully updated.');
					redirect(base_url("edit-banner/$id"));
				}
			}
		}else{
        	$this->view('banner/edit_banner', $data_msg);
		}
    }
	
	public function del_banner($id) {
		
        $data_msg = array();		
		$this->Banner_model->del_banner($id);						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');
		redirect(base_url("manage-banner"));
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