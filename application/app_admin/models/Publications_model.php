<?php class Publications_model extends CI_Model {
		  
		  function count_publications_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_PUBLICATIONS . ' as `cp`');
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
		 function get_publications_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('cp.*')
                          ->from(TBL_PUBLICATIONS . ' as `cp`');
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
		  function count_publications() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_PUBLICATIONS . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
			function get_publications($total_row_display , $limit_from) {
                  $this->db->select('cp.*')
                          ->from(TBL_PUBLICATIONS . ' as `cp`');

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		 
			 function del_publications($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_PUBLICATIONS);
		  }

			function get_publications_details($id) {
                  $this->db->select('*')
                          ->from(TBL_PUBLICATIONS)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		 
		function update_publications($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_PUBLICATIONS , $data);
          }
		
		  function add_publications($data){
              $this->db->insert(TBL_PUBLICATIONS , $data);
			  return $this->db->insert_id();
		  }
  }