<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Events_model extends CI_Model
    {
			function booking_remove($time,$data) {
                  $this->db->where('exp_time < '.$time)
				  		  ->where('payment_type', 'Paypal')
						  ->where('is_paid', 'Pending')
						  ->where('booking_status', 'N')
                          ->update(TBL_EVENT_REGISTRATION , $data);
          	}
			function count_all_other_events()
			{
				$this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_OTHER_EVENT)
						  ->where('status', 'Y');

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
			}
			
			
			function get_all_other_events($total_row_display , $limit_from)
			{
				$this->db->select('*')
					 ->from(TBL_OTHER_EVENT)
					 ->where('status', 'Y')
					 ->order_by('sort_order','ASC')
					 ->limit($total_row_display , $limit_from);
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
				
			}
			
			
			function count_all_svca_events()
			{
				$this->db->select('id')
                          ->from(TBL_EVENTS)
						  ->where('status', 'Y')
						  //->where('end_date >= CURDATE()')
      				 	  ->order_by('start_date','DESC');

                  $query = $this->db->get()->result_array();
				  //echo $this->db->last_query(); 
				  //echo count($query);die();
                  return count($query);
			}
			
			
			
			function get_all_svca_events($total_row_display , $limit_from)
			{
				$this->db->select('*')
					 ->from(TBL_EVENTS)
					 ->where('status', 'Y')
					 //->where('end_date>=CURDATE()')
      				 ->order_by('start_date','DESC')
					 ->limit($total_row_display , $limit_from);					 
				$query = $this->db->get()->result_array();
				
			return $query;	
				
			}
			
			
			function get_event_details($seo_url)
			{
				$this->db->select('*')
					 ->from(TBL_EVENTS)
					 ->where('status', 'Y')
					 ->where('seo_url', $seo_url)
					 ->order_by('sort_order', 'ASC');
					 
					 $query = $this->db->get()->result_array();
				
			       return $query;	
			}
			
			
			function get_event_pdf($event_id) {
	
			$this->db->select('*')
					->from(TBL_EVENTS_PDF)
					->where('event_id', $event_id)
					->order_by('sort_order','ASC');
	
			$query = $this->db->get()->result_array();
			return $query;
		}
		
		
		function count_event_filter($FlterData)
		{
			$FromDate = ''; $ToDate = '';
				$this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_EVENTS)
						  ->where('status', 'Y');
                   if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'title' ){
								$this->db->like($key , $value);
							}
							if( $key == 'venue' ){
								$this->db->like($key , $value);
							}
							if( $key == 'start_date' ){
								$FromDate = str_replace("/", "-", $value); 
								$FromDate = date("Y-m-d", strtotime($FromDate));
							}
							if( $key == 'end_date' ){
								$ToDate = str_replace("/", "-", $value); 
								$ToDate = date("Y-m-d",  strtotime('+1 day', strtotime($ToDate)));
							}
							
						}
					}
				  }
				   if($FromDate!='' && $ToDate!=''){
					  $this->db->where('start_date BETWEEN "'.$FromDate.'" AND "'.$ToDate.'"');
				  }elseif($FromDate=='' && $ToDate!=''){
					  $this->db->where('start_date <= "'.$ToDate.'"');
				  }elseif($FromDate!='' && $ToDate==''){
					  $this->db->where('start_date >= "'.$ToDate.'"');
				  }
				  //$this->db->where('end_date>=CURDATE()');
      				$this->db->order_by('start_date','DESC');
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
		}
			
       function get_event_filter($total_row_display , $limit_from, $FlterData)
	   {
		   $FromDate = ''; $ToDate = '';
		   $this->db->select('*')
					 ->from(TBL_EVENTS)
					 ->where('status', 'Y');
					
		   if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'title' ){
								$this->db->like($key , $value);
							}
							if( $key == 'venue' ){
								$this->db->like($key , $value);
							}
							if( $key == 'start_date' ){
								$FromDate = str_replace("/", "-", $value); 
								$FromDate = date("Y-m-d", strtotime($FromDate));
							}
							if( $key == 'end_date' ){
								$ToDate = str_replace("/", "-", $value); 
								$ToDate = date("Y-m-d",  strtotime('+1 day', strtotime($ToDate)));
							}							
						}
					}
				  }
				  if($FromDate!='' && $ToDate!=''){
					  $this->db->where('start_date BETWEEN "'.$FromDate.'" AND "'.$ToDate.'"');
				  }elseif($FromDate=='' && $ToDate!=''){
					  $this->db->where('start_date <= "'.$ToDate.'"');
				  }elseif($FromDate!='' && $ToDate==''){
					  $this->db->where('start_date >= "'.$ToDate.'"');
				  }
				  //$this->db->where('end_date>=CURDATE()');
      				$this->db->order_by('start_date','$this->db');
				  $this->db->limit($total_row_display , $limit_from);
				  $this->db->order_by('sort_order' , 'ASC');
				  $query = $this->db->get()->result_array();
				  //echo $this->db->last_query();
			      return $query;	
				  
	   }

       function get_home_svca_events()
	   {
		   $this->db->select('*')
					 ->from(TBL_EVENTS)
					 ->where('status', 'Y')
					 ->where('end_date>=CURDATE()')
      				 ->order_by('start_date','ASC');
				$query = $this->db->get()->result_array();
				
			return $query;
		   
		   
	   }
	   
	   
	   function get_event_details_by_id($id)
			{
				$this->db->select('*')
					 ->from(TBL_EVENTS)
					 ->where('status', 'Y')
					 ->where('id', $id)
					 ->order_by('sort_order', 'ASC');
					 
					 $query = $this->db->get()->row_array();
				
			       return $query;	
			}
	   

    }