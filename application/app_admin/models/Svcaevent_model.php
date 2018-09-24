<?php class Svcaevent_model extends CI_Model {
		  
		  function count_svcaevent_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_EVENTS . ' as `cp`');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'title' ){
								$this->db->like($key , $value);
							}
							if( $key == 'status' ){
								$this->db->where($key , $value);
							}
							if( $key == 'promo_code' ){
								$this->db->where($key , $value);
							}
							if( $key == 'registration_date' ){
								$create_date = str_replace("/", "-", $value); 
								$create_date = date("Y-m-d", strtotime($create_date));
								$this->db->where('DATE(cp.'.$key.')' , $create_date);
							}
							if( $key == 'start_date' ){
								$create_date = str_replace("/", "-", $value); 
								$create_date = date("Y-m-d", strtotime($create_date));
								$this->db->where('DATE(cp.'.$key.')' , $create_date);
							}
						}
					}
				  }
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
		 function get_svcaevent_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_EVENTS);
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'title' ){
								$this->db->like($key , $value);
							}
							if( $key == 'status' ){
								$this->db->where($key , $value);
							}
							if( $key == 'promo_code' ){
								$this->db->where($key , $value);
							}
							if( $key == 'registration_date' ){
								$create_date = str_replace("/", "-", $value); 
								$create_date = date("Y-m-d", strtotime($create_date));
								$this->db->where('DATE('.$key.')' , $create_date);
							}
							if( $key == 'start_date' ){
								$create_date = str_replace("/", "-", $value); 
								$create_date = date("Y-m-d", strtotime($create_date));
								$this->db->where('DATE('.$key.')' , $create_date);
							}
						}
					}
				  }
                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'DESC');

                  $query = $this->db->get();
                  return $query;
          }
		  function count_svcaevent() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_EVENTS . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
			function get_svcaevent($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_EVENTS);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'DESC');

                  $query = $this->db->get();
                  return $query;
          }
		 
			 function del_svcaevent($id){
			  $this->db->where('id', $id);
              $this->db->delete(TBL_EVENTS);
		    }

			function get_svcaevent_details($id) {
                  $this->db->select('*')
                          ->from(TBL_EVENTS)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		 
		function update_svcaevent($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_EVENTS , $data);
          }
		
		  function add_svcaevent($data){
              $this->db->insert(TBL_EVENTS , $data);
			  return $this->db->insert_id();
		  }
		  
		  
		  function get_additional_pdf_file($event_id) {
			  $this->db->select('*')
					  ->from(TBL_EVENTS_PDF)
					  ->where('event_id' , $event_id);
			  $query = $this->db->get();
			  return $query;
	     }
		  
		function get_event_pdf($id)
		 {
			
			$this->db->select('*')
					  ->from(TBL_EVENTS_PDF)
					  ->where('id' , $id);
			  $query = $this->db->get()->row_array();
			  return $query;
			
			 
		 }
		 
		 function del_event_pdf($id) {
                  $this->db->where('event_id' , $id)
                          ->delete(TBL_EVENTS_PDF);
          }    
		  
  }