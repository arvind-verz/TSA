<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model
{

	function get_member($member_id) {		
		
		$this->db->select('*')
			 ->from(TBL_MEMBER)
			 ->where('member_id', $member_id);					 
		$query = $this->db->get()->row_array();		
		return $query;					
	} 
	function update_member($data , $member_id) {			
		  $this->db->where('member_id' , $member_id);
		  $this->db->update(TBL_MEMBER, $data);
	}	
		

}