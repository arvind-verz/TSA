<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Rdirectory_model extends CI_Model
    {
			
			function get_rdirectory_details($seo_url)
			{
				$this->db->select('*')
					 ->from(TBL_RDIRECTORY)
					 ->where('status', 'Y')
					 ->where('seo_url', $seo_url)
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
				
			return $query;
			}
			
			
		function get_toolkit()
		{
			$this->db->select('*')
					 ->from(TBL_TOOLKIT)
					 ->where('status','Y')
					 ->order_by('sort_order', 'ASC');					 						 
				$query = $this->db->get()->result_array();
				
			return $query;
		}

    }