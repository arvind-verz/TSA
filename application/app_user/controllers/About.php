<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class About extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);   
		$this->load->model('About_model', '', TRUE); 
		
    }
	
	public function committees($url) {

        $data_msg = array();
				
		$data_msg['page'] = $page = $this->Cms_model->get_page('committee');
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		$data_msg['page_id'] = 58;
		
		//echo $page[0]['id'];exit;
		/*
		$data_msg['cat_id'] = 0;
		$data_msg['top_parent_id'] = 0;*/
			
		$data_msg['url'] = 'committee';
		$data_msg['url_name'] = 'committee';
		$data_msg['url_name2'] = $url;
		
		$data_msg['committee_cat'] =$comm_cat_id=$this->About_model->get_category_id($url);
		$data_msg['committee'] = $this->About_model->get_committee_member($comm_cat_id['id']);
		
		
		
        $this->view('committee_listing',$data_msg);
		
    } 
	
	
	function secretariat()
	{
		$data_msg = array();
				
		$data_msg['page'] = $page = $this->Cms_model->get_page('secretariat');
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		/*
		$data_msg['cat_id'] = 0;
		$data_msg['top_parent_id'] = 0;*/
			
		$data_msg['url'] = 'secretariat';
		
		$data_msg['url_name'] = 'secretariat';
		$data_msg['url_name2'] = 'secretariat';
		$data_msg['secretariat'] = $this->About_model->get_secretariat();
		
		
        $this->view('secretariat_listing',$data_msg);
		
	}
	
	
	
	
	
	
	
	
	
}