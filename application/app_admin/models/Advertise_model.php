<?php class Advertise_model extends CI_Model {
		  
		  function count_information_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_HOME_ADVERTISE . ' as `cp`');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'url' ){
								$this->db->like($key , $value);
							}
							if( $key == 'status' ){
								$this->db->where($key , $value);
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
		 function get_information_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_HOME_ADVERTISE);
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'url' ){
								$this->db->like($key , $value);
							}
							if( $key == 'status' ){
								$this->db->where($key , $value);
							}
						}
					}
				  }
                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		  function count_information() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_HOME_ADVERTISE . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
			function get_information($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_HOME_ADVERTISE);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		 
			 function del_information($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_HOME_ADVERTISE);
		  }

			function get_information_details($id) {
                  $this->db->select('*')
                          ->from(TBL_HOME_ADVERTISE)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		 
		function update_information($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_HOME_ADVERTISE , $data);
          }
		
		  function add_information($data){
              $this->db->insert(TBL_HOME_ADVERTISE , $data);
			  return $this->db->insert_id();
		  }
  }