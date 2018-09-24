<?php

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Cms_model extends CI_Model
    {

		/*function get_menu_position($page_id) {		
				
				 $this->db->select('position')
                          ->from(TBL_MENU)
						  ->where('page_id' , $page_id);
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['position']){
					  $val = $query[0]['position'];
					  }else{
						$val = '';  
					  }
                  return $val;
						
			}
		function get_newsletter($email) {		
				
				 $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_SUSCRIBER . ' as `cp`')
						  ->where('cp.email' , $email);
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
						
			}
			function add_newsletter($data){
              $this->db->insert(TBL_SUSCRIBER , $data);
		  }
		  function add_cart($data){
              $this->db->insert(TBL_CART , $data);
			  return $this->db->insert_id();
		  }
		  function add_cart_item($data){
              $this->db->insert(TBL_CART_PRODUCTS , $data);
		  }
		  
		  
			function get_quotation($id) {		
				
				$this->db->select('*')
					 ->from(TBL_QUOTATION)
					 ->where('id', $id);					 
				$query = $this->db->get()->result_array();
				
			return $query;	
						
			} 
			function get_quotation_enquery($id) {		
				
				$this->db->select('*')
					 ->from(TBL_ENQUIRIES)
					 ->where('id', $id);					 
				$query = $this->db->get()->result_array();
				
			return $query;	
						
			}
			function update_quotation($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_QUOTATION , $data);
          }
			function get_page($url_name) {		
				
				$this->db->select('cp.*, m.menu_title, m.id as menu_id')
					 ->from(TBL_CMS . ' as `cp`')
					 ->join(TBL_MENU . ' as `m`' , 'm.page_id = cp.id')
					 ->where('cp.url_name', $url_name)
					 ->where('cp.status', 'Y');					 
				$query = $this->db->get()->result_array();
				
			return $query;	
						
			} 
			function get_page_others($url_name) {		
				
				$this->db->select('cp.*')
					 ->from(TBL_CMS . ' as `cp`')
					 ->where('cp.url_name', $url_name)
					 ->where('cp.status', 'Y');					 
				$query = $this->db->get()->result_array();
				
			return $query;	
						
			}
			
			function get_testimonial_home() {		
				
				$this->db->select('*')
					 ->from(TBL_TESTIMONIALS)
					 ->order_by('sort_order', 'ASC')
					 ->limit('10','0');					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			}
			function get_latest_news_home() {		
				
				$this->db->select('*')
					 ->from(TBL_LATEST_NEWS)
					 ->order_by('sort_order', 'ASC')
					 ->limit('10','0');					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			}
			function count_gallery() {		
				
				$this->db->select('count(id) as `TotalNum`')
					 ->from(TBL_GALLERY);					 						 
				$query = $this->db->get()->result_array();
				if(isset($query[0]['TotalNum'])){
					$val = $query[0]['TotalNum'];
				}else{
					$val = 0;
				}

                return $val;
			
			}
			
			function get_gallery($test_per_page, $limit_from) {		
				
				$this->db->select('*')
					 ->from(TBL_GALLERY)
					 ->order_by('sort_order', 'ASC')
					 ->limit($test_per_page, $limit_from);					 						 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			}
			function count_testimonials() {		
				
				$this->db->select('count(id) as `TotalNum`')
					 ->from(TBL_TESTIMONIALS);					 						 
				$query = $this->db->get()->result_array();
				
				$val = $query[0]['TotalNum'];

                return $val;
			
			}
			
			function get_testimonial($test_per_page, $limit_from) {		
				
				$this->db->select('*')
					 ->from(TBL_TESTIMONIALS)
					 ->order_by('sort_order', 'ASC')
					 ->limit($test_per_page, $limit_from);					 						 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			}
			function get_news($id) {		
				
				$this->db->select('*')
					 ->from(TBL_LATEST_NEWS)
					 ->where('id', $id)
					 ->order_by('sort_order', 'ASC');					 						 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			}
			function get_faq() {		
				
				$this->db->select('*')
					 ->from(TBL_FAQ)
					 ->order_by('sort_order', 'ASC');					 						 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			}
			function get_home_box($id) {		
				
				$this->db->select('*')
					 ->from(TBL_HOME_BOXES)
					 ->where('id', $id);					 
				$query = $this->db->get()->result_array();
				
			   return $query;	
			
			}
			
			
			
			
			
			
			
			function add_enquiry_form($data){
				
				$this->db->insert(TBL_ENQUIRIES , $data);
				
			}
			function add_contact_form($data){
				
				$this->db->insert(TBL_CONTACT , $data);
				
			}
			function get_contact_form($id) {		
				
				$this->db->select('*')
					 ->from(TBL_EMAIL_TEMP)
					 ->where('id', $id);
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			
			function contact_us_country_list()
			{
				$this->db->select('*')
					 ->from(TBL_COUNTRY_CONTACT)
					 ->where('status', 'Y')
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;
			}*/
			
			function get_page($url_name) {		
				
				$this->db->select('cp.*, m.menu_title, m.id as menu_id')
					 ->from(TBL_CMS . ' as `cp`')
					 ->join(TBL_MENU . ' as `m`' , 'm.page_id = cp.id')
					 ->where('cp.url_name', $url_name)
					 ->where('cp.status', 'Y');					 
				$query = $this->db->get()->result_array();
				
			return $query;	
						
			} 
			function get_page_others($url_name) {		
				
				$this->db->select('cp.*')
					 ->from(TBL_CMS . ' as `cp`')
					 ->where('cp.url_name', $url_name)
					 ->where('cp.status', 'Y');					 
				$query = $this->db->get()->result_array();
				
			return $query;	
						
			}
			
			function get_advatise()
			{
				$this->db->select('*')
					 ->from(TBL_HOME_ADVERTISE)
					 ->where('status', 'Y')
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;
			}
			
			function get_members_cms()
			{
				$this->db->select('cp.*')
					 ->from(TBL_JOIN_US_MEMBER . ' as `cp`')
					 ->where('cp.id', 1);
					 //->where('cp.status', 'Y');					 
				$query = $this->db->get()->row_array();
				return $query;
			}
			
			function get_faq() {		
				
				$this->db->select('*')
					 ->from(TBL_FAQ)
					 ->where('status','Y')
					 ->order_by('sort_order', 'ASC');					 						 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			}
			
			
			function get_page_parent($menu_id)
		    {
			    $this->db->select('tm.*')
					 ->from(TBL_MENU . ' as `tm`')
					 ->where('tm.id', $menu_id);
				return $this->db->get()->row_array();
		    }
		    
		    function get_membership_type()

			{

				$this->db->select('cp.*')

					 ->from(TBL_MEMBERSHIP_TYPE . ' as `cp`')

					 ->where('cp.id', 1);

					 //->where('cp.status', 'Y');					 

				$query = $this->db->get()->row_array();

				return $query;

			}

    }