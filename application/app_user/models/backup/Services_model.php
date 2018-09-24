<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Services_model extends CI_Model
    {
           
		   function get_service_centres()
		   {
			   
			   $this->db->select('*')
                          ->from(TBL_SERVICE_CENTRE)	
						  ->where('status', 'Y');
						  $this->db->order_by('sort_order' , 'asc');
                  $query = $this->db->get()->result_array();
				 return $query;
			   
		   }
		   
		   function get_hear_about()
		   {
			   
			   $this->db->select('*')
                          ->from(TBL_HEAR_ABOUT)	
						  ->where('status', 'Y');
						  $this->db->order_by('sort_order' , 'asc');
                  $query = $this->db->get()->result_array();
				 return $query;
			   
		   }
	      function get_why_choose()
		   {
			   
			   $this->db->select('*')
                          ->from(TBL_WHY_CHOOSE)	
						  ->where('status', 'Y');
						  $this->db->order_by('sort_order' , 'asc');
                  $query = $this->db->get()->result_array();
				 return $query;
			   
		   }

    }