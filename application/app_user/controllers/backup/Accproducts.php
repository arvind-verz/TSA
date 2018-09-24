<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accproducts extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);  
		$this->load->model('Accproducts_model', '', TRUE);
		$this->load->model('Accessoriescat_model', '', TRUE);  
    }
	
	public function product_detail($seo_url) {
        $data_msg = array();
		
		$page = $this->Accproducts_model->get_product_detail($seo_url);
		//print_r($page);exit;
		if(count($page)>0){
			
			$seo_url = 'accproduct/'.$seo_url;
			
			$data_msg['page'] = $page;
			
			
			$parent_cat = $this->Accessoriescat_model->get_parent_cat($page[0]['parent_id']);
			$data_msg['parent_cat'] = $parent_cat;
			$data_msg['top_parent_id']=$parent_cat['cat_id'];
			
			//$menu = $this->Cms_model->get_page('search-by-category');
			//$data_msg['menu_id'] = $menu[0]['menu_id'];
			$data_msg['menu_id'] = 39;
			$data_msg['cat_id'] =$page[0]['cat_id'];
			$id = $page[0]['id'];
			
			//$data_msg['products_options'] = $this->Product_model->get_options();
						
			$data_msg['url_name'] = $seo_url;
			
			$data_msg['url'] = 'accessories';
		
		}else{
			redirect(base_url("page-not-found"));
			
			exit;  	
		}
		
		$data_items['item_viewed'] = array();
		
		$data_items['item_viewed'][] = array('products_id' => $id,'seo_url' => $seo_url,'type'=>'accessories');
		
		$pre_item = $this->session->userdata('item_viewed');
		
		if(!empty($pre_item)){
			
			$data_items['item_viewed'] = array_merge($this->session->userdata('item_viewed'),$data_items['item_viewed']);
			$data_items['item_viewed'] = array_unique($data_items['item_viewed'], SORT_REGULAR);
		}	
				
		$this->session->set_userdata('item_viewed',$data_items['item_viewed']);
		
		//$this->session->unset_userdata('item_viewed');
		
		$this->view('acc_product_detail',$data_msg);

		
    } //Complete Done
		
	 
   
}