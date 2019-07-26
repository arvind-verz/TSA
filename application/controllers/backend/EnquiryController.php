<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EnquiryController extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->model('backend/accounts', 'accounts');
        $this->result = $this->accounts->get_login_user_id();
        $this->title = ADMINPANEL . ' | ' . ENQUIRY;
	}
	
	public function contact_enquiry()
	{
		//$this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'CONTACT_ENQUIRY', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(CONTACT_ENQUIRY, 'admin/contact-enquiry');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
		$data['page_title']  = CONTACT_ENQUIRY;
		$data['contact_enquiry'] = getContactEnquiry();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/enquiry/contact-enquiry');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
	}

	public function quick_enquiry()
	{
		//$this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'CONTACT_ENQUIRY', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(QUICK_ENQUIRY, 'admin/quick-enquiry');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
		$data['page_title']  = QUICK_ENQUIRY;
		$data['quick_enquiry'] = getQuickEnquiry();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/enquiry/quick-enquiry');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
	}
}
