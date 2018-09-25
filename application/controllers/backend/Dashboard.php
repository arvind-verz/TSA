<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->breadcrumbs->push('Dashboard', 'admin/dashboard');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = "Admin Panel | Dashboard";
        $data['page_title'] = "Dashboard";

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/dashboard');
        $this->load->view('backend/include/footer');
    }
}
