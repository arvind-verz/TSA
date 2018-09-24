<?php class Toolkit_model extends CI_Model {
		  
		  function count_toolkit_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_TOOLKIT . ' as `cp`');
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
		 function get_toolkit_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('cp.*')
                          ->from(TBL_TOOLKIT . ' as `cp`');
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
		  function count_toolkit() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_TOOLKIT . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
			function get_toolkit($total_row_display , $limit_from) {
                  $this->db->select('cp.*')
                          ->from(TBL_TOOLKIT . ' as `cp`');

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		 
			 function del_toolkit($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_TOOLKIT);
		  }

			function get_toolkit_details($id) {
                  $this->db->select('*')
                          ->from(TBL_TOOLKIT)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		 
		function update_toolkit($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_TOOLKIT , $data);
          }
		
		  function add_toolkit($data){
              $this->db->insert(TBL_TOOLKIT , $data);
			  return $this->db->insert_id();
		  }
  }