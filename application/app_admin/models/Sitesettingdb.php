<?php class Sitesettingdb extends CI_Model {
	  function get_tot_num() {
			  $this->db->select('count(option_id) as `TotalNum`')
					  ->from(TBL_SITE_OPTIONS)
					  ->where('is_showing' , 'Y');
			  $query = $this->db->get()->result_array();
			  if(isset($query[0]['TotalNum'])){
				  $val = $query[0]['TotalNum'];
			  }else{
				  $val = 0;
			  }

			  return $val;
	  }
	function get_all_details($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_SITE_OPTIONS)
						  ->where('is_showing' , 'Y')
                          ->order_by('sort_order' , 'asc')
                          ->limit($total_row_display , $limit_from);
                  $query = $this->db->get();

                  return $query;
          }
	function get_details($page_name) {
			  $this->db->select('*')
					  ->from(TBL_SITE_OPTIONS)
					  ->where('option_id' , $page_name);
			  $query = $this->db->get();
			  //echo $this->db->last_query();exit;
			  return $query;
	  }
	function get_details_by_option_name($option_name) {
			  $this->db->select('option_name, option_value, default_value, update_date')
					  ->from(TBL_SITE_OPTIONS)
					  ->where('option_id' , $option_name);
			  $query = $this->db->get();
			  return $query;
	  }
	function update_sitesetting($data , $option_name) {

			  $this->db->where('option_id' , $option_name);
			  $this->db->update(TBL_SITE_OPTIONS , $data);
	  }


	  function update_general($data , $id) {
			  $this->db->where('option_id' , $id);
			  $this->db->update(TBL_SITE_OPTIONS , $data);
	  }
		function get_google_analytics($id) {
			  $this->db->select('*')
					  ->from(TBL_GOOGLE)
					  ->where('id' , $id);
			  $query = $this->db->get();
			  return $query;
	  }
	  function update_google_analytics($data , $id) {
			  $this->db->where('id' , $id);
			  $this->db->update(TBL_GOOGLE , $data);
	  }


	  public function get_all_language() {
			  return $this->db->select('*')
							  ->from(TBL_LANGUAGE)
							  ->where('status <>' , '2')
							  ->get()
							  ->result_array();
	  }


	  function update_default_language($data , $id) {
			  $this->db->where('id' , $id);
			  $this->db->where('status' , '1');
			  $this->db->update(TBL_LANGUAGE , $data);

			  $this->db->where('id <>' , $id);
			  $this->db->update(TBL_LANGUAGE , array('default' => '0'));
	  }


	  function update_status_language($data , $id) {
			  $this->db->where('id' , $id);
			  $this->db->where('default' , '0');
			  $this->db->update(TBL_LANGUAGE , $data);
			  //echo $this->db->last_query();exit;
	  }


  }

?>