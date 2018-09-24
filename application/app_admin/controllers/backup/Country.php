<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Country extends MY_Controller {

    function __construct() {		
        parent::__construct();
        $this->load->model('Country_model', '', TRUE);
    }
	
	 public function manage_country() {
		
		$data_msg = array();		
        		
        $data_msg['meta_title'] = "Country Manager";
		
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
			$data_msg['total'] = $total_items = $this->Country_model->count_country_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-country'));
			$data_msg['display_result'] = $this->Country_model->get_country_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  
				$this->Country_model->del_country($del_id);	
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-country'));
			  exit;
			  }else{redirect(base_url('manage-country'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Country_model->update_country($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-country'));
			  exit;
			  }else{redirect(base_url('manage-country'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Country_model->update_country($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-country'));
			  exit;
			  }else{redirect(base_url('manage-country'));exit;}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Country_model->count_country_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-country'));
			  $data_msg['display_result'] = $this->Country_model->get_country_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'name'=>'',
				'status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Country_model->count_country();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-country'));
        	$get_value = $this->Country_model->get_country($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
        $this->view('country/manage_country', $data_msg);
    }
	public function add_country() {
		
        $data_msg = array();

        $data_msg['meta_title'] = "Add Country";
		
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
				$this->view('country/add_country', $data_msg);
			}
			else {
              $post_data = $_POST; $error_msg = '';
					
					
			  if ($error_msg != '') {       
					$data_msg['error_msg'] = $error_msg;
					$this->view('country/add_country', $data_msg);
                }else {
			  
			  $data = array(					
						'name' => $post_data['name'],
						'longitude' => $post_data['longitude'],
						'latitude' => $post_data['latitude'],
						'zoom' => $post_data['zoom'],
						'sort_order' => $post_data['sort_order'],
						'create_date' => date('Y-m-d H:i:s'),
						'status' => $post_data['status']
                    ); 
                    $page_id = $this->Country_model->add_country($data);
					
                $this->session->set_flashdata('success_msg', 'Successfully added');
            	redirect(base_url("manage-country"));
				}
        	}
		}else{		
        	$this->view('country/add_country', $data_msg);
		}
    }
	
	public function del_country($id) {
		
        $data_msg = array();
		
		$this->Country_model->del_country($id);			
						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');
		
		redirect(base_url("manage-country"));
       
    }
	
	public function edit_country($id){
		
        $data_msg = array();

        $data_msg['meta_title'] = "Edit Country";
		
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
		
		$get_result = $this->Country_model->get_country_details($id);
		$details = $get_result->result_array();
        if (count($details) == 0) {			
				redirect(base_url("manage-country"));
        }
		$data_msg['details'] = $details;
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{	
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('country/edit_country', $data_msg);
			}else {           
             $post_data = $_POST;$error_msg = '';
			 if ($error_msg != '') {       
                $data_msg['error_msg'] = $error_msg;
				$this->view('country/edit_country', $data_msg);
            }else{
             $data = array(					
						'name' => $post_data['name'],
						'longitude' => $post_data['longitude'],
						'latitude' => $post_data['latitude'],
						'zoom' => $post_data['zoom'],
						'sort_order' => $post_data['sort_order'],
						'status' => $post_data['status']
                    ); 
				
				$this->Country_model->update_country($data,  $id);
                $this->session->set_flashdata('success_msg', 'Successfully updated.');				
				redirect(base_url("edit-country/$id")); 
			 
			 
			 
			}
        	}
		}else{
			$this->view('country/edit_country', $data_msg);
		}
    }

}