<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Faq extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('Faq_model', '', TRUE);

    }
	public function manage_faq() {
		
		$data_msg = array();	        
        $data_msg['meta_title'] = "FAQ Manager";		
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
			$data_msg['total'] = $total_items = $this->Faq_model->count_faq_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-faq'));
			$data_msg['display_result'] = $this->Faq_model->get_faq_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){ 
				$this->Faq_model->delete_faq($del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-faq'));
			  }else{redirect(base_url('manage-faq'));}
		}
		elseif( isset($_POST['action']) && $_POST['action']=='SortOrder'){				
			$checkbox_arr = $this->input->post('orderid');
			$order_arr = $this->input->post('sort_order');
			$c = 0;
			foreach ($checkbox_arr as $del_id){
			  $data = array('sort_order' => $order_arr[$c]);
			  $this->Faq_model->update_faq($data,  $del_id);
			  $c++;
			}
			$this->session->set_flashdata('success_msg', 'Records have been sorted successfully');
			redirect(base_url('manage-faq'));
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 'Y'){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Faq_model->update_faq($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-faq'));
			  }else{redirect(base_url('manage-faq'));}
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 'N'){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Faq_model->update_faq($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-faq'));
			  }else{redirect(base_url('manage-faq'));}
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Faq_model->count_faq_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-faq'));
			  $data_msg['display_result'] = $this->Faq_model->get_faq_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'name'=>'',
				'content'=>'',
				'status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Faq_model->get_faq_num();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-faq'));
        	$get_value = $this->Faq_model->get_all_faq_details($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
        $this->view('faq/manage_faq', $data_msg);
    }
	public function del_faq($id) {
		$data_msg = array();
          $this->Faq_model->delete_faq($id);
		  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
		  redirect(base_url('manage-faq'));
		
    }// Not Need Validation

    public function add_faq() {
		$data_msg = array();
        $data_msg['meta_title'] = "Add FAQ";
		$this->load->library('form_validation');
		$config = array(
               array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'content',
                     'label'   => 'Content',
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
				$error_msg = strip_tags(validation_errors());
				$this->view('faq/add_faq', $data_msg);
				
			}else{
			$error_msg = "";
            $name = trim(strip_tags($this->input->post('name')));
			$content = trim(strip_tags($this->input->post('content')));
			$data = array(
			'name' => $name,
			'content' => $this->input->post('content'),
			'sort_order' => $this->input->post('sort_order'),
			'create_date' => date('Y-m-d H:i:s'),
			'modified_date' => date('Y-m-d H:i:s')
			);
			$this->Faq_model->add_faq($data);
			$this->session->set_flashdata('success_msg', 'Successfully added');
			redirect(base_url("manage-faq"));
        	}
		}
		$this->view('faq/add_faq', $data_msg);
    }
	public function edit_faq($id) {
		
		$data_msg = array();
		$data_msg['meta_title'] = "Edit FAQ";
		$get_value = $this->Faq_model->get_details($id);
        $details = $get_value->result_array();
        if (empty($details)) {
            redirect(base_url("manage-faq"));
        }
       
		
		$data_msg['details'] = $details;
		
		
        $this->load->library('form_validation');
		$config = array(
               array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'content',
                     'label'   => 'Content',
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
				$error_msg = strip_tags(validation_errors());
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('faq/edit_faq', $data_msg);
			}
			else {
				$name = trim(strip_tags($this->input->post('name')));
				$content = trim(strip_tags($this->input->post('content')));
				$status = trim(strip_tags($this->input->post('status')));
                   	$data = array(
						'name' => $name,
						'content' => $this->input->post('content'),
						'sort_order' => $this->input->post('sort_order'),
						'status' => $this->input->post('status'),
						'modified_date' => date('Y-m-d H:i:s')
					);
				$this->Faq_model->update_faq($data, $id);
				$this->session->set_flashdata('success_msg', 'Faq record has been updated successfully');
				redirect(base_url("edit-faq/$id"));
        	}
		}
		$this->view('faq/edit_faq', $data_msg);
    }
}