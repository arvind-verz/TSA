<?php

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Our_clients_model extends CI_Model
    {

		function count_all_our_clients()
			{
				$this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_OUR_CLIENT)
						  ->where('status', 'Y');

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
			}
			
			
			function get_all_our_clients($total_row_display , $limit_from) {		
				
				$this->db->select('*')
					 ->from(TBL_OUR_CLIENT)
					 ->where('status', 'Y')
					 ->order_by('sort_order', 'ASC')
					 ->limit($total_row_display , $limit_from);
					 
				$query = $this->db->get()->result_array();
			return $query;	
			
			}
			
				
			

    }