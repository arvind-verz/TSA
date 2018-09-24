<?php class user_model extends CI_Model {
          /*
           * total number of all records
           */
		  function get_user_num_filter($FlterData) {
                  $this->db->select('count(admin_id) as `TotalNum`')
                          ->from(TBL_ADMIN);
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'user_name' ){
								$user_name = explode(" ", $value);
								foreach($user_name as $name) {
									$this->db->where('(first_name LIKE "%'.$name.'%" OR last_name LIKE "%'.$name.'%")');
								}
							}
							if( $key == 'email' ){
								$this->db->like($key , $value);
							}
							if( $key == 'user_type' ){
								$this->db->where($key , $value);
							}
							if( $key == 'status' ){
								$this->db->where($key , $value);
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
          function get_all_user_details_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_ADMIN);
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'user_name' ){
								$user_name = explode(" ", $value);
								foreach($user_name as $name) {
									$this->db->where('(first_name LIKE "%'.$name.'%" OR last_name LIKE "%'.$name.'%")');
								}
							}
							if( $key == 'email' ){
								$this->db->like($key , $value);
							}
							if( $key == 'user_type' ){
								$this->db->where($key , $value);
							}
							if( $key == 'status' ){
								$this->db->where($key , $value);
							}
						}
					}
				  }
                  $this->db->order_by('last_updated_on' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();

                  return $query;
          }
		  function get_user_num() {
                  $this->db->select('count(admin_id) as `TotalNum`')
                          ->from(TBL_ADMIN);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }

          function get_all_user_details($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_ADMIN)
                          ->order_by('last_updated_on' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();

                  return $query;
          }
		  function get_details($id) {
                  $this->db->select('*')
                          ->from(TBL_ADMIN)
                          ->where('admin_id' , $id);
                  $query = $this->db->get();
                  return $query;
          }    
		  function update_user($data , $id) {

                  $this->db->where('admin_id' , $id);
                  $this->db->update(TBL_ADMIN , $data);
          }  
		  function count_user_existing($email) {
                  $this->db->select('count(cp.admin_id) as `TotalNum`')
                          ->from(TBL_ADMIN . ' as `cp`')
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
                  $this->db->select('count(cp.admin_id) as `TotalNum`')
                          ->from(TBL_ADMIN . ' as `cp`')
						  ->where('email', $email);
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		  function add_user($data){
              $this->db->insert(TBL_ADMIN , $data);
		  }
		  function delete_user($id) {
                  $this->db->where('admin_id' , $id)
                          ->delete(TBL_ADMIN);
          }
		  
		  
		  
		  function delete_role($id) {
                  $this->db->where('id' , $id)
                          ->delete(TBL_ROLE);
          }
		  function delete_department($id) {
                  $this->db->where('id' , $id)
                          ->delete(TBL_DEPARTMENT);
          }
		  function get_role_details($id) {
                  $this->db->select('*')
                          ->from(TBL_ROLE)
                          ->where('id' , $id);
                  $query = $this->db->get();
                  return $query;
          }   
		  function update_role($data , $id) {

                  $this->db->where('id' , $id);
                  $this->db->update(TBL_ROLE , $data);
          }  
		  function get_department_details($id) {
                  $this->db->select('*')
                          ->from(TBL_DEPARTMENT)
                          ->where('id' , $id);
                  $query = $this->db->get();
                  return $query;
          }    
		  function update_department($data , $id) {

                  $this->db->where('id' , $id);
                  $this->db->update(TBL_DEPARTMENT , $data);
          }  
		   
		  function get_role_num() {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_ROLE);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		  function get_all_role($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_ROLE)
                          ->order_by('last_updated' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();

                  return $query;
          }
		  function get_roles() {
                  $this->db->select('*')
                          ->from(TBL_ROLE)
                          ->order_by('last_updated' , 'desc');
                  $query = $this->db->get();

                  return $query;
          }
		  function get_department_num() {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_DEPARTMENT);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		  function get_all_department($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_DEPARTMENT)
                          ->order_by('last_updated' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();

                  return $query;
          }
		  function get_departments() {
                  $this->db->select('*')
                          ->from(TBL_DEPARTMENT)
                          ->order_by('last_updated' , 'desc');
                  $query = $this->db->get();

                  return $query;
          }
		  function count_role_existing($role_name) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_ROLE . ' as `cp`')
						  ->where('role_name', $role_name);
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		  function count_role_existing_edit($role_name,$id) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_ROLE . ' as `cp`')
						  ->where('role_name', $role_name)
						  ->where("id !=",$id);
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		  function add_role($data){
              $this->db->insert(TBL_ROLE , $data);
		  }
		  function count_department_existing($group_name) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_DEPARTMENT . ' as `cp`')
						  ->where('group_name', $group_name);
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		  function count_department_existing_edit($group_name,$id) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_DEPARTMENT . ' as `cp`')
						  ->where('group_name', $group_name)
						  ->where("id !=",$id);
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		  
		  function add_department($data){
              $this->db->insert(TBL_DEPARTMENT , $data);
		  }
		  function get_last_login($user_id){
			   
			   $this->db->select('*')
                          ->from(TBL_ADMIN_LOG_DETAILS)
                            ->where('admin_id' , $user_id)
                          ->order_by('login_time' , 'desc')
                          ->limit(1 , 1);
                  $query = $this->db->get();

                  return $query;
			   
		   }
		   function get_last_login_ip($user_id){
			   
			   $this->db->select('*')
                          ->from(TBL_ADMIN_LOG_DETAILS)
                            ->where('admin_id' , $user_id)
                          ->order_by('login_time' , 'desc')
                          ->limit(1 , 1);
                  $query = $this->db->get();

                  return $query;
			   
		   }
		    function get_role($user_type){
			   
			   $this->db->select('*')
                          ->from(TBL_ROLE)
                            ->where('user_type' , $user_type);
                  $query = $this->db->get();

                  return $query;
			   
		   }


  }

?>