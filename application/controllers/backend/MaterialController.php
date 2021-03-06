<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MaterialController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/material', 'material');
        $this->load->model('backend/accounts', 'accounts');
        $this->accounts->is_logged_in();
        $this->result = $this->accounts->get_login_user_id();
        $this->title  = ADMINPANEL . ' | ' . MATERIAL;
    }

    public function index()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'MATERIAL', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(MATERIAL, 'admin/material');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = MATERIAL;
        $data['books']       = get_book();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/material/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function archived()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'MATERIAL', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(MATERIAL, 'admin/material');
        $this->breadcrumbs->push(ARCHIVED, 'admin/archived');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = MATERIAL . " <small> " . ARCHIVED . " </small>";
        $data['books']       = get_archived(DB_MATERIAL);

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/material/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function create()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'MATERIAL', 'creates');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(MATERIAL, 'admin/material');
        $this->breadcrumbs->push(CREATE, 'admin/material/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = MATERIAL . " <small> " . CREATE . " </small>";
        $data['subjects']    = get_subject();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/material/create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function store()
    {
        //die(print_r($_POST));
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'MATERIAL', 'creates');
        $config = [
            [
                'field' => 'material_id',
                'label' => 'Book ID',
                'rules' => 'required|is_unique[material.material_id]',
            ],
        ];

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $this->material->store($_POST);
        }
    }

    public function edit($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'MATERIAL', 'edits');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(MATERIAL, 'admin/material');
        $this->breadcrumbs->push(EDIT, 'admin/material/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = MATERIAL . " <small> " . EDIT . ' #' . $id . " </small>";
        $data['crud_id']     = $id;
        $data['book']        = get_book($id);
        $data['subjects']    = get_subject();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/material/edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function update($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'MATERIAL', 'edits');
        $result = $this->material->update($id, $_POST);
        if($result == false) {
            $this->edit($id);
        }
    }

    public function delete($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'MATERIAL', 'deletes');
        $this->material->delete($id, $_POST);
    }

    public function moveto_active_list($id)
    {
        $this->material->moveto_active_list($id, $_POST);
    }

    public function get_student_by_class_code()
    {
        $class_code = isset($_GET['class_code']) ? $_GET['class_code'] : '';
        print_r(get_student_by_class_code($class_code));
    }

    public function get_book_price_range()
    {
        $price_from = isset($_GET['price_from']) ? $_GET['price_from'] : '';
        $price_to = isset($_GET['price_to']) ? $_GET['price_to'] : '';
        print_r(get_book_price_range($price_from, $price_to));
    }

    public function get_books_by_subject()
    {
        $subjects = isset($_GET['subject']) ? explode(',', $_GET['subject']) : '';
        print_r(get_books_by_subject($subjects));
    }

    public function delete_archive($material_id)
    {
        $this->material->delete_archive($material_id);
    }

    public function archive()
    {
        $result = $this->material->archive($_POST);
        if($result == false) {
            $this->index();
        }
    }
}
