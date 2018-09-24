<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class About_model extends CI_Model
    {
			
			function get_committee_member($cat_id)
			{
				$this->db->select('*')
					 ->from(TBL_COMMITTEE_MEMBER)
					 ->where('status', 'Y')
					 ->where('cat_id', $cat_id)
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			}
			
			function get_category_id($seo_url)
			{
				
				$this->db->select('*')
					 ->from(TBL_COMMITTEE_CATEGORY)
					 ->where('status', 'Y')
					 ->where('seo_url', $seo_url);
					 
					 
				$query = $this->db->get()->row_array();
				
			return $query;	
			}
			
			function get_secretariat()
			{
				$this->db->select('*')
					 ->from(TBL_SECRETARIAT)
					 ->where('status', 'Y')
					 ->order_by('sort_order','ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
				
			}
			

    }