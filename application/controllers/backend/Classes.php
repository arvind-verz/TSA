<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classes extends CI_Controller
{

    public function __construct()
    {
    	parent::__construct();
    }

    public function index()
    {
        $this->load->view('backend/include/header');
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/classes/index');
        $this->load->view('backend/include/footer');
    }
}
