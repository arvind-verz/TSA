<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Parts extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model('Cms_model', '', TRUE);
		$this->load->model('Parts_model', '', TRUE);   
       
    }
	
	public function index() {
        $data_msg = array();
		
		$data_msg['meta_title'] = "Welcome to ".$this->all_function->get_site_options('site_name');
				
		$data_msg['page'] = $page = $this->Cms_model->get_page('parts');
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		$data_msg['cat_id'] = 0;
		$data_msg['top_parent_id'] = 0;
		$data_msg['url'] = 'parts';
		$data_msg['url_name'] = 'parts';
		//echo $this->input->get('key');
		$skey=$this->input->get('key');
		if(!empty($skey) && isset($skey))
		{
		 $data_msg['key'] = $skey;
		 $data_msg['skey'] = $skey;
		 $data_msg['parts'] = $this->Parts_model->search_parts($skey);
		}else{
		$data_msg['key'] = '0';	
        $data_msg['parts'] = $this->Parts_model->get_parts('0');
		}
		//echo $this->db->last_query();
		//print_r( $data_msg['parts']);
        $this->view('parts_listing',$data_msg);
		
    } 
	
	function parts_details($char)
	{  
		 $data_msg = array();
		 $data_msg['page'] = $page = $this->Cms_model->get_page('parts');
		 
		$data_msg['menu_id'] = $page[0]['menu_id'];
		$data_msg['cat_id'] = 0;
		$data_msg['top_parent_id'] = 0;
		$data_msg['key'] = $char;	
		$data_msg['url'] = 'parts';
		
		$data_msg['url_name'] = 'parts';
		$data_msg['parts'] = $this->Parts_model->get_parts($char);
		 
		 $this->view('parts_listing',$data_msg);
		 
	}
	
}