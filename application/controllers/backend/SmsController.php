<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SmsController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/sms', 'sms');
        $this->load->model('backend/accounts', 'accounts');
        $this->accounts->is_logged_in();
        $this->result = $this->accounts->get_login_user_id();
        $this->title = ADMINPANEL . ' | ' . SMS;
    }

    public function index()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'SMS', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(SMS_TEMPLATE, 'admin/sms_template');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = $this->title;
        $data['page_title'] = SMS_TEMPLATE;
        $data['sms_template'] = get_sms_template();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/sms/sms_template');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function sms_history()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'SMS_HISTORY', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(SMS_HISTORY, 'admin/sms_template');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = $this->title;
        $data['page_title'] = SMS_HISTORY;
        $data['sms_history'] = get_sms_history();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/sms/sms_history');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function sms_template_create()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'SMS', 'creates');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(SMS_TEMPLATE, 'admin/sms_template');
        $this->breadcrumbs->push(CREATE, 'admin/sms_template/sms_template_create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = $this->title;
        $data['page_title'] = SMS_TEMPLATE . " <small> " . CREATE . " </small>";
        $data['sms_condition'] = get_sms_condition();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/sms/sms_template_create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function sms_template_store()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'SMS', 'creates');
        $this->sms->sms_template_store($_POST);
    }

    public function sms_template_edit($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'SMS', 'edits');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(SMS_TEMPLATE, 'admin/sms_template');
        $this->breadcrumbs->push(EDIT, 'admin/sms_template/sms_template_create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = $this->title;
        $data['page_title'] = SMS_TEMPLATE . " <small> " . EDIT . " </small>";
        $data['sms_template'] = get_sms_template($id);
        $data['sms_condition'] = get_sms_condition();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/sms/sms_template_edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function sms_template_update($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'SMS', 'edits');
        $this->sms->sms_template_update($id, $_POST);
    }

    public function sms_reminder() {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'SMS_REMINDER', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(SMS_REMINDER, 'admin/sms_reminder');;
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = $this->title;
        $data['page_title'] = SMS_REMINDER;
        $data['fee_reminder'] = get_fee_reminder();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/sms/sms_reminder');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function sms_reminder_store() {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'SMS_REMINDER', 'creates');
        $this->sms->sms_reminder_store($_POST);
    }
}
