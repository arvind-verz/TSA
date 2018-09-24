<?php class Registration_model extends CI_Model {
          /*
           * total number of all records
           */
		   function get_registration_num_filter($FlterData) {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_REGISTRATION);
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
								$this->db->like($key , $value);
							}
							if( $key == 'email' ){
								$this->db->like($key , $value);
							}
							if( $key == 'mobile_no' ){
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
		  function get_all_registration_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_REGISTRATION);
                  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
								$this->db->like($key , $value);
							}
							if( $key == 'email' ){
								$this->db->like($key , $value);
							}
							if( $key == 'mobile_no' ){
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
		  function get_registration_num() {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_REGISTRATION);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
          }
		  function get_all_registration($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_REGISTRATION)
                          ->order_by('create_date' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();
				 
                  return $query;
          }
		   function delete_registration($id) {
                  $this->db->where('id' , $id)
                          ->delete(TBL_REGISTRATION);
          }		  
		  function get_registration_details($id) {
                  $this->db->select('cp.*,GROUP_CONCAT(DISTINCT ha.name) ha_name,GROUP_CONCAT(DISTINCT wc.name) wc_name')
                          ->from(TBL_REGISTRATION. ' as `cp`')
						  ->join(TBL_HEAR_ABOUT . ' as `ha`' , 'FIND_IN_SET(ha.id,cp.hear_about)','left')
						  ->join(TBL_WHY_CHOOSE . ' as `wc`' , 'FIND_IN_SET(wc.id,cp.why_choose)','left')
                          ->where('cp.id' , $id)
						  ->group_by('cp.id');
                  $query = $this->db->get();
                  return $query;
          }   
		  function update_registration($data , $id) {

                  $this->db->where('id' , $id);
                  $this->db->update(TBL_REGISTRATION , $data);
          }  
		  
         

  }

?>