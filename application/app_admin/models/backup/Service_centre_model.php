<?php class Service_centre_model extends CI_Model {
		  
		  function count_service_centre_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_SERVICE_CENTRE . ' as `cp`');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
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
		 function get_service_centre_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_SERVICE_CENTRE);
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
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
		  function count_service_centre() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_SERVICE_CENTRE . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
			function get_service_centre($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_SERVICE_CENTRE);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		 
			 function del_service_centre($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_SERVICE_CENTRE);
		  }

			function get_service_centre_details($id) {
                  $this->db->select('*')
                          ->from(TBL_SERVICE_CENTRE)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		 
		function update_service_centre($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_SERVICE_CENTRE , $data);
          }
		
		  function add_service_centre($data){
              $this->db->insert(TBL_SERVICE_CENTRE , $data);
			  return $this->db->insert_id();
		  }
  }