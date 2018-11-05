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
}