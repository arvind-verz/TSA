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

    public function create($class_id, $date)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ATTENDANCE', 'creates');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(ATTENDANCE, 'admin/attendance');
        $this->breadcrumbs->push('Mark', 'admin/attendance/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = ATTENDANCE . " <small> Mark </small>";
        $data['classes']     = get_classes();
        $data['attendance_date']    =   $date;
        $data['class_code']    =   get_class_code_by_class($class_id);

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/attendance/edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function get_attendance_sheet()
    {
        $class_code = $_GET['class_code'];
        $attendance_date = $_GET['attendance_date'];
        print_r(get_attendance_sheet($class_code, $attendance_date));
    }

    public function get_attendance_summary() {
        $this->attendance->get_attendance_summary($_GET);
    }

    public function transfer_student() {
        $this->attendance->transfer_student($_GET);
    }

    public function get_class_code_transfer() {
        $class_code = $_GET['class_code'];
        print_r(get_class_code_transfer($class_code));
    }

    public function store()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ATTENDANCE', 'creates');
        $result = $this->attendance->store($_POST);
        if($result==false) {
            $this->create_attendance();
        }
        else {
            print_r($result);
        }
    }

    public function edit()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ATTENDANCE', 'edits');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(ATTENDANCE, 'admin/attendance');
        $this->breadcrumbs->push(EDIT, 'admin/attendance/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = ATTENDANCE . " <small> " . EDIT . " </small>";
        $data['classes']     = get_classes();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/attendance/edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function get_attendance_edit_sheet() {
        $class_code = $_GET['class_code'];
        $attendance_date = $_GET['attendance_date'];
        print_r(get_attendance_edit_sheet($class_code, $attendance_date));
    }

    public function update()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ATTENDANCE', 'edits');
        $result = $this->attendance->update($_POST);
        if($result==false) {
            $this->index();
        }
        else {
            print_r($result);
        }
    }

    public function delete($id)
    {

    }

    public function get_attendance_date_by_class_code()
    {
        $class_code = isset($_GET['class_code']) ? $_GET['class_code'] : '';
        print_r(get_attendance_date_by_class_code($class_code));
    }

    public function create_attendance()
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

    public function schedule_store()
    {
        $this->attendance->schedule_store($_POST);
    }

    public function raw_delete()
    {
        return $this->attendance->raw_delete($_GET);
    }
}
