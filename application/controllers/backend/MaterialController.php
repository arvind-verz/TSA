<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MaterialController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/material', 'material');
        $this->title = ADMINPANEL . ' | ' . MATERIAL;
    }

    public function index()
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(MATERIAL, 'admin/material');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = $this->title;
        $data['page_title'] = MATERIAL;
        $data['books'] = get_book();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/material/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function archived()
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(MATERIAL, 'admin/material');
        $this->breadcrumbs->push(ARCHIVED, 'admin/archived');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = MATERIAL . " <small> " . ARCHIVED . " </small>";
        $data['books']     = get_archived(MATERIAL);

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/material/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function create()
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(MATERIAL, 'admin/material');
        $this->breadcrumbs->push(CREATE, 'admin/material/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = MATERIAL . " <small> " . CREATE . " </small>";
        $data['subjects']     = get_subject();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/material/create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function store()
    {
        //die(print_r($_POST));
        $this->material->store($_POST);
    }

    public function edit($id)
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(MATERIAL, 'admin/material');
        $this->breadcrumbs->push(EDIT, 'admin/material/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = MATERIAL . " <small> " . EDIT . ' #' . $id . " </small>";
        $data['crud_id']     = $id;
        $data['book']     = get_book($id);
        $data['subjects']     = get_subject();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/material/edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function update($id)
    {
        $this->material->update($id, $_POST);
    }

    public function delete($id)
    {
        $this->material->delete($id, $_POST);
    }

    public function moveto_active_list($id)
    {
        $this->material->moveto_active_list($id, $_POST);
    }
}