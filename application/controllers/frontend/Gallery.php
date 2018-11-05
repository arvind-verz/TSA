<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery extends CI_Controller {

   public  function __construct() {
        parent::__construct();
        $this->load->model('frontend/Gallery_model', '', TRUE);  
		$this->load->model('frontend/Cms_model', '', TRUE);   
		//$this->load->model('Banner_model', '', TRUE);  
    }
	public function index() {
		
	    $data_msg = array();	
		$url="gallery";	
		$data_msg['page'] =$page = $this->Cms_model->get_page($url);
		$data_msg['menu_id'] = $page[0]['menu_id'];
		$data_msg['url'] = $url;
		$data_msg['gallery'] = $this->Gallery_model->get_gallery();
		$this->breadcrumbs->push('Home', 'home');
        $this->breadcrumbs->push($page[0]['page_heading'], '#');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();	
	
			$this->load->view('frontend/include/header', $data_msg);
			$this->load->view('frontend/gallery');
			$this->load->view('frontend/include/footer');
	}
	
	
	
	
	
}