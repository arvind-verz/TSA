<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Tools_product_model extends CI_Model
    {
		
		function get_featured_product()
		{
			$this->db->select('p.*')
					 ->from(TBL_TOOLS_PRODUCTS . ' as `p`')
					 ->where('p.status', 'Y')
					 ->where('p.featured_product','Y')
					 ->order_by('p.sort_order', 'ASC');
					 //->limit(6);
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
		}
		
		
		/*function get_product_detail($seo_url) {		
					 $this->db->select('p.*,c.cat_name,c.image_banner,c.parent_id,c.seo_url')
					 ->from(TBL_PRODUCTS . ' as `p`')
					 ->join(TBL_CATEGORIES . ' as `c`' , 'p.cat_id = c.cat_id')
					 ->where('p.status', 'Y')
					 ->where('p.seo_url', $seo_url)
					 ->order_by('p.sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			function get_products_options($products_id) {
                  $this->db->select('po.*')
                          ->from(TBL_PRODUCTS_OPTIONS . ' as `po`')
						  ->join(TBL_PRODUCTS_ATTRIBUTES . ' as `pa`' , 'pa.options_id = po.products_options_id')
						  ->where('pa.products_id', $products_id)
						  ->group_by('po.products_options_id')
                          ->order_by('po.sort_order' , 'asc');
                  $query = $this->db->get()->result_array();
				  return $query;
          }		
			function get_options() {
                  $this->db->select('*')
                          ->from(TBL_PRODUCTS_OPTIONS)
                          ->order_by('sort_order' , 'asc');
                  $query = $this->db->get()->result_array();
				 
                  return $query;
          }		
		function get_products_options_name($products_options_id) {
                  $this->db->select('*')
                          ->from(TBL_PRODUCTS_OPTIONS)
						  ->where('products_options_id', $products_options_id);
                  $query = $this->db->get()->result_array();
				   if(isset($query[0]['products_options_name'])){
						$val = $query[0]['products_options_name'];
					}else{
						$val = '';
					}
					return $val;
          }	
		  
		  
		function get_product_pdf($products_id) {
	
			$this->db->select('*')
					->from(TBL_PRODUCTS_PDF)
					->where('products_id', $products_id)
					->order_by('sort_order','ASC');
	
			$query = $this->db->get()->result_array();
			return $query;
		}*/

    }