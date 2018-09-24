<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);   
		$this->load->model('Events_model', '', TRUE); 
		
    }
	
	
	
	function other_events()
	{
		$data_msg = array();
				
		$data_msg['page'] = $page = $this->Cms_model->get_page('supported-events');
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
			
		$data_msg['url'] = 'supported-events';
		
		$data_msg['url_name'] = 'supported-events';
		
		
		$products_per_page = $this->all_function->get_site_options('other_events_per_page');
		$current_page = (int) $this->input->get('page');			
		$current_page = $current_page > 0 ? $current_page : 1;	
		$limit_from = ($current_page - 1) * $products_per_page;
		
		$total_items = $this->Events_model->count_all_other_events();
		$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $products_per_page, $current_page, 3,base_url('supported-events'));
		$data_msg['oe'] = $this->Events_model->get_all_other_events($products_per_page, $limit_from);
		
		
        $this->view('other_events_listing',$data_msg);
		
	}
	
	
	function event_listing()
	{
		
		$data_msg = array();
		if($this->session->flashdata('error_status')){
			$data_msg['error_status'] = $this->session->flashdata('error_status');
		}else{
			$data_msg['error_status'] = 0;
		}	
		$data_msg['page'] = $page = $this->Cms_model->get_page('svca-events');		
		$data_msg['menu_id'] = $page[0]['menu_id'];			
		$data_msg['url'] = 'svca-events';		
		$data_msg['url_name'] = 'svca-events';
		
		$products_per_page = $this->all_function->get_site_options('svca_events_per_page');
		$current_page = (int) $this->input->get('page');			
		$current_page = $current_page > 0 ? $current_page : 1;	
		$limit_from = ($current_page - 1) * $products_per_page;
		
		if(!isset($_POST['OkFilter']) & !isset($_GET['page'])){
			$this->session->set_userdata(array('FlterData' => '' ));
		   }	
		if(isset($_POST['OkFilter'])){
			$this->session->set_userdata(array('FlterData' => $_POST['FlterData'] ));
			$data_msg['FlterData'] = $FlterData = $_POST['FlterData'];
			$data_msg['total'] = $total_items = $this->Events_model->count_event_filter($FlterData);				
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $products_per_page, $current_page, 3,base_url('svca-events'));
			$data_msg['svca'] = $this->Events_model->get_event_filter($products_per_page, $limit_from, $FlterData);			
		}elseif($this->session->userdata('FlterData')){
			$data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			$data_msg['total'] = $total_items = $this->Events_model->count_event_filter($FlterData);				
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $products_per_page, $current_page, 3,base_url('svca-events'));
			$data_msg['svca'] = $this->Events_model->get_event_filter($products_per_page, $limit_from, $FlterData);	
		}else{
			$this->session->set_userdata(array('FlterData' => '' ));					
		  		$FlterData = array(
				'title'=>'',							
				'venue'=>'',
				'start_date'=>'',							
				'end_date'=>''											
				);
		   $data_msg['FlterData'] = $FlterData;			
		 $total_items = $this->Events_model->count_all_svca_events();
		$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $products_per_page, $current_page, 3,base_url('svca-events'));
		$data_msg['svca'] = $this->Events_model->get_all_svca_events($products_per_page, $limit_from);
		}
		$this->view('events_listing',$data_msg);
		
	}
	
	function event_details($seo_url)
	{
		
		$data_msg = array();
		
		if($this->session->flashdata('error_status')){
			$data_msg['error_status'] = $this->session->flashdata('error_status');
		}else{
			$data_msg['error_status'] = 0;
		}
		
		
		$page = $this->Events_model->get_event_details($seo_url);
		//print_r($page);
		if(count($page)>0){
			
			$data_msg['page'] = $page;
			$data_msg['url_name'] = $seo_url;
			$data_msg['url'] = 'svca-events';
			$data_msg['menu_id'] =0;
			
			$data_msg['pagemain'] = $this->Cms_model->get_page('svca-events');	
			
			$event_pdf = $this->Events_model->get_event_pdf($page[0]['id']);
			$data_msg['pdf'] = $event_pdf;
			
			
		}else{
			redirect(base_url("page-not-found"));
			
			exit;  	
		}	
		
		
		$this->view('event_details',$data_msg);
		
		
	}
	
	
	
	
}