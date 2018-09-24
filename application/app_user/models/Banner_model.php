<?php

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Banner_model extends CI_Model
    {

			function get_home_banner() {		
				
				$this->db->select('*')
					 ->from(TBL_BANNER)
					 ->where('status', '1')
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			function get_adds_banner() {		
				
				$this->db->select('*')
					 ->from(TBL_ADDS)
					 ->where('status', '1')
					 ->order_by('sort_order', 'ASC')
					 ->limit('1','0');
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			function get_top_banner($method_name) {		
				
				$this->db->select('*')
					 ->from(TBL_TOPBANNER)
					 ->where('status', '1')
					 ->where('method_name', $method_name)
					 ->order_by('sort_order', 'ASC')
					 ->limit('1','0');
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 

    }