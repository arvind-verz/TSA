<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StudentController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //is_logged_in();
        $this->load->model('backend/students', 'students');
        $this->load->model('backend/accounts', 'accounts');
        $this->accounts->is_logged_in();
        $this->result = $this->accounts->get_login_user_id();
        $this->title  = ADMINPANEL . ' | ' . STUDENT;
    }

    public function index()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'STUDENT', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(STUDENT, 'admin/students');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = STUDENT;
        $data['students']    = get_student();
        $data['classes']     = get_classes();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/students/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function archive($id)
    {
        $this->students->update_archive($id);
    }

    public function create()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'STUDENT', 'creates');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(STUDENT, 'admin/students');
        $this->breadcrumbs->push(CREATE, 'admin/students/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = "Add Student";

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/students/create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }
    public function archived()
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(STUDENT, 'admin/students');
        $this->breadcrumbs->push(ARCHIVED, 'admin/archived');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = STUDENT . " <small> " . ARCHIVED . " </small>";
        $data['students']    = $this->students->get_archived_classes();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/students/archived');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function store()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'STUDENT', 'creates');

        $config = [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required',
            ],
            [
                'field' => 'nric',
                'label' => 'NRIC',
                'rules' => 'required',
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique[student.email]',
            ],
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required',
            ],
            [
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'trim|required|numeric',
            ],
            [
                'field' => 'age',
                'label' => 'Age',
                'rules' => 'required|numeric',
            ],
            [
                'field' => 'gender',
                'label' => 'Gender',
                'rules' => 'required',
            ],
            [
                'field' => 'parent_name',
                'label' => 'Parent Name',
                'rules' => 'required',
            ],
            [
                'field' => 'parent_email',
                'label' => 'Parent Email',
                'rules' => 'trim|required|valid_email',
            ],
            [
                'field' => 'siblings',
                'label' => 'Siblings',
                'rules' => 'required',
            ],
            [
                'field' => 'parents_phone',
                'label' => 'Parent Phone',
                'rules' => 'trim|required|numeric',
            ],
            [
                'field' => 'parent_email',
                'label' => 'Parent Email',
                'rules' => 'trim|required|valid_email',
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[6]',
            ],
            [
                'field' => 'confirm_password',
                'label' => 'Confirm Password',
                'rules' => 'trim|required|matches[password]',
            ],
        ];

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $this->students->store($_POST);

        }

        //$this->classes->store($_POST);
    }

    public function enroll()
    {
        $this->students->store_2($_POST);
    }

    public function search()
    {
        //die(print_r($_POST));
        $this->students->search($_POST);
    }

    public function edit($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'STUDENT', 'edits');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(STUDENT, 'admin/students');
        $this->breadcrumbs->push(EDIT, 'admin/students/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = STUDENT . " <small> " . EDIT . ' #' . $id . " </small>";
        $data['crud_id']     = $id;
        $data['student']     = $this->students->get_student($id);

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/students/edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function update($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'STUDENT', 'edits');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[student.email]');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('age', 'Age', 'required');
        $this->form_validation->set_rules('parent_name', 'Parent Name', 'required');
        $this->form_validation->set_rules('parent_email', 'Parent Email', 'required');
        $this->form_validation->set_rules('siblings', 'Siblings', 'required');
        $this->form_validation->set_rules('parents_phone', 'Parents Phone', 'required');

        if (isset($_POST['password']) && $_POST['password'] != "") {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        }

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/students/edit/' . $id);
        } else {
            $this->students->update($id, $_POST);

        }

    }

    public function delete($id)
    {
        $this->students->delete($id, $_POST);
    }

    public function moveto_active_list($id)
    {
        $this->students->moveto_active_list($id);

        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'STUDENT', 'deletes');
        $this->classes->delete($id, $_POST);

    }

    public function get_student_status()
    {
        $class_id   = $_GET['class_id'];
        $student_id = $_GET['student_id'];
        print_r(get_student_status($class_id, $student_id));
    }
}
