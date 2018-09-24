<?php class Newsletter_model extends CI_Model {

		 function count_newsletter_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_NEWSLETTER . ' as `cp`');
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
          function get_newsletter_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_NEWSLETTER);
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
		 function count_newsletter() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_NEWSLETTER . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }		
          function get_newsletter($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_NEWSLETTER);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		 

          function get_newsletter_details($id) {
                  $this->db->select('*')
                          ->from(TBL_NEWSLETTER)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		function update_newsletter($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_NEWSLETTER , $data);
          }

         
		  function add_newsletter($data){
              $this->db->insert(TBL_NEWSLETTER , $data);
		  }
		   function del_newsletter($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_NEWSLETTER);
		  }
		



  }