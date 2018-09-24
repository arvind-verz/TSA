<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);   
		$this->load->model('Banner_model', '', TRUE);  
    }
	
	public function inner_pages($url) {

        $data_msg = array();
		$data_msg['cat_id']=0;
		//$data_msg['shop_menu'] = $this->Cms_model->shop_menu();
		
		$page = $this->Cms_model->get_page($url);
		
		if(count($page)>0){
			
		$data_msg['page'] = $page;
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		
		$data_msg['page_id'] = $page[0]['id'];
		
		$data_msg['url_name'] = $url;
		$data_msg['url'] = $url;
		
		}else{

			redirect(base_url("page-not-found"));	
		}
		
		
		/*$menu_position = $this->Cms_model->get_menu_position($page[0]['id']);
		
		if($menu_position=='footerLeft'){
			$this->view('about_page',$data_msg);
		}else{
			$this->view('inner_page',$data_msg);
		}*/
		
		$this->view('inner_page',$data_msg);
		
		
    }  //Complete Done
	
}