<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubjectController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/subject', 'subject');
        $this->title = ADMINPANEL . ' | ' . SUBJECT;
    }

    public function index()
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(SUBJECT, 'admin/subject');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = $this->title;
        $data['page_title'] = SUBJECT;
        $data['subjects']     = get_subject();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/subject/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function archived()
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(SUBJECT, 'admin/subject');
        $this->breadcrumbs->push(ARCHIVED, 'admin/archived');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = SUBJECT . " <small> " . ARCHIVED . " </small>";
        $data['subjects']     = get_archived(SUBJECT);

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/subject/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function create()
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(SUBJECT, 'admin/subject');
        $this->breadcrumbs->push(CREATE, 'admin/subject/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = SUBJECT . " <small> " . CREATE . " </small>";

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/subject/create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function store()
    {
        //die(print_r($_POST));
        $this->subject->store($_POST);
    }

    public function edit($id)
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(SUBJECT, 'admin/subject');
        $this->breadcrumbs->push(EDIT, 'admin/subject/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = SUBJECT . " <small> " . EDIT . ' #' . $id . " </small>";
        $data['crud_id']     = $id;
        $data['subject']     = get_subject($id);

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/subject/edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function update($id)
    {
        $this->subject->update($id, $_POST);
    }

    public function delete($id)
    {
        $this->subject->delete($id, $_POST);
    }
}
