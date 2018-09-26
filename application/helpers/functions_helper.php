<?php
defined('BASEPATH') or exit('No direct script access allowed');

function is_logged_in()
{
    $ci = &get_instance();
    $ci->load->library('session');
    if ($ci->session->has_userdata('logged_in')) {
        return redirect('admin/dashboard');
    } else {
        $ci->session->unset_userdata('logged_in');
        return redirect('admin/login');
    }
}

function level($value=null) {
	if($value==0) {
		return "S1";
	}
	elseif($value==1) {
		return "S2";
	}
	elseif($value==2) {
		return "S3";
	}
	elseif($value==3) {
		return "S4";
	}
	elseif($value==4) {
		return "J1";
	}
	elseif($value==5) {
		return "J2";
	}
	else {
		return "-";
	}

}

function get_classes($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    if($id) {
	    $query = $ci->db->get_where(CLASSES, ['is_archive' => 0, 'class_id' => $id]);
	}
	else {
		$query = $ci->db->get_where(CLASSES, ['is_archive' => 0]);
	}
    return $query->result();
}

function get_archived_classes()
{
    $ci = &get_instance();
    $ci->load->database();
    $query = $ci->db->get_where(CLASSES, ['is_archive' => 1]);
    return $query->result();
}
