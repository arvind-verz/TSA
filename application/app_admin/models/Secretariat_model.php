<?php class Secretariat_model extends CI_Model {
		  
		  function count_secretariat_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_SECRETARIAT . ' as `cp`');
						 //->join(TBL_COMMITTEE_CATEGORY . ' as `tc`' , 'cp.cat_id = tc.id','left');
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
		 function get_secretariat_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('cp.*')
                          ->from(TBL_SECRETARIAT . ' as `cp`');
						 // ->join(TBL_COMMITTEE_CATEGORY . ' as `tc`' , 'cp.cat_id = tc.id','left');
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
		  function count_secretariat() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_SECRETARIAT . ' as `cp`');
						  //>join(TBL_COMMITTEE_CATEGORY . ' as `tc`' , 'cp.cat_id = tc.id','left');
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
			function get_secretariat($total_row_display , $limit_from) {
                  $this->db->select('cp.*')
                          ->from(TBL_SECRETARIAT . ' as `cp`');
						 // ->join(TBL_COMMITTEE_CATEGORY . ' as `tc`' , 'cp.cat_id = tc.id','left');

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		 
			 function del_secretariat($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_SECRETARIAT);
		  }

			function get_secretariat_details($id) {
                  $this->db->select('*')
                          ->from(TBL_SECRETARIAT)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		 
		function update_secretariat($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_SECRETARIAT , $data);
          }
		
		  function add_secretariat($data){
              $this->db->insert(TBL_SECRETARIAT , $data);
			  return $this->db->insert_id();
		  }
  }