<?php class Rdirectory_model extends CI_Model {
		  
		  function count_rdirectory_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_RDIRECTORY . ' as `cp`');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name'){
								$this->db->like('cp.'.$key , $value);
							}
							if( $key == 'status' ){
								$this->db->where('cp.'.$key , $value);
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
		 function get_rdirectory_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('cp.*')
                          ->from(TBL_RDIRECTORY . ' as `cp`');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
								$this->db->like('cp.'.$key , $value);
							}
							if( $key == 'status' ){
								$this->db->where('cp.'.$key , $value);
							}
							
						}
					}
				  }
                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		  function count_rdirectory() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_RDIRECTORY . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
			function get_rdirectory($total_row_display , $limit_from) {
                  $this->db->select('cp.*')
                          ->from(TBL_RDIRECTORY . ' as `cp`');

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		 
			 function del_rdirectory($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_RDIRECTORY);
		  }

			function get_rdirectory_details($id) {
                  $this->db->select('*')
                          ->from(TBL_RDIRECTORY)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		 
		function update_rdirectory($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_RDIRECTORY , $data);
          }
		
		  function add_rdirectory($data){
              $this->db->insert(TBL_RDIRECTORY , $data);
			  return $this->db->insert_id();
		  }
  }