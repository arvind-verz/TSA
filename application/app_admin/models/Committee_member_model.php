<?php class Committee_member_model extends CI_Model {
		  
		  function count_committee_member_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_COMMITTEE_MEMBER . ' as `cp`')
						   ->join(TBL_COMMITTEE_CATEGORY . ' as `tc`' , 'cp.cat_id = tc.id','left');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name'){
								$this->db->like('cp.'.$key , $value);
							}
							if( $key == 'status' ){
								$this->db->where('cp.'.$key , $value);
							}
							if( $key == 'cat_id' ){
								$this->db->where('tc.id' , $value);
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
		 function get_committee_member_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('cp.*,tc.name cat_name')
                          ->from(TBL_COMMITTEE_MEMBER . ' as `cp`')
						  ->join(TBL_COMMITTEE_CATEGORY . ' as `tc`' , 'cp.cat_id = tc.id','left');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
								$this->db->like('cp.'.$key , $value);
							}
							if( $key == 'status' ){
								$this->db->where('cp.'.$key , $value);
							}
							if( $key == 'cat_id' ){
								$this->db->where('tc.id' , $value);
							}
						}
					}
				  }
                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		  function count_committee_member() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_COMMITTEE_MEMBER . ' as `cp`')
						  ->join(TBL_COMMITTEE_CATEGORY . ' as `tc`' , 'cp.cat_id = tc.id','left');
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
			function get_committee_member($total_row_display , $limit_from) {
                  $this->db->select('cp.*,tc.name cat_name')
                          ->from(TBL_COMMITTEE_MEMBER . ' as `cp`')
						  ->join(TBL_COMMITTEE_CATEGORY . ' as `tc`' , 'cp.cat_id = tc.id','left');

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		 
			 function del_committee_member($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_COMMITTEE_MEMBER);
		  }

			function get_committee_member_details($id) {
                  $this->db->select('*')
                          ->from(TBL_COMMITTEE_MEMBER)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		 
		function update_committee_member($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_COMMITTEE_MEMBER , $data);
          }
		
		  function add_committee_member($data){
              $this->db->insert(TBL_COMMITTEE_MEMBER , $data);
			  return $this->db->insert_id();
		  }
  }