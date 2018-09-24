<?php

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class News_model extends CI_Model
    {

			function get_all_news($total_row_display , $limit_from) {		
				
				$this->db->select('*')
					 ->from(TBL_LATESTNEWS)
					 ->where('status', 'Y')
					 ->order_by('post_date', 'DESC')
					 ->limit($total_row_display , $limit_from);
					 
				$query = $this->db->get()->result_array();
			return $query;	
			
			} 
			function count_all_news() {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_LATESTNEWS)
						  ->where('status', 'Y');

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
          }
		  
		  	
			
			function get_news_list_year_start($year) {		
				
				$this->db->select('*')
					 ->from(TBL_LATESTNEWS)
					 ->where('status', 'Y')
					 ->where('YEAR(post_date)', $year)
					 ->order_by('post_date', 'ASC');
				$query = $this->db->get()->result_array();
			return $query;	
			
			} 
			function get_news_list_year_end($year) {		
				
				$this->db->select('*')
					 ->from(TBL_LATESTNEWS)
					 ->where('status', 'Y')
					 ->where('YEAR(post_date)', $year)
					 ->order_by('post_date', 'DESC');
				$query = $this->db->get()->result_array();
			return $query;	
			
			} 
			function count_get_news_list($month,$year) {		
				
				$this->db->select('*')
					 ->from(TBL_LATESTNEWS)
					 ->where('status', 'Y')
					 ->where('MONTH(post_date)', $month)
					 ->where('YEAR(post_date)', $year)
					 ->order_by('post_date', 'DESC');
				$query = $this->db->get()->result_array();
				if(count($query)>0){
					  $val = count($query);
				  }else{
					  $val = 0;
				  }
                  return $val;
			}
			function get_news_list($month,$year,$total_row_display , $limit_from) {		
				$this->db->select('*')
					 ->from(TBL_LATESTNEWS)
					 ->where('status', 'Y')
					 ->where('MONTH(post_date)', $month)
					 ->where('YEAR(post_date)', $year)
					 ->order_by('post_date', 'DESC')
					 ->limit($total_row_display , $limit_from);
					
				$query = $this->db->get()->result_array();
			return $query;	
			
			} 
			function get_news_start_date() {		
				
				$this->db->select('post_date')
					 ->from(TBL_LATESTNEWS)
					 ->where('status', 'Y')
					 ->order_by('post_date', 'ASC')
					 ->limit(1, 0);
					 
				$query = $this->db->get()->result_array();
			return $query;	
			
			} 
			function get_news_end_date() {		
				
				$this->db->select('post_date')
					 ->from(TBL_LATESTNEWS)
					 ->where('status', 'Y')
					 ->order_by('post_date', 'DESC')
					 ->limit(1, 0);
					 
				$query = $this->db->get()->result_array();
			return $query;	
			
			} 
			
			function get_news_details($seo_url) {		
				
				$this->db->select('*')
					 ->from(TBL_LATESTNEWS)
					 ->where('status', 'Y')
					 ->where('seo_url', $seo_url);
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			
	######################################
	function count_all_newsletter() {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_NEWSLETTER)
						  ->where('status', 'Y');

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
          }
		  
		  function get_all_newsletter($total_row_display , $limit_from) {		
				
				$this->db->select('*')
					 ->from(TBL_NEWSLETTER)
					 ->where('status', 'Y')
					 ->order_by('post_date', 'DESC')
					 ->limit($total_row_display , $limit_from);
					 
				$query = $this->db->get()->result_array();
			return $query;	
			
			}
			
			function get_newsletter_details($seo_url) {		
				
				$this->db->select('*')
					 ->from(TBL_NEWSLETTER)
					 ->where('status', 'Y')
					 ->where('seo_url', $seo_url);
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			 			
			

    }