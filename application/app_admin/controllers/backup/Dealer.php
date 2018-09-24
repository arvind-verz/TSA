<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Dealer extends MY_Controller {

    function __construct() {		
        parent::__construct();
        $this->load->model('Dealer_model', '', TRUE);
		 $this->load->model('Country_model', '', TRUE);
    }
	
	 public function manage_dealer() {
		
		$data_msg = array();		
        		
        $data_msg['meta_title'] = "Dealer Manager";
		
		$data_msg['country'] = $this->Country_model->get_all_country();
		
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
			$data_msg['total'] = $total_items = $this->Dealer_model->count_dealer_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-dealer'));
			$data_msg['display_result'] = $this->Dealer_model->get_dealer_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  
				$this->Dealer_model->del_dealer($del_id);	
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-dealer'));
			  exit;
			  }else{redirect(base_url('manage-dealer'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Dealer_model->update_dealer($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-dealer'));
			  exit;
			  }else{redirect(base_url('manage-dealer'));exit;}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Dealer_model->update_dealer($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-dealer'));
			  exit;
			  }else{redirect(base_url('manage-dealer'));exit;}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Dealer_model->count_dealer_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-dealer'));
			  $data_msg['display_result'] = $this->Dealer_model->get_dealer_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'name'=>'',
				'country_id'=>'',
				'status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Dealer_model->count_dealer();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-dealer'));
        	$get_value = $this->Dealer_model->get_dealer($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
        $this->view('dealer/manage_dealer', $data_msg);
    }
	public function add_dealer() {
		
        $data_msg = array();

        $data_msg['meta_title'] = "Add Dealer";
		
		
		$data_msg['country'] = $this->Country_model->get_all_country();	
		
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
				$this->view('dealer/add_dealer', $data_msg);
			}
			else {
              $post_data = $_POST; $error_msg = '';$image_name_name='';
					
					
			  if ($error_msg != '') {       
					$data_msg['error_msg'] = $error_msg;
					$this->view('dealer/add_dealer', $data_msg);
                }else {
			  
			  $data = array(					
						'name' => $post_data['name'],
						'country_id' => $post_data['country_id'],
						'address' => $post_data['address'],
						'longitude' => $post_data['longitude'],
						'latitude' => $post_data['latitude'],
						'sort_order' => $post_data['sort_order'],
						'create_date' => date('Y-m-d H:i:s'),
						'status' => $post_data['status']
                    ); 
                    $page_id = $this->Dealer_model->add_dealer($data);
					
                $this->session->set_flashdata('success_msg', 'Successfully added');
            	redirect(base_url("manage-dealer"));
				}
        	}
		}else{		
        	$this->view('dealer/add_dealer', $data_msg);
		}
    }
	
	public function del_dealer($id) {
		
        $data_msg = array();
		
		$details = $this->Dealer_model->get_dealer_details($id)->result_array();
		
		 $file = MAIN_SITE_AB_UPLOAD_PATH.'dealer/'.$details[0]['pdf_name'];
		 if(is_file($file)){unlink($file); } 
		
		
		$this->Dealer_model->del_dealer($id);			
						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');
		
		redirect(base_url("manage-dealer"));
       
    }
	
	public function edit_dealer($id){
		
        $data_msg = array();

        $data_msg['meta_title'] = "Edit dealer";
		$data_msg['country'] = $this->Country_model->get_all_country();
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
		
		$get_result = $this->Dealer_model->get_dealer_details($id);
		$details = $get_result->result_array();
        if (count($details) == 0) {			
				redirect(base_url("manage-dealer"));
        }
		$data_msg['details'] = $details;
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{	
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('dealer/edit_dealer', $data_msg);
			}else {           
             $post_data = $_POST;$error_msg = '';
				  
			 
			 if ($error_msg != '') {       
                $data_msg['error_msg'] = $error_msg;
				$this->view('dealer/edit_dealer', $data_msg);
            }else{
             $data = array(					
						'name' => $post_data['name'],
						'country_id' => $post_data['country_id'],
						'address' => $post_data['address'],
						'longitude' => $post_data['longitude'],
						'latitude' => $post_data['latitude'],
						'sort_order' => $post_data['sort_order'],
						'status' => $post_data['status']
                    );  
				
				$this->Dealer_model->update_dealer($data,  $id);
                $this->session->set_flashdata('success_msg', 'Successfully updated.');				
				redirect(base_url("edit-dealer/$id")); 
			 
			}
        	}
		}else{
			$this->view('dealer/edit_dealer', $data_msg);
		}
    }

}