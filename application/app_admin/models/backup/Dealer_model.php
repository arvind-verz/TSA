<?php class Dealer_model extends CI_Model {
		  
		  function count_dealer_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_DEALER . ' as `cp`')
						   ->join(TBL_COUNTRY . ' as `tc`' , 'cp.country_id = tc.id','left');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
								$this->db->like('cp.'.$key , $value);
							}
							if( $key == 'status' ){
								$this->db->where('cp.'.$key , $value);
							}
							if( $key == 'country_id' ){
								$this->db->where('tc.id' , $value);
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
		 function get_dealer_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('cp.*,tc.name country_name')
                          ->from(TBL_DEALER . ' as `cp`')
						  ->join(TBL_COUNTRY . ' as `tc`' , 'cp.country_id = tc.id','left');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
								$this->db->like('cp.'.$key , $value);
							}
							if( $key == 'status' ){
								$this->db->where('cp.'.$key , $value);
							}
							if( $key == 'country_id' ){
								$this->db->where('tc.id' , $value);
							}
						}
					}
				  }
                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		  function count_dealer() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_DEALER . ' as `cp`')
						  ->join(TBL_COUNTRY . ' as `tc`' , 'cp.country_id = tc.id','left');
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
			function get_dealer($total_row_display , $limit_from) {
                  $this->db->select('cp.*,tc.name country_name')
                          ->from(TBL_DEALER . ' as `cp`')
						  ->join(TBL_COUNTRY . ' as `tc`' , 'cp.country_id = tc.id','left');

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		 
			 function del_dealer($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_DEALER);
		  }

			function get_dealer_details($id) {
                  $this->db->select('*')
                          ->from(TBL_DEALER)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		 
		function update_dealer($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_DEALER , $data);
          }
		
		  function add_dealer($data){
              $this->db->insert(TBL_DEALER , $data);
			  return $this->db->insert_id();
		  }
  }