<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ClassController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //is_logged_in();
        $this->load->model('backend/classes', 'classes');
        $this->load->model('backend/accounts', 'accounts');
        $this->accounts->is_logged_in();
        $this->result = $this->accounts->get_login_user_id();
        $this->title  = ADMINPANEL . ' | ' . CLASSES;
    }

    public function index()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'CLASSES', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(CLASSES, 'admin/classes');
        $data['breadcrumbs']     = $this->breadcrumbs->show();
        $data['title']           = $this->title;
        $data['page_title']      = CLASSES;
        $data['classes']         = get_classes();
        $data['subject_classes'] = get_subject_classes();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/classes/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function archived()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'CLASSES', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(CLASSES, 'admin/classes');
        $this->breadcrumbs->push(ARCHIVED, 'admin/archived');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = CLASSES . " <small> " . ARCHIVED . " </small>";
        $data['classes']     = get_archived(DB_CLASSES);

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/classes/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function create()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'CLASSES', 'creates');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(CLASSES, 'admin/classes');
        $this->breadcrumbs->push(CREATE, 'admin/classes/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = CLASSES . " <small> " . CREATE . " </small>";
        $data['subjects']    = get_subject();
        $data['tutors']      = get_tutors();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/classes/create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function store()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'CLASSES', 'creates');
        $this->classes->store($_POST);
    }

    public function edit($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'CLASSES', 'edits');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(CLASSES, 'admin/classes');
        $this->breadcrumbs->push(EDIT, 'admin/classes/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = CLASSES . " <small> " . EDIT . ' #' . $id . " </small>";
        $data['crud_id']     = $id;
        $data['classes']     = get_classes($id);
        $data['subjects']    = get_subject();
        $data['tutors']      = get_tutors();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/classes/edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function update($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'CLASSES', 'creates');
        $this->classes->update($id, $_POST);
    }

    public function delete($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'CLASSES', 'deletes');
        $this->classes->delete($id, $_POST);
    }

    public function moveto_active_list($id)
    {
        $this->classes->moveto_active_list($id, $_POST);
    }

    public function delete_archive($class_id)
    {
        $this->classes->delete_archive($class_id);
    }
}
