<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Gallery_model extends CI_Model
    {


			function get_gallery()
			{
				$this->db->select('*')
					 ->from(DB_GALLERY)
					 ->order_by('sort_order','ASC');
				 
				$query = $this->db->get()->result_array();
			    return $query;
			}
			
			

    }