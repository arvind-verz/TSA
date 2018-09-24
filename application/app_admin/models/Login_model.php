<?php
class Login_model extends CI_Model {

		  function matchuser_reset_password($admin_id, $reset_key){
			  $this->db->select('*')
					  ->from(TBL_ADMIN)
					  ->where('admin_id',$admin_id)
					  ->where('reset_key',$reset_key)
					  ->where('reset_status','Y')
					  ->where('status', 'Y');
			  $query = $this->db->get();
			  return $query;
          }
		  function update_user($data , $email) {

                  $this->db->where('email' , $email);
                  $this->db->update(TBL_ADMIN , $data);
          } 
          function matchuser($email , $password) {

                  $this->db->select('*')
                          ->from(TBL_ADMIN)
                          ->where('email' , $email)
                          ->where('password' , $password)
                  		  ->where('status', 'Y');

                  $query = $this->db->get();
				// echo $this->db->last_query(); die();
                  return $query;
          }
		  function matchuser_email($email) {

                  $this->db->select('*')
                          ->from(TBL_ADMIN)
                          ->where('email' , $email)
                  		  ->where('status', 'Y');
                  $query = $this->db->get();
                  return $query;
          }


          function admin_login($db_insert) {
                  $this->db->insert(TBL_ADMIN_LOG_DETAILS , $db_insert);
                  
          }
		  function admin_login_update($data , $login_id) {
                  $this->db->where('login_id' , $login_id);
                  $this->db->update(TBL_ADMIN_LOG_DETAILS , $data);
          }

          function tot_get_admin_login_details() {
                  $this->db->select('count(l.login_id) as `Totallogin`')
                          ->from(TBL_ADMIN_LOG_DETAILS . ' as `l`')
                          ->join(TBL_ADMIN . ' as `a`' , 'a.admin_id = l.admin_id');

                  $query = $this->db->get()->result_array();
				  if(isset($query[0]['Totallogin'])){
					  $val = $query[0]['Totallogin'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }


          function get_login_details($total_row_display , $limit_from) {
                   $this->db->select('*')
                          ->from(TBL_ADMIN_LOG_DETAILS . ' as `l`')
                          ->join(TBL_ADMIN . ' as `a`' , 'a.admin_id = l.admin_id');
                  $this->db->order_by('login_time','ASC');
                  $this->db->limit($total_row_display , $limit_from);

                  $query = $this->db->get();
                  //echo $this->db->last_query();
                  return $query;
          }


          function delete_admin_login_details($id) {
                  $this->db->where('login_id' , $id)
                          ->delete(TBL_ADMIN_LOG_DETAILS);
          }


          function count_login_details() {
                  $this->db->select('count(cp.email_code) as `TotalNum`')
                          ->from(TBL_EMAIL_NOTIFICATION . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }


  }

?>