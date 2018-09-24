<?php class Reviews_model extends CI_Model {
          function get_sme_review_num() {
                  $this->db->select('count(member_id) as `TotalNum`')
                          ->from(TBL_MEMBER)
						  ->where('director_status' , 'Review')
						  ->where('user_type' , 'SME');

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }

          function get_sme_review_details($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_MEMBER)
						  ->where('director_status' , 'Review')
						  ->where('user_type' , 'SME')
                          ->order_by('last_updated_on' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();

                  return $query;
          }
		  
		  
		  function get_investor_review_num() {
                  $this->db->select('count(member_id) as `TotalNum`')
                          ->from(TBL_MEMBER)
						  ->where('user_type' , 'Investor')
						  ->where('director_status' , 'Review');

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }

          function get_investor_review_details($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_MEMBER)
						  ->where('director_status' , 'Review')
						  ->where('user_type' , 'Investor')
                          ->order_by('last_updated_on' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();

                  return $query;
          }
		  
		  function get_under_process_trade_num() {
		  $this->db->select('count(id) as `TotalNum`')
				  ->from(TBL_INVOICE)
				  ->where('trade_launch_status','Submitted')
				  ->where('trade_launch', 'R')
				  ->order_by('id' , 'desc');
		  $query = $this->db->get()->result_array();
		  if(isset($query[0]['TotalNum'])){
			  $val = $query[0]['TotalNum'];
		  }else{
			  $val = 0;
		  }
		  return $val;
	}
	function get_under_process_trade_details($total_row_display , $limit_from) {
		  $this->db->select('*')
				  ->from(TBL_INVOICE)
				  ->where('trade_launch_status','Submitted')
				  ->where('trade_launch', 'R')
				  ->order_by('id' , 'desc')
				  ->limit($total_row_display , $limit_from);
		  $query = $this->db->get();
		  return $query;
	}
  }?>