<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TutorController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //is_logged_in();
        $this->load->model('backend/tutors', 'tutors');
        $this->load->model('backend/accounts', 'accounts');
        $this->accounts->is_logged_in();
        $this->result = $this->accounts->get_login_user_id();
        $this->title = ADMINPANEL . ' | ' . TUTOR;
    }

    public function index()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'TUTOR', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(TUTOR, 'admin/tutors');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = TUTOR;
        $data['tutors']     = $this->tutors->get_tutors();
		

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/tutors/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function archive($id)
    {
     $cur_date = date('Y-m-d H:i:s');	
	$data = array(
            'is_archive'   => 1,
			'updated_at'   => $cur_date
        );
	 $this->tutors->update_archive($id,$data);  
    }

    public function create()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'TUTOR', 'creates');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(TUTOR, 'admin/tutors');
        $this->breadcrumbs->push(CREATE, 'admin/tutors/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = "Add Tutor";
		$data['permission_data'] = get_permission_data();
        $data['subjects']   = get_subject();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/tutors/create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }
	 public function archived()
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(TUTOR, 'admin/tutors');
        $this->breadcrumbs->push(ARCHIVED, 'admin/archived');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = TUTOR . " <small> " . ARCHIVED . " </small>";
        $data['tutors']     = $this->tutors->get_archived_tutors();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/tutors/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }
	
    public function store()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'TUTOR', 'creates');

        $result = $this->tutors->store($_POST);
        if($result==false) {
            $this->create();
        }
    }
	
	public function enroll()
	{
		$this->tutors->store_2($_POST);
	}
	
	public function search()
	{
		die(print_r($_POST));
		$this->tutors->search($_POST);
	}

    public function edit($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'TUTOR', 'edits');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(TUTOR, 'admin/tutors');
        $this->breadcrumbs->push(EDIT, 'admin/tutors/edit');
		$data['permission_data'] = get_permission_data();
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = TUTOR . " <small> " . EDIT . ' #' . $id . " </small>";
        $data['crud_id']     = $id;
        $data['tutor']     = $this->tutors->get_tutors($id);
        $data['subjects']     = get_subject();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/tutors/edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function update($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'TUTOR', 'edits');
        $this->load->library('form_validation');

        $result = $this->tutors->update($id, $_POST);
		if($result==false) {
            $this->edit($id);
        }
		
    }
	public function moveto_active_list($id)
	{
		
	$cur_date = date('Y-m-d H:i:s');	
	$data = array(
            'is_archive'   => 0,
			'updated_at'   => $cur_date
        );
	$this->tutors->update_archive2($id,$data);	
	
	}

    public function delete($id)
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'TUTOR', 'deletes');
        $this->classes->delete($id, $_POST);
    }
}
