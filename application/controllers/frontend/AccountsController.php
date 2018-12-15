<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountsController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/Cms_model', '', true);
        $this->load->model('frontend/accounts', 'accounts');
        $this->title = STUDENT . ' | ' . LOGIN;
    }

    public function index()
    {
        $data['title']      = $this->title;
        $data['page_title'] = $this->title;

        $this->load->view('backend/include/header_login', $data);
        $this->load->view('frontend/accounts/login');
        $this->load->view('backend/include/footer');
    }

    public function process()
    {
        $url = 'login';
        $data_msg['title']      = $this->title;
        $data_msg['page_title'] = $this->title;
        $data_msg = array();
        $page     = $this->Cms_model->get_page($url);
        $page1    = $this->Cms_model->get_page_others($url);

        if (count($page) > 0) {

            $data_msg['page']      = $page;
            $data_msg['menu_id']   = $page[0]['menu_id'];
            $data_msg['page_id']   = $page[0]['id'];
            $data_msg['url_name']  = $url;
            $data_msg['url']       = $url;
            $data_msg['url_name2'] = $url;
        } elseif (count($page1) > 0) {
            $page                  = $page1;
            $data_msg['page']      = $page;
            $data_msg['menu_id']   = 0;
            $data_msg['page_id']   = $page[0]['id'];
            $data_msg['url_name']  = $url;
            $data_msg['url']       = $url;
            $data_msg['url_name2'] = $url;
        } else {

            $this->breadcrumbs2->push('Home', 'home');
            $this->breadcrumbs2->push('404 Page', '404 Page');
            $data_msg['menu_id']     = 0;
            $data_msg['url']         = '404 Page';
            $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();

            $this->load->view('frontend/include/header', $data_msg);
            $this->load->view('frontend/page-not-found');
            $this->load->view('frontend/include/footer');
            //die('hiiiii');
        }

        $config = [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required',
            ],
        ];

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {
            $this->breadcrumbs2->push('Home', 'home');
            $this->breadcrumbs2->push('Login', 'login');
            $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();
            $this->load->view('frontend/include/header', $data_msg);
            $this->load->view('frontend/accounts/login');
            $this->load->view('frontend/include/footer');
        } else {
            $result = $this->accounts->process($_POST);
            if ($result == false) {
                $this->breadcrumbs2->push('Home', 'home');
            $this->breadcrumbs2->push('Login', 'login');
            $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();
            $this->load->view('frontend/include/header', $data_msg);
            $this->load->view('frontend/accounts/login');
            $this->load->view('frontend/include/footer');
            }
        }
    }

    public function logout()
    {
        $this->accounts->logout();
    }

    public function reset_password_process()
    {
        $data['title']      = $this->title;
        $data['page_title'] = $this->title;

        $config = [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email',
            ],
        ];

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Enter valid email to reset password.');
            return redirect('reset-password');
        } else {
            $result = $this->accounts->reset_password_process($_POST);
            if ($result == false) {
                $this->session->set_flashdata('error', 'Enter valid email to reset password.');
                return redirect('reset-password');
            }
        }
    }

    public function reset_new_password($id)
    {
        $data['title']      = "New Password";
        $data['page_title'] = "New Password";
        $data['student_id'] = $id;

        $this->load->view('backend/include/header_login', $data);
        $this->load->view('frontend/accounts/new-password');
        $this->load->view('backend/include/footer');
    }

    public function reset_new_password_process($id)
    {
        $data['title']      = "New Password";
        $data['page_title'] = "New Password";

        $config = [
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[6]',
            ],
            [
                'field' => 'confirm_password',
                'label' => 'Confirm Password',
                'rules' => 'trim|required|matches[password]',
            ],
        ];

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Password does not match or should contain minimum 6 charaters.');
            return redirect('login/reset-password/new-password/' . $id);
        } else {
            $result = $this->accounts->reset_new_password_process($id, $_POST);
            if ($result == false) {
                $this->session->set_flashdata('error', 'Something went wrong.');
                return redirect('reset-password');
            }
        }
    }
}
