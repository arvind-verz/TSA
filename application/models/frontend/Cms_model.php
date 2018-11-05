<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Cms_model extends CI_Model
    {

			
			function get_page($url_name) {		
				
				$this->db->select('cp.*, m.menu_title, m.id as menu_id')
					 ->from(TBL_CMS . ' as `cp`')
					 ->join(TBL_MENU . ' as `m`' , 'm.page_id = cp.id')
					 ->where('cp.url_name', $url_name)
					 ->where('cp.status', 'Y');					 
				$query = $this->db->get()->result_array();
			//echo $this->db->last_query();	
			return $query;	
						
			} 
			function get_page_others($url_name) {		
				
				$this->db->select('cp.*')
					 ->from(TBL_CMS . ' as `cp`')
					 ->where('cp.url_name', $url_name)
					 ->where('cp.status', 'Y');					 
				$query = $this->db->get()->result_array();
				
			return $query;	
						
			}
			
			function get_testimonials()
			{
				$this->db->select('*')
					 ->from(DB_TESTIMONIAL);					 
				$query = $this->db->get()->result_array();
				
			    return $query;
			}
			
			function get_subjects()
			{
				$this->db->select('*')
					 ->from(DB_SUBJECT);					 
				$query = $this->db->get()->result_array();
				
			    return $query;
			}
			
			function get_cms_subjects($subject_id)
			{
				$this->db->select('*')
					 ->from(TBL_CMS)
					  ->where('subject_id',$subject_id);					 
				$query = $this->db->get()->result_array();
				
			    return $query;
			}
			
			function get_members_cms()
			{
				$this->db->select('cp.*')
					 ->from(TBL_JOIN_US_MEMBER . ' as `cp`')
					 ->where('cp.id', 1);
					 //->where('cp.status', 'Y');					 
				$query = $this->db->get()->row_array();
				return $query;
			}
			
			function get_faq() {		
				
				$this->db->select('*')
					 ->from(TBL_FAQ)
					 ->where('status','Y')
					 ->order_by('sort_order', 'ASC');					 						 
				$query = $this->db->get()->result_array();
				
			return $query;	
			
			}
			
			
			function get_page_parent($menu_id)
		    {
			    $this->db->select('tm.*')
					 ->from(TBL_MENU . ' as `tm`')
					 ->where('tm.id', $menu_id);
				return $this->db->get()->row_array();
		    }
		    
		    function get_membership_type()

			{

				$this->db->select('cp.*')

					 ->from(TBL_MEMBERSHIP_TYPE . ' as `cp`')

					 ->where('cp.id', 1);

					 //->where('cp.status', 'Y');					 

				$query = $this->db->get()->row_array();

				return $query;

			}
			
	public function batch_email($to, $from, $formname, $recipients, $subject, $message) 
	{
	   $config = Array(
			      'protocol' => $this->get_site_options('protocol'),
			      'smtp_host' => $this->get_site_options('smtp_host'),
			      'smtp_port' => $this->get_site_options('smtp_port'),
			      'smtp_user' => $this->get_site_options('smtp_user'),
			      'smtp_pass' => $this->get_site_options('smtp_pass'),
				  'mailtype' => $this->get_site_options('mailtype'), 
        		  'charset'   => $this->get_site_options('charset')
			);
	  $this->load->library('email', $config);
	  $this->email->clear(TRUE);
	  $this->email->from($from, $formname); 
	  $this->email->to($to);
	  $this->email->bcc($recipients);
	  $this->email->subject($subject);
	  $this->email->message($message);  
	
	  $this->email->send();
	  
	  //echo $this->email->print_debugger(); die();
	  return TRUE;
	
	}
	
	public function batch_email_attach($to, $from, $formname, $recipients, $subject, $message, $attachFile) 
	{
	   $config = Array(
			      'protocol' => $this->get_site_options('protocol'),
			      'smtp_host' => $this->get_site_options('smtp_host'),
			      'smtp_port' => $this->get_site_options('smtp_port'),
			      'smtp_user' => $this->get_site_options('smtp_user'),
			      'smtp_pass' => $this->get_site_options('smtp_pass'),
				  'mailtype' => $this->get_site_options('mailtype'), 
        		  'charset'   => $this->get_site_options('charset')
			);
	  $this->load->library('email', $config);
	  $this->email->clear(TRUE);
	  $this->email->from($from, $formname); 
	  $this->email->to($to);
	  $this->email->bcc($recipients);
	  $this->email->subject($subject);
	  $this->email->message($message); 
	  $this->email->attach($attachFile); 
	
	  $this->email->send();
	  //echo $this->email->print_debugger(); die();
	  return TRUE;
	
	}
	
	function get_menu_pid_Mposition($pid,$Mposition){
        $this->db->select('cms.*, m.menu_title, cms.url_name, m.id, m.parent_id, m.external_url, m.link_type, m.link_target')
                ->from(TBL_MENU. ' as m')
				->join(TBL_CMS. ' as cms', 'cms.id = m.page_id', 'LEFT')
				->where('m.parent_id', $pid)
				->where('m.position', $Mposition)
				->order_by('m.sort_order','ASC')
				->order_by('m.menu_position','ASC');
        $query = $this->db->get()->result_array();
        return $query;
    }
	function get_selected_menu_id($current_menu_id, $menu_id, $Mposition){
        $this->db->select('cms.*, m.menu_title, cms.url_name, m.id, m.parent_id')
                ->from(TBL_MENU. ' as m')
				->join(TBL_CMS. ' as cms', 'cms.id = m.page_id', 'LEFT')
				->where('m.id', $current_menu_id)
				->where('m.position', $Mposition)
				->where('cms.status', 'Y')
				->order_by('m.menu_position','ASC')
				->order_by('m.sort_order','ASC');
        $query = $this->db->get()->row_array();
		if($query['id']==$menu_id){
			return 'Y';
		}elseif($query['id']!=$menu_id && $query['parent_id']==0){
			return 'N';
		}else{
			return $this->get_parent_selected_menu_id($query['parent_id'], $menu_id, $Mposition);	
		}
    }
	function get_parent_selected_menu_id($parent_id, $menu_id, $Mposition){

        $this->db->select('cms.*, m.menu_title, cms.url_name, m.id, m.parent_id')
                ->from(TBL_MENU. ' as m')
				->join(TBL_CMS. ' as cms', 'cms.id = m.page_id', 'LEFT')
				->where('m.id', $parent_id)
				->where('m.position', $Mposition)
				->order_by('m.menu_position','ASC')
				->order_by('m.sort_order','ASC');

        $query = $this->db->get()->row_array();

		if($query['id']==$menu_id){

			return 'Y';

		}elseif($query['id']!=$menu_id && $query['parent_id']==0){

			return 'N';

		}else{

			return $this->get_parent_selected_menu_id($query['parent_id'], $menu_id, $Mposition);	

		}  

    }

    }