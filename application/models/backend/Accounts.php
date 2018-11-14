<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounts extends CI_Model
{
    public function is_logged_in()
    {
        if($this->aauth->is_loggedin()==false)
        {
            redirect('admin/login');
        }
    }

    public function process()
    {
    	$email = isset($_POST['email']) ? $_POST['email'] : '';
    	$password = isset($_POST['password']) ? $_POST['password'] : '';
    	$remember_me = isset($_POST['remember_me']) ? $_POST['remember_me'] : 0;
    	if($this->aauth->login($email, $password)==false) {
            redirect('admin/login');
        }
        if(empty($remember_me)) {
            if($this->aauth->login($email, $password)) {
                redirect('admin/dashboard');
            }
        }
        else {
            if($this->aauth->login($email, $password, true)) {
                redirect('admin/dashboard');
            }
        }
    }

    public function logout() {
        $this->aauth->logout();
        redirect('admin/login');
    }

    public function permission_store() {
        //print_r($_POST);
        $title = isset($_POST['name']) ? $_POST['name'] : '';
        $modules = isset($_POST['module']) ? $_POST['module'] : '';

        $result = $this->aauth->create_perm($title);
        if($result) {
            foreach($modules as $module) {
                $this->aauth->permission_access($result, $module['name'][0], $module['view'][0], $module['create'][0], $module['edit'][0], $module['delete'][0]);
            }
        }
        $this->session->set_flashdata('success', ROLESANDPERMISSION . ' ' . MSG_CREATED);
        return redirect('admin/users');
    }

    public function permission_update($id) {
        //print_r($_POST);
        $title = isset($_POST['name']) ? $_POST['name'] : '';
        $modules = isset($_POST['module']) ? $_POST['module'] : '';

        $result = $this->aauth->update_perm($id, $title);
        if($result) {
            foreach($modules as $module) {
                $this->aauth->update_permission_access($id, $module['name'][0], $module['view'][0], $module['create'][0], $module['edit'][0], $module['delete'][0]);
            }
        }
        $this->session->set_flashdata('success', ROLESANDPERMISSION . ' ' . MSG_UPDATED);
        return redirect('admin/users');
    }

    public function users_store() {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $perm_id = isset($_POST['perm_id']) ? $_POST['perm_id'] : '';

        if($email && $password && $username && $perm_id && strlen($password)>=6) {
            $result = $this->aauth->create_user($email, $password, $username, 2);
            if($result) {
                $this->aauth->allow_user($result, $perm_id);
                $this->session->set_flashdata('success', USERS . ' ' . MSG_CREATED);
                return redirect('admin/users');
            }
        }
        return false;
    }

    public function users_update($id) {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $perm_id = isset($_POST['perm_id']) ? $_POST['perm_id'] : '';

        if($email && $username && $perm_id) {
            $result = $this->aauth->update_user($id, $email, false, $username);
            $this->aauth->update_allow_user($id, $perm_id);
            $this->session->set_flashdata('success', USERS . ' ' . MSG_UPDATED);
            return redirect('admin/users');
        }
        return false;
    }

    public function is_permission_allowed($user_id, $perm_id, $module, $type) {
        $this->db->select('*');
        $this->db->from('aauth_permission_access');
        $this->db->join('aauth_perm_to_user', 'aauth_permission_access.perm_id = aauth_perm_to_user.perm_id');
        $this->db->where(['aauth_perm_to_user.user_id' =>  $user_id, 'aauth_permission_access.perm_id' => $perm_id, 'aauth_permission_access.module' => $module, 'aauth_permission_access.' . $type => 1]);
        $query = $this->db->get();
        if($query->num_rows()<1 && $user_id!=1) {
            return redirect('admin/denied-access-control');
        }
    }

    public function get_login_user_id() {
        $result = $this->session->userdata('user_credentials');
        if($result['id']==1) {
            return [
                'user_id'   =>  $result['id'],
                'perm_id'   =>  '',
            ];
        }
        $query = $this->db->get_where('aauth_perm_to_user', ['user_id' => $result['id']]);
        $result1 = $query->row();
        if($result1) {
            return [
                'user_id'   =>  $result['id'],
                'perm_id'   =>  $result1->perm_id,
            ];
        }
    }

    public function profileUpdate() {
        $old_password = isset($_POST['old_password']) ? $_POST['old_password'] : '';
        $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : '';

        if($old_password && $new_password) {
            $user_credentials = $this->session->userdata('user_credentials');
            $query = $this->db->get_where('aauth_users', ['id'    =>  $user_credentials['id']]);
            $result = $query->row();
            if($query->num_rows()<1) {
                $this->session->set_flashdata('error', PROFILE . ' ' . MSG_UPD_FAILED);
                return false;
            }
            if(!(password_verify($old_password, $result->pass))) {
                $this->session->set_flashdata('error', 'Old Password does not match.');
                return false;
            }
            $this->aauth->update_user($user_credentials['id'], false, $new_password, false);
            $this->session->set_flashdata('success', PROFILE . ' ' . MSG_UPDATED);
            return redirect('admin/users/profile');
        }
        return false;
    }
}
