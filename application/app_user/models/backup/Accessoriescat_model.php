<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Accessoriescat_model extends CI_Model
    {

			function get_root_category() {		
				
				$this->db->select('*')
					 ->from(TBL_CATEGORIES)
					 ->where('status', 'Y')
					 ->where('parent_id', '0')
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			function get_sub_categories($cat_id){
				
				$this->db->select('*')
                          ->from(TBL_CATEGORIES)
						  ->where('parent_id' , $cat_id);
                   $this->db->order_by('cat_name' , 'ASC');

                  $query = $this->db->get()->result_array();
                  return $query;
		 }
		 function get_sub_category_details($cat_id) {		
				
				$this->db->select('*')
					 ->from(TBL_CATEGORIES)
					 ->where('status', 'Y')
					 ->where('parent_id', $cat_id)
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			function get_category_details($seo_url) {		
				
				$this->db->select('*')
					 ->from(TBL_CATEGORIES)
					 ->where('status', 'Y')
					 ->where('seo_url', $seo_url)
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			
			function count_products_by_category($cat_id) {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_PRODUCTS)
						  ->where('status', 'Y')
					 	  ->where('cat_id', $cat_id);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }		
			function get_products_by_category($cat_id, $total_row_display , $limit_from) {		
				
				$this->db->select('*')
					 ->from(TBL_PRODUCTS)
					 ->where('status', 'Y')
					 ->where('cat_id', $cat_id)
					 ->order_by('sort_order', 'ASC')
					 ->limit($total_row_display , $limit_from);;
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			
			function get_parent_cat($cat_id)
			{
				
				$this->db->select('*')
					 ->from(TBL_CATEGORIES)
					 ->where('status', 'Y')
					 ->where('cat_id', $cat_id)
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->row_array();
				
			return $query;	

				
				
			}
			
			
			function count_subcat_products($cat_id) {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_PRODUCTS)
						  ->where('status', 'Y')
					 	  ->where('cat_id', $cat_id);
					$query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		  
		  
		  function get_subcat_products($cat_id, $total_row_display , $limit_from) {		
			
			$this->db->select('*')
					 ->from(TBL_PRODUCTS)
					 ->where('status', 'Y')
					 ->where('cat_id', $cat_id)
					 ->order_by('sort_order', 'ASC')
					 ->limit($total_row_display , $limit_from);
					 
				$query = $this->db->get()->result_array();
				
			   return $query;	
			
			} 
			

    }