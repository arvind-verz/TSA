<?php class Tools_categories_model extends CI_Model {

		  function get_sub_categories($cat_id){
				
				$this->db->select('*')
                          ->from(TBL_TOOLS_CATEGORIES)
						  ->where('parent_id' , $cat_id);
                   $this->db->order_by('sort_order' , 'ASC');

                  $query = $this->db->get()->result_array();
                  return $query;
		 }
		 function count_categories_filter($FlterData) {
                  $this->db->select('count(cp.cat_id) as `TotalNum`')
                          ->from(TBL_TOOLS_CATEGORIES . ' as `cp`');
                  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){	
							if( $key == 'cat_name' ){
								$this->db->like($key , $value);
							}
							if( $key == 'parent_category' ){
								$this->db->like('cat_name' , $value);
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
		
          function get_categories_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_TOOLS_CATEGORIES);
                  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){	
							if( $key == 'cat_name' ){
								$this->db->like($key , $value);
							}
							if( $key == 'parent_id' ){
								$this->db->where($key , $value);
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
		  function count_categories() {
                  $this->db->select('count(cp.cat_id) as `TotalNum`')
                          ->from(TBL_TOOLS_CATEGORIES . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
          }
		
          function get_categories($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_TOOLS_CATEGORIES);
                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('sort_order' , 'ASC');
                  $query = $this->db->get();
                  return $query;
          }
		  function get_root_categories(){
				
				$this->db->select('*')
                          ->from(TBL_TOOLS_CATEGORIES)
						  ->where('parent_id' , 0);
                   $this->db->order_by('sort_order' , 'ASC');

                  $query = $this->db->get();
                  return $query;
		 }

          function get_categories_details($cat_id) {
                  $this->db->select('*')
                          ->from(TBL_TOOLS_CATEGORIES)
                          ->where('cat_id' , $cat_id);

                  return $this->db->get();
          }
		function update_categories($data , $cat_id) {
			  		
				  $this->db->where('cat_id' , $cat_id);
                  $this->db->update(TBL_TOOLS_CATEGORIES , $data);
          }

         
		  function add_categories($data){
              $this->db->insert(TBL_TOOLS_CATEGORIES , $data);
			  return $this->db->insert_id();
		  }
		   function del_categories($cat_id){
			  $this->db->where('cat_id' , $cat_id);
              $this->db->delete(TBL_TOOLS_CATEGORIES);
		  }
		



  }