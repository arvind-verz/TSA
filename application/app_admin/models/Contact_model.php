<?php class contact_model extends CI_Model {
          /*
           * total number of all records
           */
		   function get_contact_num_filter($FlterData) {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_CONTACT);
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
								$this->db->like($key , $value);
							}
							if( $key == 'email' ){
								$this->db->like($key , $value);
							}
							if( $key == 'phone_no' ){
								$this->db->like($key , $value);
							}
							if( $key == 'create_date' ){
								$create_date = str_replace("/", "-", $value); 
								$create_date = date("Y-m-d", strtotime($create_date));
								$this->db->where('DATE('.$key.')' , $create_date);
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
		  function get_all_contact_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_CONTACT);
                  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
								$this->db->like($key , $value);
							}
							if( $key == 'email' ){
								$this->db->like($key , $value);
							}
							if( $key == 'phone_no' ){
								$this->db->like($key , $value);
							}
							if( $key == 'create_date' ){
								$create_date = str_replace("/", "-", $value); 
								$create_date = date("Y-m-d", strtotime($create_date));
								$this->db->where('DATE('.$key.')' , $create_date);
							}
						}
					}
				  }
					$this->db->order_by('create_date' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();
				 
                  return $query;
          }
		  function get_contact_num() {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_CONTACT);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
          }
		  function get_all_contact($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_CONTACT)
                          ->order_by('create_date' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();
				 
                  return $query;
          }
		   function delete_contact($id) {
                  $this->db->where('id' , $id)
                          ->delete(TBL_CONTACT);
          }		  
		  function get_contact_details($id) {
                  $this->db->select('cp.*')
                          ->from(TBL_CONTACT. ' as `cp`')
						  //->join(TBL_COUNTRY_CONTACT . ' as `tc`' , 'cp.contact_country_id = tc.id','left')
                          ->where('cp.id' , $id);
                  $query = $this->db->get();
                  return $query;
          }   
		  function update_contact($data , $id) {

                  $this->db->where('id' , $id);
                  $this->db->update(TBL_CONTACT , $data);
          }  
		  
         function get_country_name($id)
		 {
			$this->db->select('*')
                          ->from(TBL_COUNTRY_CONTACT)
                          ->where('id' , $id);
                  $query = $this->db->get()->row_array();
                  return $query; 
		 }

  }

?>