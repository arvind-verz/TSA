<?php class Otherevent_model extends CI_Model {
		  
		  function count_otherevent_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_OTHER_EVENT . ' as `cp`');
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
		 function get_otherevent_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_OTHER_EVENT);
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
		  function count_otherevent() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_OTHER_EVENT . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
			function get_otherevent($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_OTHER_EVENT);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		 
			 function del_otherevent($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_OTHER_EVENT);
		  }

			function get_otherevent_details($id) {
                  $this->db->select('*')
                          ->from(TBL_OTHER_EVENT)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		 
		function update_otherevent($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_OTHER_EVENT , $data);
          }
		
		  function add_otherevent($data){
              $this->db->insert(TBL_OTHER_EVENT , $data);
			  return $this->db->insert_id();
		  }
  }