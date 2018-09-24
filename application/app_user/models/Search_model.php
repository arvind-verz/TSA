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
	
      
	  function get_main_pages($key) {
							
                  $this->db->select('m.*, cms.url_name, cms.page_content,cms.page_heading')
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
	  
	  function get_newsletter_pages($key) {
							
                  $this->db->select('*')
                          ->from(TBL_NEWSLETTER)					  
						  ->where('status', 'Y');
						  if($key!=''){
						   $this->db->where('( `title` LIKE "%'.$key.'%" OR `description` LIKE "%'.$key.'%" )');
							}
						  $this->db->order_by('title' , 'asc')
						  		   ->group_by('id');
								   
                  $query = $this->db->get()->result_array();
				 return $query;
          }
		  
		  function get_latestnews_pages($key) {
							
                  $this->db->select('*')
                          ->from(TBL_LATESTNEWS)					  
						  ->where('status', 'Y');
						  if($key!=''){
						   $this->db->where('( `title` LIKE "%'.$key.'%" OR `description` LIKE "%'.$key.'%" )');
							}
						  $this->db->order_by('title' , 'asc')
						  		   ->group_by('id');
								   
                  $query = $this->db->get()->result_array();
				 return $query;
          }
		  
		 
		 
		 function get_rdirectory_pages($key) {
							
                  $this->db->select('*')
                          ->from(TBL_RDIRECTORY)					  
						  ->where('status', 'Y');
						  if($key!=''){
						   $this->db->where('( `name` LIKE "%'.$key.'%" OR `descriptions` LIKE "%'.$key.'%" )');
							}
						  $this->db->order_by('name' , 'asc')
						  		   ->group_by('id');
								   
                  $query = $this->db->get()->result_array();
                  //echo  $this->db->last_query();exit;
				 return $query;
          }
		 
		  
		  function get_publication_pages($key) {
							
                  $this->db->select('*')
                          ->from(TBL_PUBLICATIONS)					  
						  ->where('status', 'Y');
						  if($key!=''){
						   $this->db->where('( `name` LIKE "%'.$key.'%" OR `descriptions` LIKE "%'.$key.'%" )');
							}
						  $this->db->order_by('name' , 'asc')
						  		   ->group_by('id');
								   
                  $query = $this->db->get()->result_array();
                  //echo  $this->db->last_query();exit;
				 return $query;
          }
		  
		  
		  function get_toolkit_pages($key) {
							
                  $this->db->select('*')
                          ->from(TBL_TOOLKIT)					  
						  ->where('status', 'Y');
						  if($key!=''){
						   $this->db->where('( `name` LIKE "%'.$key.'%" )');
							}
						  $this->db->order_by('name' , 'asc')
						  		   ->group_by('id');
								   
                  $query = $this->db->get()->result_array();
				 return $query;
          }
		  
		  function get_our_network_pages($key) {
							
                  $this->db->select('*')
                          ->from(TBL_OUR_NETWORK);					  
						  //->where('status', 'Y');
						  if($key!=''){
						   $this->db->where('( `name` LIKE "%'.$key.'%" OR `description` LIKE "%'.$key.'%" )');
							}
						  $this->db->order_by('name' , 'asc')
						  		   ->group_by('id');
								   
                  $query = $this->db->get()->result_array();
				 return $query;
          }
		  
		  
		  
		   function get_faq_pages($key) {
							
                  $this->db->select('*')
                          ->from(TBL_FAQ)					  
						  ->where('status', 'Y');
						  if($key!=''){
						   $this->db->where('( `name` LIKE "%'.$key.'%" OR `content` LIKE "%'.$key.'%" )');
							}
						  $this->db->order_by('name' , 'asc')
						  		   ->group_by('id');
								   
                  $query = $this->db->get()->result_array();
				 return $query;
          }
		  
		  
		 function get_committee_pages($key) {
							
                  $this->db->select('cm.*,mc.seo_url')
                          ->from(TBL_COMMITTEE_MEMBER . ' as cm')
						  ->join(TBL_COMMITTEE_CATEGORY . ' as mc', 'cm.cat_id = mc.id')					  
						  ->where('cm.status', 'Y');
						  if($key!=''){
						   $this->db->where('( cm.`name` LIKE "%'.$key.'%" OR cm.`description` LIKE "%'.$key.'%" )');
							}
						  $this->db->order_by('cm.name' , 'asc')
						  		   ->group_by('cm.id');
								   
                  $query = $this->db->get()->result_array();
				 return $query;
          }
		  
		  
		  function get_secretariat_pages($key) {
							
                  $this->db->select('*')
                          ->from(TBL_SECRETARIAT)					  
						  ->where('status', 'Y');
						  if($key!=''){
						   $this->db->where('( `name` LIKE "%'.$key.'%" OR `description` LIKE "%'.$key.'%" )');
							}
						  $this->db->order_by('name' , 'asc')
						  		   ->group_by('id');
								   
                  $query = $this->db->get()->result_array();
				 return $query;
          } 
		  
	  
    }