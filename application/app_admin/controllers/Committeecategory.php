<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Committeecategory extends MY_Controller {

    function __construct() {		
        parent::__construct();
        $this->load->model('Committeecategory_model', '', TRUE);
    }
	
	 public function manage_committee_categtory() {
		
		$data_msg = array();		
        		
        $data_msg['meta_title'] = "Committee Category Manager";
		
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
			$data_msg['total'] = $total_items = $this->Committeecategory_model->count_country_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-committee-categtory'));
			$data_msg['display_result'] = $this->Committeecategory_model->get_country_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  
				$this->Committeecategory_model->del_country($del_id);	
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-committee-categtory'));
			  exit;
			  }else{redirect(base_url('manage-committee-categtory'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Committeecategory_model->update_country($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-committee-categtory'));
			  exit;
			  }else{redirect(base_url('manage-committee-categtory'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Committeecategory_model->update_country($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-committee-categtory'));
			  exit;
			  }else{redirect(base_url('manage-committee-categtory'));exit;}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Committeecategory_model->count_country_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-committee-categtory'));
			  $data_msg['display_result'] = $this->Committeecategory_model->get_country_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'name'=>'',
				'status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Committeecategory_model->count_country();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-committee-categtory'));
        	$get_value = $this->Committeecategory_model->get_country($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
        $this->view('committee_category/manage_country', $data_msg);
    }
	public function add_committee_categtory() {
		
        $data_msg = array();

        $data_msg['meta_title'] = "Add Committee Category";
		
		$this->load->library('form_validation');
		
		$config = array(
               array(
				 'field'   => 'name',
				 'label'   => 'Name',
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
				$this->view('country_contact/add_country', $data_msg);
			}
			else {
              $post_data = $_POST; $error_msg = '';
					
					
			  if ($error_msg != '') {       
					$data_msg['error_msg'] = $error_msg;
					$this->view('country/add_country', $data_msg);
                }else {
			    $url_name = trim(strip_tags($this->input->post('name')));
     			$url_name =  preg_replace("/^'|[^A-Za-z0-9\'-]|'$/", '',$url_name);
			  $data = array(					
						'name' => $post_data['name'],
						'seo_url'=>$url_name,
						'sort_order' => $post_data['sort_order'],
						'create_date' => date('Y-m-d H:i:s'),
						'status' => $post_data['status']
                    ); 
                    $page_id = $this->Committeecategory_model->add_country($data);
					
                $this->session->set_flashdata('success_msg', 'Successfully added');
            	redirect(base_url("manage-committee-categtory"));
				}
        	}
		}else{		
        	$this->view('committee_category/add_country', $data_msg);
		}
    }
	
	public function del_committee_categtory($id) {
		
        $data_msg = array();
		
		$this->Committeecategory_model->del_country($id);			
						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');
		
		redirect(base_url("manage-committee-categtory"));
       
    }
	
	public function edit_committee_categtory($id){
		
        $data_msg = array();

        $data_msg['meta_title'] = "Edit Committee Category";
		
		$this->load->library('form_validation');
		
		$config = array(
               array(
				 'field'   => 'name',
				 'label'   => 'Name',
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
		
		$get_result = $this->Committeecategory_model->get_country_details($id);
		$details = $get_result->result_array();
        if (count($details) == 0) {			
				redirect(base_url("manage-committee-categtory"));
        }
		$data_msg['details'] = $details;
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{	
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('country_contact/edit_country', $data_msg);
			}else {           
             $post_data = $_POST;$error_msg = '';
			 if ($error_msg != '') {       
                $data_msg['error_msg'] = $error_msg;
				$this->view('country_contact/edit_country', $data_msg);
            }else{
				
				$url_name = trim(strip_tags($this->input->post('name')));
     			$url_name =  preg_replace("/^'|[^A-Za-z0-9\'-]|'$/", '',$url_name);
				
             $data = array(					
						'name' => $post_data['name'],
						'seo_url'=>$url_name,
						'sort_order' => $post_data['sort_order'],
						'status' => $post_data['status']
                    ); 
				
				$this->Committeecategory_model->update_country($data,  $id);
                $this->session->set_flashdata('success_msg', 'Successfully updated.');				
				redirect(base_url("edit-committee-categtory/$id")); 
			 
			 
			 
			}
        	}
		}else{
			$this->view('committee_category/edit_country', $data_msg);
		}
    }

}