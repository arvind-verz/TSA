<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class OurClients extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);
		$this->load->model('Our_clients_model', '', TRUE);
		//$this->load->helper('form');   
    }
	
	 
	
	/*public function index($url) {
		$data_msg = array();
		$page = $this->Cms_model->get_page($url);
		
		$data_msg['page'] = $page;
		$data_msg['menu_id'] = $page[0]['menu_id'];
		$data_msg['page_id'] = $page[0]['id'];
		$data_msg['url_name'] = $url;
		$data_msg['url'] = $url;
		$parent=$this->Cms_model->get_page_parent($page[0]['menu_id']);
		$data_msg['cs_parent']=$parent['parent_id'];
		$data_msg['left_url'] = $url;
		
		$this->view('inner_page_ourdna',$data_msg);
		
	}*/
	
	
	
	function our_clients()
	{
		$data_msg = array();
		$data_msg['cat_id'] = 0;
		$data_msg['meta_title'] = "Our Clients";
		
		$data_msg['url_name'] = 'our-clients';
		
		$data_msg['url'] = 'our-clients';
		
		$data_msg['page'] = $page = $this->Cms_model->get_page('our-clients');
		$data_msg['menu_id'] = $page[0]['menu_id'];
		//$parent=$this->Cms_model->get_page_parent($page[0]['menu_id']);
		//$data_msg['cs_parent']=$parent['parent_id'];
		//$data_msg['left_url'] = 'client-spaces';
		
		###
		//$products_per_page = $this->all_function->get_site_options('news_per_page');
		$products_per_page = 9;
		$current_page = (int) $this->input->get('page');			
		$current_page = $current_page > 0 ? $current_page : 1;	
		$limit_from = ($current_page - 1) * $products_per_page;
					
		$total_items = $this->Our_clients_model->count_all_our_clients();
		$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $products_per_page, $current_page, 3,base_url('our-clients'));			
		$data_msg['cs'] = $this->Our_clients_model->get_all_our_clients($products_per_page, $limit_from);
		###
		
		
		$this->view('our_clients',$data_msg);
	}
	
	
	
}