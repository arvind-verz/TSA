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
    	if($this->aauth->login('arvind.verz@gmail.com', '123')==false) {
            redirect('admin/login');
        }
        if(empty($remember_me)) {
            if($this->aauth->login('arvind.verz@gmail.com', '123')) {
                redirect('admin/dashboard');
            }
        }
        else {
            if($this->aauth->login('arvind.verz@gmail.com', '123', true)) {
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
            $result = $this->aauth->create_user($email, $password, $username);
            if($result) {
                $this->aauth->allow_user($result, $perm_id);
                $this->session->set_flashdata('success', USERS . ' ' . MSG_CREATED);
                return redirect('admin/users');
            }
        }
        return false;
    }
}
