<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Cms_model extends CI_Model
    {

			
			public function get_page($url_name) {		
				
				$this->db->select('cp.*, m.menu_title, m.id as menu_id')
					 ->from(TBL_CMS . ' as `cp`')
					 ->join(TBL_MENU . ' as `m`' , 'm.page_id = cp.id')
					 ->where('cp.url_name', $url_name)
					 ->where('cp.status', 'Y');					 
				$query = $this->db->get()->result_array();
			//echo $this->db->last_query();	
			return $query;	
						
			} 
			
			public function get_assign_class() {		
				$student_id = $this->session->userdata('student_credentials');
				$this->db->select('*');
				$this->db->from(DB_STUDENT);
    			$this->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
    			$this->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');
				$this->db->where('student.id', $student_id['id']);
				$this->db->order_by(DB_CLASSES . '.created_at', 'DESC');
				$query = $this->db->get();
				$result = $query->result();	
				return $result;	
						
			} 
			
			public function get_page_others($url_name) {		
				
				$this->db->select('cp.*')
					 ->from(TBL_CMS . ' as `cp`')
					 ->where('cp.url_name', $url_name)
					 ->where('cp.status', 'Y');					 
				$query = $this->db->get()->result_array();
				
			return $query;	
						
			}
			
			
			public function get_subjects_name($ids) {		
				
				$this->db->select('s.id,s.subject_name')
					 ->from(DB_SUBJECT . ' as `s`')
					 ->where('s.is_archive',0)
					 ->where_in('s.id', $ids);					 
				$query = $this->db->get()->result_array();
				//echo $this->db->last_query();
			return $query;	
						
			}
			
			public function get_book($id) {		
				
				$this->db->select('m.book_name')
					 ->from(DB_MATERIAL . ' as `m`')
					 ->where('m.is_archive',0)
					 ->like('m.subject', $id);					 
				$query = $this->db->get()->result_array();
				//echo $this->db->last_query();
			if(count($query))
			return $query[0];
			else 
			return false;	
						
			}
			
			public function get_testimonials()
			{
				$this->db->select('*')
					 ->from(DB_TESTIMONIAL);					 
				$query = $this->db->get()->result_array();
				
			    return $query;
			}
			
			public function get_attendance($student_id = false)
			{
				$this->db->select('*')
					    ->from(DB_ATTENDANCE)
					    ->where('student_id', $student_id);					 
				$query = $this->db->get();
				if($student_id) {
					$result = $query->row();
				}
				else {
					$result = $query->result();
				}
			    return $result;
			}
			
			public function get_subjects()
			{
				$this->db->select('*')
					 ->from(DB_SUBJECT . ' as `s`')
					 ->join(TBL_CMS . ' as `c`' , 's.subject_id = c.subject_id')
					 ;					 
				$query = $this->db->get()->result_array();
				
			    return $query;
			}
			
			public function get_cms_subjects($subject_id)
			{
				$this->db->select('*')
					 ->from(TBL_CMS)
					  ->where('subject_id',$subject_id);					 
				$query = $this->db->get()->result_array();
				
			    return $query;
			}
			
			public function get_gallery()
			{
				$this->db->select('*')
					 ->from(DB_GALLERY);
				 
				$query = $this->db->get()->result_array();
				
			    return $query;
			}
			
			public function get_members_cms()
			{
				$this->db->select('cp.*')
					 ->from(TBL_JOIN_US_MEMBER . ' as `cp`')
					 ->where('cp.id', 1);
					 //->where('cp.status', 'Y');					 
				$query = $this->db->get()->row_array();
				return $query;
			}
			
			public function get_faq() {		
				
				$this->db->select('*')
					 ->from(TBL_FAQ)
					 ->where('status','Y')
					 ->order_by('sort_order', 'ASC');					 						 
				$query = $this->db->get()->result_array();
				
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
	
	public function get_menu_pid_Mposition($pid,$Mposition){
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
	public function get_selected_menu_id($current_menu_id, $menu_id, $Mposition){
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
	public function get_parent_selected_menu_id($parent_id, $menu_id, $Mposition){

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