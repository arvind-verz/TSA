<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Committeemember extends MY_Controller {

    function __construct() {		
        parent::__construct();
        $this->load->model('Committee_member_model', '', TRUE);
		$this->load->model('Committeecategory_model', '', TRUE);
    }
	
	 public function manage_committee_member() {
		
		$data_msg = array();		
        		
        $data_msg['meta_title'] = "Committee Member Manager";
		
		$data_msg['country'] = $this->Committeecategory_model->get_all_country();
		
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
			$data_msg['total'] = $total_items = $this->Committee_member_model->count_committee_member_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-committee-member'));
			$data_msg['display_result'] = $this->Committee_member_model->get_committee_member_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $details = $this->Committee_member_model->get_committee_member_details($del_id)->result_array();
				  
				        $file = MAIN_SITE_AB_UPLOAD_PATH.'committee_member/original/'.$details[0]['image_name'];
		 				if(is_file($file)){unlink($file); } 
		 				$file = MAIN_SITE_AB_UPLOAD_PATH.'committee_member/thumb/'.$details[0]['image_name'];
		 				if(is_file($file)){unlink($file); }
				  
				  
				$this->Committee_member_model->del_committee_member($del_id);	
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-committee-member'));
			  exit;
			  }else{redirect(base_url('manage-committee-member'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Committee_member_model->update_committee_member($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-committee-member'));
			  exit;
			  }else{redirect(base_url('manage-committee-member'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Committee_member_model->update_committee_member($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-committee-member'));
			  exit;
			  }else{redirect(base_url('manage-committee-member'));exit;}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Committee_member_model->count_committee_member_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-committee-member'));
			  $data_msg['display_result'] = $this->Committee_member_model->get_committee_member_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'name'=>'',
				'cat_id'=>'',
				'status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Committee_member_model->count_committee_member();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-committee-member'));
        	$get_value = $this->Committee_member_model->get_committee_member($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
        $this->view('committee_member/manage_committee_member', $data_msg);
    }
	public function add_committee_member() {
		
        $data_msg = array();

        $data_msg['meta_title'] = "Add Committee Member";
		
		
		$data_msg['country'] = $this->Committeecategory_model->get_all_country();	
		
		$this->load->library('form_validation');
		
		$config = array(
               array(
				 'field'   => 'name',
				 'label'   => 'Title',
				 'rules'   => 'required'
				),
				 array(
				 'field'   => 'cat_id',
				 'label'   => 'Committee Category',
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
				$this->view('committee_member/add_committee_member', $data_msg);
			}
			else {
              $post_data = $_POST; $error_msg = '';$im_bn='';
				if ($_FILES['image_name']['name'] == '') {$error_msg = 'Need Image.';}
				else{
					
							$this->load->library('upload');
							$this->load->library('image_lib');
							$im_nm='';
							$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'committee_member/original/';
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
									$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'committee_member/thumb/'.$upload_data['file_name'];
									$config['width']         = 230;
									$config['height']       = 250;
								
									$this->image_lib->initialize($config);
									$this->image_lib->resize();
									$this->image_lib->clear();
								}else{
									$upload_error= array('error' => $this->upload->display_errors()); 
									$error_msg=$upload_error['error'];
									
								}
					
					
				}
					
			  if ($error_msg != '') {       
					$data_msg['error_msg'] = $error_msg;
					$this->view('committee_member/add_committee_member', $data_msg);
                }else {
			  
			  $data = array(					
						'name' => $post_data['name'],
						'cat_id' => $post_data['cat_id'],
						'description' => $post_data['description'],
						'image_name' => $im_nm,
						'sort_order' => $post_data['sort_order'],
						'create_date' => date('Y-m-d H:i:s'),
						'status' => $post_data['status']
                    ); 
                    $page_id = $this->Committee_member_model->add_committee_member($data);
					
                $this->session->set_flashdata('success_msg', 'Successfully added');
            	redirect(base_url("manage-committee-member"));
				}
        	}
		}else{		
        	$this->view('committee_member/add_committee_member', $data_msg);
		}
    }
	
	public function del_committee_member($id) {
		
        $data_msg = array();
		
		$details = $this->Committee_member_model->get_committee_member_details($id)->result_array();
		
		$file = MAIN_SITE_AB_UPLOAD_PATH.'committee_member/original/'.$details[0]['image_name'];
		 if(is_file($file)){unlink($file); } 
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'committee_member/thumb/'.$details[0]['image_name'];
		 if(is_file($file)){unlink($file); }
		
		
		$this->Committee_member_model->del_committee_member($id);			
						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');
		
		redirect(base_url("manage-committee-member"));
       
    }
	
	public function edit_committee_member($id){
		
        $data_msg = array();

        $data_msg['meta_title'] = "Edit Committee Member";
		$data_msg['country'] = $this->Committeecategory_model->get_all_country();
		$this->load->library('form_validation');
		
		$config = array(
               array(
				 'field'   => 'name',
				 'label'   => 'Title',
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
		
		$get_result = $this->Committee_member_model->get_committee_member_details($id);
		$details = $get_result->result_array();
        if (count($details) == 0) {			
				redirect(base_url("manage-committee-member"));
        }
		$data_msg['details'] = $details;
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{	
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('committee_member/edit_committee_member', $data_msg);
			}else {           
             $post_data = $_POST;$error_msg = '';
			$image_name=$post_data['old_image_name'];
			
			##
					$this->load->library('upload');
					$this->load->library('image_lib');
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'committee_member/original/';
                	$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
						if($this->upload->do_upload('image_name'))
				        { 
						
						   $file = MAIN_SITE_AB_UPLOAD_PATH.'committee_member/original/'.$image_name;
		 				   if(is_file($file)){unlink($file); } 
		 				   $file = MAIN_SITE_AB_UPLOAD_PATH.'committee_member/thumb/'.$image_name;
		                   if(is_file($file)){unlink($file); }
						
							$upload_data = $this->upload->data();
							$image_name=$upload_data['file_name'];
							
							$config['image_library'] = 'gd2';
							$config['source_image'] = $upload_data['full_path'];
							$config['create_thumb'] = false;
							$config['maintain_ratio'] = false;
							$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'committee_member/thumb/'.$upload_data['file_name'];
							$config['width']         = 230;
							$config['height']       = 250;
						
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
							$this->image_lib->clear();
					    }
					##
			
			
			
				  
			 
			 if ($error_msg != '') {       
                $data_msg['error_msg'] = $error_msg;
				$this->view('committee_member/edit_committee_member', $data_msg);
            }else{
             $data = array(					
						'name' => $post_data['name'],
						'cat_id' => $post_data['cat_id'],
						'description' => $post_data['description'],
						'image_name' => $image_name,
						'sort_order' => $post_data['sort_order'],
						//'create_date' => date('Y-m-d H:i:s'),
						'status' => $post_data['status']
                    );
				
				$this->Committee_member_model->update_committee_member($data,  $id);
                $this->session->set_flashdata('success_msg', 'Successfully updated.');				
				redirect(base_url("edit-committee-member/$id")); 
			 
			}
        	}
		}else{
			$this->view('committee_member/edit_committee_member', $data_msg);
		}
    }

}