<?php


  class templates_model extends CI_Model {
          /*
           * total number of all records
           */
		   
		   function get_email_temp_num() {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_EMAIL_TEMP);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		  
		  function get_all_email_temp($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_EMAIL_TEMP)
                          ->order_by('id' , 'asc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get()->result_array();
				 
                  return $query;
          }
		  
		  
		  
		  function delete_enquiries($id) {
                  $this->db->where('id' , $id)
                          ->delete(TBL_ENQUIRIES);
          }
		  
		  function get_enquiries_details($id) {
                  $this->db->select('*')
                          ->from(TBL_ENQUIRIES)
                          ->where('id' , $id);
                  $query = $this->db->get();
                  return $query;
          }   
		   function get_enquiries_temp($id) {
                  $this->db->select('*')
                          ->from(TBL_EMAIL_TEMP)
                          ->where('id' , $id);
                  $query = $this->db->get();
                  return $query;
          }   
		  function update_enquiries($data , $id) {

                  $this->db->where('id' , $id);
                  $this->db->update(TBL_ENQUIRIES , $data);
          }  
		  function update_enquiries_temp($data , $id) {

                  $this->db->where('id' , $id);
                  $this->db->update(TBL_EMAIL_TEMP , $data);
          }  
		  function get_enquiries_num() {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_ENQUIRIES);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		  function get_all_enquiries($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_ENQUIRIES)
                          ->order_by('create_date' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get()->result_array();
				 
                  return $query;
          }
		
		  function count_enquiries_existing($category_name) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_ENQUIRIES . ' as `cp`')
						  ->where('category_name', $category_name);
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		  function check_parent_is_sub($parent_id) {
                  $this->db->select('cp.parent_id as `TotalNum`')
                          ->from(TBL_ENQUIRIES . ' as `cp`')
						  ->where('id', $parent_id);
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
          }
		  function count_enquiries_existing_edit($category_name,$id) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_ENQUIRIES . ' as `cp`')
						  ->where('category_name', $category_name)
						  ->where("id !=",$id);
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		  function add_enquiries($data){
              $this->db->insert(TBL_ENQUIRIES , $data);
		  }
		  function get_parent_enquiries($id){
			   
			   $this->db->select('*')
                          ->from(TBL_ENQUIRIES)
						  ->where("id !=",$id);
                  $query = $this->db->get();

                  return $query;
			   
		   }
		    function get_parent(){
			   
			   $this->db->select('*')
                          ->from(TBL_ENQUIRIES);
                  $query = $this->db->get();

                  return $query;
			   
		   }
		   
		    function get_enquiries($user_type){
			   
			   $this->db->select('*')
                          ->from(TBL_ENQUIRIES)
                            ->where('user_type' , $user_type);
                  $query = $this->db->get();

                  return $query;
			   
		   }
		   


  }

?>