<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Dealer_model extends CI_Model
    {
           
		   function get_country()
		   {
			   $this->db->select('*')
                          ->from(TBL_COUNTRY)	
						  ->where('status', 'Y');
						  $this->db->order_by('sort_order' , 'asc');
						  		   
								   
                  $query = $this->db->get()->result_array();
				 return $query;
		   }
		   
		   
		   function get_address($id)
		   {
			   /*$this->db->select('cp.*,tc.longitude clng,tc.latitude clat,tc.zoom,tc.name cname')
                        ->from(TBL_DEALER. ' as `cp`')
						 ->join(TBL_COUNTRY . ' as `tc`' , 'cp.country_id = tc.id','left')
                          ->where('cp.country_id' , $id)
						  ->order_by('cp.sort_order', 'ASC');
                  $query = $this->db->get()->result_array();
                  return $query;*/
				  
				  
				  $this->db->select('cp.*,tc.longitude clng,tc.latitude clat,tc.zoom,tc.name cname')
                        ->from(TBL_COUNTRY. ' as `tc`')
						 ->join(TBL_DEALER . ' as `cp`' , 'tc.id=cp.country_id ','left')
                          ->where('tc.id' , $id)
						  ->order_by('cp.sort_order', 'ASC');
                  $query = $this->db->get()->result_array();
                  return $query;
				  
				  
		   }
		   
		  
	

    }