<?php class Latestnews_model extends CI_Model {

		 function count_latestnews_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_LATESTNEWS . ' as `cp`');
                  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'title' ){
								$this->db->like($key , $value);
							}
							if( $key == 'post_date' ){
								$post_date = str_replace("/", "-", $value); 
								$post_date = date("Y-m-d", strtotime($post_date));
								$this->db->where('DATE('.$key.')' , $post_date);
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
          function get_latestnews_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_LATESTNEWS);
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'title' ){
								$this->db->like($key , $value);
							}
							if( $key == 'post_date' ){
								$post_date = str_replace("/", "-", $value); 
								$post_date = date("Y-m-d", strtotime($post_date));
								$this->db->where('DATE('.$key.')' , $post_date);
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
		 function count_latestnews() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_LATESTNEWS . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }		
          function get_latestnews($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_LATESTNEWS);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		 

          function get_latestnews_details($id) {
                  $this->db->select('*')
                          ->from(TBL_LATESTNEWS)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		function update_latestnews($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_LATESTNEWS , $data);
          }

         
		  function add_latestnews($data){
              $this->db->insert(TBL_LATESTNEWS , $data);
		  }
		   function del_latestnews($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_LATESTNEWS);
		  }
		



  }