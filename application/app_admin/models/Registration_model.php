<?php class Registration_model extends CI_Model {
          /*
           * total number of all records
           */
		   function get_paypal_transaction_details($event_reg_id,$event_id) {
                  $this->db->select('*')
                          ->from(TBL_PAYPAL_TRANSACTION)
				  		  ->where('event_reg_id' , $event_reg_id)
				  		  ->where('event_id' , $event_id);
				  $query = $this->db->get()->row_array();
				  return $query;
          }
		   function get_registration_num_filter($FlterData) {
                  $this->db->select('count(er.id) as `TotalNum`')
                          ->from(TBL_EVENT_REGISTRATION . ' as `er`')
						  ->join(TBL_EVENTS . ' as `te`' , 'er.event_id = te.id')
						  ->join(TBL_MEMBER . ' as `m`' , 'er.member_id = m.member_id','left');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){
							if( $key == 'title' ){
								$this->db->like('te.'.$key , $value);
							}							
							if( $key == 'user_name' ){
								$this->db->like('m.'.$key , $value);
							}
							if( $key == 'first_name' ){
								$this->db->like('er.'.$key , $value);
							}
							if( $key == 'last_name' ){
								$this->db->like('er.'.$key , $value);
							}
							if( $key == 'email' ){
								$this->db->like('er.'.$key , $value);
							}
							if( $key == 'mobile_no' ){
								$this->db->like('er.'.$key , $value);
							}
							if( $key == 'member_type_id' ){
								$this->db->where('er.'.$key , $value);
							}
							if( $key == 'payment_type' ){
								$this->db->where('er.'.$key , $value);
							}
							if( $key == 'is_paid' ){
								$this->db->where('er.'.$key , $value);
							}
							if( $key == 'booking_status' ){
								$this->db->where('er.'.$key , $value);
							}
							if( $key == 'create_date' ){
								$create_date = str_replace("/", "-", $value); 
								$create_date = date("Y-m-d", strtotime($create_date));
								$this->db->where('DATE(er.'.$key.')' , $create_date);
							}
						}
					}
				  }
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
          }
		  function get_all_registration_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('er.*,m.user_name,te.title,te.seo_url')
                          ->from(TBL_EVENT_REGISTRATION . ' as `er`')
						  ->join(TBL_EVENTS . ' as `te`' , 'er.event_id = te.id')
						  ->join(TBL_MEMBER . ' as `m`' , 'er.member_id = m.member_id','left');
                  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){
							if( $key == 'title' ){
								$this->db->like('te.'.$key , $value);
							}							
							if( $key == 'user_name' ){
								$this->db->like('m.'.$key , $value);
							}
							if( $key == 'first_name' ){
								$this->db->like('er.'.$key , $value);
							}
							if( $key == 'last_name' ){
								$this->db->like('er.'.$key , $value);
							}
							if( $key == 'email' ){
								$this->db->like('er.'.$key , $value);
							}
							if( $key == 'mobile_no' ){
								$this->db->like('er.'.$key , $value);
							}
							if( $key == 'member_type_id' ){
								$this->db->where('er.'.$key , $value);
							}
							if( $key == 'payment_type' ){
								$this->db->where('er.'.$key , $value);
							}
							if( $key == 'is_paid' ){
								$this->db->where('er.'.$key , $value);
							}
							if( $key == 'booking_status' ){
								$this->db->where('er.'.$key , $value);
							}
							if( $key == 'create_date' ){
								$create_date = str_replace("/", "-", $value); 
								$create_date = date("Y-m-d", strtotime($create_date));
								$this->db->where('DATE(er.'.$key.')' , $create_date);
							}
						}
					}
				  }
					$this->db->order_by('create_date' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();
				 
                  return $query;
          }
		  function get_registration_num() {
                  $this->db->select('count(er.id) as `TotalNum`')
                          ->from(TBL_EVENT_REGISTRATION . ' as `er`')
						  ->join(TBL_EVENTS . ' as `te`' , 'er.event_id = te.id')
						  ->join(TBL_MEMBER . ' as `m`' , 'er.member_id = m.member_id','left');

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
          }
		  function get_all_registration($total_row_display , $limit_from) {
                  $this->db->select('er.*,te.title,te.seo_url')
                          ->from(TBL_EVENT_REGISTRATION . ' as `er`')
						  ->join(TBL_EVENTS . ' as `te`' , 'er.event_id = te.id')
						  ->join(TBL_MEMBER . ' as `m`' , 'er.member_id = m.member_id','left')
                          ->order_by('er.id' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();
				 
                  return $query;
          }
		   function delete_registration($id) {
                  $this->db->where('id' , $id)
                          ->delete(TBL_EVENT_REGISTRATION);
          }		  
		  function get_registration_details($id) {                  
						  $this->db->select('er.*,te.title,te.seo_url,mt.name')
						  		   ->from(TBL_EVENT_REGISTRATION . ' as `er`')
								   ->join(TBL_EVENTS . ' as `te`' , 'er.event_id = te.id')
								   ->join(TBL_MEMBER_TYPE . ' as `mt`' , 'er.member_type_id = mt.member_type_id','left')
								   ->where('er.id' , $id);
						  
                  $query = $this->db->get();
                  return $query;
          }   
		  function update_registration($data , $id) {

                  $this->db->where('id' , $id);
                  $this->db->update(TBL_EVENT_REGISTRATION , $data);
          }  
		  
         

  }

?>