<?php


  class Logo_model extends CI_Model {

		  
		   function get_page_cms_details($id) {
                  $this->db->select('*')
                          ->from(TBL_LOGO)
						  ->where('id' , $id);
                  $query = $this->db->get();
                  return $query;
          }
          function get_tot_num_static() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_LOGO . ' as `cp`')
                          ->where('language_id' , $this->language_id);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }


          function count_logo() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_LOGO . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		function count_top_logo() {
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
			function get_top_logo($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_TOPBANNER);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
          function get_logo($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_LOGO);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
			function get_top_logo_details($id) {
                  $this->db->select('*')
                          ->from(TBL_TOPBANNER)
                          ->where('id' , $id);

                  return $this->db->get();
          }

          function get_logo_details($id) {
                  $this->db->select('*')
                          ->from(TBL_LOGO)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		function update_page_cms($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_LOGO , $data);
          }

          function update_top_logo($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_TOPBANNER , $data);
          }
		  function add_logo($data){
              $this->db->insert(TBL_LOGO , $data);
		  }
		   function del_logo($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_LOGO);
		  }
		 function add_top_logo($data){
              $this->db->insert(TBL_TOPBANNER , $data);
		  }
		   function del_top_logo($id){
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
                          ->from(TBL_LOGO)
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