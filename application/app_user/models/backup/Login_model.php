<?php
class Login_model extends CI_Model {

		  function matchuser_reset_password($member_id, $reset_key){
			  $this->db->select('*')
					  ->from(TBL_MEMBER)
					  ->where('member_id',$member_id)
					  ->where('reset_key',$reset_key)
					  ->where('reset_status','Y')
					  ->where('status', 'Y');
			  $query = $this->db->get();
			  return $query;
          }
		  function update_user($data , $email) {

                  $this->db->where('email' , $email);
                  $this->db->update(TBL_MEMBER , $data);
          } 
          function matchuser($email , $password) {

                  $this->db->select('*')
                          ->from(TBL_MEMBER)
                          ->where('email' , $email)
                          ->where('password' , $password)
                  		  ->where('status', 'Y');

                  $query = $this->db->get();
				// echo $this->db->last_query(); die();
                  return $query;
          }
		  function matchuser_email($email) {

                  $this->db->select('*')
                          ->from(TBL_MEMBER)
                          ->where('email' , $email)
                  		  ->where('status', 'Y');
                  $query = $this->db->get();
                  return $query;
          }


          function member_login($db_insert) {
                  $this->db->insert(TBL_MEMBER_LOG_DETAILS , $db_insert);
                  
          }
		  function member_login_update($data , $login_id) {
                  $this->db->where('login_id' , $login_id);
                  $this->db->update(TBL_MEMBER_LOG_DETAILS , $data);
          } 

         


  }

?>