<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Parts extends MY_Controller {

    function __construct() {		
        parent::__construct();
        $this->load->model('Parts_model', '', TRUE);
    }
	
	 public function manage_parts() {
		
		$data_msg = array();		
        		
        $data_msg['meta_title'] = "Parts Manager";
		
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
			$data_msg['total'] = $total_items = $this->Parts_model->count_parts_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-parts'));
			$data_msg['display_result'] = $this->Parts_model->get_parts_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $details = $this->Parts_model->get_parts_details($del_id)->result_array();
				  
				  $file = MAIN_SITE_AB_UPLOAD_PATH.'parts/'.$details[0]['pdf_name'];
						 if(is_file($file)){unlink($file); } 
				$this->Parts_model->del_parts($del_id);	
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-parts'));
			  exit;
			  }else{redirect(base_url('manage-parts'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Parts_model->update_parts($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-parts'));
			  exit;
			  }else{redirect(base_url('manage-parts'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Parts_model->update_parts($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-parts'));
			  exit;
			  }else{redirect(base_url('manage-parts'));exit;}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Parts_model->count_parts_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-parts'));
			  $data_msg['display_result'] = $this->Parts_model->get_parts_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'name'=>'',
				'status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Parts_model->count_parts();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-parts'));
        	$get_value = $this->Parts_model->get_parts($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
        $this->view('parts/manage_parts', $data_msg);
    }
	public function add_parts() {
		
        $data_msg = array();

        $data_msg['meta_title'] = "Add Our Client";
		
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
		
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('parts/add_parts', $data_msg);
			}
			else {
              $post_data = $_POST; $error_msg = '';$image_name_name='';
					##
					$this->load->library('upload');
					$im_nm='';
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'parts/';
                	$config['allowed_types']        = 'pdf|PDF';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
						if ($this->upload->do_upload('pdf_name'))
				        { 
							$upload_data = $this->upload->data();
							$im_nm=$upload_data['file_name'];
					    }else{
							$upload_error= array('error' => $this->upload->display_errors()); 
							$error_msg=$upload_error['error'];
							
						}
						
						
					##
					
			  if ($error_msg != '') {       
					$data_msg['error_msg'] = $error_msg;
					$this->view('parts/add_parts', $data_msg);
                }else {
			  
			  $data = array(					
						'name' => $post_data['name'],
						'pdf_name' => $im_nm,
						'sort_order' => $post_data['sort_order'],
						'create_date' => date('Y-m-d H:i:s'),
						'status' => $post_data['status']
                    ); 
                    $page_id = $this->Parts_model->add_parts($data);
					
                $this->session->set_flashdata('success_msg', 'Successfully added');
            	redirect(base_url("manage-parts"));
				}
        	}
		}else{		
        	$this->view('parts/add_parts', $data_msg);
		}
    }
	
	public function del_parts($id) {
		
        $data_msg = array();
		
		$details = $this->Parts_model->get_parts_details($id)->result_array();
		
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'parts/'.$details[0]['pdf_name'];
		 if(is_file($file)){unlink($file); } 
		
		
		$this->Parts_model->del_parts($id);			
						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');
		
		redirect(base_url("manage-parts"));
       
    }
	
	public function edit_parts($id){
		
        $data_msg = array();

        $data_msg['meta_title'] = "Edit Parts";
		
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
		
		$get_result = $this->Parts_model->get_parts_details($id);
		$details = $get_result->result_array();
        if (count($details) == 0) {			
				redirect(base_url("manage-parts"));
        }
		$data_msg['details'] = $details;
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{	
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('parts/edit_parts', $data_msg);
			}else {           
             $post_data = $_POST;$error_msg = '';$im_nm=$post_data['old_pdf_name'];
				  ##
					$this->load->library('upload');
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'parts/';
                	$config['allowed_types']        = 'pdf|PDF';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
						if ($this->upload->do_upload('pdf_name'))
				        { 
						 $file = MAIN_SITE_AB_UPLOAD_PATH.'parts/'.$im_nm;
						 if(is_file($file)){unlink($file); } 
						
							$upload_data = $this->upload->data();
							$im_nm=$upload_data['file_name'];
					    }/*else{
							$upload_error= array('error' => $this->upload->display_errors()); 
							$error_msg=$upload_error['error'];
							
						}*/
					##
				   
			 
			 if ($error_msg != '') {       
                $data_msg['error_msg'] = $error_msg;
				$this->view('parts/edit_parts', $data_msg);
            }else{
             $data = array(					
						'name' => $post_data['name'],
						'pdf_name' => $im_nm,
						'sort_order' => $post_data['sort_order'],
						'status' => $post_data['status']
                    ); 
				
				$this->Parts_model->update_parts($data,  $id);
                $this->session->set_flashdata('success_msg', 'Successfully updated.');				
				redirect(base_url("edit-parts/$id")); 
			 
			 
			 
			}
        	}
		}else{
			$this->view('parts/edit_parts', $data_msg);
		}
    }

}