<?php class Parts_model extends CI_Model {
		  
		  function count_parts_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_PARTS . ' as `cp`');
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
		 function get_parts_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_PARTS);
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
		  function count_parts() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_PARTS . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
			function get_parts($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_PARTS);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		 
			 function del_parts($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_PARTS);
		  }

			function get_parts_details($id) {
                  $this->db->select('*')
                          ->from(TBL_PARTS)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		 
		function update_parts($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_PARTS , $data);
          }
		
		  function add_parts($data){
              $this->db->insert(TBL_PARTS , $data);
			  return $this->db->insert_id();
		  }
  }