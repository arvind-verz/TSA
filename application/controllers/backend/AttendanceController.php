<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AttendanceController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/attendance', 'attendance');
        $this->load->model('backend/accounts', 'accounts');
        $this->accounts->is_logged_in();
        $this->result = $this->accounts->get_login_user_id();
        $this->title = ADMINPANEL . ' | ' . ATTENDANCE;
    }

    public function index()
    {
        //print_r(get_weekdays_of_month('September', 'Monday'));
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ATTENDANCE', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(ATTENDANCE, 'admin/attendance');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = ATTENDANCE;
        $data['classes']     = get_classes();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/attendance/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function archived()
    {
        
    }

    public function create()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ATTENDANCE', 'creates');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(ATTENDANCE, 'admin/attendance');
        $this->breadcrumbs->push(CREATE, 'admin/attendance/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = ATTENDANCE . " <small> " . CREATE . " </small>";
        $data['classes']     = get_classes();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/attendance/create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function get_attendance_sheet()
    {
        $class_code = $_GET['class_code'];
        print_r(get_attendance_sheet($class_code));
    }

    public function get_attendance_summary() {
        $this->attendance->get_attendance_summary($_GET);
    }

    public function transfer_student() {
        $this->attendance->transfer_student();
    }

    public function get_class_code_transfer() {
        $class_code = $_GET['class_code'];
        print_r(get_class_code_transfer($class_code));
    }    

    public function store()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ATTENDANCE', 'creates');
        $result = $this->attendance->store($_POST);
        print_r($result);
    }

    public function edit($id)
    {

    }

    public function update($id)
    {
        
    }

    public function delete($id)
    {
       
    }
}
