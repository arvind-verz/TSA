<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Accessoriescat extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cms_model', '', TRUE);   
		$this->load->model('Accessoriescat_model', '', TRUE);  
    }
	
	public function accessoriescat_details($seo_url) {

        $data_msg = array();
		
		$page = $this->Accessoriescat_model->get_category_details($seo_url);
		if(count($page)>0){
			$seo_url = 'accessoriescat/'.$seo_url;
			$data_msg['page'] = $page;
		   
		    $data_msg['top_parent_id'] = 0;
			$data_msg['menu_id'] = 39;
			$cat_id = $page[0]['cat_id'];
			$data_msg['cat_id'] = $cat_id;
			$data_msg['url_name'] = $seo_url;
			$data_msg['url'] = 'accessories';
			
			$data_msg['category'] = $this->Accessoriescat_model->get_root_category();
			
			$data_msg['subcat']=$subcat=$this->Accessoriescat_model->get_sub_category_details($cat_id);
			$data_msg['subcat_id']=isset($subcat[0]['cat_id'])?$subcat[0]['cat_id']:0;
			$subcat=isset($subcat[0]['cat_id'])?$subcat[0]['cat_id']:0;
			
			
			$products_per_page = $this->all_function->get_site_options('category_per_page');
			//$products_per_page =1;
			$current_page = (int) $this->input->get('page');			
			$current_page = $current_page > 0 ? $current_page : 1;	
			$limit_from = ($current_page - 1) * $products_per_page;
			$total_items = $this->Accessoriescat_model->count_products_by_category($subcat);
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $products_per_page, $current_page, 3,base_url($seo_url));
			$data_msg['products_list'] = $this->Accessoriescat_model->get_products_by_category($subcat, $products_per_page, $limit_from);
			
		
		}else{
			
			redirect(base_url("page-not-found"));
			
			exit;  	
		}
		
		$this->view('acc_category_details',$data_msg);

		
    }
	
	
	public function accessories_subcat_details($seo_url) {

        $data_msg = array();
		
		$page = $this->Accessoriescat_model->get_category_details($seo_url);
		//print_r($page);exit;
		if(count($page)>0){
			$parent_cat = $this->Accessoriescat_model->get_parent_cat($page[0]['parent_id']);
			//$data_msg['parent_cat'] = $parent_cat;
			//print_r($parent_cat);
			$data_msg['top_parent_id'] =$parent_cat['cat_id'];
			$seo_url = 'accessories-sub-cat/'.$seo_url;
			$data_msg['page'] = $page;
			$data_msg['subcat_id']=$page[0]['cat_id'];
			//$menu = $this->Cms_model->get_page('products');
		   //print_r($menu);exit;
			$data_msg['menu_id'] = 39;
			
			$cat_id = $page[0]['cat_id'];
			$data_msg['cat_id'] = 0;
			$data_msg['url_name'] = $seo_url;
			
			$data_msg['url'] = 'accessories';
			
			$data_msg['category'] = $this->Accessoriescat_model->get_root_category();
			
			
			$products_per_page = $this->all_function->get_site_options('category_per_page');
			//$products_per_page =1;
			$current_page = (int) $this->input->get('page');			
			$current_page = $current_page > 0 ? $current_page : 1;	
			$limit_from = ($current_page - 1) * $products_per_page;
			$total_items = $this->Accessoriescat_model->count_subcat_products($cat_id);
			//echo $this->db->last_query();
			//echo $total_items;//exit;
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $products_per_page, $current_page, 3,base_url($seo_url));
			$data_msg['products_list'] = $this->Accessoriescat_model->get_subcat_products($cat_id, $products_per_page, $limit_from);
			
		
			
		
		}else{
			
			redirect(base_url("page-not-found"));
			
			exit;  	
		}
		
		$this->view('acc_subcategory_details',$data_msg);

		
    }
	
	
	
	
	
}