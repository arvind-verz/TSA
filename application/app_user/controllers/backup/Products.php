<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);  
		$this->load->model('Product_model', '', TRUE);
		$this->load->model('Category_model', '', TRUE);  
    }
	
	public function product_detail($seo_url) {
        $data_msg = array();
		
		$page = $this->Product_model->get_product_detail($seo_url);
		//print_r($page);exit;
		if(count($page)>0){
			
			$seo_url = 'product/'.$seo_url;
			
			$data_msg['page'] = $page;
			
			
			$parent_cat = $this->Category_model->get_parent_cat($page[0]['parent_id']);
			$data_msg['parent_cat'] = $parent_cat;
			$data_msg['top_parent_id']=$parent_cat['cat_id'];
			
			
			$product_pdf = $this->Product_model->get_product_pdf($page[0]['id']);
			$data_msg['product_pdf'] = $product_pdf;
			
			$product_video = $this->Product_model->get_product_video($page[0]['id']);
			$data_msg['product_video'] = $product_video;
			
			
			
			//$menu = $this->Cms_model->get_page('search-by-category');
			//$data_msg['menu_id'] = $menu[0]['menu_id'];
			$data_msg['menu_id'] = 38;
			$data_msg['cat_id'] =$page[0]['cat_id'];
			$id = $page[0]['id'];
			
			//$data_msg['products_options'] = $this->Product_model->get_options();
						
			$data_msg['url_name'] = $seo_url;
			
			$data_msg['url'] = 'tools';
		
		}else{
			redirect(base_url("page-not-found"));
			
			exit;  	
		}
		
		$data_items['item_viewed'] = array();
		
		$data_items['item_viewed'][] = array('products_id' => $id,'seo_url' => $seo_url,'type'=>'tools');
		
		$pre_item = $this->session->userdata('item_viewed');
		
		if(!empty($pre_item)){
			
			$data_items['item_viewed'] = array_merge($this->session->userdata('item_viewed'),$data_items['item_viewed']);
			$data_items['item_viewed'] = array_unique($data_items['item_viewed'], SORT_REGULAR);
		}	
				
		$this->session->set_userdata('item_viewed',$data_items['item_viewed']);
		
		$this->view('product_detail',$data_msg);

		
    } //Complete Done
		
	 
   
}