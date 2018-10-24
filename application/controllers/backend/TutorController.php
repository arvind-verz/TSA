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
        $this->title = ADMINPANEL . ' | ' . TUTOR;
    }

    public function index()
    {
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
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(TUTOR, 'admin/tutors');
        $this->breadcrumbs->push(CREATE, 'admin/tutors/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = "Add Tutor";

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
        $this->load->view('backend/tutors/archived');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }
	
    public function store()
    {
                $this->load->library('form_validation');

			$this->form_validation->set_rules('tutor_name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tutor.email]');
			$this->form_validation->set_rules('phone', 'phone', 'required');
			$this->form_validation->set_rules('salary_scheme', 'salary_scheme', 'required');
			$this->form_validation->set_rules('subject', 'subject', 'required');
			$this->form_validation->set_rules('tutor_permission', 'tutor_permission', 'required');
			$this->form_validation->set_rules('password', 'Password','trim|required|min_length[8]|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
                

                if ($this->form_validation->run() == FALSE)
                {
                         $this->session->set_flashdata('error', validation_errors());
            			 return redirect('admin/tutors/create');
                }
                else
                {
					$this->tutors->store($_POST);
                       
                }
		
		//$this->classes->store($_POST);
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
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(TUTOR, 'admin/tutors');
        $this->breadcrumbs->push(EDIT, 'admin/tutors/edit');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = TUTOR . " <small> " . EDIT . ' #' . $id . " </small>";
        $data['crud_id']     = $id;
        $data['tutor']     = $this->tutors->get_tutor($id);

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/tutors/edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function update($id)
    {
        $this->load->library('form_validation');

            $this->form_validation->set_rules('tutor_name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('phone', 'phone', 'required');
			$this->form_validation->set_rules('salary_scheme', 'salary_scheme', 'required');
			$this->form_validation->set_rules('subject', 'subject', 'required');
			$this->form_validation->set_rules('tutor_permission', 'tutor_permission', 'required');

               
		if(isset($_POST['password']) && $_POST['password']!="")
		{
		$this->form_validation->set_rules('password', 'Password','trim|required|min_length[8]|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
		}
                

                if ($this->form_validation->run() == FALSE)
                {
                         $this->session->set_flashdata('error', validation_errors());
            			 return redirect('admin/tutors/edit/'.$id);
                }
                else
                {
					$this->tutors->update($id, $_POST);
                       
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
        $this->classes->delete($id, $_POST);
    }
}
