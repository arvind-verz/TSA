<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Parts_model extends CI_Model
    {
           
		   function get_parts($char)
		   {
			   $this->db->select('*')
                          ->from(TBL_PARTS)	
						  ->where('status', 'Y');
						   $this->db->where('( `name` LIKE "'.$char.'%")');
						  $this->db->order_by('sort_order' , 'asc');
						  		   
								   
                  $query = $this->db->get()->result_array();
				 return $query;
		   }
		   
		   function search_parts($skey)
		   {
			   $this->db->select('*')
                          ->from(TBL_PARTS)	
						  ->where('status', 'Y');
						   $this->db->where('( `name` LIKE "%'.$skey.'%")');
						  $this->db->order_by('sort_order' , 'asc');
						  		   
								   
                  $query = $this->db->get()->result_array();
				 return $query;
			   
		   }
		   
		  
	

    }