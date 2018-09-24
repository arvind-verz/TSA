<?php
class Setting_model extends CI_Model {

    /*
     * verfify old password...if it matches it returns 1 row else 0
     */
    function verify_old_password($old_password, $admin_id) {
        $this->db->select('count(admin_id) as `TotalNum`')
            ->from(TBL_ADMIN)
            ->where('password', md5($old_password))
            ->where('admin_id', $admin_id);

        $query = $this->db->get()->result_array();
        if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

        return $val;
    }
      
    /*
     * fetch the current admin email & username
     */
    function get_email($admin_id) {

        $this->db->select('email')
            ->from(TBL_ADMIN)
            ->where('admin_id',$admin_id);

        $query = $this->db->get()->result_array();
        return $query[0]['email'];
    }
	
	function get_username($admin_id) {

        $this->db->select('name')
            ->from(TBL_ADMIN)
            ->where('admin_id',$admin_id);

        $query = $this->db->get()->result_array();
        return $query[0]['name'];
    }

    /*
     * verfify old email...if it matches it returns 1 row else 0
     */
    function verify_old_email($new_email) {
        $this->db->select('count(email) as `TotalNum`')
            ->from(TBL_ADMIN)
            ->where('email  ', $new_email);

        $query = $this->db->get()->result_array();
        if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
        
        return $val;

    }

    /*
     * update details
     */
    function update_admin_setting($data, $id) {

        $this->db->where('admin_id',$id);
        $this->db->update(TBL_ADMIN,$data);
    }
     

}
?>