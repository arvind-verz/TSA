<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Reviews extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Reviews_model', '', TRUE);
		$this->load->model('Reviews_model', '', TRUE);
    }
	public function manage_sme_review() {
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
		if($admin_type=='Director' || $admin_type=='Administrator'){
        $data_msg = array();		
		$data_msg['meta_title'] = "Manage SME Director Review";		
		$items_per_page = $this->all_function->get_site_options('admin_listing_per_page');
        $current_page = (int) $this->input->get('page');
        $current_page = $current_page > 0 ? $current_page : 1;		
		$data_msg['start_count'] = ($current_page * $items_per_page - $items_per_page + 1);
        $limit_from = ($current_page - 1) * $items_per_page;
		
		$total_items = $this->Reviews_model->get_sme_review_num();
		$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-sme-review'));
		$get_value = $this->Reviews_model->get_sme_review_details($items_per_page, $limit_from);
		$data_msg['display_result'] = $get_value->result_array();
		
		$sql_last = $this->db->last_query();
		$sql_last = explode('LIMIT',$sql_last);
		$this->session->set_userdata(array('ExportSme' => $sql_last[0] ));
		$this->view('reviews/manage_sme_review', $data_msg);
		}else{			
			 redirect(base_url('access-denied'));		
		}
    }
	public function manage_investor_review() {
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
		if($admin_type=='Director' || $admin_type=='Administrator'){
        $data_msg = array();		
		$data_msg['meta_title'] = "Manage Investor Director Review";		
		$items_per_page = $this->all_function->get_site_options('admin_listing_per_page');
        $current_page = (int) $this->input->get('page');
        $current_page = $current_page > 0 ? $current_page : 1;		
		$data_msg['start_count'] = ($current_page * $items_per_page - $items_per_page + 1);
        $limit_from = ($current_page - 1) * $items_per_page;
		
		$total_items = $this->Reviews_model->get_investor_review_num();
		$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-investor-review'));
		$get_value = $this->Reviews_model->get_investor_review_details($items_per_page, $limit_from);
		$data_msg['display_result'] = $get_value->result_array();
		
		$sql_last = $this->db->last_query();
		$sql_last = explode('LIMIT',$sql_last);
		$this->session->set_userdata(array('ExportSme' => $sql_last[0] ));
		$this->view('reviews/manage_investor_review', $data_msg);
		}else{			
			 redirect(base_url('access-denied'));		
		}
    }
	
	public function manage_invoices_review(){
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
		if($admin_type=='Director' || $admin_type=='Administrator'){
        $data_msg = array();		
		$data_msg['meta_title'] = "Manage Under Process Trade";		
		$items_per_page = $this->all_function->get_site_options('admin_listing_per_page');
        $current_page = (int) $this->input->get('page');
        $current_page = $current_page > 0 ? $current_page : 1;		
		$data_msg['start_count'] = ($current_page * $items_per_page - $items_per_page + 1);
        $limit_from = ($current_page - 1) * $items_per_page;
				
		$total_items = $this->Reviews_model->get_under_process_trade_num();
		$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 1,base_url('manage-invoices-review'));
		$get_value = $this->Reviews_model->get_under_process_trade_details($items_per_page, $limit_from);
		$data_msg['display_result'] = $get_value->result_array();
		
		$sql_last = $this->db->last_query();
		$sql_last = explode('LIMIT',$sql_last);
		$this->session->set_userdata(array('ExportUnderProcessTrade' => $sql_last[0] ));
		$this->view('reviews/manage_invoices_review', $data_msg);
		}else{			
			 redirect(base_url('access-denied'));		
		}	
	}
	
}