<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountsController extends CI_Controller
{

	public function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/accounts', 'accounts');
        $this->title = STUDENT . ' | ' . LOGIN;
    }

	public function index() {
		$data['title']       = $this->title;
        $data['page_title']  = $this->title;

        $this->load->view('backend/include/header_login', $data);
        $this->load->view('frontend/accounts/login');
        $this->load->view('backend/include/footer');
	}

	public function process() {
		$data['title']       = $this->title;
        $data['page_title']  = $this->title;

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
        	$this->load->view('frontend/accounts/login');
        	$this->load->view('backend/include/footer');
        }
        else
        {
        	$result = $this->accounts->process($_POST);
            if($result==false) {
                $this->load->view('backend/include/header_login', $data);
                $this->load->view('frontend/accounts/login');
                $this->load->view('backend/include/footer');
            }
        }
	}

    public function logout() {
        $this->accounts->logout();
    }

    public function reset_password_process() {
        $data['title']       = $this->title;
        $data['page_title']  = $this->title;

        $config = [
            [
                'field' =>  'email',
                'label' =>  'Email',
                'rules' =>  'trim|required|valid_email',
            ],
        ];

        $this->form_validation->set_rules($config);

        
        if ($this->form_validation->run() == FALSE)
        {
            return redirect('reset-password');
        }
        else
        {
            $result = $this->accounts->reset_password_process($_POST);
            if($result==false) {
                return redirect('reset-password');
            }
        }
    }

    public function reset_new_password() {
        $data['title']       = "New Password";
        $data['page_title']  = "New Password";

        $this->load->view('backend/include/header_login', $data);
        $this->load->view('frontend/accounts/new-password');
        $this->load->view('backend/include/footer');
    }
}