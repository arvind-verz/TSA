<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //is_logged_in();
        $this->load->model('backend/order', 'order');
        $this->load->model('backend/accounts', 'accounts');
        $this->accounts->is_logged_in();
        $this->result = $this->accounts->get_login_user_id();
        $this->title = ADMINPANEL . ' | ' . ORDER;
    }

    public function index()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ORDER', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(ORDER, 'admin/order');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = ORDER;
        $data['orders']    = get_order();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/order/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function archive()
    {
        $result = $this->order->archive($_POST);
        if($result == false) {
            $this->index();
        }
    }

    public function archived()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ORDER', 'views');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(ORDER, 'admin/order');
        $this->breadcrumbs->push(ARCHIVED, 'admin/order/archived');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = ORDER;
        $data['orders']    = get_archived_order();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/order/index');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function create()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ORDER', 'creates');
        $this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(ORDER, 'admin/order');
        $this->breadcrumbs->push(CREATE, 'admin/order/create');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = ORDER . " <small> " . CREATE . " </small>";
        $data['subjects']    = get_subject();
        $data['classes']     = get_classes();
        $data['books']       = get_book();

        $this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/order/create');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }

    public function store()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ORDER', 'creates');
        $config = [
            [
                'field' => 'class_code',
                'label' => 'Class Code',
                'rules' => 'required',
            ],
            [
                'field' => 'subject[]',
                'label' => 'Subject',
                'rules' => 'required',
            ],
            [
                'field' => 'student[]',
                'label' => 'Student',
                'rules' => 'required',
            ],
            [
                'field' => 'book_id',
                'label' => 'Book ID',
                'rules' => 'required',
            ],
        ];

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            $this->create();
        } else {
            $this->order->store($_POST);
        }
    }

    public function update_order_status()
    {
        $this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'ORDER', 'edits');
        $this->order->update_order_status($_GET);
    }

    public function order_status_change()
    {
        $order_id = $_GET['order_id'];
        $class_code = $_GET['class_code'];
        $status = $_GET['status'];
        print_r(get_order_student_content($order_id, $class_code, $status));
	}
	
	public function update_order_date()
	{
		$result = $this->order->update_order_date($_GET);
		return print_r($result);
	}

    public function moveto_active_list($id)
	{

	       $this->order->moveto_active_list($id);

	}

    public function delete_archive($order_id)
    {
        $this->order->delete_archive($order_id);
    }
}
