<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InvoiceController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/invoice', 'invoice');
        $this->load->model('backend/accounts', 'accounts');
        $this->accounts->is_logged_in();
        $this->result = $this->accounts->get_login_user_id();
        $this->title = ADMINPANEL . ' | ' . INVOICE;
    }

    public function index()
    {
        send_final_settlement_invoice('123');        
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'INVOICE', 'views'); 
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(INVOICE, 'admin/invoice');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = $this->title;
        $data['page_title'] = INVOICE;
        $data['classes']     = get_classes();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/invoice/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function get_invoice_sheet()
    {
        $class_code = $_GET['class_code'];
        print_r(get_invoice_sheet($class_code));
    }

    public function payment_status_update() {
        $result = $this->invoice->payment_status_update($_GET);
        echo $result;
    }
}
