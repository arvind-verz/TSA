<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Member extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Member_model', '', TRUE);
    }
	public function manage_member() {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
		
		$permission='Y';
		
 		if($permission=='Y'){

        $data_msg = array();
		
		$data_msg['meta_title'] = "Manage Member";
		
		$items_per_page = $this->all_function->get_site_options('admin_listing_per_page');

        $current_page = (int) $this->input->get('page');

        $current_page = $current_page > 0 ? $current_page : 1;
		
		$data_msg['start_count'] = ($current_page * $items_per_page - $items_per_page + 1);

        $limit_from = ($current_page - 1) * $items_per_page;
		
		if(!isset($_POST['OkFilter']) & !isset($_GET['page'])){
			$this->session->set_userdata(array('FlterData' => '' ));
		}		
		if(isset($_POST['OkFilter'])){
			$this->session->set_userdata(array('FlterData' => $_POST['FlterData'] ));
			$data_msg['FlterData'] = $FlterData = $_POST['FlterData'];
			$data_msg['total'] = $total_items = $this->Member_model->get_member_num_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-member'));
			$data_msg['display_result'] = $this->Member_model->get_all_member_details_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $this->Member_model->delete_member($del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-member'));
			  exit;
			  }else{redirect(base_url('manage-member'));}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Member_model->update_member($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-member'));
			  exit;
			  }else{redirect(base_url('manage-member'));}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Member_model->update_member($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-member'));
			  exit;
			  }else{redirect(base_url('manage-member'));}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Member_model->get_member_num_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-member'));
			  $data_msg['display_result'] = $this->Member_model->get_all_member_details_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'user_name'=>'',							
				'email'=>'',
				'user_type'=>'',
				'status'=>'',
				'email_status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Member_model->get_member_num();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-member'));
        	$get_value = $this->Member_model->get_all_member_details($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
			}
		$this->view('member/manage_member', $data_msg);
		}
		if($permission=='N'){			
			 redirect(base_url('access-denied'));
             exit;			
		}
    }
	
	public function del_member($id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];		
		$permission='Y';		
		if($permission=='Y'){
          $data_msg = array();
          $this->Member_model->delete_member($id);								  
		  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');			  
		  redirect(base_url('manage-member'));		  
		}if($permission=='N'){redirect(base_url('access-denied'));}
    }

    public function add_member() {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];		
		$permission='Y';		
		if($permission=='Y'){
        $data_msg = array();
        $data_msg['meta_title'] = "Add Member";		
		$this->load->library('form_validation');		
		$config = array(
               array(
                     'field'   => 'first_name',
                     'label'   => 'First Name',
                     'rules'   => 'required'
                  ), 
				array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email|is_unique['.TBL_MEMBER.'.email]'
                  ),
				array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required|min_length[5]|matches[confirm_password]'
                  ),
				array(
                     'field'   => 'confirm_password',
                     'label'   => 'Confirm Password',
                     'rules'   => 'trim|required'
                  ),     
               array(
                     'field'   => 'status',
                     'label'   => 'Status',
                     'rules'   => 'required'
                  )
			   
            );
		$this->form_validation->set_rules($config);		
		if($_POST){				
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('member/add_member', $data_msg);
			}
			else{			 
			$error_msg = "";
            $first_name = trim(strip_tags($this->input->post('first_name')));
			$last_name = trim(strip_tags($this->input->post('last_name')));
			$email = trim(strip_tags($this->input->post('email')));
			$password = trim(strip_tags($this->input->post('password')));
			$confirm_password = trim(strip_tags($this->input->post('confirm_password')));

            $total_items = $this->Member_model->count_user_existing($email);				
			if($total_items<1){	
				$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$admin_id_ch = '';
				for ($i = 0; $i < 3; $i++)
				$admin_id_ch .= $characters[mt_rand(0, 3)];				
				$digits = 3;
				$admin_id_no = rand(pow(6, $digits-1), pow(6, $digits)-1);				
				$admin_id = time().$admin_id_no.$admin_id_ch;				
				$data = array(
				'member_id' => $admin_id,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'email' => $email,
				'user_type' => $this->input->post('user_type'),
				'status' => $this->input->post('status'),
				'password' => md5($password),
				'last_updated_on' => date('Y-m-d H:i:s'),
				'create_date' => date('Y-m-d H:i:s')
				);
				$this->Member_model->add_member($data);
				$this->session->set_flashdata('success_msg', 'Successfully added');
				redirect(base_url("manage-member"));
				}else{
					 $data_msg['error_msg'] = $error_msg = $email.' email id is already registered.'; 
					 $this->view('member/add_member', $data_msg);	
				}
        	}
		}else{
			$this->view('member/add_member', $data_msg);
		}
		}if($permission=='N'){redirect(base_url('access-denied'));}
    }
	
	public function edit_member($id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];				
		$data_msg = array();		
		$data_msg['meta_title'] = "Edit Member";		
		$get_value = $this->Member_model->get_details($id);
        $details = $get_value->row_array();
        if (empty($details)) {
            redirect(base_url("manage-member"));
        }
		
        $data_msg['first_name'] = $details['first_name'];
		$data_msg['last_name'] = $details['last_name'];
		$data_msg['password'] = $details['password'];		
		$data_msg['email'] = $details['email'];
		$data_msg['status'] = $details['status'];
		$data_msg['user_type'] = $details['user_type'];
		$data_msg['member_id'] = $details['member_id'];
        $this->load->library('form_validation');		
		$config = array(
               array(
                     'field'   => 'first_name',
                     'label'   => 'First Name',
                     'rules'   => 'required'
                  ), 
				array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email'
                  ),
				array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|matches[confirm_password]'
                  ),
				array(
                     'field'   => 'confirm_password',
                     'label'   => 'Confirm Password',
                     'rules'   => 'trim'
                  ),     
               array(
                     'field'   => 'status',
                     'label'   => 'Status',
                     'rules'   => 'required'
                  )
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){	
			if ($this->form_validation->run() == FALSE){
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('member/edit_member', $data_msg);
			}else { 
				$first_name = trim(strip_tags($this->input->post('first_name')));
				$last_name = trim(strip_tags($this->input->post('last_name')));
				$email = trim(strip_tags($this->input->post('email')));
				$password = trim(strip_tags($this->input->post('password')));
				$confirm_password = trim(strip_tags($this->input->post('confirm_password')));
				$user_type = trim(strip_tags($this->input->post('user_type')));
				$status = trim(strip_tags($this->input->post('status')));
	
				if($password!=''){	
					$data = array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'email' => $email,
						'user_type' => $this->input->post('user_type'),
						'status' => $this->input->post('status'),
						'password' => md5($password),
						'last_updated_on' => date('Y-m-d H:i:s')
					);
					}else{
					$data = array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'email' => $email,
						'user_type' => $this->input->post('user_type'),
						'status' => $this->input->post('status'),
						'last_updated_on' => date('Y-m-d H:i:s')
					);
				}
				
				$this->Member_model->update_member($data, $id);	
				$this->session->set_flashdata('success_msg', 'User record has been updated successfully');	
				redirect(base_url("edit-member/$id"));
        	}
		}else{
			$this->view('member/edit_member', $data_msg);
		}
    } 	
	
	public function login_member_details() {

		  $admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];

		  //$permission = $this->user_model->get_user_permission($admin_type,'user','login_details');
		  
		  $permission = 'Y';
		
		  if($permission=='Y'){

		  $data_msg = array();

		  $data_msg['meta_title'] = 'Members Login Details';
		  
		  $items_per_page = $this->all_function->get_site_options('admin_listing_per_page');

		  $current_page = (int) $this->input->get('page');
		  
		  $current_page = $current_page > 0 ? $current_page : 1;
		  
		  $data_msg['start_count'] = ($current_page * $items_per_page - $items_per_page + 1);

		  $limit_from = ($current_page - 1) * $items_per_page;

		  $total_items = $this->Member_model->total_get_member_login_details();
		  
		  $data_msg['total_items'] = $total_items;

		  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items , $items_per_page , $current_page , 3);

		  $get_value = $this->Member_model->get_member_login_details($items_per_page , $limit_from);

		  $data_msg['display_result'] = $get_value->result_array();
		  
		  if($this->input->post('frm_display_submit') == '1')
		  {
				  $checkbox_arr = $this->input->post('id');

				  if(count($checkbox_arr) !== 0)
				  {
						  foreach ($checkbox_arr as $del_id)
						  {
								  $this->Member_model->delete_member_login_details($del_id);
						  }
						  
						  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');	
						  
						  redirect(base_url('login-member-details'));
						  exit;
				  }else{redirect(base_url('login-member-details'));}
		  }

		
		  $this->view('member/login_member_details' , $data_msg);
		  
			  }if($permission=='N'){
		
		 redirect(base_url('access-denied'));
		
		}
  }
}