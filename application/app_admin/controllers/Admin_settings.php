<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Admin_settings extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Setting_model', '', TRUE);
        $this->load->library('form_validation');		
		$this->load->model('user_model', '', TRUE);
   }

    function change_password() {
        $data_msg = array();
        $initial_array = array(
            'error_msg' => ''
        );
		$data_msg['meta_title'] = "Change Password";
        if ($this->session->userdata('error_msg') != "") {
            foreach ($initial_array as $v => $key) {
                $data_msg[$v] = $this->session->userdata($v);
            }
            $this->session->unset_userdata($initial_array);
        }
        if ($this->session->userdata('success_msg') != "") {
            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if ($this->input->post('change_password')) {

            $error_msg = "";
            $old_password = trim(strip_tags($this->input->post('old_password')));
            $new_password = trim(strip_tags($this->input->post('new_password')));
            $retype_password = trim(strip_tags($this->input->post('retype_new_password')));
            $pswd_indb = $this->Setting_model->verify_old_password($old_password, $this->mdg_admin_id);
            if ($old_password == "") {
                $error_msg = "Please enter old password.";
            } elseif ($pswd_indb == 0) {
                $error_msg = "Please enter valid old password.";
            } elseif ($new_password == $old_password) {
                $error_msg = "Old and new password are same. Please enter a different new password.";
            } elseif ($new_password == "") {
                $error_msg = "Please enter new password.";
            } elseif (!$this->form_validation->min_length($new_password, 6)) {
                $error_msg = "New password must be at least 6 characters.";
            } elseif ($retype_password == "") {
                $error_msg = "Please retype your new password.";
            } elseif ($retype_password != $new_password) {
                $error_msg = "There seems to be a password mismatch.";
            }
            if ($error_msg != "") {
                $sess_array = array();
                foreach ($initial_array as $key => $v) {
                    if (isset($$key)) {
                        $sess_array[$key] = $$key;
                    }
                }
                $this->session->set_userdata($sess_array);
            } else {
                $data = array(
                    'password' => md5($retype_password)
                );
                $this->Setting_model->update_admin_setting($data, $this->mdg_admin_id); //for admin
                $this->session->set_flashdata('success_msg', 'New password saved successfully.');
            }
            redirect(base_url() . 'change-password');
        }
        $this->view('admin_settings/change_password', $data_msg);
    }

    function change_email() {
        $data_msg = array();
        $initial_array = array(
            'new_email' => '',
            'retype_new_email' => '',
            'error_msg' => ''
        );		
		$data_msg['meta_title'] = "Change Email";
        $data_msg['email'] = $this->Setting_model->get_email($this->mdg_admin_id);
        if ($this->session->userdata('error_msg') != "") {
            foreach ($initial_array as $v => $key) {
                $data_msg[$v] = $this->session->userdata($v);
            }
            $this->session->unset_userdata($initial_array);
        }
        if ($this->session->userdata('success_msg') != "") {
            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if ($this->input->post('change_email')) {
            $error_msg = "";
            $new_email = trim(strip_tags($this->input->post('new_email')));
            $retype_new_email = trim(strip_tags($this->input->post('retype_new_email')));			
			if($new_email!=$retype_new_email){
				 $error_msg = $new_email.' email id is not same with retype.'; 
					 $this->session->set_flashdata('error_msg',$error_msg); 
					  redirect(base_url("change-email"));			
			}
            $existing_email_check = $this->Setting_model->verify_old_email($new_email);
			if($existing_email_check>0){
				 $error_msg = $new_email.' email id is already registered.'; 
					 $this->session->set_flashdata('error_msg',$error_msg); 
					  redirect(base_url("change-email"));
			}
            if ($new_email == "") {
                $error_msg = "Please enter new email.";
            } elseif (!$this->form_validation->valid_email($new_email)) {
                $error_msg = "Please enter valid new email.";
            } elseif ($existing_email_check > 0) {
                $error_msg = "This email already exists. Please enter a different email address.";
            } elseif ($retype_new_email == "") {
                $error_msg = "Please retype your new email.";
            } elseif ($retype_new_email != $new_email) {
                $error_msg = "There seems to be a email mismatch.";
            }
            if ($error_msg != "") {
                $sess_array = array();
                foreach ($initial_array as $key => $v) {
                    if (isset($$key)) {
                        $sess_array[$key] = $$key;
                    }
                }
                $this->session->set_userdata($sess_array);
            } else {
                $data = array(
                    'email' => $retype_new_email
                );
                $this->Setting_model->update_admin_setting($data, $this->mdg_admin_id);
                $this->session->set_flashdata('success_msg', 'New email saved successfully.');
            }
            redirect(base_url() . 'change-email');
        }
        $this->view('admin_settings/change_email', $data_msg);
    }
}