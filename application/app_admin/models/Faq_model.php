<?php class Faq_model extends CI_Model {
          /*
           * total number of all records
           */
		   function count_faq_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_FAQ . ' as `cp`');
                  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
								$this->db->like($key , $value);
							}
							if( $key == 'content' ){
								$this->db->like($key , $value);
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
		   function get_faq_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_FAQ);
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
								$this->db->like($key , $value);
							}
							if( $key == 'content' ){
								$this->db->like($key , $value);
							}
							if( $key == 'status' ){
								$this->db->where($key , $value);
							}
						}
					}
				  }
                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('sort_order' , 'ASC');
                  $query = $this->db->get();
                  return $query;
          }
		   function get_details($id) {
                  $this->db->select('*')
                          ->from(TBL_FAQ)
                          ->where('id' , $id);
                  $query = $this->db->get();
                  return $query;
          }
		  function update_faq($data , $id) {

                  $this->db->where('id' , $id);
                  $this->db->update(TBL_FAQ , $data);
          }
		  function add_faq($data){
              $this->db->insert(TBL_FAQ , $data);
		  }

		  function delete_faq($id) {
                  $this->db->where('id' , $id)
                          ->delete(TBL_FAQ);
          }
		  function get_faq_num() {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_FAQ);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
          function get_all_faq_details($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_FAQ)
                          ->order_by('sort_order' , 'asc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();

                  return $query;
          }
  }?>