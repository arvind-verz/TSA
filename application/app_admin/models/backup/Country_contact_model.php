<?php class Country_contact_model extends CI_Model {
		  
		  function count_country_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_COUNTRY_CONTACT . ' as `cp`');
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
		 function get_country_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_COUNTRY_CONTACT);
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
		  function count_country() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_COUNTRY_CONTACT . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
			function get_country($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_COUNTRY_CONTACT);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		 
			 function del_country($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_COUNTRY_CONTACT);
		  }

			function get_country_details($id) {
                  $this->db->select('*')
                          ->from(TBL_COUNTRY_CONTACT)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		 
		function update_country($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_COUNTRY_CONTACT , $data);
          }
		
		  function add_country($data){
              $this->db->insert(TBL_COUNTRY_CONTACT , $data);
			  return $this->db->insert_id();
		  }
		  
		  function get_all_country() {
                  $this->db->select('*')
                          ->from(TBL_COUNTRY_CONTACT)
						  ->order_by('name' , 'ASC');
                  $query = $this->db->get()->result_array();
                  return $query;
          }
		  
		  
		  
  }