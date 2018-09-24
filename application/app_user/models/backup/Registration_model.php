<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Registration_model extends CI_Model
{

	function add_member($db_insert) {
			  $this->db->insert(TBL_MEMBER , $db_insert);
			  
	  }	
		

}