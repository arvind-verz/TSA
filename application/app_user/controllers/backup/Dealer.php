<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dealer extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model('Cms_model', '', TRUE);
		$this->load->model('Dealer_model', '', TRUE);   
       
    }
	
	public function index() {
        $data_msg = array();
		
		$data_msg['page'] = $page = $this->Cms_model->get_page('find-a-dealer');
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		$data_msg['cat_id'] = 0;
		$data_msg['top_parent_id'] = 0;
		$data_msg['url'] = 'find-a-dealer';
		$data_msg['url_name'] = 'find-a-dealer';
		$data_msg['country'] = $this->Dealer_model->get_country();
		$country_id=$this->input->post('country_id');
		if(!empty($country_id) && isset($country_id))
		{
			$data_msg['country_id'] = $country_id;
			$data_msg['address']=$address=$this->Dealer_model->get_address($country_id);
			//echo $this->db->last_query();
			
		}else{
			$data_msg['country_id'] = 3;
			$data_msg['address']=$address=$this->Dealer_model->get_address(3);
		}
		
		//echo $this->db->last_query();
		//print_r( $data_msg['parts']);
        $this->view('dealer_listing',$data_msg);
		
    } 
	
	
	
}