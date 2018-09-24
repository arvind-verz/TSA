<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    function get_recent_accommodation($item = 5) {
        return $this->db->select('*')
                        ->from(TBL_ACCM_DATA)
                        //->where()
                        ->order_by('added_date', 'DESC')
                        ->limit($item, 0)
                        ->get()->result_array();
    }

    function get_recent_booking($item) {
        return $this->db->select('bd.*,um.user_name')
                        ->from(TBL_BOOKING_DATA . ' as bd')
                        ->join(TBL_USER_MASTER . ' as um', 'um.user_id = bd.user_id')
                        ->where('status','A')
                        //->order_by('added_date', 'DESC')
                        ->limit($item, 0)
                        ->get()->result_array();
    }

    function get_recent_cancel_booking($item) {
        return $this->db->select('bd.*,um.user_name')
                        ->from(TBL_BOOKING_DATA . ' as bd')
                        ->join(TBL_USER_MASTER . ' as um', 'um.user_id = bd.user_id')
                        ->where('status','C')
                        //->order_by('added_date', 'DESC')
                        ->limit($item, 0)
                        ->get()->result_array();
    }

}