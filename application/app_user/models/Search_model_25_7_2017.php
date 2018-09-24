<?php

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Search_model extends CI_Model
    {

		  /*function get_main_pages($key) {
							
                  $this->db->select('m.*, cms.url_name, cms.page_content')
                          ->from(TBL_CMS . ' as cms')	
						  ->join(TBL_MENU . ' as m', 'm.page_id = cms.id')				  
						  ->where('cms.status', 'Y');
						  if($key!=''){
						   $this->db->where('( cms.`page_heading` LIKE "%'.$key.'%" OR m.`menu_title` LIKE "%'.$key.'%" OR cms.`url_name` LIKE "%'.$key.'%" OR cms.`page_content` LIKE "%'.$key.'%" )');
							}
						  $this->db->order_by('cms.page_heading' , 'asc')
						  		   ->group_by('m.menu_title');
								   
                  $query = $this->db->get()->result_array();
				 return $query;
          }
		  
		  
		  function get_product_pages($key) {
							
                  $this->db->select('*')
                          ->from(TBL_TOOLS_PRODUCTS)					  
						  ->where('status', 'Y');
						  if($key!=''){
						   $this->db->where('( `product_name` LIKE "%'.$key.'%" OR `product_short_description` LIKE "%'.$key.'%" OR `about_product` LIKE "%'.$key.'%"  OR `standard_equipment` LIKE "%'.$key.'%"  OR `it` LIKE "%'.$key.'%"  OR `specification` LIKE "%'.$key.'%" OR `spare_parts` LIKE "%'.$key.'%")');
							}
						  $this->db->order_by('product_name' , 'asc')
						  		   ->group_by('id');
								   
                  $query = $this->db->get()->result_array();
				 return $query;
          }
		  function get_blog_pages($key) {
							
                  $this->db->select('*')
                          ->from(TBL_BLOG)					  
						  ->where('status', 'Y');
						  if($key!=''){
						   $this->db->where('( `title` LIKE "%'.$key.'%" OR `description` LIKE "%'.$key.'%" )');
							}
						  $this->db->order_by('title' , 'asc')
						  		   ->group_by('id');
								   
                  $query = $this->db->get()->result_array();
				 return $query;
          }
		  function get_news_pages($key) {
							
                  $this->db->select('*')
                          ->from(TBL_NEWS)					  
						  ->where('status', 'Y');
						  if($key!=''){
						   $this->db->where('( `title` LIKE "%'.$key.'%" OR `description` LIKE "%'.$key.'%" )');
							}
						  $this->db->order_by('title' , 'asc')
						  		   ->group_by('id');
								   
                  $query = $this->db->get()->result_array();
				 return $query;
          }*/
		  
		  function get_svca_event($key)
		  {
			  $this->db->select('*')
                          ->from(TBL_EVENTS)	
						  ->where('end_date>=CURDATE()')      				 						  
						  ->where('status', 'Y');
						  if($key!=''){
						   $this->db->where('( `title` LIKE "%'.$key.'%" OR `contact` LIKE "%'.$key.'%" OR `description` LIKE "%'.$key.'%"  OR `programme` LIKE "%'.$key.'%" )');
							}
						  $this->db->order_by('title' , 'asc')
						  		   ->group_by('id');
								   
                  $query = $this->db->get()->result_array();
				 return $query;
		  }
	

    }