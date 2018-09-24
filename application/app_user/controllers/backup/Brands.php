<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brands extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);   
		$this->load->model('Brands_model', '', TRUE);  
    }
	
	public function search_by_brands() {

         $data_msg = array();
		
		$data_msg['meta_title'] = "Search By Brands | ".$this->all_function->get_site_options('site_name');
				
		$page = $this->Cms_model->get_page('search-by-brands');
		
		if(count($page)>0){
			
			$data_msg['page'] = $page;
			
			$data_msg['menu_id'] = $page[0]['menu_id'];
						
			$data_msg['url'] = 'search-by-brands';
		
		    $data_msg['url_name'] = 'search-by-brands';

       		$data_msg['brands'] = $this->Brands_model->get_brands();
		
		}else{
			redirect(base_url("page-not-found"));
			
			exit;  	
		}
				
		$this->view('search_by_brands',$data_msg);

		
    }  
	
	public function brands_details($seo_url) {

        $data_msg = array();
		
		$page = $this->Brands_model->get_brands_details($seo_url);
		
		if(count($page)>0){
			
			$seo_url = 'brands/'.$seo_url;
			
			$data_msg['page'] = $page;
			$data_msg['cat_id'] = 0;
			//$menu = $this->Cms_model->get_page('search-by-brands');
		
			$data_msg['menu_id'] = 27;
			
			$id = $page[0]['id'];
						
			$data_msg['url_name'] = $seo_url;
			
			$data_msg['url'] = 'products';
			
			$data_msg['brands'] = $this->Brands_model->get_brands();
						
			// Products Listing.
			
			//$products_per_page = $this->all_function->get_site_options('products_per_page');
			$products_per_page =9;
		
			$current_page = (int) $this->input->get('page');
			
			$current_page = $current_page > 0 ? $current_page : 1;
	
			$limit_from = ($current_page - 1) * $products_per_page;
			
			$total_items = $this->Brands_model->count_products_by_brands($id);
		
			$data_msg['total_items'] = $total_items;
			
			$current_items = ($current_page * $products_per_page);
			
			if($current_items>$total_items){
				if($current_page==1){
					$data_msg['current_items'] = 1;
					$data_msg['display_item'] = $total_items;
				}else{
					$data_msg['current_items'] = (($current_page * $products_per_page) - $products_per_page + 1);
					$data_msg['display_item'] = ($total_items - $data_msg['current_items'] + 1);
				}
			
			}else{
				
				$data_msg['current_items'] = (($current_page * $products_per_page) - $products_per_page + 1);
			}
			if($products_per_page>$total_items){
				
				$products_per_page = $total_items;
			}
			if($products_per_page==0){
				
				$products_per_page = 9;
			}
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $products_per_page, $current_page, 3);
	
			$data_msg['products_list'] = $this->Brands_model->get_products_by_brands($id, $products_per_page, $limit_from);
			
			if($current_items<=$total_items){
			
				$data_msg['display_item'] = count($data_msg['products_list']);
			}
		
		}else{
			redirect(base_url("page-not-found"));
			
			exit;  	
		}
		
		$this->view('brands_details',$data_msg);

		
    }
	
}