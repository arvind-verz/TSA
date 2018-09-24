<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rdirectory extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);   
		$this->load->model('Rdirectory_model', '', TRUE); 
		$this->load->model('All_function_model', '', TRUE);
    }
	
	public function rdirectory_listing($seo_url) {

        $data_msg = array();
		//$data_msg['page'] = $page = $this->Cms_model->get_page_others('committee');
		$page = $this->Rdirectory_model->get_rdirectory_details($seo_url);
		//print_r($page);
		if(count($page)>0){	
		$data_msg['page'] = $page;
		$data_msg['menu_id'] = 0;
		$data_msg['url'] = 'resource';
		$data_msg['url_name'] = $seo_url;
		$data_msg['url_name2'] = 'directory';
		$rdirectory = $this->All_function_model->get_resource_directory();
		$data_msg['rdirectory'] = $rdirectory;
		$pub = $this->All_function_model->get_resource_publication();
		$data_msg['pub'] = $pub;
		
		
		}else{
			
			redirect(base_url("page-not-found"));
			
			exit;  	
		}
		
		
        $this->view('rdirectory_details',$data_msg);
		
    } 
	
	
	function toolkit()
	{
		$data_msg = array();
		$data_msg['page'] = $page = $this->Cms_model->get_page_others('toolkit');
		if(count($page)>0){	
			$data_msg['menu_id'] = 0;
			$data_msg['url'] = 'resource';
			$data_msg['url_name'] = 'toolkit';
			
			$data_msg['toolkit'] = $this->Rdirectory_model->get_toolkit();
			
			$rdirectory = $this->All_function_model->get_resource_directory();
		    $data_msg['rdirectory'] = $rdirectory;
		    $pub = $this->All_function_model->get_resource_publication();
		    $data_msg['pub'] = $pub;
			
			
		}else{
			
			redirect(base_url("page-not-found"));
			
			exit;  	
		}
		
		$this->view('toolkit_listing',$data_msg);
		
	}
	
	
}