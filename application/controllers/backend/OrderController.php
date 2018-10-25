<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //is_logged_in();
        $this->load->model('backend/order', 'order');
        $this->load->model('backend/accounts', 'accounts');
        $this->accounts->is_logged_in();
        $this->result = $this->accounts->get_login_user_id();
        $this->title = ADMINPANEL . ' | ' . ORDER;
    }

    public function index()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ORDER', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(ORDER, 'admin/order');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = ORDER;
        $data['orders']    = get_order();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/order/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function create()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ORDER', 'creates');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(ORDER, 'admin/order');
        $this->breadcrumbs->push(CREATE, 'admin/order/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = ORDER . " <small> " . CREATE . " </small>";
        $data['subjects']    = get_subject();
        $data['students']    = get_student();
        $data['classes']     = get_classes();
        $data['books']       = get_book();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/order/create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function store()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ORDER', 'creates');
        $this->order->store($_POST);
    }

    public function update_order_status()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ORDER', 'edits');
        $this->order->update_order_status($_GET);
    }
}
