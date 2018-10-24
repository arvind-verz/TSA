<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/accounts', 'accounts');
        $this->accounts->is_logged_in();
        $this->title = ADMINPANEL . ' | ' . DASHBOARD;
    }

    public function index()
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = $this->title;
        $data['page_title'] = DASHBOARD;

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/dashboard');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }
}
