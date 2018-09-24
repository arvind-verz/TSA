<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Brands_model extends CI_Model
    {

			function get_brands() {		
				
				$this->db->select('*')
					 ->from(TBL_PRODUCTS_BRANDS)
					 ->where('status', 'Y')
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			function get_brands_details($seo_url) {		
				
				$this->db->select('*')
					 ->from(TBL_PRODUCTS_BRANDS)
					 ->where('status', 'Y')
					 ->where('seo_url', $seo_url)
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			function count_products_by_brands($brands_id) {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_PRODUCTS)
						  ->where('status', 'Y')
					 	  ->where('brands_id', $brands_id);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }		
			function get_products_by_brands($brands_id, $total_row_display , $limit_from) {		
				
				$this->db->select('*')
					 ->from(TBL_PRODUCTS)
					 ->where('status', 'Y')
					 ->where('brands_id', $brands_id)
					 ->order_by('sort_order', 'ASC')
					 ->limit($total_row_display , $limit_from);;
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			

    }