<?php class Cms_model extends CI_Model {

		  function count_menu_page_filter($position, $FlterData) {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_MENU)
						  ->where('position' , $position)
						  ->where('parent_id' , 0);
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'menu_title' ){
								$this->db->like($key , $value);
							}
						}
					}
				  }
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
		  
	
	
		  function get_custom_menu_page_filter($position, $total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_MENU)
						  ->where('position' , $position)
						  ->where('parent_id' , 0);
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'menu_title' ){
								$this->db->like($key , $value);
							}
						}
					}
				  }
                  $this->db->limit($total_row_display , $limit_from);
                  $this->db->order_by('sort_order' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		  function count_menu_page($position) {
                  $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_MENU)
						  ->where('position' , $position)
						  ->where('parent_id' , 0);
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
		  function get_custom_menu_page($position) {
                  $this->db->select('*')
                          ->from(TBL_MENU)
						  ->where('position' , $position)
						  ->where('parent_id' , 0);

                  $this->db->order_by('sort_order' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		  function count_cms_filter($FlterData) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_CMS . ' as `cp`');
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'page_heading' ){
								$this->db->like($key , $value);
							}
							if( $key == 'status' ){
								$this->db->where($key , $value);
							}
						}
					}
				  }
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
		 function get_cms_filter($total_row_display , $limit_from, $FlterData) {
                  $this->db->select('*')
                          ->from(TBL_CMS);
				  if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'page_heading' ){
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
		  function count_cms() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_CMS . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['TotalNum']){
					  $val = $query[0]['TotalNum'];
					  }else{
						$val = 0;  
					  }
                  return $val;
          }
			function get_cms() {
                  $this->db->select('*')
                          ->from(TBL_CMS);

                //  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('sort_order' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		  function get_sub_menus($position, $parent_id) {
                  $this->db->select('*')
                          ->from(TBL_MENU)
						  ->where('position' , $position)
						  ->where('parent_id' , $parent_id);
                  $this->db->order_by('sort_order' , 'ASC');
                  $query = $this->db->get()->result_array();
                  return $query;
          }
		  function update_menu_item($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_MENU , $data);
          }
		  function del_menu_item($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_MENU);
		  }
		  function del_banner($page_id){
			  $this->db->where('page_id' , $page_id);
              $this->db->delete(TBL_BANNER);
		  }
		   function add_menu_item($data){
              $this->db->insert(TBL_MENU , $data);
		  }
		  
		  function get_parent_menu($position){
		  		$this->db->select('*')
                          ->from(TBL_MENU)
                          ->where('position' , $position)
						  ->where('parent_id' , 0);
                 return $query = $this->db->get();
          }
		  function get_sub_menu($menu_id){
				$this->db->select('*')
                          ->from(TBL_MENU)
						  ->where('parent_id' , $menu_id);
                   $this->db->order_by('sort_order' , 'ASC');

                  $query = $this->db->get()->result_array();
                  return $query;
		 }
		  
		   function get_menu_position_info($position){
		  		$this->db->select('display_name')
                          ->from(TBL_MENU_POSITION)
                          ->where('position' , $position);
                  $query = $this->db->get()->result_array();
                  
				  if($query[0]['display_name']){
					  $val = $query[0]['display_name'];
					  }else{
						$val = '';  
					  }
                  return $val;
          }
		 function get_pages(){
		  		$this->db->select('*')
                          ->from(TBL_CMS)
                          ->where('status', 'Y');
                  return $this->db->get();
          } 
		  function get_menu_page($position, $total_row_display , $limit_from) {
                  $this->db->select('cms.page_heading, m.menu_title, m.sort_order, m.parent_id, m.id')
                          ->from(TBL_CMS. ' as `cms`')
						  ->join(TBL_MENU . ' as `m`' , 'm.page_id = cms.id')
						  ->where('m.position' , $position);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('m.sort_order' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		  
		  function get_cms_menu(){
		  		$this->db->select('*')
                          ->from(TBL_CMS)
                          ->where('status' , 'Y');
                return $this->db->get();
          }
		  
		  function get_menu_parent_id($id){
			  $this->db->select('parent_id')
                          ->from(TBL_MENU)
                          ->where('id' , $id);
              return $this->db->get()->result_array();
		  }
		  
		  function get_box($total_row_display , $limit_from) {
                  $this->db->select('b.*, s.site_name')
                          ->from(TBL_HOME_BOXES. ' as `b`');

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('id' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
		  function get_menu_item_details($id) {
                  $this->db->select('*')
                          ->from(TBL_MENU)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		  
		  function get_box_details($id) {
                  $this->db->select('b.*, s.site_name')
                          ->from(TBL_HOME_BOXES. ' as `b`')
                          ->where('id' , $id);

                  return $this->db->get();
          }
		  function update_box($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_HOME_BOXES , $data);
          }
		  function del_box($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_HOME_BOXES);
		  }
          function get_tot_num_static() {
                  $this->db->select('count(cp.bid) as `TotalNum`')
                          ->from(TBL_ADDS . ' as `cp`')
                          ->where('language_id' , $this->language_id);

                  $query = $this->db->get()->result_array();
                 if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
			 function del_cms($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_CMS);
		  }

          function count_adds() {
                  $this->db->select('count(cp.bid) as `TotalNum`')
                          ->from(TBL_ADDS . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

                  return $val;
          }
		function get_seo($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_SEO);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('sort_order' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
          function get_adds($total_row_display , $limit_from) {
                  $this->db->select('*')
                          ->from(TBL_ADDS);

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('bid' , 'ASC');

                  $query = $this->db->get();
                  return $query;
          }
			function get_cms_details($id) {
                  $this->db->select('*')
                          ->from(TBL_CMS)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		  function get_menu_position_display($position) {
                  $this->db->select('*')
                          ->from(TBL_MENU_POSITION)
                          ->where('position' , $position);

                  return $this->db->get();
          }
		  function get_menu_position() {
                  $this->db->select('*')
                          ->from(TBL_MENU_POSITION);

                  $query=$this->db->get()->result_array();
				  //echo $this->db->last_query();
                  return $query;
          }
		  
			function get_seo_details($id) {
                  $this->db->select('*')
                          ->from(TBL_SEO)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		  
          function get_adds_details($id) {
                  $this->db->select('*')
                          ->from(TBL_ADDS)
                          ->where('bid' , $id);

                  return $this->db->get();
          }
		function update_cms($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_CMS , $data);
          }
		function update_seo($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_SEO , $data);
          }
          function update_top_adds($data , $id) {
			  		
				  $this->db->where('bid' , $id);
                  $this->db->update(TBL_TOPBANNER , $data);
          }
		  function add_cms($data){
              $this->db->insert(TBL_CMS , $data);
			  return $this->db->insert_id();
		  }
		  function del_seo($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_SEO);
		  }
		 function add_top_adds($data){
              $this->db->insert(TBL_TOPBANNER , $data);
		  }
		   function del_top_adds($id){
			  $this->db->where('bid' , $id);
              $this->db->delete(TBL_TOPBANNER);
		  }

          //=================== Label CMS ====================//

          function get_tot_num_label_cms() {
                  $this->db->select('count(cp.bid) as `TotalNum`')
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
                  $this->db->select('count(cp.bid) as `TotalNum`')
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
                          ->from(TBL_ADDS)
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