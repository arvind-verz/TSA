<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Blog_model extends CI_Model
    {
			function add_comment($data){
              $this->db->insert(TBL_BLOG_COMMENTS , $data);
		    }
			function get_blog_cat() {		
				
				$this->db->select('*')
					 ->from(TBL_BLOG_CAT)
					 ->where('status', 'Y')
					 ->order_by('sort_order', 'ASC');
					 
				$query = $this->db->get()->result_array();
			return $query;	
			} 			
			function get_blog(){		
				
				$this->db->select('b.*')
					 ->from(TBL_BLOG . ' as `b`')
					 ->join(TBL_ADMIN . ' as `u`' , 'u.admin_id = b.author')
					 ->where('b.status', 'Y')
					 ->order_by('b.post_date', 'DESC')
					 ->limit(6, 0);					 
				$query = $this->db->get()->result_array();
			//echo $str = $this->db->last_query();
			return $query;	
			
			} 
			function get_blog_list($bcat_id) {		
				
				$this->db->select('b.*')
					 ->from(TBL_BLOG . ' as `b`')
					 ->join(TBL_ADMIN . ' as `u`' , 'u.admin_id = b.author')
					 ->where('b.status', 'Y')
					 ->where('b.bcat_id', $bcat_id)
					 ->order_by('b.post_date', 'DESC');
				$query = $this->db->get()->result_array();
			return $query;	
			
			} 
			function get_blog_details($seo_url) {		
				
				$this->db->select('b.*')
					 ->from(TBL_BLOG . ' as `b`')
					 ->join(TBL_ADMIN . ' as `u`' , 'u.admin_id = b.author')
					 ->where('b.status', 'Y')
					 ->where('b.seo_url', $seo_url);
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			function get_cat_details($seo_url) {		
				
				$this->db->select('*')
					 ->from(TBL_BLOG_CAT)
					 ->where('status', 'Y')
					 ->where('seo_url', $seo_url);
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			function get_blog_comments_details($blog_id) {		
				
				$this->db->select('*')
					 ->from(TBL_BLOG_COMMENTS)
					 ->where('status', 'Y')
					 ->where('blog_id', $blog_id);
					 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			} 
			
			

    }