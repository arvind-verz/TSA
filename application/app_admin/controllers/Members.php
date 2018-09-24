<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Members extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Member_model', '', TRUE);
    }
	public function manage_members() {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
		
		$permission='Y';
		
 		if($permission=='Y'){

        $data_msg = array();
		
		$data_msg['meta_title'] = "Manage Member";
		$data_msg['member_type'] = $this->Member_model->get_member_type();
		
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
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-members'));
			$data_msg['display_result'] = $this->Member_model->get_all_member_details_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $this->Member_model->delete_member($del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-members'));
			  exit;
			  }else{redirect(base_url('manage-members'));}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Member_model->update_member($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-members'));
			  exit;
			  }else{redirect(base_url('manage-members'));}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Member_model->update_member($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-members'));
			  exit;
			  }else{redirect(base_url('manage-members'));}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Member_model->get_member_num_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-members'));
			  $data_msg['display_result'] = $this->Member_model->get_all_member_details_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'user_name'=>'',							
				'company_email'=>'',
				'status'=>'',
				'member_type_id'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Member_model->get_member_num();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-members'));
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
	
	public function del_members($id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];		
		$permission='Y';		
		if($permission=='Y'){
          $data_msg = array();
          $this->Member_model->delete_member($id);								  
		  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');			  
		  redirect(base_url('manage-members'));		  
		}if($permission=='N'){redirect(base_url('access-denied'));}
    }

    public function add_members() {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];		
		$permission='Y';		
		if($permission=='Y'){
        $data_msg = array();
        $data_msg['meta_title'] = "Add Member";	
		
		$data_msg['member_type'] = $this->Member_model->get_member_type();
		
			
		$this->load->library('form_validation');		
		$config = array(
               array(
                     'field'   => 'member_type_id',
                     'label'   => 'Member Type',
                     'rules'   => 'required'
                  ), 
				array(
                     'field'   => 'company_email',
                     'label'   => 'Company Email',
                     'rules'   => 'trim|required|valid_email'
                  ),
				array(
                     'field'   => 'company_name',
                     'label'   => 'Company Name',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'company_type',
                     'label'   => 'Company Type',
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
            
				$data = array(
				'member_type_id' => $this->input->post('member_type_id'),
				'company_name' => $this->input->post('company_name'),
				'company_email' => $this->input->post('company_email'),
				'company_type' => $this->input->post('company_type'),
				'status' => $this->input->post('status'),
				'modified_date' => date('Y-m-d H:i:s'),
				'create_date' => date('Y-m-d H:i:s')
				);
				$member_id=$this->Member_model->add_member($data);
				if($this->input->post('member_type_id')==1){
					$pre = 'SVCA';
				}elseif($this->input->post('member_type_id')==2){
					$pre = 'SVCA';
				}else{
					$pre = 'SVCA';
				}
				$user_name = $pre.time().$member_id;
				$data = array(
						'user_name' =>$user_name
					);
				$this->Member_model->update_member($data, $member_id);
				##
				$this->email_member($member_id);
				##
				$this->session->set_flashdata('success_msg', 'Successfully added');
				redirect(base_url("manage-members"));
				
        	}
		}else{
			$this->view('member/add_member', $data_msg);
		}
		}if($permission=='N'){redirect(base_url('access-denied'));}
    }
	
	public function edit_members($id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];				
		$data_msg = array();		
		$data_msg['meta_title'] = "Edit Member";
		$data_msg['member_type'] = $this->Member_model->get_member_type();		
		$get_value = $this->Member_model->get_details($id);
        $details = $get_value->row_array();
        if (empty($details)) {
            redirect(base_url("manage-members"));
        }
		$data_msg['details'] = $details;
        
        $this->load->library('form_validation');		
		$config = array(
               /*array(
                     'field'   => 'member_type_id',
                     'label'   => 'Member Type',
                     'rules'   => 'required'
                  ),*/ 
				array(
                     'field'   => 'company_email',
                     'label'   => 'Company Email',
                     'rules'   => 'trim|required|valid_email'
                  ),
				array(
                     'field'   => 'company_name',
                     'label'   => 'Company Name',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'company_type',
                     'label'   => 'Company Type',
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
			if ($this->form_validation->run() == FALSE){
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('member/edit_member', $data_msg);
			}else { 
				
	
				
					$data = array(
				//'member_type_id' => $this->input->post('member_type_id'),
				'company_name' => $this->input->post('company_name'),
				'company_email' => $this->input->post('company_email'),
				'company_type' => $this->input->post('company_type'),
				'status' => $this->input->post('status'),
				'modified_date' => date('Y-m-d H:i:s')
				);
				
				$this->Member_model->update_member($data, $id);
				
				##
				$this->email_member($id);
				##
					
				$this->session->set_flashdata('success_msg', 'User record has been updated successfully');	
				redirect(base_url("edit-members/$id"));
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
  
  function email_member($member_id)
  {
		
                  $this->db->select('m.*,mt.name')
                          ->from(TBL_MEMBER . ' as `m`')
						  ->join(TBL_MEMBER_TYPE . ' as `mt`' , 'm.member_type_id = mt.member_type_id','left')
                          ->where('m.member_id' , $member_id);
                         
                        $details = $this->db->get()->row_array();

                 
		
		
	  
	                    $store_name = $this->all_function->get_site_options('site_name');
						
						$to = $this->all_function->get_site_options('to_email_address');
						$domain = $this->all_function->get_site_options('domain_name');
						
						$auto_from = $this->all_function->get_site_options('from_email_address');
						$auto_from_name = $this->all_function->get_site_options('from_email_name');
						
						
						$auto_mail = $this->all_function->get_template(13);
						
						$body_auto = $auto_mail["body"];
		
						$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
						$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.get_site_image('upload/logo/original').$this->all_function->get_site_options('logo').'" border="0"/>', $body_auto);		
						$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
						$body_auto			  = str_replace("{MEMBER_ID}", $details['user_name'], $body_auto);	
						$body_auto			  = str_replace("{MEMBER_TYPE}", $details['name'], $body_auto);
						$body_auto			  = str_replace("{COMPANY_NAME}", $details['company_name'], $body_auto);
						$body_auto			  = str_replace("{COMPANY_TYPE}", $details['company_type'], $body_auto);
						$body_auto			  = str_replace("{COMPANY_EMAIL}", $details['company_email'], $body_auto);
						$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);
	  
	  					$auto_subject = $auto_mail["subject"];
						
						//echo  $body_auto;
						
						$this->all_function->batch_email($details['company_email'], $auto_from, $auto_from_name, '', $auto_subject, $body_auto);
						return;
	  
	  
  }
  
}