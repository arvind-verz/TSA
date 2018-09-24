<?php class Banner_model extends CI_Model {

		 function count_banner_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_BANNER . ' as `cp`');
                  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'title' ){
								$this->db->like($key , $value);
							}
							if( $key == 'content' ){
								$this->db->like($key , $value);
							}
							if( $key == 'url' ){
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
		   function get_banner_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_BANNER);
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'title' ){
								$this->db->like($key , $value);
							}
							if( $key == 'content' ){
								$this->db->like($key , $value);
							}
							if( $key == 'url' ){
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
		  function count_banner() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_BANNER . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
          }
		   function get_banner($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_BANNER);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('sort_order' , 'ASC');
                  $query = $this->db->get();
                  return $query;
          }
		  function get_page_cms_details($id) {
                  $this->db->select('*')
                          ->from(TBL_BANNER)
						  ->where('id' , $id);
                  $query = $this->db->get();
                  return $query;
          }
          function get_tot_num_static() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_BANNER . ' as `cp`')
                          ->where('language_id' , $this->language_id);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		function count_top_banner() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_TOPBANNER . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
			function get_top_banner($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_TOPBANNER);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('sort_order' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
         
			function get_top_banner_details($id) {
                  $this->db->select('*')
                          ->from(TBL_TOPBANNER)
                          ->where('id' , $id);

                  return $this->db->get();
          }

          function get_banner_details($id) {
                  $this->db->select('*')
                          ->from(TBL_BANNER)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		function update_page_cms($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_BANNER , $data);
          }

          function update_top_banner($data , $id) {			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_TOPBANNER , $data);
          }
		  function add_banner($data){
              $this->db->insert(TBL_BANNER , $data);
		  }
		   function del_banner($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_BANNER);
		  }
		 function add_top_banner($data){
              $this->db->insert(TBL_TOPBANNER , $data);
		  }
		   function del_top_banner($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_TOPBANNER);
		  }

          //=================== Label CMS ====================//

          function get_tot_num_label_cms() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_LABEL_PAGE . ' as `cp`')
                          ->where('language_id' , $this->language_id);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }


          function count_label_cms() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_LABEL_PAGE . ' as `cp`')
                          ->where('language_id' , $this->language_id);
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }


          function get_label_cms($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_LABEL_PAGE)
                          ->where('language_id' , $this->language_id);

                  $this->db->limit($total_row_display , $limit_from);

                  $query = $this->db->get();
                  return $query;
          }


          function get_label_cms_details($label_id) {
                  $this->db->select('*')
                          ->from(TBL_BANNER)
                          ->where('label_id' , $label_id);

                  return $this->db->get();
          }


          function update_label_cms($data , $language_id , $label_id) {
                  $this->db->where('language_id' , $language_id);
                  $this->db->where('label_id' , $label_id);
                  $this->db->update(TBL_LABEL_PAGE , $data);
          }


          function get_financial_info() {
                  $this->db->select('*')
                          ->from(TBL_FINANCIAL_INFO);

                  return $this->db->get()->result_array();
          }


          function update_finance_info($data) {
                  $this->db->update(TBL_FINANCIAL_INFO , $data);
          }


  }