<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Information extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model('Cms_model', '', TRUE);
		$this->load->model('Information_model', '', TRUE);   
       
    }
	
	public function index() {
        $data_msg = array();
		
		$data_msg['info']=$info = $this->Information_model->get_information();
				
		$data_msg['page'] = $page = $this->Information_model->get_information_slug($info[0]['seo_url']);
		
		$data_msg['menu_id'] = 0;
		$data_msg['cat_id'] = 0;
		$data_msg['top_parent_id'] = 0;
		$data_msg['url'] = 'information';
		$data_msg['url_name'] = 'information';
		
		//$data_msg['key'] = '0';	
       // $data_msg['parts'] = $this->Parts_model->get_parts('0');
		//echo $this->db->last_query();
		//print_r( $data_msg['parts']);
        $this->view('information_listing',$data_msg);
		
    } 
	
	function information_details($seo_url)
	{  
		 $data_msg = array();
		$data_msg['info']=$this->Information_model->get_information();
		$data_msg['page'] = $page = $this->Information_model->get_information_slug($seo_url);
		if(count($page)>0){
		$data_msg['menu_id'] = 0;
		$data_msg['cat_id'] = 0;
		$data_msg['top_parent_id'] = 0;
		$data_msg['url'] = 'information';
		$data_msg['url_name'] = 'information';
		}else{
			
			redirect(base_url("page-not-found"));
			
			exit;  	
		}
		
		$this->view('information_listing',$data_msg);
		 
	}
	
}