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
        //die(print_r(get_invoice_result2('1','2019-01-17 10:27')));
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'STUDENT', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(STUDENT, 'admin/students');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = STUDENT;
        $data['students']    = get_student();
        $data['classes']     = get_classes();
        $data['enrollment_type'] = get_enrollment_type();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/students/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function archive()
    {
        $result = $this->students->archive($_POST);
        if($result == false) {
            $this->index();
        }
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
        $data['student_names'] = get_student_names_with_nric();

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
        $data['students']    = get_student_archived();
        $data['classes']     = get_classes();
        $data['enrollment_type'] = get_enrollment_type();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/students/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function store()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'STUDENT', 'creates');

        $config = [
            [
                'field' => 'firstname',
                'label' => 'Student First Name',
                'rules' => 'required',
            ],
            [
                'field' => 'lastname',
                'label' => 'Student Last Name',
                'rules' => 'required',
            ],
            [
                'field' => 'nric',
                'label' => 'NRIC',
                'rules' => 'trim|required|is_unique[student.nric]|matches[username]|regex_match[/^[a-z][0-9]{7}[a-z]$/i]',
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email',
            ],
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required|is_unique[student.username]',
            ],
            [
                'field' => 'parent_email',
                'label' => 'Parent Email',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[6]',
            ],
        ];

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $file_name_placeholder = array_keys($_FILES);
            $image_file = $_FILES['profile_picture']['name'];

            $_POST['profile_picture'] = upload_image_file($image_file, $file_name_placeholder[0], 200, 200);


            $this->students->store($_POST);

        }

        //$this->classes->store($_POST);
    }

    public function enroll()
    {

        $this->students->enroll($_POST);
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
        $data['page_title']  = STUDENT . " <small> " . EDIT . " </small>";
        $data['crud_id']     = $id;
        $data['student']     = get_student($id);
        $data['student_names'] = get_student_names_with_nric($id);

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/students/edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function update($id)
    {

        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'STUDENT', 'edits');

        $config = [
            [
                'field' => 'firstname',
                'label' => 'Student First Name',
                'rules' => 'required',
            ],
            [
                'field' => 'lastname',
                'label' => 'Student Last Name',
                'rules' => 'required',
            ],
            [
                'field' => 'nric',
                'label' => 'NRIC',
                'rules' => 'trim|required|matches[username]|regex_match[/^[a-z][0-9]{7}[a-z]$/i]',
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email',
            ],
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'parent_email',
                'label' => 'Parent Email',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|min_length[6]',
            ],
        ];

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == false) {
            //$this->session->set_flashdata('error', validation_errors());
            $this->edit($id);
        } else {

            $file_name_placeholder = array_keys($_FILES);
            $image_file = $_FILES['profile_picture']['name'];
            if($image_file) {
                $_POST['profile_picture'] = upload_image_file($image_file, $file_name_placeholder[0], 200, 200);
            }
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
        $class_id   = isset($_GET['class_id']) ? $_GET['class_id'] : '';
        $student_id = isset($_GET['student_id']) ? $_GET['student_id'] : '';
        print_r(get_student_status($class_id, $student_id));
    }

    public function get_enrollment_type_popup_content()
    {
        $type = !empty($_GET['type']) ? $_GET['type'] : '';
        $class_id = !empty($_GET['class_id']) ? $_GET['class_id'] : '';
        $student_id = !empty($_GET['student_id']) ? $_GET['student_id'] : '';
        print_r(get_enrollment_type_popup_content($type, $student_id, $class_id));
    }

    public function get_class_size()
    {
        $class_id = !empty($_GET['class_id']) ? $_GET['class_id'] : '';
        $enrollment_type = !empty($_GET['enrollment_type']) ? $_GET['enrollment_type'] : '';
        print_r(get_class_size($class_id, $enrollment_type));
    }

    public function get_class_deposit_amount()
    {
        $class_id = !empty($_GET['class_id']) ? $_GET['class_id'] : '';
        print_r(get_deposit_value_of_class($class_id));
    }

    public function enrollment_decision()
    {
        $class_id = !empty($_GET['class_id']) ? $_GET['class_id'] : '';
        $student_id = !empty($_GET['student_id']) ? $_GET['student_id'] : '';
        print_r(enrollment_decision($class_id, $student_id));
    }

    public function get_view_all_contents()
    {
        $class_id = !empty($_GET['class_id']) ? $_GET['class_id'] : '';
        $student_id = !empty($_GET['student_id']) ? $_GET['student_id'] : '';
        print_r(get_view_all_contents($student_id, $class_id));
    }

    public function final_settlement($student_id)
    {
        $this->students->final_settlement($student_id);
    }

    public function get_enrollment_type_popup_content_update()
    {
        $class_id = !empty($_GET['class_id']) ? $_GET['class_id'] : '';
        $student_id = !empty($_GET['student_id']) ? $_GET['student_id'] : '';
        print_r(get_enrollment_type_popup_content_update($student_id, $class_id));
    }

    public function update_enrollment()
    {
        $this->students->update_enrollment($_POST);
    }

    public function delete_archive($student_id)
    {
        $this->students->delete_archive($student_id);
    }

    public function get_p_content()
    {
      print_r(get_p_content());
    }
}
