<?php

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Information_model extends CI_Model
    {

				
			function get_home_information() {		
				
				$this->db->select('*')
					 ->from(TBL_INFORMATION)
					 ->where('status', 'Y')
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
			//echo $str = $this->db->last_query();
			return $query;	
			
			} 
			 
			function get_information()
			{
				$this->db->select('*')
					 ->from(TBL_INFORMATION)
					 ->where('status', 'Y')
					 ->order_by('sort_order', 'asc');
					 
				$query = $this->db->get()->result_array();
			   return $query;
			}
			
			function get_information_slug($seo_url)
			{
				$this->db->select('*')
					 ->from(TBL_INFORMATION)
					 ->where('status', 'Y')
					 ->where('seo_url', $seo_url)
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			}

    }