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
		$page = $this->Cms_model->get_page($url);
		$page1 = $this->Cms_model->get_page_others($url); 
		if(count($page)>0){			
			$data_msg['page'] = $page;		
			$data_msg['menu_id'] = $page[0]['menu_id'];
			$data_msg['page_id'] = $page[0]['id'];		
			$data_msg['url_name'] = $url;
			$data_msg['url'] = $url;		
			$data_msg['url_name2'] = $url;		
		}elseif(count($page1)>0){
			$page = $page1;			
			$data_msg['page'] = $page;		
			$data_msg['menu_id'] = 0;
			$data_msg['page_id'] = $page[0]['id'];		
			$data_msg['url_name'] = $url;
			$data_msg['url'] = $url;		
			$data_msg['url_name2'] = $url;		
		}else{

			redirect(base_url("page-not-found"));	
		}
		
		if($page[0]['template']=='About Us')
		{
			//$data_msg['url_name2'] ='committee';
			$this->view('about_page',$data_msg);
		}else if($page[0]['template']=='Why Join Us'){
		 if($page[0]['id']==46)
		 {
			$data_msg['join_us']='<a href="'.base_url('membership-types').'" class="link-red">JOIN US NOW</a>';
		 }
		$this->view('why_join_us_page',$data_msg);
		
		}else{
		$this->view('inner_page',$data_msg);
		}
		
		
    }  //Complete Done
	
	
	function members()
	{
		$data_msg = array();
				
		$data_msg['page'] = $page = $this->Cms_model->get_page('our-members');
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		/*
		$data_msg['cat_id'] = 0;
		$data_msg['top_parent_id'] = 0;*/
			
		$data_msg['url'] = 'our-members';
		
		$data_msg['url_name'] = 'our-members';
		$data_msg['url_name2'] = 'our-members';
		$data_msg['mc'] = $this->Cms_model->get_members_cms();
		
        $this->view('members_cms',$data_msg);
		
	}
	
	function success()
	{
		$data_msg = array();
		$data_msg['page'] = $page = $this->Cms_model->get_page_others('success');
		$data_msg['menu_id'] = 0;
		$data_msg['url_name'] = 'success';
		$data_msg['url'] = 'success';
		//$this->session->userdata = array();
		$this->view('payment_success',$data_msg);
	}
	function cancel()
	{
		$data_msg = array();
		$data_msg['page'] = $page = $this->Cms_model->get_page_others('cancel');
		$data_msg['menu_id'] = 0;
		$data_msg['url_name'] = 'cancel';
		$data_msg['url'] = 'cancel';
		//$this->session->userdata = array();
		$this->view('payment_cancel',$data_msg);
	}
	
	function membership_type()
	{
		$data_msg = array();
				
		$data_msg['page'] = $page = $this->Cms_model->get_page('membership-types');
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		
			
		$data_msg['url'] = 'membership-types';
		
		$data_msg['url_name'] = 'membership-types';
		$data_msg['url_name2'] = 'membership-types';
		$data_msg['mt'] = $this->Cms_model->get_membership_type();
		
        $this->view('membership_type_cms',$data_msg);
		
	}
	
	
}