<?php

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Staticpage_model extends CI_Model
    {

			function get_categories() {		
				
				$this->db->select('*')
					 ->from(TBL_CATEGORIES)
					 ->where('parent_id', 0);
					 
				$query = $this->db->get()->result_array();
				
				$parent_name= array(); $i=0;
				
				$sub_query = array();
				
				foreach ($query as $key => $val){ 
				
					  $parent_id =$val['id'];
					  
					  if($parent_id>0){
						  
						   $this->db->select('*')
								  ->from(TBL_CATEGORIES)
								  ->where('parent_id', $parent_id);
								  
					  $sub_query = $this->db->get()->result_array();
					  
					  }
					  
					  array_push($query[$i] ,$sub_query);
					  
					  $i++;
				  }
				
			return $query;	
			
			} 
			function get_cate_name($cat) {		
				
				$this->db->select('*')
					 ->from(TBL_CATEGORIES)
					 ->where('cat_seo_name', $cat);
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			function get_cate_url($cat) {		
				
				$this->db->select('*')
					 ->from(TBL_CATEGORIES)
					 ->where('id', $cat);
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			
			function get_articles_name($article) {		
				
				$this->db->select('*')
					 ->from(TBL_ARTICLES)
					 ->where('seo_name', $article);
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			
		   
		   
		   function count_suscriber_existing($email) {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_SUSCRIBER . ' as `cp`')
						  ->where('email', $email);
                  $query = $this->db->get()->result_array();
                  $val = $query[0]['TotalNum'];

                  return $val;
          }
		 
		 
		 function add_contactus($data){
              $this->db->insert(TBL_CONTACT_US , $data);
		  }
		  
		   function add_subscriber($data){
              $this->db->insert(TBL_SUSCRIBER , $data);
		  }
		  
		  function get_page_status($page_name)
          {

                $this->db->select('status')
                        ->from(TBL_CMS_PAGE)
                        ->where('page_name', $page_name);

                $query = $this->db->get()->result_array();
                $val = isset($query[0]['status']) ? $query[0]['status'] : 0;
                return $val;

          }

          function get_page_content($page_name)
          {

                $this->db->select('*')
                        ->from(TBL_CMS_PAGE)
                        ->where('page_name', $page_name)
                        ->where('status', '1');

                $query = $this->db->get();
                return $query;

          }
		   function get_cat_name($page_name)
          {

                $this->db->select('*')
                        ->from(TBL_CATEGORIES)
                        ->where('placeholder_id', $page_name)
                        ->where('status', '1');

                $query = $this->db->get();
                return $query;

          }
		   function get_all_banner($id)
          {

                $this->db->select('*')
                        ->from(TBL_CATBANNER)
                        ->where('cat_id', $id)
                        ->where('status', '1');

                $query = $this->db->get();
                return $query;

          }
		  function get_banner()
          {

                $this->db->select('*')
                        ->from(TBL_BANNER)
                        ->where('status', '1')
						->order_by('sort_order', 'ASC');

                $query = $this->db->get();
                return $query;

          }
		  function get_top_three_box()
          {

                $this->db->select('*')
                        ->from(TBL_HOME_BOX)
						->order_by('sort_order', 'ASC')
						->limit('3','0');

                $query = $this->db->get();
                return $query;

          }
		  function get_about_box()
          {

                $this->db->select('*')
                        ->from(TBL_HOME_BOX)
						->where('bid', '4');

                $query = $this->db->get();
                return $query;

          }
		  function get_testimonial()
          {

                $this->db->select('*')
                        ->from(TBL_TESTIMONIAL)
                        ->where('status', '1')
						->order_by('id', 'RANDOM')
						->limit('1','0');

                $query = $this->db->get();
                return $query;

          }

          function insert_contactus_request($data)
          {

                $this->db->insert(TABLE_CONTACT_US, $data);

          }

          function insert_partner($data)
          {
                $this->db->insert(TABLE_OW_PARTNER, $data);

          }

          function search_partner($email)
          {
                $this->db->select('count(xpi.OWPartnerId) as `TotalRecords`')
                        ->from(TABLE_OW_PARTNER . ' as xpi');
                $this->db->where('xpi.OWPartnerEmail', $email);
                $this->db->where('xpi.Status =', '1');
                $query = $this->db->get();

                if ($query->num_rows > 0)
                {
                      $query = $query->result_array();
                      $val = $query[0]['TotalRecords'];
                }
                else
                {
                      $val = 0;
                }
                return $val;

          }

    }