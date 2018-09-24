<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);   
		$this->load->model('Banner_model', '', TRUE); 
		$this->load->model('Search_model', '', TRUE); 
		$this->load->model('Events_model', '', TRUE);
		//$this->load->model('Category_model', '', TRUE);
		$this->load->library('form_validation');
		//$this->load->library('recaptcha');
    }
	public function booking_remove() { 
		$time = time();
		$this->Events_model->booking_remove($time);
    }
	public function error() { 
		$this->view('include/error');
    }
	public function home() {
        $data_msg = array();
		//echo "<pre>";
		//print_r($_SERVER);
		if($this->session->flashdata('error_status')){
			$data_msg['error_status'] = $this->session->flashdata('error_status');
		}else{
			$data_msg['error_status'] = 0;
		}
		
		//echo $this->session->flashdata('error_status');exit;
		
		$data_msg['meta_title'] = "Welcome to ".$this->all_function->get_site_options('site_name');
				
		$data_msg['page'] = $page = $this->Cms_model->get_page('home');
		
		$data_msg['menu_id'] = $page[0]['menu_id'];
		/*$data_msg['cat_id'] = 0;
		$data_msg['top_parent_id'] = 0;*/
			
		$data_msg['url'] = 'home';
		
		$data_msg['url_name'] = 'home';
		$data_msg['home_banner'] = $this->Banner_model->get_home_banner();
		$data_msg['advatise'] =  $this->Cms_model->get_advatise();
		$data_msg['events'] =  $this->Events_model->get_home_svca_events();
		
		
        $this->view('home',$data_msg);
		
    } 
	
	
	
	
	
	
	
	public function search() {

        $data_msg = array();
		//echo "xxxx";exit;
		//$data_msg['cat_id'] = 0;
		
		$page = $this->Cms_model->get_page_others('search');
		
		if(count($page)>0){
			
		$data_msg['page'] = $page;
		
		$data_msg['menu_id'] = 0;
		
		$data_msg['url_name'] = 'search';
		
		$data_msg['url'] = 'search';
		
		}else{

			redirect(base_url("page-not-found"));
			
			exit;  	
		}
		
		$data_msg['meta_title'] = "Search | ".$this->all_function->get_site_options('site_name');;	
		
		$data_msg['inner_pages'] = array();
		$data_msg['event_pages'] = array();
		//$data_msg['blog_pages'] = array();
		$data_msg['news_pages'] = array();
		
		if(isset($_GET['key'])){
			
			$data_msg['key'] = $key = $_GET['key'];
			
			//$data_msg['inner_pages'] = $this->Search_model->get_main_pages($key);
			$data_msg['event_pages'] = $this->Search_model->get_svca_event($key);
			//$data_msg['news_pages'] = $this->Search_model->get_news_pages($key);
			//echo  $this->db->last_query();
		}else{
			$data_msg['key'] ='';
		}

		$this->view('search',$data_msg);
		
		
    } // Done
	
	
	
	public function faq() {

        $data_msg = array();
		
		$data_msg['meta_title'] = "FAQ";
		
		$data_msg['page'] = $page = $this->Cms_model->get_page_others('faq');
		
		$data_msg['menu_id'] = 0;
		
		$data_msg['faq'] = $this->Cms_model->get_faq();
		
		$data_msg['url_name'] = 'faq';
		
		$data_msg['url'] = 'faq';
		
        $this->view('faq_listing',$data_msg);
		
    } 
	
	
	
	
	public function page_not_found() { 

        redirect(base_url("/"));
		
		
		/*$data_msg = array();
		
		$data_msg['page'] = '';
		
		$data_msg['url'] = '404';
		
		$data_msg['meta_title'] = "Page not found";
		
		$data_msg['url_name'] = 'page-not-found';
		
		$data_msg['brands'] = $this->Brands_model->get_brands();
				
        $this->view('404',$data_msg);*/
		
    } 
	
	
	
	
}