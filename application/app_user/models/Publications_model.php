<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Publications_model extends CI_Model
    {
			
			function get_publications_details($seo_url)
			{
				$this->db->select('*')
					 ->from(TBL_PUBLICATIONS)
					 ->where('status', 'Y')
					 ->where('seo_url', $seo_url)
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;
			}
			
			
		function get_publications()
		{
			$this->db->select('*')
					 ->from(TBL_PUBLICATIONS)
					 ->where('status','Y')
					 ->order_by('sort_order', 'ASC');					 						 
				$query = $this->db->get()->result_array();
				
			return $query;
		}
		
		
		function get_our_network_cms()
			{
				$this->db->select('cp.*')
					 ->from(TBL_OUR_NETWORK . ' as `cp`')
					 ->where('cp.id', 1);
					 //->where('cp.status', 'Y');					 
				$query = $this->db->get()->row_array();
				return $query;
			}
		
		

    }