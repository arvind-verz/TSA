<?php class Tools_contact_model extends CI_Model {
          /*
           * total number of all records
           */
		   function get_contact_num_filter($FlterData) {
                  $this->db->select('count(tc.id) as `TotalNum`')
                          ->from(TBL_CONTACT_PRODUCT . ' as `tc`')
						  ->join(TBL_TOOLS_PRODUCTS . ' as `tp`' , 'tc.product_id = tp.id','left')
						  ->where('tc.type' ,'tools');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
								$this->db->like('tc.'.$key , $value);
							}
							if( $key == 'email' ){
								$this->db->like('tc.'.$key , $value);
							}
							if( $key == 'mobile_no' ){
								$this->db->like('tc.'.$key , $value);
							}
							if( $key == 'create_date' ){
								$create_date = str_replace("/", "-", $value); 
								$create_date = date("Y-m-d", strtotime($create_date));
								$this->db->where('DATE(tc.'.$key.')' , $create_date);
							}
							if( $key == 'product_name' ){
								$this->db->like('tp.'.$key , $value);
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
		  function get_all_contact_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('tc.*,tp.product_name')
                          ->from(TBL_CONTACT_PRODUCT . ' as `tc`')
						  ->join(TBL_TOOLS_PRODUCTS . ' as `tp`' , 'tc.product_id = tp.id','left')
						  ->where('tc.type' ,'tools');
                  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'name' ){
								$this->db->like('tc.'.$key , $value);
							}
							if( $key == 'email' ){
								$this->db->like('tc.'.$key , $value);
							}
							if( $key == 'mobile_no' ){
								$this->db->like('tc.'.$key , $value);
							}
							if( $key == 'create_date' ){
								$create_date = str_replace("/", "-", $value); 
								$create_date = date("Y-m-d", strtotime($create_date));
								$this->db->where('DATE(tc.'.$key.')' , $create_date);
							}
							if( $key == 'product_name' ){
								$this->db->like('tp.'.$key , $value);
							}
							
						}
					}
				  }
					$this->db->order_by('tc.create_date' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();
				 
                  return $query;
          }
		  function get_contact_num() {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_CONTACT_PRODUCT)
						  ->where('type' ,'tools');

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
          }
		  function get_all_contact($total_row_display , $limit_from) {
                  $this->db->select('tc.*,tp.product_name')
                          ->from(TBL_CONTACT_PRODUCT . ' as `tc`')
						  ->join(TBL_TOOLS_PRODUCTS . ' as `tp`' , 'tc.product_id = tp.id','left')
						  ->where('tc.type','tools')
                          ->order_by('tc.create_date' , 'desc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();
                  return $query;
          }
		   function delete_contact($id) {
                  $this->db->where('id' , $id)
                          ->delete(TBL_CONTACT_PRODUCT);
          }		  
		  function get_contact_details($id) {
                  $this->db->select('cp.*,tc.name country_name,tp.product_name')
                          ->from(TBL_CONTACT_PRODUCT. ' as `cp`')
						  ->join(TBL_COUNTRY_CONTACT . ' as `tc`' , 'cp.contact_country_id = tc.id','left')
						  ->join(TBL_TOOLS_PRODUCTS . ' as `tp`' , 'cp.product_id = tp.id','left')
                          ->where('cp.id' , $id);
                  $query = $this->db->get();
                  return $query;
          }   
		  function update_contact($data , $id) {

                  $this->db->where('id' , $id);
                  $this->db->update(TBL_CONTACT_PRODUCT , $data);
          }  
		  
         function get_country_name($id)
		 {
			$this->db->select('*')
                          ->from(TBL_COUNTRY_CONTACT)
                          ->where('id' , $id);
                  $query = $this->db->get()->row_array();
                  return $query; 
		 }

  }

?>