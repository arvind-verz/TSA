<?php class Member_model extends CI_Model {
          /*
           * total number of all records
           */
		  function get_member_num_filter($FlterData) {
                  $this->db->select('count(m.member_id) as `TotalNum`')
                          ->from(TBL_MEMBER . ' as `m`')
						  ->join(TBL_MEMBER_TYPE . ' as `mt`' , 'm.member_type_id = mt.member_type_id','left');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'user_name' ){
								$this->db->where('m.'.$key , $value);
							}
							if( $key == 'company_email' ){
								$this->db->like('m.'.$key, $value);
							}
							if( $key == 'member_type_id' ){
								$this->db->where('m.'.$key , $value);
							}
							if( $key == 'status' ){
								$this->db->where('m.'.$key , $value);
							}
							
						}
					}
				  }
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
          function get_all_member_details_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('m.*,mt.name')
                          ->from(TBL_MEMBER . ' as `m`')
						  ->join(TBL_MEMBER_TYPE . ' as `mt`' , 'm.member_type_id = mt.member_type_id','left');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'user_name' ){
								$this->db->where('m.'.$key , $value);
							}
							if( $key == 'company_email' ){
								$this->db->like('m.'.$key, $value);
							}
							if( $key == 'member_type_id' ){
								$this->db->where('m.'.$key , $value);
							}
							if( $key == 'status' ){
								$this->db->where('m.'.$key , $value);
							}
						}
					}
				  }
                  $this->db->order_by('member_id' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();

                  return $query;
          }
		  function get_member_num() {
                  $this->db->select('count(m.member_id) as `TotalNum`')
                          ->from(TBL_MEMBER . ' as `m`')
						  ->join(TBL_MEMBER_TYPE . ' as `mt`' , 'm.member_type_id = mt.member_type_id','left');

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }

          function get_all_member_details($total_row_display , $limit_from) {
                  $this->db->select('m.*,mt.name')
                          ->from(TBL_MEMBER . ' as `m`')
						  ->join(TBL_MEMBER_TYPE . ' as `mt`' , 'm.member_type_id = mt.member_type_id','left')
                          ->order_by('m.member_id' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();

                  return $query;
          }
		  function get_details($id) {
                  $this->db->select('*')
                          ->from(TBL_MEMBER)
                          ->where('member_id' , $id);
                  $query = $this->db->get();
                  return $query;
          }    
		  function update_member($data , $id) {

                  $this->db->where('member_id' , $id);
                  $this->db->update(TBL_MEMBER , $data);
          }  
		  function count_member_existing($email) {
                  $this->db->select('count(cp.member_id) as `TotalNum`')
                          ->from(TBL_MEMBER . ' as `cp`')
						  ->where('email', $email);
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		   function count_email_existing($email) {
                  $this->db->select('count(cp.member_id) as `TotalNum`')
                          ->from(TBL_MEMBER . ' as `cp`')
						  ->where('email', $email);
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		  function add_member($data){
              $this->db->insert(TBL_MEMBER , $data);
			  return $this->db->insert_id();
		  }
		  function delete_member($id) {
                  $this->db->where('member_id' , $id)
                          ->delete(TBL_MEMBER);
          }
		  function get_last_login($user_id){
			   
			   $this->db->select('*')
                          ->from(TBL_MEMBER_LOG_DETAILS)
                            ->where('member_id' , $user_id)
                          ->order_by('login_time' , 'desc')
                          ->limit(1 , 1);
                  $query = $this->db->get();

                  return $query;
			   
		   }
		   function get_last_login_ip($user_id){
			   
			   $this->db->select('*')
                          ->from(TBL_MEMBER_LOG_DETAILS)
                            ->where('member_id' , $user_id)
                          ->order_by('login_time' , 'desc')
                          ->limit(1 , 1);
                  $query = $this->db->get();

                  return $query;
			   
		   }
		   
		   function total_get_member_login_details() {
                  $this->db->select('count(l.login_id) as `Totallogin`')
                          ->from(TBL_MEMBER_LOG_DETAILS . ' as `l`')
                          ->join(TBL_MEMBER . ' as `a`' , 'a.member_id = l.member_id');

                  $query = $this->db->get()->result_array();
				  if(isset($query[0]['Totallogin'])){
					  $val = $query[0]['Totallogin'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }


          function get_member_login_details($total_row_display , $limit_from) {
                   $this->db->select('*')
                          ->from(TBL_MEMBER_LOG_DETAILS . ' as `l`')
                          ->join(TBL_MEMBER . ' as `a`' , 'a.member_id = l.member_id');
                  $this->db->order_by('login_time','ASC');
                  $this->db->limit($total_row_display , $limit_from);

                  $query = $this->db->get();
                  //echo $this->db->last_query();
                  return $query;
          }


          function delete_member_login_details($id) {
                  $this->db->where('login_id' , $id)
                          ->delete(TBL_MEMBER_LOG_DETAILS);
          }
		  
		  function get_member_type()
		  {
			  $this->db->select('*')
                          ->from(TBL_MEMBER_TYPE)
                          ->order_by('sort_order' , 'asc');
                          
                  $query = $this->db->get()->result_array();
				  return $query;
		  }
		  
		  
  }
?>