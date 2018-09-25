<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function is_logged_in() {
	$ci = & get_instance();
    $ci->load->library('session');
    if($ci->session->has_userdata('logged_in')) {
    	return redirect('admin/dashboard');
    }
    else {
    	$ci->session->unset_userdata('logged_in');
    	return redirect('admin/login');
    }
}