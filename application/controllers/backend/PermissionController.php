<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PermissionController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //is_logged_in();
        $this->load->model('backend/permission', 'permission');
        $this->title = ADMINPANEL . ' | ' . PERMISSION;
    }

    public function index()
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(PERMISSION, 'admin/permission');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = PERMISSION;
        $data['permissions']     = $this->permission->get_permissions();
		$data['users']     = $this->permission->get_users();
		$modules     = $this->permission->get_modules();
		$md=array();
		foreach($modules as $module):
		$md[]=$module->label;
		endforeach;
		
		$data['modules']     =$md;
		

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/permissions/index');
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
        $this->breadcrumbs->push(PERMISSION, 'admin/permission');
        $this->breadcrumbs->push(CREATE, 'admin/permission/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['modules']     = $this->permission->get_modules();
        $data['title']       = $this->title;
        $data['page_title']  = "Add Permission";

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/permissions/create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }
	
	public function create_user()
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(PERMISSION, 'admin/permission');
        $this->breadcrumbs->push(CREATE, 'admin/permission/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['modules']     = $this->permission->get_modules();
		$data['permissions']     = $this->permission->get_permissions();
        $data['title']       = $this->title;
        $data['page_title']  = "Add Role";

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/permissions/role/create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }
	
	

	
    public function store()
    {
            $this->load->library('form_validation');
			$this->form_validation->set_rules('title', 'Name', 'required');
			/*echo '<pre>';
			print_r($_POST);
			echo '</pre>';
			die;*/
                

                if ($this->form_validation->run() == FALSE)
                {
                         $this->session->set_flashdata('error', validation_errors());
            			 return redirect('admin/permission/create');
                }
                else
                {
					$this->permission->store($_POST);
                       
                }

    }
	 public function store_user()
    {
	$this->load->library('form_validation');
	$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
	$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	$this->form_validation->set_rules('password', 'Password', 'required');
	$this->form_validation->set_rules('password_confirmation', 'Confirm password', 'required|matches[password]');
	$this->form_validation->set_rules('role_type_id', 'Role Type', 'required');
			
			/*echo '<pre>';
			print_r($_POST);
			echo '</pre>';
			die;*/
                

                if ($this->form_validation->run() == FALSE)
                {
                         $this->session->set_flashdata('error', validation_errors());
            			 return redirect('admin/role/create');
                }
                else
                {
					$this->permission->store_user($_POST);
                       
                }

    }

	public function search()
	{
		die(print_r($_POST));
		$this->tutors->search($_POST);
	}

    public function edit($id)
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(PERMISSION, 'admin/permission');
        $this->breadcrumbs->push(CREATE, 'admin/permission/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['permission']     = $this->permission->get_permission($id);
		$data['name']     = $this->permission->get_permission_details($id);
		$data['modules']     = $this->permission->get_modules();
        $data['title']       = $this->title;
		$data['id']       = $id;
        $data['page_title']  = "Edit Permission";

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/permissions/edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }
	
	public function edit_user($id)
    {
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(PERMISSION, 'admin/permission');
        $this->breadcrumbs->push(CREATE, 'admin/permission/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['permissions']     = $this->permission->get_permissions();
		$data['user']     = $this->permission->get_user_details($id);
		//$data['modules']     = $this->permission->get_modules();
        $data['title']       = $this->title;
		$data['id']       = $id;
        $data['page_title']  = "Edit Role";

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/permissions/role/edit');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function update($id)
    {
        $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Name', 'required');


                

                if ($this->form_validation->run() == FALSE)
                {
                         $this->session->set_flashdata('error', validation_errors());
            			 return redirect('admin/permission/edit/'.$id);
                }
                else
                {
					$this->permission->update($id);
                       
                }
		
		
    }
	
	public function update_user($id)
    {
        $this->load->library('form_validation');
	$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
	$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	$this->form_validation->set_rules('role_type_id', 'Role Type', 'required');
	
	if(!empty($_POST['password']))
	{
	$this->form_validation->set_rules('password', 'Password', 'required');
	$this->form_validation->set_rules('password_confirmation', 'Confirm password', 'required|matches[password]');
	}
	

                

                if ($this->form_validation->run() == FALSE)
                {
                         $this->session->set_flashdata('error', validation_errors());
            			 return redirect('admin/permission/edit/'.$id);
                }
                else
                {
					$this->permission->update_user($id);
                       
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
        $this->permission->delete($id);
    }
}
