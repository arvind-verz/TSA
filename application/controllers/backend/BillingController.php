<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BillingController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //is_logged_in();
        $this->load->model('backend/billing', 'billing');
        $this->load->model('backend/accounts', 'accounts');
        $this->accounts->is_logged_in();
        $this->result = $this->accounts->get_login_user_id();
        $this->title = ADMINPANEL . ' | ' . BILLING;
    }

    public function index()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'BILLING', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(BILLING, 'admin/billing');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = $this->title;
        $data['page_title'] = BILLING;
        $data['billings'] = get_billing();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/billing/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function archived()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'BILLING', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(BILLING, 'admin/billing');
        $this->breadcrumbs->push(ARCHIVED, 'admin/archived');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = SUBJECT . " <small> " . ARCHIVED . " </small>";
        $data['billings']    = get_archived(DB_BILLING);

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/billing/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function create()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'BILLING', 'creates');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(BILLING, 'admin/billing');
        $this->breadcrumbs->push(CREATE, 'admin/billing/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = $this->title;
        $data['page_title'] = BILLING . " <small> " . CREATE . " </small>";

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/billing/create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function store()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'BILLING', 'creates');
        $this->billing->store($_POST);
    }

    public function edit($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'BILLING', 'edits');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(BILLING, 'admin/billing');
        $this->breadcrumbs->push(EDIT, 'admin/billing/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = $this->title;
        $data['page_title'] = BILLING . " <small> " . EDIT . " </small>";
        $data['billing'] = get_billing($id);

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/billing/edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function update($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'BILLING', 'edits');
        $this->billing->update($id, $_POST);
    }

    public function moveto_active_list($id)
    {
        $this->billing->moveto_active_list($id, $_POST);
    }

    public function delete_archive($billing_id)
    {
        $this->billing->delete_archive($billing_id);
    }

    public function archive()
    {
        $result = $this->billing->archive($_POST);
        if($result == false) {
            $this->index();
        }
    }
}
