<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountsController extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/accounts', 'accounts');
        $this->result = $this->accounts->get_login_user_id();
        $this->title = ADMINPANEL . ' | ' . LOGIN;
        $this->title_perm = ADMINPANEL . ' | ' . USERS . ' ' . ROLESANDPERMISSION;
    }

	public function index() {
        $data['title']       = $this->title;
        $data['page_title']  = LOGIN;

        $this->load->view('backend/include/header_login', $data);
        $this->load->view('backend/accounts/login');
        $this->load->view('backend/include/footer');
	}

	public function process() {
        $data['title']       = $this->title;
        $data['page_title']  = LOGIN;

        $config = [
        	[
        		'field'	=>	'email',
        		'label'	=>	'Email',
        		'rules'	=>	'trim|required|valid_email',
        	],
        	[
        		'field'	=>	'password',
        		'label'	=>	'Password',
        		'rules'	=>	'trim|required',
        	],
        ];

        $this->form_validation->set_rules($config);

        
        if ($this->form_validation->run() == FALSE)
        {
        	$this->load->view('backend/include/header_login', $data);
        	$this->load->view('backend/accounts/login');
        	$this->load->view('backend/include/footer');
        }
        else
        {
        	$result = $this->accounts->process($_POST);
            if($result==false) {
                $this->load->view('backend/include/header_login', $data);
                $this->load->view('backend/accounts/login');
                $this->load->view('backend/include/footer');
            }
        }
	}

    public function logout() {
        $this->accounts->logout();
    }

    public function users() {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'USERS', 'views');
        $this->accounts->is_logged_in();
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(USERS, 'admin/users');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title_perm;
        $data['page_title']  = USERS;
        $data['permission_data'] = get_permission_data();
        $data['users_data'] = get_users_data();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/accounts/users');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function permission_create() {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'USERS', 'creates');
        $this->accounts->is_logged_in();
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(USERS, 'admin/users');
        $this->breadcrumbs->push(ROLESANDPERMISSION, 'admin/users/roles-and-permission/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title_perm;
        $data['page_title']  = ROLESANDPERMISSION . " <small> " . CREATE . " </small>";
        $data['modules_arr'] = get_all_modules();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/accounts/roles-and-permission-create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function permission_store() {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'USERS', 'creates');
        $this->accounts->is_logged_in();
        $config = [
            [
                'field' =>  'name',
                'label' =>  'Title',
                'rules' =>  'required',
            ]
        ];

        $this->form_validation->set_rules($config);

        
        if ($this->form_validation->run() == FALSE) {
            $this->permission_create();
        }
        else {
            $this->accounts->permission_store($_POST);
        }
    }

    public function permission_edit($id) {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'USERS', 'edits');
        $this->accounts->is_logged_in();
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(USERS, 'admin/users');
        $this->breadcrumbs->push(ROLESANDPERMISSION, 'admin/users/roles-and-permission/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title_perm;
        $data['page_title']  = ROLESANDPERMISSION . " <small> " . EDIT . " </small>";
        $data['modules_arr'] = get_all_modules();
        $data['permission_data'] = get_permission_data($id);
        $data['perm_id']    =   $id;


        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/accounts/roles-and-permission-edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function permission_update($id) {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'USERS', 'edits');
        $this->accounts->is_logged_in();
        $config = [
            [
                'field' =>  'name',
                'label' =>  'Title',
                'rules' =>  'required',
            ]
        ];

        $this->form_validation->set_rules($config);

        
        if ($this->form_validation->run() == FALSE) {
            $this->permission_edit($id);
        }
        else {
            $this->accounts->permission_update($id, $_POST);
        }
    }

    public function users_create() {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'USERS', 'creates');
        $this->accounts->is_logged_in();
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(USERS, 'admin/users');
        $this->breadcrumbs->push(CREATE, 'admin/users/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title_perm;
        $data['page_title']  = USERS . " <small> " . CREATE . " </small>";
        $data['permission_data'] = get_permission_data();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/accounts/users-create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function users_store() {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'USERS', 'creates');
        $this->accounts->is_logged_in();
        $config = [
            [
                'field' =>  'username',
                'label' =>  'Name',
                'rules' =>  'required',
            ],
            [
                'field' =>  'email',
                'label' =>  'Email',
                'rules' =>  'trim|required|valid_email',
            ],
            [
                'field' =>  'password',
                'label' =>  'Password',
                'rules' =>  'trim|required|min_length[6]',
            ],
            [
                'field' =>  'perm_id',
                'label' =>  'Access Control',
                'rules' =>  'required',
            ]
        ];

        $this->form_validation->set_rules($config);

        
        if ($this->form_validation->run() == FALSE) {
            $this->users_create();
        }
        else {
            $result = $this->accounts->users_store($_POST);
            if($result==false) {
                $this->users_create();
            }
        }
    }

    public function users_edit($id) {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'USERS', 'edits');
        $this->accounts->is_logged_in();
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(USERS, 'admin/users');
        $this->breadcrumbs->push(EDIT, 'admin/users/edit/' . $id);
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title_perm;
        $data['page_title']  = USERS . " <small> " . EDIT . " </small>";
        $data['users_data'] = get_users_data($id);
        $data['permission_data'] = get_permission_data();
        $data['users_id']    =   $id;


        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/accounts/users-edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function users_update($id) {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'USERS', 'edits');
        $this->accounts->is_logged_in();
        $config = [
            [
                'field' =>  'username',
                'label' =>  'Name',
                'rules' =>  'required',
            ],
            [
                'field' =>  'email',
                'label' =>  'Email',
                'rules' =>  'trim|required|valid_email',
            ],
            [
                'field' =>  'perm_id',
                'label' =>  'Access Control',
                'rules' =>  'required',
            ]
        ];

        $this->form_validation->set_rules($config);

        
        if ($this->form_validation->run() == FALSE) {
            $this->users_edit($id);
        }
        else {
            $result = $this->accounts->users_update($id, $_POST);
            if($result==false) {
                $this->users_edit($id);
            }
        }
    }

    public function denied_access() {
        $this->accounts->is_logged_in();
        $data['title']       = $this->title_perm;
        $data['page_title']  = 'Denied Access Control';

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/accounts/denied-access');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function profile() {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(PROFILE, 'admin/users/profile');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title_perm;
        $data['page_title']  = PROFILE;
        $data['user_data'] = get_users_data_by_id($this->session->userdata('user_credentials')['id']);

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/accounts/profile');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function profileUpdate() {
        $this->accounts->is_logged_in();
        $config = [
            [
                'field' =>  'old_password',
                'label' =>  'Old Password',
                'rules' =>  'trim|required',
            ],
            [
                'field' =>  'new_password',
                'label' =>  'New Password',
                'rules' =>  'trim|required|min_length[6]',
            ],
            [
                'field' =>  'confirm_new_password',
                'label' =>  'Confirm New Password',
                'rules' =>  'trim|required|matches[new_password]',
            ]
        ];

        $this->form_validation->set_rules($config);

        
        if ($this->form_validation->run() == FALSE) {
            $this->profile();
        }
        else {
            $result = $this->accounts->profileUpdate($_POST);
            if($result==false) {
                $this->profile();
            }
        }
    }

    public function userDetailsUpdate() {
        $config = [
            [
                'field' =>  'username',
                'label' =>  'Username',
                'rules' =>  'trim|required',
            ],
            [
                'field' =>  'email',
                'label' =>  'Email',
                'rules' =>  'trim|required|xss_clean|valid_email',
            ],
        ];

        $this->form_validation->set_rules($config);

        
        if ($this->form_validation->run() == FALSE) {
            $this->profile();
        }
        else {
            $result = $this->accounts->userDetailsUpdate($_POST);
            if($result==false) {
                $this->profile();
            }
        }   
    }

    public function users_delete($id)
    {
        $this->accounts->users_delete($id);
    }

    public function permission_delete($id)
    {
        $this->accounts->permission_delete($id);
    }
}