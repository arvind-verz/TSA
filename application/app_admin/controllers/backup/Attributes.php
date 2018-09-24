<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
class Attributes extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('attributes_model', '', TRUE);
    }
	
	public function manage_options() {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];				
		$permission='Y';		
 		if($permission=='Y'){
        $data_msg = array();		
		$data_msg['meta_title'] = "Manage Options";		
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
			$data_msg['total'] = $total_items = $this->attributes_model->get_options_num_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-options'));
			$data_msg['display_result'] = $this->attributes_model->get_all_options_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $this->attributes_model->delete_options($del_id);
				 $this->attributes_model->delete_values_all($del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-options'));
			  exit;
			  }else{redirect(base_url('manage-options'));}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='SortOrder'){			
			$checkbox_arr = $this->input->post('orderid');
			$order_arr = $this->input->post('sort_order');
			$c = 0;
			foreach ($checkbox_arr as $del_id){
			  $data = array('sort_order' => $order_arr[$c]);
			  $this->attributes_model->update_options($data,  $del_id);
			  $c++;
			}
			$this->session->set_flashdata('success_msg', 'Records have been sorted successfully');
			redirect(base_url('manage-options'));			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->attributes_model->get_options_num_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-options'));
			  $data_msg['display_result'] = $this->attributes_model->get_all_options_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'products_options_name'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->attributes_model->get_options_num();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-options'));
        	$get_value = $this->attributes_model->get_all_options($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
		$this->view('attributes/manage_options', $data_msg);
		}
		if($permission=='N'){			
			 redirect(base_url('access-denied'));
             exit;			
		}
    }
	
	public function del_options($products_options_id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];				
		$permission='Y';		
		if($permission=='Y'){
			$data_msg = array();
			$this->attributes_model->delete_options($products_options_id);
			$this->attributes_model->delete_values_all($products_options_id);	  
			$this->session->set_flashdata('success_msg', 'Record has been deleted successfully');		  
			redirect(base_url('manage-options'));			  
		}if($permission=='N'){redirect(base_url('access-denied'));}
    }	
	
	public function edit_options($products_options_id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];				
		$permission='Y';		
		if($permission=='Y'){			
        $data_msg = array();		
		$data_msg['meta_title'] = "Edit Product Options";	
        $get_value = $this->attributes_model->get_options_details($products_options_id);		
        $details = $get_value->row_array();		
        if (empty($details)) { redirect(base_url("manage-options")); }
        $data_msg['products_options_name'] = $details['products_options_name'];		
		$data_msg['sort_order'] = $details['sort_order'];		
		$data_msg['products_options_id'] = $products_options_id;        
        if ($this->input->post('edit_options')) { 			
            $products_options_name = trim(strip_tags($this->input->post('products_options_name')));			
			$sort_order = $this->input->post('sort_order');
            $error_msg = "";			
            if ($products_options_name == '') {
                $error_msg = "Please enter name.";
            }			
			if ($sort_order == '') {
                $sort_order = 0;
            }
            if ($error_msg == "") {										
				 $data = array(				 
					'products_options_name' => $products_options_name,
					'sort_order' => $sort_order					
                );				
                $this->attributes_model->update_options($data, $products_options_id);
                $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
				redirect(base_url("edit-options/$products_options_id"));
            }else{
				$data_msg['error_msg'] = $error_msg;
				$this->view('attributes/edit_options', $data_msg);
			}			
            
        }else{
        $this->view('attributes/edit_options', $data_msg);
		}
		}if($permission=='N'){redirect(base_url('access-denied'));}
    }	
	
	public function add_options() {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];				
		$permission='Y';		
		if($permission=='Y'){			
        $data_msg = array();		
		$data_msg['meta_title'] = "Add Product Options";		        
        if ($this->input->post('add_options')) {						
            $products_options_name = trim(strip_tags($this->input->post('products_options_name')));			
			$sort_order = $this->input->post('sort_order');
            $error_msg = "";			
            if ($products_options_name == '') {
                $error_msg = "Please enter name.";
            }			
			if ($sort_order == '') {
                $sort_order = 0;
            }
            if ($error_msg == "") {										
				 $data = array(
					'products_options_name' => $products_options_name,
					'sort_order' => $sort_order
                );				
                $this->attributes_model->add_options($data);
                $this->session->set_flashdata('success_msg', 'Record has been added successfully');
				redirect(base_url("manage-options"));
            }else{
				$data_msg['error_msg'] = $error_msg;
				$this->view('attributes/add_options', $data_msg);
			}
        }else{
        	$this->view('attributes/add_options', $data_msg);
		}
		}if($permission=='N'){ redirect(base_url('access-denied'));}
    }	
	
	public function manage_values($products_options_id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];				
		$permission='Y';		
 		if($permission=='Y'){
        $data_msg = array();		
		$data_msg['meta_title'] = "Manage Values";		 
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
			$data_msg['total'] = $total_items = $this->attributes_model->get_values_num_filter($products_options_id,$FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-values/'.$products_options_id));
			$data_msg['display_result'] = $this->attributes_model->get_all_values_filter($products_options_id, $items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $this->attributes_model->delete_values($del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-values/'.$products_options_id));
			  exit;
			  }else{redirect(base_url('manage-values/'.$products_options_id));}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='SortOrder'){			
			$checkbox_arr = $this->input->post('orderid');
			$order_arr = $this->input->post('sort_order');
			$c = 0;
			foreach ($checkbox_arr as $del_id){
			  $data = array('sort_order' => $order_arr[$c]);
			  $this->attributes_model->update_values($data,  $del_id);
			  $c++;
			}
			$this->session->set_flashdata('success_msg', 'Records have been sorted successfully');
			redirect(base_url('manage-values/'.$products_options_id));		
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->attributes_model->get_values_num_filter($products_options_id,$FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-values/'.$products_options_id));
			  $data_msg['display_result'] = $this->attributes_model->get_all_values_filter($products_options_id,$items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'products_options_values_name'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->attributes_model->get_values_num($products_options_id);
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-values/'.$products_options_id));
        	$get_value = $this->attributes_model->get_all_values($products_options_id,$items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
		$data_msg['products_options_id'] = $products_options_id;

        $this->view('attributes/manage_values', $data_msg);
	}
		if($permission=='N'){ redirect(base_url('access-denied'));}

    }
	
	public function del_values($products_options_id,$products_options_values_id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];				
		$permission='Y';		
		if($permission=='Y'){

          $data_msg = array();
          $this->attributes_model->delete_values($products_options_values_id);								  
		  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');		  
		  redirect(base_url('manage-values/'.$products_options_id));
		  
		}if($permission=='N'){ redirect(base_url('access-denied'));}

    }	
	
	public function edit_values($products_options_id,$products_options_values_id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];				
		$permission='Y';		
		if($permission=='Y'){
			
        $data_msg = array();		
		$data_msg['meta_title'] = "Edit Product Values";		
		$data_msg['products_options_id'] = $products_options_id;		
		$data_msg['products_options_values_id'] = $products_options_values_id;		
        $get_value = $this->attributes_model->get_values_details($products_options_values_id);		
        $details = $get_value->row_array();
        if (empty($details)) { redirect(base_url("manage-values/".$products_options_id));}

        $data_msg['products_options_values_name'] = $details['products_options_values_name'];		
		$data_msg['image_name'] = $details['image_name'];		
		if ($this->input->post('edit_values')) {
            $products_options_values_name = trim(strip_tags($this->input->post('products_options_values_name')));
            $error_msg = "";
            if ($products_options_values_name == '') {
                $error_msg = "Please enter name.";
            }
			
				if ($error_msg == "") {
					 $data = array(
						'products_options_values_name' => $products_options_values_name,
						'products_options_id' => $products_options_id
					);
					$this->attributes_model->update_values($data, $products_options_values_id);
					$this->session->set_flashdata('success_msg', 'Record has been updated successfully');
					redirect(base_url("edit-values/$products_options_id/$products_options_values_id"));
				}else{
					$data_msg['error_msg'] = $error_msg;
					$this->view('attributes/edit_values', $data_msg);
				}
        }
		else{
		$this->view('attributes/edit_values', $data_msg);
		}
		}if($permission=='N'){ redirect(base_url('access-denied'));}

    }	
	
	public function add_values($products_options_id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
		
		$permission='Y';
		
		if($permission=='Y'){
			
        $data_msg = array();
		
		$data_msg['products_options_id'] = $products_options_id;
		
		$data_msg['meta_title'] = "Add Product Values";
		        
        if ($this->input->post('add_values')) { 			
            $products_options_values_name = trim(strip_tags($this->input->post('products_options_values_name')));
            $error_msg = "";
            if ($products_options_values_name == '') {
                $error_msg = "Please enter name.";
            }						
				if ($error_msg == "") {											
					 $data = array(
						'products_options_values_name' => $products_options_values_name,
						'products_options_id' => $products_options_id
					);					
					$this->attributes_model->add_values($data);	
					$this->session->set_flashdata('success_msg', 'Record has been added successfully');
					redirect(base_url("manage-values/".$products_options_id));					
				}else{
					$data_msg['error_msg'] = $error_msg;
					$this->view('attributes/add_values', $data_msg);
				}
        }else{
        	$this->view('attributes/add_values', $data_msg);
		}
		}if($permission=='N'){redirect(base_url('access-denied'));}
    }	
}